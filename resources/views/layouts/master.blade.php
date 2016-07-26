<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <title>Stylitics | @yield('title')</title>
  <link rel="stylesheet" type="text/css"
        href="{{asset('assets/css/font-awesome/css/font-awesome.min.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/css.css')}}"/>

  @yield('head.css')
</head>
<body>
<!--header outside class container because header in full screens-->
@include('partials.header')

<div id="content">
  @yield('content')
</div>

@include('partials.footer')
<script type="text/javascript" src="{{asset('assets/js/jquery/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/back-to-top.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/accounting.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/site.js')}}"></script>

<script>
  $(document).ready(function(){
    var content_height = $(window).height() - 348;
    $('#content').css('min-height', content_height + 'px');
    $('#ft_id').show();
  });
</script>

@yield('javascript')


</body>
</html>
