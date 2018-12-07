@if(Session::has('alert') && isset(Session::get('alert')['message']))
    @if(Session::get('alert')['type'] != 'success')
        <div class="alert alert-{{Session::get('alert')['type']}}">
        	{{Session::get('alert')['message']}} 
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        		<span aria-hidden="true">&times;</span>
        	</button>
        </div>
    @endif
@endif
@if(count($errors) > 0)
	<div class="alert alert-danger">
 		<ul>
	    	@foreach ($errors->all() as $error)
	            <li>{{ $error }}</li>
	        @endforeach
        </ul>
    </div>
@endif