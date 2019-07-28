@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    
                <form method="POST" action=" {{ route('register') }} ">
					@csrf
					<input id="fn" name="fn" class="form-control m-2" type="text" placeholder="First Name" required />
					<input id="mn" name="mn" class="form-control m-2" type="text" placeholder="Middle Name" required />
					<input id="ln" name="ln" class="form-control m-2" type="text" placeholder="Last Name" required />
					<select id="role" name="role" class="form-control m-2" required>
                        <option selected disabled> -- Select Department -- </option>
                        <option id="bio-dept" value="Biology" name="bio-dept"> Biology </option>
                        <option id="cs-dept" value="Computer Science" name="cs-dept"> Computer Science </option>
                        <option id="lang-dept" value="Language & Literature" name="lang-dept"> Language & Literature </option>
                        <option id="math-dept" value="Mathematics" name="math-dept"> Mathematics </option>
                        <option id="pe-dept" value="Physical Education" name="pe-dept"> Physical Education </option>
                        <option id="phy-dept" value="Physical Science" name="phy-dept"> Physical Science </option>
                        <option id="soc-dept" value="Social Science" name="soc-dept"> Social Science </option>
						<option id="admin" value="admin" name="admin">CAS Dean</option>
                    </select>
					<hr>
					<input id="email" name="email" class="form-control m-2" type="text" placeholder="User Name" required />
					<input id="password" name="password" class="form-control m-2" type="password" placeholder="Password" required />
					<input id="password-confirm" name="password_confirmation" class="form-control m-2" type="password" placeholder="Confirm Password" required />
					<input class="btn btn-success m-2" type="submit" value="Register" required />
				</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
