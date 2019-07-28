@extends('layouts.app')
@section('content')

	<div class="card mb-5"> 
		<div class="card-header text-white green-card d-print-none"> 
			<div class="float-left"> <h4> Master List - {{ $role }} </h4> </div>
		</div>
		<div class="card-body">
			<div class="input-group d-print-none">
				<input type="text" class="form-control mb-2" name="searchCondemn" placeholder="Search something..." id="searchCondemn"/>
			</div>
			<table class="table">
			<tr>
				<th> @sortablelink('inventory_no', '#') </th>
				<th> Quantity </th>
				<th> Cost </th>
				<th> Total </th>
				<th> Description </th>
				<th> @sortablelink('date', 'Date Acquired') </th>
				@can('isAdmin')
				<th colspan="4"> @sortablelink('role', 'Department') </th>
				@endcan
			</tr>

			<tbody id="condemn-body">
				@if(count($listings) > 0)
				
					@foreach($listings as $listing)
						<tr class="alternate test" data-toggle="tooltip" data-placement="top" title="{{ $listing->reason }}">
							<td>
								{{ $listing->inventory_no }}
							</td>
							<td>
								{{ $listing->quantity }}
							</td>
							<td>
								{{ $listing->cost }}
							</td>
							<td>
								{{ $listing->cost * $listing->quantity }}
							</td>
							<td>
								{{ $listing->description }}
							</td>
							<td>
								{{ $listing->date }}
							</td>
							@can('isAdmin')
								<td>{{ $listing->role->role }}</td>
							@endcan
						</tr>
					@endforeach
					@else
				@endif
			</tbody>
			
			</table>
			@if(count($listings) > 0)
				@can('isAdmin')
					<div class="d-print-none">{{ $listings->links() }}</div>
				@endcan

				
				<a href="{{route('condemn')}}" class="btnprn float-right d-print-none" data-toggle="tooltip" data-placement="top" title="Print"><i class="fas fa-print"></i></a>
			@endif
		</div>
	</div>

@endsection