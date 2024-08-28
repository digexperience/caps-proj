@extends('layouts.master')

@section('content')
<div class="container rounded mt-5 mb-5">
    <div class="row">  
        <div class="col-md-3">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5 profilepic" width= "150px" height= "150px" @if ($user->image == "") src="assets/images/profile.jpg" @elseif ($user->image !== "") src="assets/images/{{$user['image']}}" @endif">
                <div class="media-icons">
                <a href="#uploadprofile" data-toggle="modal" class="btn btn-sm btn-flat float-right"><i class="fa-solid fa-camera"></i></a>
                </div>
                <span class="font-weight-bold">{{$user['fname']}} {{$user['mi']}}. {{$user['lname']}}</span>
            </div>
        </div>
            <div class="col-md-9">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                        <div class="form-group row">
                            <div class="col-5">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control @error('fname') is-invalid @enderror" placeholder="Enter a First Name" value="{{$user->fname}}" id="fname{{$user->id}}" name="fname" required oninput="upvalidateNameFields({{$user->id}})">
                            </div>
                            <div class="col-2">
                                <label for="mi">MI</label>
                                <input type="text" class="form-control @error('mi') is-invalid @enderror" placeholder="M.I." value="{{$user->mi}}" id="mi{{$user->id}}" name="mi" required oninput="upvalidateNameFields({{$user->id}})"/>
                            </div>
                            <div class="col-5">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control @error('lname') is-invalid @enderror" placeholder="Enter a Last Name" value="{{$user->lname}}" id="lname{{$user->id}}" name="lname" required oninput="upvalidateNameFields({{$user->id}})"/>
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
                        <div class="row mt-3">
                            <div class="col-md-12">
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
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                        </div>
                    </Form>
                </div>
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
@include('includes.profilepicture')
@endsection