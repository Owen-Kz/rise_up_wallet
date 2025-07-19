<?php

namespace Database\Seeders\Fresh;

use App\Models\Admin\BasicSettings;
use Illuminate\Database\Seeder;

class BasicSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'site_name'       => "RiseUp",
            'site_title'      => "Your Ultimate Digital Mobile Wallet Solution",
            'base_color'      => "#600ea3ff",
            'secondary_color'   => "#ffffff",
            'web_version'         => '1.1.0',
            'otp_exp_seconds' => "240",
            'timezone'        => "Asia/Dhaka",
            'broadcast_config'  => [
                "method" => "pusher", 
                "app_id" => "", 
                "primary_key" => "", 
                "secret_key" => "", 
                "cluster" => "ap2" 
            ],
            'push_notification_config'  => [
                "method" => "pusher", 
                "instance_id" => "", 
                "primary_key" => ""
            ],
            'kyc_verification'  => true,
            'mail_config'       => [
                "method" => "smtp",
                "host" => "",
                "port" => "",
                "encryption" => "",
                "username" => "",
                "password" => "",
                "from" => "",
                "app_name" => "RiseUp",
            ],
            'email_verification'    => true,
            'user_registration'     => true,
            'agree_policy'          => true,
            'email_notification'    => true,
            'site_logo_dark'        => "seeder/dark-logo.webp",
            'site_logo'             => "seeder/white-logo.webp",
            'site_fav_dark'         => "seeder/dark-fav.webp",
            'site_fav'              => "seeder/white-fav.webp",
        ];

        BasicSettings::firstOrCreate($data);
    }
}
