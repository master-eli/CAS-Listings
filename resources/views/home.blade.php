@extends('layouts.app')

@section('content')

    <div class="card"> 
        <div class="card-header text-white green-card">  <h4> CAS Dashboard </h4> </div>
        <div class="card-body">
            <div class="row">
            @if(count($listings) > 0)
                <div class="col-md-4">
                    <canvas id="myChart1" height="50" width="100%"></canvas>
                </div>
                <div class="col-md-4 text-center pt-5">
                    <h6> Registered Users </h6> <span id="bio-badge" class="badge badge-success user"> {{ $total_user }}  </span>
                </div>
                <div class="col-md-4">
                    <canvas id="myChart" height="50" width="100%"></canvas>
                </div>
                @endif
            </div>
        </div>
    </div>

@if(count($listings) > 0)
    <script>
        var condemn = {!! json_encode($condemn_count) !!} ;
        var listings = {!! json_encode($listing_count) !!} ;
        var condemnP = {!! json_encode($condemnPercentage) !!} ;
        var total = {!! json_encode($total) !!} ;
        var counter = Object.values({!! json_encode($counter) !!}) ;
        var roles = Object.values({!! json_encode($roles) !!}) ;

    </script>
@else
@endif
@endsection