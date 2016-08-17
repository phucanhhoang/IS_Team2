@extends('layouts.master')
@section('title')
Stylitics - Announce page
@stop

@section('breadcrumb')
<nav class="container breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    {{ $announce['tit'] }}
</nav>
@stop

@section('content')
<div class="container">
    <div class="col-md-12" style="text-align: center; margin-top: 30px">
        <p>{{ $announce['msg'] }}</p>
        <a href="{{asset('/')}}" class="txt-link">Quay về trang chủ</a>
    </div>
</div>
@stop

@section('javascript')
<script>

</script>
@stop