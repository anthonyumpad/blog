@if(! empty($flash_message))
    <div class="alert alert-{{ $flash_message['status'] }}">
        <div class="layoutContainer">
            <div class="container">
                @if(isset($flash_message['code']))
                    {{ $flash_message['code'] }}
                @else
                    @if( is_array($flash_message['message']))
                        @foreach($flash_message['message'] as $e_message)
                            {{ $e_message }} <br>
                        @endforeach
                    @else
                        {{ $flash_message['message'] }}
                    @endif
                @endif
                {{-- <b>{{ $flash_message['message']}}</b> {{$flash_message['error_fields']}} --}}</div>
        </div>
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif