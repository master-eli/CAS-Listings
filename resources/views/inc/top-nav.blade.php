
<div class="top-nav svg-container d-print-none">

	<div class="container-fluid">
		<div class="left float-left">
			<a href="{{ route('index') }}" class="text-white" style="text-decoration: none"> <h1> CAS <span><small>Inventory System</small></span> </h1>  </a>
		</div>
		<div class="right float-right">
			@guest
				<a href="" data-target="#login" data-toggle="modal"> <div class="navbar-text"> Login </div> </a>
				<a href="" data-target="#register" data-toggle="modal" ><div class="navbar-text"> Register </div> </a>
			@else
				<a href="" data-toggle="dropdown"> 
					{{-- <div class="navbar-text"> <i class="far fa-user"></i> Welcome, {{ $roles }}! --}}
					<div class="navbar-text"> <i class="far fa-user"></i> Welcome! {{ Auth::user()->ln }}
				</div> </a>

				<ul class="dropdown-menu text-dark mt-3 text-center">
					<li>
						<a class="text-dark" href=""> View Profile </a>

					</li>
					<li>
						<a class="text-dark" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
						{{ __('Logout') }}
						</a>
					</li>
				</ul>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
			@endguest

		</div>

	</div>
	
</div>