<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard.partials.style')
    @include('dashboard.partials.chatstyle')
</head>

<body>
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div id="main-wrapper">
        @include('dashboard.layouts.header')
        @include('dashboard.layouts.sidebar')

        <div class="content-body">
            @yield('container')
        </div>

        @include('dashboard.partials.chat')

        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="#">Rida</a> </p>
            </div>
        </div>
    </div>

    @include('dashboard.partials.script')
    @include('dashboard.partials.chatjs')
</body>

</html>
