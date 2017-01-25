@extends('legacy_client_support::layouts.single-page')

@section('head_extra')

    <meta name="robots" content="noindex">

    <link href="{{ asset("/vendor/lesk-modules/legacy_client_support/css/legacy-client-dialog.css") }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

    <header class="flash-explanation push--bottom centered">
        <div class="flash-explanation__content">
            <h3 class="flush">{!! trans('legacy_client_support::general.page.index.please_upgrade', ['app-name' => $app_name]) !!}</h3>
        </div>
    </header>

    <section>

        <p class="flush--bottom">
            {!! trans('legacy_client_support::general.page.index.upgrade_details', ['app-name' => $app_name]) !!}
        </p>

        <ul class="browsers list--unbulleted flush--top">
            <li class="browsers__item">
                <div class="browsers__download browsers__download--chrome">
                    <img src="{{ asset("/vendor/lesk-modules/legacy_client_support/img/chrome.png")}}" height="64" width="64">
                    <h4 class="flush"><a href="http://www.google.com/chrome/" title="Download Google Chrome" class="decorated">Google Chrome</a></h4>
                </div>
            </li>
            <li class="browsers__item">
                <div class="browsers__download browsers__download--firefox">
                    <img src="{{ asset("/vendor/lesk-modules/legacy_client_support/img/firefox.png")}}" height="64" width="64">
                    <h4 class="flush"><a href="http://www.mozilla.com/firefox/" title="Download Mozilla Firefox" class="decorated">Mozilla Firefox</a></h4>
                </div>
            </li>
            <li class="browsers__item">
                <div class="browsers__download browsers__download--safari">
                    <img src="{{ asset("/vendor/lesk-modules/legacy_client_support/img/safari.png")}}" height="64" width="64">
                    <h4 class="flush"><a href="http://www.apple.com/safari/" title="Download Apple Safari" class="decorated">Apple Safari</a></h4>
                </div>
            </li>
            <li class="browsers__item">
                <div class="browsers__download browsers__download--opera">
                    <img src="{{ asset("/vendor/lesk-modules/legacy_client_support/img/opera.png")}}" height="64" width="64">
                    <h4 class="flush"><a href="http://www.opera.com/" title="Opera" class="decorated">Opera</a></h4>
                </div>
            </li>
        </ul>

        <p class="flush--bottom">
            {!! trans('legacy_client_support::general.page.index.upgrade_more_info') !!}
        </p>

        <p class="flush--bottom">
            {!! trans('legacy_client_support::general.page.index.upgrade_compare_browsers') !!}
        </p>

        <p class="flush--bottom">
            {!! trans('legacy_client_support::general.page.index.versions_info', $browser_id) !!}
        </p>

    </section>

@endsection
