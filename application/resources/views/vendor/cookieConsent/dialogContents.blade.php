<div class="fixed-bottom bg-success p-2 text-light text-center js-cookie-consent cookie-consent"
    style="background-color: #2ECC40 !important">

    <span class="cookie-consent__message">
        {{-- {!! trans('cookieConsent::texts.message') !!} --}}
        {{ __('fl.allow-cookie') }}
    </span>

    <button class="btn btn-sm btn-primary js-cookie-consent-agree cookie-consent__agree ml-4">
        {{-- {{ trans('cookieConsent::texts.agree') }} --}}
        {{ __('fl.agree') }}

    </button>

</div>
