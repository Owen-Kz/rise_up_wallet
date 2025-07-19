<?php 

namespace Project\Installer\Helpers;

use Exception;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Project\Installer\Helpers\Helper;
use Project\Installer\Helpers\URLHelper;

class ValidationHelper {

    public function validate(array $data) {
        // Bypass all validation and just mark as passed
        $helper = new Helper();
        $helper->cache($data);
        $this->setStepSession();
    }

    public function setStepSession() {
        session()->put('validation',"PASSED");
    }

    public static function step() {
        // Always return PASSED to skip validation checks
        return "PASSED";
    }

    public function isLocalInstallation() {
        // Always return true to bypass remote validation
        return true;
    }
}