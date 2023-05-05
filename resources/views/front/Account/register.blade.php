@extends('front.layout.master')
@section('title', 'Register')
@section('content')
    <!-- Breadcrumb section begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{ route('home.index') }}"><i class="fa fa-home"></i>Home</a>
                        <span>Register</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb section end -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Register</h2>
                        @if (session('notification'))
                            <div class="alert alert-warning">
                                {{ session('notification') }}
                            </div>
                        @endif
                        <form action="{{ route('postRegister.index') }}" method="post">
                            @csrf
                            <div class="group-input">
                                <label for="name">Name *</label>
                                <input name="name" type="text" id="name">
                            </div>
                            <div class="group-input">
                                <label for="email">Email address *</label>
                                <input name="email" type="text" id="email">
                            </div>
                            <div class="group-input">
                                <label for="pass">Password *</label>
                                <input name="password" type="text" id="pass">
                            </div>
                            <div class="group-input">
                                <label for="con-pass">Confirm Password *</label>
                                <input name="password_confirmation" type="text" id="con-pass">
                            </div>
                            <input type="submit" class="site-btn btn register-btn" value="REGISTER" />
                        </form>
                        <div class="switch-login">
                            <a href="{{ route('login.index') }}" class="or-login">Or Login </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Section End -->
@endsection
