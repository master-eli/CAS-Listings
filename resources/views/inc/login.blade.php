
<div class="modal fade" id="login" tab-index="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role-document>
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"> Login </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true"> &times </span>
				</button>
			</div>

			<div class="modal-body text-center">

				<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
						@csrf

						<input type="text" class="form-control mb-2" placeholder="User Name" name="email" required autofocus />

						<input type="password" class="form-control mb-2" placeholder="Password" name="password" required />

						<button type="submit" class="btn btn-success"> {{ __('Login') }} </button>


				</form>

			</div>

		</div>
	</div>
</div>