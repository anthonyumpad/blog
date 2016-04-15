@if(! empty($flash_message))
    <div class="alert alert-{{ $flash_message['status'] }}">
        <div class="layoutContainer">
            <div class="container">
                @if(isset($flash_message['code']))
                    {{ $flash_message['code'] }}
                @else
                    {{ $flash_message['message'] }}
                @endif
                {{-- <b>{{ $flash_message['message']}}</b> {{$flash_message['error_fields']}} --}}</div>
        </div>
    </div>
@endif