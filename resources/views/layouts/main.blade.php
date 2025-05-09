<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body id="page-top">
    <div id="wrapper">
        @include('partials.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('partials.topbar')

                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            @include('partials.footer')
        </div>
    </div>

    @include('partials.scripts')
</body>
</html>
