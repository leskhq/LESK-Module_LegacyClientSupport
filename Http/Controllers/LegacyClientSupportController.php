<?php
namespace App\Modules\LegacyClientSupport\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;
use Setting;

class LegacyClientSupportController extends Controller
{
    public function index()
    {
        $page_title = trans('legacy_client_support::general.page.index.title');
        $app_name = Setting::get('app.short_name');
        $browser          = Agent::browser();
        $browser_version  = Agent::version($browser);
        $platform         = Agent::platform();
        $platform_version = Agent::version($platform);

        $browser_id = [
            'browser'          => $browser,
            'browser-version'  => $browser_version,
            'platform'         => $platform,
            'platform-version' => $platform_version,
        ];

        return view('legacy_client_support::index', compact('page_title', 'app_name', 'browser_id'));
    }

}
