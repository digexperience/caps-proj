@extends('layouts.master')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                    @forelse ($users as $user)
                        <div class="report-item">
                            <form action="{{ route('records.calendar', ['user' => $user->id]) }}" method="GET">
                                <button type="submit" class="btn filebutton" style="background: none; border: none;">
                                    <div class="row">
                                        <div class="col-xl-10 col-lg-8 col-md-6 col-sm-7 col-6">
                                            <h6 class="">{{$user->fname}} {{$user->mi}}. {{$user->lname}} - {{$user->email}}</h6>
                                        </div>
                                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-5 col-6">
                                            <p class=""><strong>ACTIVITY LOG </strong><br>Last Modified: 10-10-2024</p>
                                        </div>
                                    </div>
                                </button>
                            </form>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No Instructor Account Registered</td>
                        </tr>
                    @endforelse
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection