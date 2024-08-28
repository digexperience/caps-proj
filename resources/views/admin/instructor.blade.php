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
                            <th><b>Profile Picture</b></th>
                            <th><b>First Name</b></th>
                            <th><b>M.I.</b></th>
                            <th><b>Last Name</b></th>
                            <th><b>Phone Number</b></th>
                            <th><b>Email</b></th>
                            <th><b>Status</b></th>
                            <th style="width: 15%;"></th>
                            <th style="width: 10%;"></th>
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
                                @if(in_array($user->id, $sched))
                                <div class="row">
                                    <div class="col-6 m-0 pr-1">
                                        <a style="width: 100%; color: #FFF !important;" class="btn btn-info m-0" href="{{ route('schedules.view', ['user' => $user->id]) }}">
                                            View
                                        </a>
                                    </div>
                                    <div class="col-6 m-0 pl-1">
                                        <a style="width: 100%; color: #FFF !important;" class="btn btn-danger" href="#deletesched{{ $user->id }}" data-toggle="modal">
                                            Delete
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a style="width: 100%; color: #FFF !important;" class="btn btn-warning mt-2" href="#schedule{{ $user->id }}" data-toggle="modal">
                                            Update Schedule
                                        </a>
                                    </div>
                                </div>
                                @else
                                    <a style="width: 100%; color: #FFF !important;" class="btn btn-success" href="#schedule{{ $user->id }}" data-toggle="modal">
                                        Upload Schedule
                                    </a>
                                @endif
                            </td>

                            <td>
                                <a style="color: #FFF !important;" class="btn btn-info" href="#edit{{ $user->id }}" data-toggle="modal">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                                <a style="color: #FFF !important;" class="btn btn-danger" href="#delete{{ $user->id }}" data-toggle="modal">
                                    <i class="mdi mdi-trash-can-outline"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No Instructor Account Registered</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach ($users as $user)
    @include('includes.editdeleteuser')
    @include('includes.addschedule', ['user' => $user])
@endforeach

@include('includes.adduser')
@include('includes.flash')

<script>
document.addEventListener('DOMContentLoaded', function() {
    @foreach ($users as $user)
        document.getElementById('scheduleFile{{ $user->id }}').addEventListener('change', function(event) {
            let file = event.target.files[0];

            if (file) {
                let formData = new FormData();
                formData.append('scheduleFile', file);

                fetch('{{ route("schedules.getSheets") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.sheets && data.sheets.length > 0) {
                        let sheetSelect = document.getElementById('sheetName{{ $user->id }}');
                        sheetSelect.innerHTML = '';

                        data.sheets.forEach(sheet => {
                            let option = document.createElement('option');
                            option.value = sheet;
                            option.text = sheet;
                            sheetSelect.appendChild(option);
                        });

                        document.getElementById('sheetSelection{{ $user->id }}').style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    @endforeach
});
</script>

@endsection
