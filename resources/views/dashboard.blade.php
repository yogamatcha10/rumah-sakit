@extends('app')
@section('content')
<div class="row">

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Data Positions</div>
                        @csrf
                        @method('GET')
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totaldataposition }}</div>
                </div>
                <div class="col-auto">
                    <i class="fa-solid fa-user-tie fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Data Departements</div>
                        @csrf
                        @method('GET')
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totaldatadepartement }}</div>
                </div>
                <div class="col-auto">
                    <i class="fa-solid fa-building fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Data Users</div>
                        @csrf
                        @method('GET')
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totaldata }}</div>
                </div>
                <div class="col-auto">
                    <i class="fa-solid fa-hospital-user fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
@endsection