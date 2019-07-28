@extends('layouts.app')
@section('content')

		<div class="card mb-5"> 
			<div class="card-header text-white green-card d-print-none">
				<div class="float-left"> <h4> Master List - {{ $role }} </h4> </div>
			</div>
			<div class="card-body">
				<div class="alert alert-danger alert-top" style="display:none"></div>
				<div class="input-group d-print-none">
					<input type="text" class="form-control mb-2" name="search" placeholder="Search something..." id="search"/>
				</div>
				<table class="table">
				<tr>
					<th> @sortablelink('inventory_no', '#')</th>
					<th> Quantity </th>
					<th> Cost </th>
					<th> Total </th>
					<th> Description </th>
					<th> @sortablelink('date', 'Date Acquired')</th>
					@cannot('isAdmin')
					<th colspan="4" class="d-print-none"> Action </th>
					@endcan
					@can('isAdmin')
					<th colspan="4"> @sortablelink('user_id', 'Department') </th>
					@endcan
				</tr>

				<tbody id="table-body" name="table-body">
					
					@foreach($listings as $listing)
						<tr class="alternate" id="listing{{$listing->id}}">
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
							@cannot('isAdmin')
							<td width="5px" class="d-print-none">
								<button class="btn btn-info btn-sm open-modal" value="{{$listing->id}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button>
							</td>
							<td width="5px" class="d-print-none">
								<button class="btn btn-danger btn-sm btn-delete" value="{{$listing->id}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></button>
								
							</td>
							<td width="5px" class="d-print-none">
								<button class="btn btn-warning btn-sm btn-condemn" value="{{$listing->id}}" data-toggle="tooltip" data-placement="top" title="Condemn"><i class="fas fa-minus-circle"></i></button>
							</td>
							@endcan
							@can('isAdmin')
								<td>{{ $listing->role['role'] }}</td>
								{{-- <td>{{ $listing->role->role }}</td> --}}
							@endcan
						</tr>

						
					@endforeach
					
				</tbody>
				
				</table>
				@if(count($listings) > 0)
					@can('isAdmin')
						<div class="d-print-none">{{ $listings->links() }}</div>
					@endcan

					
					<a href="{{route('listings.index')}}" class="btnprn float-right d-print-none" data-toggle="tooltip" data-placement="top" title="Print"><i class="fas fa-print"></i></a>
				@endif
			</div>
		</div>

		<input type="hidden" id="url" value="{{ \Request::url() }}">

		<div class="modal fade" id="myModal" tab-index="-1" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header not-condemn">
						<h5 class="modal-title"> Entry </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"> &times </span>
						</button>
					</div>
					<div class="modal-header is-condemn">
						<h5 class="modal-title"> Condemn Entry ? </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"> &times </span>
						</button>
					</div>
					<div class="modal-body text-center">
						<form id="listingForm" name="listingForm" novalidate="" class="not-condemn"> 
							@csrf
							<input id="inventory_no" name="inventory_no" class="form-control m-2" type="number" placeholder="Inventory #" value="" required>
							<input id="quantity" name="quantity" class="form-control m-2" type="number" placeholder="Quantity" value="" required>
							<input id="cost" name="cost" class="form-control m-2" type="number" placeholder="Unit Cost" value="" required>
							<textarea id="description" name="description" class="form-control m-2" placeholder="Description" value="" required></textarea>
							<input id="date" name="date" class="form-control m-2" type="date" placeholder="Date Acquired" value="" required>
							<input id="condemn" type="hidden" value="0" name="condemn">
							<input id="listing_id" type="hidden" value="0" name="listing_id">
						</form>
						<textarea id="reason" name="reason" class="form-control m-2 is-condemn" placeholder="Reason" value="" required></textarea>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" id="btn-save" value="add" type="submit">Save changes</button>
					</div>
				</div>
			</div>
		</div>

@endsection


