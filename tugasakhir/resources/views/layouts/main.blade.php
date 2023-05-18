<!DOCTYPE html>
<html>
@include('partials.header')
<body>
	
<header class="item header margin-top-0">
@include('partials.navbar')
<div class="container mt-4">
    @yield('container')
</div>

@include('partials.footer')
@include('partials.script')
@include('partials.custom')

</body>
</html>