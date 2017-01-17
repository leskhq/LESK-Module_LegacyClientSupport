<?php
namespace App\Modules\LegacyClientSupport\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AuditRepository as Audit;
use Auth;

class LegacyClientSupportController extends Controller
{
    public function index()
    {
        Audit::log(Auth::user()->id, trans('legacy_client_support::general.audit-log.category'), trans('legacy_client_support::general.audit-log.msg-index'));

        $page_title = trans('legacy_client_support::general.page.index.title');
        $page_description = trans('legacy_client_support::general.page.index.description');

        return view('legacy_client_support::index', compact('page_title', 'page_description'));
    }

}
