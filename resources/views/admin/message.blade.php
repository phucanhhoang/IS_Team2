<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		 @if(Session::has('success'))
		    <div class="alert alert-success">
		        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		        <strong>Success:</strong> {!! Session::get('success') !!}
		    </div>
		@endif
	</div>
</div>
