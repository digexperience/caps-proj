@extends('layouts.master')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-md-12 ml-auto">
            <a href="#adduser" data-toggle="modal" class="btn btn-success btn-sm btn-flat float-right"><i class="mdi mdi-plus"></i> Add New Account</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th data-priority="1"><b>Profile Picture</b></th>
                            <th data-priority="2"><b>First Name</b></th>
                            <th data-priority="3"><b>M.I.</b></th>
                            <th data-priority="3"><b>Last Name</b></th>
                            <th data-priority="3"><b>Phone Number</b></th>
                            <th data-priority="4"><b>Email</b></th>
                            <th data-priority="5"><b>Status</b></th>
                            <th data-priority="6"></th>
                            <th style="width: 10%;" data-priority="6"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <img style="display: block; margin: 0 auto;" width="60px"
                                @if (empty($user->image)) src="assets/images/profile-dummy.png" @else src="assets/images/{{$user->image}}" @endif>
                            </td>
                            <td>{{ $user->fname }}</td>
                            <td>{{ $user->mi }}</td>
                            <td>{{ $user->lname }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span style="color: {{ $user->status == 1 ? 'green' : 'red' }};">&#x25CF;</span>
                                {{ $user->status == 1 ? 'Active' : 'Deactive' }}
                            </td>
                            <td>
                                <a class="btn btn-success" href="#schedule{{ $user->id }}" data-toggle="modal">
                                    Upload Schedule
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-info" href="#edit{{ $user->id }}" data-toggle="modal">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                                <a class="btn btn-danger" href="#sched{{ $user->id }}" data-toggle="modal">
                                    <i class="mdi mdi-trash-can-outline"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No Instructor Account Registered</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> <!-- end row -->
@foreach ($users as $user)
    @include('includes.editdeleteuser')
@endforeach
@foreach ($users as $user)
    @include('includes.addschedule')
@endforeach
@include('includes.adduser')
@include('includes.flash')
@endsection