<!---Contact Button-->
<link href="{{ asset('frontend/assets/contact_button/style.css') }}" rel="stylesheet" type="text/css" />
<div class="social-button">
    <div class="social-button-content">
        @php
        $webinfo = App\Models\Webinfo::first();
        @endphp
        @if ($webinfo->zalo_url && $webinfo->phonebase)
        <a href="{{$webinfo->zalo_url}}" class="zalo" id='contact_zalo' target='_blank'>
            <i></i>
            <span>Zalo: {{ $webinfo->phonebase }} </span>
        </a>

        <a href="tel: {{ $webinfo->phonebase }}" class="call-icon" rel="nofollow" id='contact_phone'>
            <i></i>
            <span>Hotline: {{ $webinfo->phonebase }}</span>
        </a>
        @endif
        @if ($webinfo->facebook_url)
        <a href="{{$webinfo->facebook_url}}" class="sms" id='contact_facebook' target='_blank'>
            <i></i>
            <span>Facebook Messenger</span>
        </a>
        @endif


    </div>
</div>
