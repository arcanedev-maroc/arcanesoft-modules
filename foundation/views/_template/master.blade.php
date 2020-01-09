<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset(mix('css/arcanesoft.css', 'assets')) }}">
    @stack('head')
</head>
<?php
    $classes = [
        'navbar-fixed',
    ];
?>
<body data-skin-mode="{{ session()->get('foundation.skin.mode', 'light') }}"
      data-sidebar-visible="{{ Arcanesoft\Foundation\Helpers\Sidebar\Manager::isVisible() ? 'true' : 'false' }}"
      class="{{ implode(' ', $classes) }}">
    <div id="foundation" class="app-container">
        <div class="wrapper">
            @include(Arcanesoft\Foundation\Core\ViewComposers\SidebarComposer::VIEW)

            <main class="main-container">
                @include('foundation::_template.navbar')

                @include('foundation::_template.page-header')

                <section class="content-wrapper">
                    @include(Arcanesoft\Foundation\Core\ViewComposers\NotificationsComposer::VIEW)

                    @include(Arcanesoft\Foundation\Core\ViewComposers\MetricsComposer::VIEW)

                    @stack('content-nav')

                    @yield('content')
                </section>

                @include('foundation::_template.footer')
            </main>
        </div>

        <toasts-manager-component></toasts-manager-component>
    </div>

    @stack('modals')

    {{-- SCRIPTS --}}
    <script src="{{ asset(mix('js/arcanesoft.js', 'assets')) }}"></script>

    @stack('scripts')

    <script>
        window.Foundation.run()
    </script>
</body>
</html>
