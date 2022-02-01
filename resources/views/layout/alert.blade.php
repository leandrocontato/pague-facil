@if (Session::has('alert'))
    <div class="row">
    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    		<div class="alert alert-{!!session('alert.code')!!} alert-dismissible fade show" role="alert">
			  {!! session('alert.text') !!}
			  <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
    	</div>
    </div>
@endif	