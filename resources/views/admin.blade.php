@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
	                    <table>
	                    	<thead>
	                    		<tr>
	                    			<th>User</th>
	                    			<th>Role</th>
	                    		</tr>
	                    	</thead>
	                    	<tbody>
	                    	@foreach($users as $user)
	                    		<tr>
	                    			<td>{{ $user->name }}</td>
	                    			<td>{{ $user->role }}</td>
	                    			<td>
	                    				<form method="POST" action="{{ route('changeApproval') }}">
											{{ csrf_field() }}
	                    					<input type="hidden" name="username" value="{{$user->name}}">
		                    				@if ($user->role == 'approved')
		                    					<input type="submit" name="" value="unapprove">
		                    				@elseif ($user->role == 'unapproved')
		                    					<input type="submit" name="" value="approve">
		                    				@else
		                    					admin accounts cannot be changed!
		                    				@endif
	                					</form>
	                    			</td>
	                    		</tr>
	                    	@endforeach
	                    	</tbody>
	                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
