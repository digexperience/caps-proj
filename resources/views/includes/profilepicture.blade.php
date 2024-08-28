<div class="modal fade" id="profilepicture">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Upload Profile</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <div class="col-md-12">
                        <img class="rounded-circle mt-5"  width= "150px" height= "150px" id="profile" @if ($user->image == "") src="assets/images/profile.jpg" @elseif ($user->image !== "") src="assets/images/{{$user->image}}" @endif alt="Profile">
                        </div>
                        <div class="form-group col-md-12" >
                            <label for="image" class="col-form-label">Profile Picture</label>
                            <input type="file" class="form-control" name="image" id="image" accept="image/gif, image/jpeg, image/png" onchange="readURL(this);" @error('image') is-invalid @enderror>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                Upload
                            </button>
                            <button type="reset" class="btn btn-danger waves-effect m-l-5" data-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>