@extends('layouts.entry')

@section('title','Login An Account')

@section('main')
    <main>
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center py-4">
                        <a href="/" class="logo d-flex align-items-center w-auto">
                            @include('include.logo')
                        </a>
                    </div><!-- End Logo -->


                    {{--Successfully registered--}}
                    @if(!empty($email))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading">Successfully registered</h4>
                        <p>Now you can log in into your panel:
                        <hr>
                        <p class="mb-0">For complete your authentication we sent a verification email link , please check your email inbox and then click on verification link.  </p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    {{--End Successfully registered--}}



                    <div class="card mb-3">

                            <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                <p class="text-center small">Enter your username & password to login</p>
                            </div>

                            <form class="row g-3 needs-validation" novalidate method="post" action="/login">
                                @csrf
                                <div class="col-12">
                                    <label for="email" class="form-label">Your Email</label>
                                    <input type="email" name="email" class="form-control" id="email" required value="@isset($email){{$email}}@endisset">
                                    <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                                </div>
                                {{--<div class="col-12">
                                    <label for="yourUsername" class="form-label">Username</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                                        <div class="invalid-feedback">Please enter your username.</div>
                                    </div>
                                </div>--}}

                                <div class="col-12">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                    <div class="invalid-feedback">Please enter your password!</div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Login</button>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0">Don't have account? <a href="/register">Create an account</a></p>
                                </div>
                            </form>

                        </div>
                    </div>

                    {{--@include('include.licenese')--}}

                </div>
            </div>
        </div>

    </section>
    </main>
@endsection
