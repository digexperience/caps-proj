<!-- Add User -->
<div class="modal fade" id="adduser">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 100%; flex-wrap: wrap;">
            <div class="modal-header">
                <h5 class="modal-title"><b>Add New User</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="card-body text-left">
                    <form method="POST" action="{{ route('instructors.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control @error('fname') is-invalid @enderror" placeholder="Enter a First Name" value="{{ old('fname') }}" id="fname" name="fname" required oninput="validateNameFields()">
                            </div>
                            <div class="col-5">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control @error('lname') is-invalid @enderror" placeholder="Enter a Last Name" value="{{ old('lname') }}" id="lname" name="lname" required oninput="validateNameFields()"/>
                            </div>
                            <div class="col-3">
                                <label for="mi">MI</label>
                                <input type="text" class="form-control @error('mi') is-invalid @enderror" placeholder="M.I." value="{{ old('mi') }}" id="mi" name="mi" required oninput="validateNameFields()"/>
                            </div>
                            <div class="col-12">
                                <span id="name-error" class="invalid-feedback" role="alert" style="display: 
                                    @error('fname') block; 
                                    @enderror 
                                    @error('mi') block; 
                                    @enderror 
                                    @error('lname') block; 
                                    @enderror 
                                    @if (!($errors->has('fname') || $errors->has('mi') || $errors->has('lname'))) none; 
                                    @endif">
                                    <strong>Name fields must meet the required criteria.</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Phone Number" id="phone" minlength="11" value="{{ old('phone') }}" maxlength="11" name="phone" required oninput="validatePhone()"/>
                            <span id="phone-error" class="invalid-feedback" role="alert" style="display: none;">
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
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter an Email" required autocomplete="email" autofocus oninput="validateEmail()">
                            <span id="email-error" class="invalid-feedback" role="alert" style="display: none;">
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
                            <select class="form-control" id="status" name="status" @error('status') is-invalid @enderror required>
                                <option value="1" selected>Active</option>
                                <option value="0">Deactive</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" >
                            <label for="image" class="col-form-label">Profile Picture (Optional)</label>
                            <input type="file" class="form-control" name="image" id="image" accept="image/gif, image/jpeg, image/png" @error('image') is-invalid @enderror>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter a Password" required autocomplete="new-password" minlength="8" oninput="validatePassword()">
                            <span id="password-error" class="invalid-feedback" role="alert" style="display: none;">
                                <strong>Password must be at least 8 characters long and contain no spaces.</strong>
                            </span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-success waves-effect waves-light">
                                    Submit
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
</div>
</div>
<script>
    function validatePassword() {
        const passwordInput = document.getElementById('password');
        const errorSpan = document.getElementById('password-error');
        const password = passwordInput.value;

        if (password.length >= 8 && !/\s/.test(password)) {
            errorSpan.style.display = 'none';
            passwordInput.classList.remove('is-invalid');
        } else {
            errorSpan.style.display = 'block';
            passwordInput.classList.add('is-invalid');
        }
    }
</script>
<script>
    function validateNameFields() {
        const fnameInput = document.getElementById('fname');
        const lnameInput = document.getElementById('lname');
        const miInput = document.getElementById('mi');
        const errorSpan = document.getElementById('name-error');
        const errorSpan1 = document.getElementById('name1-error');
        const errorSpan2 = document.getElementById('name2-error');
        const errorSpan3 = document.getElementById('name3-error');
        
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

        if (isValid) {
            errorSpan.style.display = 'none';
        } else {
            errorSpan.style.display = 'block';
        }
    }
</script>
<script>
    function validatePhone() {
        const phoneInput = document.getElementById('phone');
        const errorSpan = document.getElementById('phone-error');
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
</script>
<script>
    function validateEmail() {
        const emailInput = document.getElementById('email');
        const errorSpan = document.getElementById('email-error');
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