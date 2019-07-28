@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
						@csrf

						<input id="email" type="text" class="form-control mb-2" placeholder="User Name" name="email" required autofocus />

						<input id="password" type="password" class="form-control mb-2" placeholder="Password" name="password" required />

						<button type="submit" class="btn btn-success"> {{ __('Login') }} </button>


				</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
