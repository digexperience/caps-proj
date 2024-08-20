@extends('layouts.master')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-12">
        <a href="#checkstatus" data-toggle="modal" class="btn btn-success btn-sm btn-flat float-right"><i class="mdi mdi-plus"></i> Check Device Status</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                        <table id="datatable-buttons" class="table table-hover table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">          
                        <thead class="thead-dark">
                            <tr>
                            <th style="width: 30%;" data-priority="1"><b>Name</b></th>
                            <th style="width: 30%;" data-priority="2"><b>Email</b></th>
                            <th style="width: 30%;" data-priority="3"><b>Fingerprint</b></th>
                            <th style="width: 10%;" data-priority="4"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->fname }} {{ $user->mi }}. {{ $user->lname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span style="color: {{ $user->fingerprint == 1 ? 'green' : 'red' }};">&#x25CF;</span>
                                    {{ $user->fingerprint == 1 ? 'Registered' : 'Unregistered' }}
                                </td>
                                <td>
                                    @if ($user->fingerprint == 1)
                                        <a class="dropdown-item" href="#edit{{ $user->id }}" data-toggle="modal">
                                            <i class="mdi mdi-fingerprint"></i> Change
                                        </a>
                                        <a class="dropdown-item" href="#delete{{ $user->id }}" data-toggle="modal">
                                            <i class="mdi mdi-fingerprint-off"></i> Deregister
                                        </a>
                                    @else
                                        <a class="dropdown-item" href="#edit{{ $user->id }}" data-toggle="modal">
                                            <i class="mdi mdi-fingerprint"></i> Register
                                        </a>
                                    @endif
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
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection