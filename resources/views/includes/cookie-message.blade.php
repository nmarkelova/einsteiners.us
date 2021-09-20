<div id="alertcookie" class="uk-cookie" data-uk-alert>
    <div class="uk-flex uk-flex-middle@m uk-grid-collapse" data-uk-grid>
        <div class="uk-width-3-4@xs">
            {{ __('LanCookie1') }} <a href="#cookie" data-uk-toggle onClick="showContent.call(this);event.preventDefault();" data-link="con-cookie" data-load="cookieloading" data-position="cookieBody">{{ __('LanMore') }}</a>
        </div>
        <div class="uk-width-1-4@xs uk-text-right">
            <a href="#" class="uk-button uk-button-border uk-alert-close" onClick="agree_cookie();">Ok</a>
        </div>
    </div>
</div>
