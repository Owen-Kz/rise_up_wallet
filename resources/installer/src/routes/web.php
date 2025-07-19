<?php

use App\Http\Middleware\Admin\Localization;
use App\Http\Middleware\StartingPoint;
use Illuminate\Support\Facades\Route;
use Project\Installer\Controllers\BaseController;
use Project\Installer\Helpers\DBHelper;

// Bypass all installation steps and go straight to database config
Route::get('/manual-install', function() {
    // Set all steps as passed in session
    session()->put('requirement_step', 'PASSED');
    session()->put('validation_step', 'PASSED');
    session()->put('database_config', 'PASSED');
    
    return redirect()->route('project.install.database.config');
});
Route::prefix('project/install')->name('project.install.')->withoutMiddleware([StartingPoint::class,Localization::class])->group(function(){
    Route::controller(BaseController::class)->group(function(){
        Route::get('welcome','welcomeView')->name('welcome');
        Route::get('cancel','installationProcessCancel')->name('cancel');

        // Requirements
        Route::get('requirements','requirementsView')->name('requirements');

        // purchase validation area
        Route::get('validation/form','purchaseValidationForm')->name('validation.form');
        Route::post('validation/form/submit','purchaseValidationFormSubmit')->name('validation.form.submit');

        // Database Configuration
        Route::get('database/config','databaseConfigView')->name('database.config');
        Route::post('database/config/submit','databaseConfigSubmit')->name('database.config.submit');

        // Migration
        Route::get('migration/view','migrationView')->name('migration.view');
        Route::post('migration/submit','migrationSubmit')->name('migration.submit');

        // admin setup
        Route::get('admin/account/setting','accountSetup')->name('admin.setup');
        Route::post('admin/account/setting/submit','accountUpdate')->name('admin.setup.submit');

        // Finish 
        Route::get('finish','finish')->name('finish');
    });
});

// Route::get('project/install/reset',function(DBHelper $db) {
//     $db->updateEnv([
//         "PURCHASE_CODE" => "",
//     ]);
//     sleep(1);
//     return redirect()->route('project.install.welcome');
// });