<!-- Upload/Update Schedule -->
<div class="modal fade" id="schedule{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>{{ $user->fname }} {{ $user->mi }}. {{ $user->lname }} - Upload/Update Schedule</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('schedules.upload', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    
                    <div class="form-group">
                        <label for="scheduleFile{{ $user->id }}" class="col-form-label">Upload Schedule (Excel)</label>
                        <input type="file" class="form-control @error('scheduleFile') is-invalid @enderror" name="scheduleFile" id="scheduleFile{{ $user->id }}" accept=".xlsx, .xls" required>
                        @error('scheduleFile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Sheet Selection -->
                    <div class="form-group" id="sheetSelection{{ $user->id }}" style="display:none;">
                        <label for="sheetName{{ $user->id }}">Select Sheet</label>
                        <select name="sheetName" class="form-control" id="sheetName{{ $user->id }}">
                            <!-- Options will be dynamically populated -->
                        </select>
                    </div>

                    <div class="modal-footer">
                        @if(in_array($user->id, $sched))
                            <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                            <button type="submit" class="btn btn-warning btn-flat" name="upload" onclick="confirmDelete({{ $user->id }})"><i class="fa fa-check-square-o"></i> Update</button>
                        @else
                            <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                            <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Upload</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Delete Schedule -->
<div class="modal fade" id="deletesched{{$user->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="align-items: center">
                <h4 class="modal-title"><span>Delete Schedule</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('schedules.destroy', $user->id) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div class="text-center">
                        <h6>Are you sure you want to delete the schedule of:</h6>
                        <h2 class="font-weight-bold">{{$user->fname}} {{$user->mi}}. {{$user->lname}}</h2>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
