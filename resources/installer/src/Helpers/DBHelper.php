<?php 

namespace Project\Installer\Helpers;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Process\Process;

class DBHelper {

    public function create(array $data) {
        $this->updateEnv([
            'DB_CONNECTION'     => "mysql",
            'DB_HOST'           => $data['host'],
            'DB_PORT'           => $data['port'],
            'DB_DATABASE'       => $data['db_name'],
            'DB_USERNAME'       => $data['db_user'],
            'DB_PASSWORD'       => $data['db_user_password'],
            'PURCHASE_CODE'     => "bypassed", // Add this line
            'APP_MODE'          => "live",     // Add this line
        ]);
        
        $this->setStepSession();
        $this->saveDataInSession($data);

        $helper = new Helper();
        $helper->cache($data);
    }

    // ... [keep all other methods unchanged until updateAccountSettings]

    public function updateAccountSettings(array $data) {
        $helper = new Helper();
        $helper->cache($data);

        // Bypass purchase code check
        $p_code = "bypassed";

        $admin = DB::table('admins')->first();
        if(!$admin) {
            DB::table('admins')->insert([
                'firstname'     => $data['f_name'],
                'lastname'      => $data['l_name'],
                'password'      => password_hash($data['password'],PASSWORD_DEFAULT),
                'email'         => $data['email'],
            ]);
        } else {
            DB::table("admins")->where('id',$admin->id)->update([
                'firstname'     => $data['f_name'],
                'lastname'      => $data['l_name'],
                'password'      => password_hash($data['password'],PASSWORD_DEFAULT),
                'email'         => $data['email'],
            ]);
        }

        $client_host = parse_url(url('/'))['host'];
        $filter_host = preg_replace('/^www\./', '', $client_host);

        if(Schema::hasTable('script')) {
            DB::table('script')->truncate();
            DB::table('script')->insert([
                'client'        => $filter_host,
                'signature'     => $helper->signature($helper->cache()),
            ]);
        }
        
        if(Schema::hasTable('basic_settings')) {
            try {
                DB::table('basic_settings')->where('id',1)->update([
                    'site_name' => $helper->cache()['app_name'] ?? "",
                ]);
            } catch(Exception $e) {
                // Silent fail
            }
        }

        $this->updateEnv([
            'PURCHASE_CODE' => $p_code,
            'APP_MODE'      => "live",
            'APP_DEBUG'     => "false"
        ]);

        $this->setAdminAccountStepSession();
    }

    
    public function setAdminAccountStepSession() {
        session()->put('admin_account','PASSED');
    }

    public static function execute($cmd): string
    {
        $process = Process::fromShellCommandline($cmd);

        $processOutput = '';

        $captureOutput = function ($type, $line) use (&$processOutput) {
            $processOutput .= $line;
        };

        $process->setTimeout(null)
            ->run($captureOutput);

        if ($process->getExitCode()) {
            throw new Exception($cmd . " - " . $processOutput);
        }

        return $processOutput;
    }
}