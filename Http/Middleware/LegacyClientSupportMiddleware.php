<?php

namespace App\Modules\LegacyClientSupport\Http\Middleware;

use App\Libraries\Utils;
use Closure;
use Jenssegers\Agent\Facades\Agent;
use Log;
use Setting;
use Laracasts\Flash\Flash;

class LegacyClientSupportMiddleware
{
    const BEHAVIOUR_ALLOW  = "allow";
    const BEHAVIOUR_WARN   = "warn";
    const BEHAVIOUR_BLOCK  = "block";

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $exempt = false;

        $legacyClientSupportEnabled = Setting::get('legacy_client_support.enabled', false);

        if ($legacyClientSupportEnabled) {

            $browser          = Agent::browser();
            $browser_version  = Agent::version($browser);
            $platform         = Agent::platform();
            $platform_version = Agent::version($platform);

            $browser_info = "Web browser [".$browser."], version [".$browser_version."], platform [".$platform."], platfomr version [".$platform_version."].";
            Log::debug($browser_info);

            $behaviour = $this->getBehaviour($browser, $browser_version);

            switch ($behaviour) {
                case LegacyClientSupportMiddleware::BEHAVIOUR_BLOCK:
                    if (!$this->isExempt($request)) {
                        $request->session()->reflash();
                        return redirect()->route('legacy_client_support.index');
                    }
                    break;
                case LegacyClientSupportMiddleware::BEHAVIOUR_WARN:
                    $app_name = Setting::get('app.short_name');
                    $parms = [
                        'app-name'         => $app_name,
                        'browser'          => $browser,
                        'browser-version'  => $browser_version,
                        'platform'         => $platform,
                        'platform-version' => $platform_version,
                    ];
                    Flash::warning(trans('legacy_client_support::general.unsupported-client-warning', $parms));
                    break;
                case LegacyClientSupportMiddleware::BEHAVIOUR_ALLOW:
                    break;
            }

        }

        return $next($request);
    }

    /**
     * @param $request
     * @return bool
     */
    public function isExempt($request)
    {
        $exempt = false;

        $exemptionPath = Setting::get('legacy_client_support.exemptions-path');
        $exemptionsRegEx = Setting::get('legacy_client_support.exemptions-regex');

        $requestPath = $request->path();

        foreach ($exemptionPath as $exPath) {
            if ($exPath == $requestPath) {
                $exempt = true;
                break;
            }
        }
        if (!$exempt) {
            foreach ($exemptionsRegEx as $regEx) {
                if (preg_match($regEx, $requestPath)) {
                    $exempt = true;
                    break;
                }
            }
        }
        return $exempt;
    }

    /**
     * @param $browser
     * @param $browser_version
     * @return string
     */
    public function getBehaviour($browser, $browser_version)
    {
        $default_behaviour = Setting::get('legacy_client_support.behaviour.default', 'block');
        $command = $browser_default_behaviour = $default_behaviour;
        $match_found = false;

        $browser_rules = Setting::get('legacy_client_support.behaviour.' . $browser);
        if (!is_null($browser_rules) && is_array($browser_rules)) {
            foreach ($browser_rules as $ver => $cmd) {
                if ($match_found) {
                    break;
                } elseif ('default' === $ver) {
                    $browser_default_behaviour = $cmd;
                } else {
                    $op = '=';
                    $first_char = substr($ver, 0, 1);
                    if (('<' === $first_char) || ('>' === $first_char) || ('=' === $first_char)) {
                        $op = $first_char;
                        $ver = substr($ver, 1, strlen($ver)-1);
                    }
                    $numver = Utils::correctType($ver);

                    switch ($op) {
                        case '<':
                            if ($browser_version < $numver) {
                                $command = $cmd;
                                $match_found = true;
                            }
                            break;
                        case '>':
                            if ($browser_version > $numver) {
                                $command = $cmd;
                                $match_found = true;
                            }
                            break;
                        case '=':
                            if ($browser_version == $numver) {
                                $command = $cmd;
                                $match_found = true;
                            }
                            break;
//                    default:
//                        break;
                    }
                }
            }
        }
        if (!$match_found) {
            $command = $browser_default_behaviour;
            return $command;
        }
        return $command;
    }
}
