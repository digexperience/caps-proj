@extends('layouts.master')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-12">
            <h4 class="text-left">{{$user->fname}} {{$user->mi}}. {{$user->lname}}</h4> 
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mt-2 mb-0">
            <div class="card-body card-head d-flex justify-content-between align-items-center p-2">
                <a class="btn m-0 p-0 arr" href="{{ route('records.changeMonth', ['direction' => 'previous', 'month' => $month, 'year' => $year, 'id' => $user->id]) }}">
                    <i class="mdi mdi-menu-right mdi-36px"></i>
                </a>
                <h5 class="text-center m-0 display-4">{{ Carbon\Carbon::createFromDate($year, $month, 1)->format('F') }} {{ $year }}</h5>
                @if ($current == 0)
                <a class="btn m-0 p-0 arr" href="{{ route('records.changeMonth', ['direction' => 'next', 'month' => $month, 'year' => $year, 'user' => $user->id]) }}">
                    <i class="mdi mdi-menu-right mdi-36px"></i>
                </a>
                @else
                <a class="btn m-0 p-0 arr disabled" href="">
                    <i class="mdi mdi-menu-right mdi-36px"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-7-custom"><div class="card mb-0 cus"><div class="card-body p-0"><h5 class="text-center">Mon</h5></div></div></div>
    <div class="col-7-custom"><div class="card mb-0 cus"><div class="card-body p-0"><h5 class="text-center">Tue</h5></div></div></div>
    <div class="col-7-custom"><div class="card mb-0 cus"><div class="card-body p-0"><h5 class="text-center">Wed</h5></div></div></div>
    <div class="col-7-custom"><div class="card mb-0 cus"><div class="card-body p-0"><h5 class="text-center">Thu</h5></div></div></div>
    <div class="col-7-custom"><div class="card mb-0 cus"><div class="card-body p-0"><h5 class="text-center">Fri</h5></div></div></div>
    <div class="col-7-custom"><div class="card mb-0 cus"><div class="card-body p-0"><h5 class="text-center">Sat</h5></div></div></div>
    <div class="col-7-custom"><div class="card mb-0 cus"><div class="card-body p-0"><h5 class="text-center">Sun</h5></div></div></div>
</div>

<div class="row pt-2 cont">
    @foreach ($calendar as $day)
        @if ($day)
            <div class="col-7-custom hover-target">
                <a href="{{ route('records.report', ['day' => $day, 'month' => $month, 'year' => $year]) }}">
                    <div class="card cal box">
                        <div class="card-body">
                            <h5 class="font-16 text-uppercase mt-0 text-white">5 reports</h5>
                            <h3 class="font-500 float-right mt-0 text-white">{{ $day }} </h3>
                        </div>
                    </div>
                </a>
            </div>
        @else
            <div class="col-7-custom nothover-target">
                <div class="card cal box"></div>
            </div>
        @endif
    @endforeach
</div>
@endsection
