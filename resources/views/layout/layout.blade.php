<!-- Stored in resources/views/layouts/app.blade.php -->
@section('head')
    @include('includes.head')

@section('sidebar')
    @include('includes.sidebar')

@section('menu')
    @include('includes.menu')
    
@show
<div class="content-wrapper">
    @yield('content')
</div>

@section('footer')
@include('includes.footer')
   