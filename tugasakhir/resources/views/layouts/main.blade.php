<!DOCTYPE html>
<html>
@include('partials.header')
@include('partials.chatstyle')
<body>
	
<header class="item header margin-top-0">
@include('partials.navbar')
<div class="container mt-4">
    @yield('container')
</div>

@include('partials.chat')
@include('partials.footer')
@include('partials.script')
@include('partials.custom')
@include('partials.chatjs')

</body>
</html>