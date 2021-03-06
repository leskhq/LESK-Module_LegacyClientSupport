<?php namespace App\Modules\LegacyClientSupport\Utils;

use App\Libraries\Arr;
use DB;
use Illuminate\Database\Schema\Blueprint;
use Schema;
use Sroutier\LESKModules\Contracts\ModuleMaintenanceInterface;
use Sroutier\LESKModules\Traits\MaintenanceTrait;
use Setting;

class LegacyClientSupportMaintenance implements ModuleMaintenanceInterface
{

    use MaintenanceTrait;


    static public function initialize()
    {
        self::publishAsset('LegacyClientSupport', 'legacy_client_support');

//        DB::transaction(function () {
//
//            /////////////////////////////////////////////////
//            // Build database or run migration.
////            self::buildDB();
////            self::migrate('legacy_client_support');
//
//            /////////////////////////////////////////////////
//            // Seed the database.
////            self::seed('legacy_client_support');
//
//
//            //////////////////////////////////////////
//            // Create permissions.
//            $permUseLegacyClientSupport = self::createPermission(  'use-legacy_client_support',
//                'Use the LegacyClientSupport module',
//                'Allows a user to use the LegacyClientSupport module.');
//            ///////////////////////////////////////
//            // Register routes.
//            $routeHome = self::createRoute( 'legacy_client_support.index',
//                'legacy_client_support',
//                'App\Modules\LegacyClientSupport\Http\Controllers\LegacyClientSupportController@index',
//                $permUseLegacyClientSupport );
//
//            ////////////////////////////////////
//            // Create roles.
//            self::createRole( 'legacy_client_support-users',
//                'LegacyClientSupport Users',
//                'Users of the LegacyClientSupport module.',
//                [$permUseLegacyClientSupport->id] );
//
//            ////////////////////////////////////
//            // Create menu system for the module
//            $menuToolsContainer = self::createMenu( 'tools-container', 'Tools', 10, 'fa fa-folder', 'home', true );
//            self::createMenu( 'legacy_client_support.index', 'LegacyClientSupport', 0, 'fa fa-file', $menuToolsContainer, false, $routeHome );
//        }); // End of DB::transaction(....)
    }


    static public function unInitialize()
    {
//        DB::transaction(function () {
//
//            self::destroyMenu('legacy_client_support.index');
//            self::destroyMenu('tools-container');
//
//            self::destroyRole('legacy_client_support-users');
//
//            self::destroyRoute('legacy_client_support.index');
//
//            self::destroyPermission('use-legacy_client_support');
//
//            /////////////////////////////////////////////////
//            // Destroy database or rollback migration.
////            self::rollbackMigration('legacy_client_support');
////            self::destroyDB();
//
//        }); // End of DB::transaction(....)
    }


    static public function enable()
    {
        $exemptionPath   = Setting::get('walled-garden.exemptions-path');

        if (!is_null($exemptionPath) && is_array($exemptionPath)) {
            if (!in_array('legacy_client_support', $exemptionPath)) {
                $exemptionPath[] = 'legacy_client_support';
                Setting::set('walled-garden.exemptions-path', $exemptionPath);
            }
        }

        Setting::set('legacy_client_support.enabled', true);

//        DB::transaction(function () {
//            self::enableMenu('legacy_client_support.index');
//        });
    }


    static public function disable()
    {
        $exemptionPath   = Setting::get('walled-garden.exemptions-path');

        if (!is_null($exemptionPath) && is_array($exemptionPath)) {
            if (in_array('legacy_client_support', $exemptionPath)) {
                $exemptionPath = Arr::remove_value($exemptionPath, 'legacy_client_support');
                Setting::set('walled-garden.exemptions-path', $exemptionPath);
            }
        }

        Setting::set('legacy_client_support.enabled', false);

//        DB::transaction(function () {
//            self::disableMenu('legacy_client_support.index');
//        });
    }


    static public function buildDB()
    {
        // Add code to build database and tables as needed.
    }


    static public function destroyDB()
    {
        // Add code to destroy database and tables as needed.
    }

}