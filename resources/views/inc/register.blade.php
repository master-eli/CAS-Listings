<div class="modal fade" id="register" tab-index="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role-document>
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"> Register </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true"> &times </span>
				</button>
			</div>
			<div class="modal-body text-center">
				<form method="POST" action=" {{ route('register') }} ">
					@csrf
					<input id="fn" name="fn" class="form-control m-2" type="text" placeholder="First Name" required />
					<input id="mn" name="mn" class="form-control m-2" type="text" placeholder="Middle Name" required />
					<input id="ln" name="ln" class="form-control m-2" type="text" placeholder="Last Name" required />
					<select id="role_id" name="role_id" class="form-control m-2" required>
                        <option selected disabled> -- Select Department -- </option>
						@foreach(App\Role::all() as $role)
							<option id="{{$role->id}}" value="{{$role->id}}" name="{{$role->role}}"> {{$role->role}} </option>
						@endforeach
                    </select>
					<hr>
					<input name="email" class="form-control m-2" type="text" placeholder="User Name" required />
					<input name="password" class="form-control m-2" type="password" placeholder="Password" required />
					<input name="password_confirmation" class="form-control m-2" type="password" placeholder="Confirm Password" required />
					<input class="btn btn-success m-2" type="submit" value="Register" required />
				</form>
			</div>
		</div>
	</div>
</div>