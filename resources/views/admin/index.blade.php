@extends('layouts.master')

@section('content')
<div class="page-title-box">
    <!-- <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title text-left">Dashboard</h4> 
        </div>
    </div> -->
</div>
<div class="row">
    <div class="col-xl-3 col-md-3">
        <div class="card text-white" style="background-color: #c24d93;">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <span class="ti-id-badge" style="font-size: 30px"></span>
                    </div>
                    <h5 class="font-16 text-uppercase mt-0 text-white">Keys</h5>
                </div>
                <h1 class="font-500 float-right">2 </h1>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card text-white" style="background-color: #c24d93;">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <i class=" ti-check-box " style="font-size: 30px"></i>
                    </div>
                    <h5 class="font-16 text-uppercase mt-0 text-white">Present</h5>
                </div>   
                <h1 class="font-500 float-right">1 <i class=" text-success ml-2"></i></h1>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card text-white" style="background-color: #c24d93;">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <i class=" ti-check-box " style="font-size: 30px"></i>
                    </div>
                    <h5 class="font-16 text-uppercase mt-0 text-white">Overdue</h5>
                </div>   
                <h1 class="font-500 float-right">0 <i class=" text-success ml-2"></i></h1>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card text-white" style="background-color: #c24d93;">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <i class=" ti-check-box " style="font-size: 30px"></i>
                    </div>
                    <h5 class="font-16 text-uppercase mt-0 text-white">Alarm</h5>
                </div>   
                <h1 class="font-500 float-right">0 <i class=" text-success ml-2"></i></h1>
            </div>
        </div>
    </div>
</div>
@endsection