@extends('layouts.master')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-12">
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm btn-flat float-right">
                <i class="mdi mdi-arrow-left"></i> Back
            </a>
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
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                    <th>Thursday</th>
                                    <th>Friday</th>
                                    <th>Saturday</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($timeSlots as $timeSlot)
                                    <tr>
                                        <td>{{ $timeSlot }}</td>
                                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                            <td>
                                                @php
                                                    $schedule = $schedules->where('time_slot', $timeSlot)->where('day', $day)->first();
                                                @endphp
                                                @if($schedule)
                                                    {{ $schedule->section }}<br>
                                                    {{ $schedule->room }}
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection
