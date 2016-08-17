<h3 style="font-size:18px">Welcome to Stylitics!</h3>
<p>Click here to reset your password:</p>
<p><a href="{{ $link = url('auth/password/reset', $token).'?email='.$email }}"
      target="_blank">{{ $link }}</a></p>

<div style="margin-top:20px">
    <img src="{{asset('assets/image/logo.png')}}" style="width:80px" alt="Stylitics">
</div>
