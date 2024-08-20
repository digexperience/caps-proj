<!-- Edit -->
<div class="modal fade" id="edit{{$user->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>{{ $user->fname }} {{ $user->mi }}. {{ $user->lname }} - Edit Instructor Profile</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('instructors.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <div class="col-4">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control @error('fname') is-invalid @enderror" placeholder="Enter a First Name" value="{{$user->fname}}" id="fname{{$user->id}}" name="fname" required oninput="upvalidateNameFields({{$user->id}})">
                        </div>
                        <div class="col-5">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control @error('lname') is-invalid @enderror" placeholder="Enter a Last Name" value="{{$user->lname}}" id="lname{{$user->id}}" name="lname" required oninput="upvalidateNameFields({{$user->id}})"/>
                        </div>
                        <div class="col-3">
                            <label for="mi">MI</label>
                            <input type="text" class="form-control @error('mi') is-invalid @enderror" placeholder="M.I." value="{{$user->mi}}" id="mi{{$user->id}}" name="mi" required oninput="upvalidateNameFields({{$user->id}})"/>
                        </div>
                        <div class="col-12">
                            <span id="name-error{{$user->id}}" class="invalid-feedback" role="alert" style="display: none;">
                                <strong>Name fields must meet the required criteria.</strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Phone Number" id="phone{{$user->id}}" minlength="11" value="{{ $user->phone }}" maxlength="11" name="phone" required oninput="upvalidatePhone({{$user->id}})"/>
                        <span id="phone-error{{$user->id}}" class="invalid-feedback" role="alert" style="display: none;">
                            <strong>Phone number must start with '09' and be exactly 11 digits long.</strong>
                        </span>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email{{$user->id}}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" placeholder="Enter an Email" required autocomplete="email" autofocus oninput="upvalidateEmail({{$user->id}})">
                        <span id="email-error{{$user->id}}" class="invalid-feedback" role="alert" style="display: none;">
                            <strong>Please enter a valid email address.</strong>
                        </span>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status" class="control-label">Status</label>
                        <select class="form-control" id="status{{$user->id}}" name="status" value="{{$user->status}}" @error('status') is-invalid @enderror required>
                            <option value="1" {{ $user->status == '1'  ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $user->status == '0'  ? 'selected' : '' }}>Deactive</option>
                        </select>
                        @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-form-label">Profile Picture (Optional)</label>
                        <input type="file" class="form-control" name="image" id="image{{$user->id}}" accept="image/gif, image/jpeg, image/png" @error('image') is-invalid @enderror>
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" class="form-control" id="password{{$user->id}}" name="password" placeholder="Enter a Password" autocomplete="new-password" minlength="8" oninput="upvalidatePassword({{$user->id}})">
                        <span id="password-error{{$user->id}}" class="invalid-feedback" role="alert" style="display: none;">
                            <strong>Password must be at least 8 characters long and contain no spaces.</strong>
                        </span>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete{{$user->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="align-items: center">
                <h4 class="modal-title"><span>Delete User Account</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('instructors.destroy', $user->id) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div class="text-center">
                        <h6>Are you sure you want to delete:</h6>
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

<script>
    function upvalidatePassword(userId) {
        const passwordInput = document.getElementById('password' + userId);
        const errorSpan = document.getElementById('password-error' + userId);
        const password = passwordInput.value;

        if (password.length >= 8 && !/\s/.test(password)) {
            errorSpan.style.display = 'none';
            passwordInput.classList.remove('is-invalid');
        } else {
            errorSpan.style.display = 'block';
            passwordInput.classList.add('is-invalid');
        }
    }

    function upvalidateNameFields(userId) {
        const fnameInput = document.getElementById('fname' + userId);
        const lnameInput = document.getElementById('lname' + userId);
        const miInput = document.getElementById('mi' + userId);
        const errorSpan = document.getElementById('name-error' + userId);
        const regex = /^[\p{L}\s\-.]+$/u;
        let isValid = true;

        if (fnameInput.value.length < 3 || fnameInput.value.length > 255 || !regex.test(fnameInput.value)) {
            fnameInput.classList.add('is-invalid');
            isValid = false;
        } else {
            fnameInput.classList.remove('is-invalid');
        }

        if (lnameInput.value.length < 2 || lnameInput.value.length > 255 || !regex.test(lnameInput.value)) {
            lnameInput.classList.add('is-invalid');
            isValid = false;
        } else {
            lnameInput.classList.remove('is-invalid');
        }

        if (miInput.value.length > 2 || !regex.test(miInput.value)) {
            miInput.classList.add('is-invalid');
            isValid = false;
        } else {
            miInput.classList.remove('is-invalid');
        }

        errorSpan.style.display = isValid ? 'none' : 'block';
    }

    function upvalidatePhone(userId) {
        const phoneInput = document.getElementById('phone' + userId);
        const errorSpan = document.getElementById('phone-error' + userId);
        const phoneValue = phoneInput.value;

        phoneInput.value = phoneValue.replace(/[^0-9]/g, '');

        if (phoneInput.value.length === 11 && phoneInput.value.startsWith('09')) {
            errorSpan.style.display = 'none';
            phoneInput.classList.remove('is-invalid');
        } else {
            errorSpan.style.display = 'block';
            phoneInput.classList.add('is-invalid');
        }
    }

    function upvalidateEmail(userId) {
        const emailInput = document.getElementById('email' + userId);
        const errorSpan = document.getElementById('email-error' + userId);
        const emailValue = emailInput.value;

        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (emailPattern.test(emailValue)) {
            errorSpan.style.display = 'none';
            emailInput.classList.remove('is-invalid');
        } else {
            errorSpan.style.display = 'block';
            emailInput.classList.add('is-invalid');
        }
    }
</script>
