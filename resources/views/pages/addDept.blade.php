@extends('layouts.app')
@section('content')

		<div class="card mb-5"> 
			{{-- <div class="card-header text-white green-card d-print-none"> 
				<div class="float-left"> <h4> Master List - {{ $role }} </h4> </div>
			</div> --}}
			<div class="card-body">
				<div class="alert alert-danger alert-top" style="display:none"></div>
				<table class="table">
				<tr>
					<th> Department</th>
				</tr>

				<tbody id="department-body" name="table-body">
					
					@foreach($departments as $department)
						<tr class="alternate" id="role{{$department->id}}">
							<td>
								{{ $department->role }}
							</td>
						</tr>
					@endforeach
					
				</tbody>
				</table>
                <button class="btn btn-info btn-sm add-dept" data-toggle="tooltip" data-placement="top" title="Add Department"><i class="fas fa-add">Add Department</i></button>
			</div>
		</div>

		<input type="hidden" id="url" value="{{ \Request::url() }}">

		<div class="modal fade" id="dept-modal" tab-index="-1" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"> Add Department </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"> &times </span>
						</button>
					</div>
					<div class="modal-body text-center">
						<form id="deptForm" name="deptForm"> 
							@csrf
							<input id="department_name" name="department_name" class="form-control m-2" type="text" placeholder="Department Name" value="">
						</form>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" id="btn-save-dept" value="add-dept" type="submit">Save changes</button>
					</div>
				</div>
			</div>
		</div>

@endsection


