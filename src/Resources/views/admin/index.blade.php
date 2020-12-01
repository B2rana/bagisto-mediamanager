@extends('mediamanager::admin.layouts.master')

@section('page_title')
    {{ __('mediamanager::app.admin.menu.title') }}
@stop

@section('css')
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <!-- elFinder CSS (REQUIRED) -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/mediamanager/css/elfinder.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/mediamanager/css/theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/mediamanager/custom/style.css') }}">
@stop

@section('content')
    <div class="content" style="height: 100%;">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('mediamanager::app.admin.menu.heading') }}</h1>
            </div>
        </div>

        <div class="page-content">
            <div id="elfinder"></div>
        </div>

    </div>
@stop

@push('scripts')
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="{{ asset('vendor/mediamanager/js/elfinder.min.js') }}"></script>

    <!-- elFinder initialization (REQUIRED) -->
    <script type="text/javascript" charset="utf-8">
        $().ready(function() {

            $('#elfinder').elfinder({
                customData: { 
                    _token: '{{ csrf_token() }}'
                },
                baseUrl: '/vendor/mediamanager/',
                url : '{{ route("elfinder.connector") }}',
                soundPath: '{{ asset('vendor/mediamanager/sounds') }}',
                resizable: false,
                height: '770px',
                defaultView: 'icons',
                bootCallback : function(fm) {
                    fm.bind('init', function() {
                        fm._commands.quicklook.getstate = function() {
                            return -1;
                        }
                    });
                }
            });
        });
    </script>
@endpush