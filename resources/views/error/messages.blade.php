@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            {!! $error !!}<br/>
        @endforeach
    </div>
@elseif (session()->get('flash_success'))

        @if(is_array(json_decode(session()->get('flash_success'), true)))
            @section('notify-scripts')
                <script>
                    $.notify({
                        message: '{!! implode('', Session::get('flash_success')->all(':message<br/>')) !!}'
                    },{
                        type: 'success'
                    });
                </script>
            @endsection
        @else
            @section('notify-scripts')
                <script>
                    $.notify({
                        message: '{!! Session::get('flash_success') !!}'
                    },{
                        type: 'success'
                    });
                </script>
            @endsection
        @endif

@elseif (session()->get('flash_warning'))

        @if(is_array(json_decode(session()->get('flash_warning'), true)))
            @section('notify-scripts')
                <script>
                    $.notify({
                        message: '{!! implode('', Session::get('flash_warning')->all(':message<br/>')) !!}'
                    },{
                        type: 'warning'
                    });
                </script>
            @endsection
        @else
            @section('notify-scripts')
                <script>
                    $.notify({
                        message: '{!! Session::get('flash_warning') !!}'
                    },{
                        type: 'warning'
                    });
                </script>
            @endsection
        @endif

@elseif (session()->get('flash_info'))

        @if(is_array(json_decode(session()->get('flash_info'), true)))
            @section('notify-scripts')
                <script>
                    $.notify({
                        message: '{!! implode('', Session::get('flash_info')->all(':message<br/>')) !!}'
                    },{
                        type: 'info'
                    });
                </script>
            @endsection
        @else
            @section('notify-scripts')
                <script>
                    $.notify({
                        message: '{!! Session::get('flash_info') !!}'
                    },{
                        type: 'info'
                    });
                </script>
            @endsection
        @endif

@elseif (session()->get('flash_danger'))

        @if(is_array(json_decode(session()->get('flash_danger'), true)))
            @section('notify-scripts')
                <script>
                    $.notify({
                        message: '{!! implode('', Session::get('flash_danger')->all(':message<br/>')) !!}'
                    },{
                        type: 'danger'
                    });
                </script>
            @endsection
        @else
            @section('notify-scripts')
                <script>
                    $.notify({
                        message: '{!! Session::get('flash_danger') !!}'
                    },{
                        type: 'danger'
                    });
                </script>
            @endsection
        @endif

@elseif (session()->get('flash_message'))
    <div class="alert alert-info">
        @if(is_array(json_decode(session()->get('flash_message'), true)))
            {!! implode('', session()->get('flash_message')->all(':message<br/>')) !!}
        @else
            {!! session()->get('flash_message') !!}
        @endif
    </div>
@endif