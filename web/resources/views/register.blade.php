@extends('layouts.entry')

@section('title','Register An Account')

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


                    {{--Register Faild--}}
                    @if(!empty($registerErrors))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h4 class="alert-heading">Registration Failed</h4>
                            <ul>
                             @foreach($registerErrors as $registerError)
                                 <li>{{$registerError}}</li>
                             @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    {{--End Successfully registered--}}


                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                <p class="text-center small">Enter your personal details to create account</p>
                            </div>

                            <form class="row g-3 needs-validation" novalidate method="post" action="/register">
                                @csrf
                                <div class="col-12">
                                    <label for="name" class="form-label">Name : </label>
                                    <input type="text" name="name" class="form-control" id="name" required value="@isset($registerData['name']){{$registerData['name']}}@endisset">
                                    <div class="invalid-feedback">Please, enter your name!</div>
                                </div>

                                <div class="col-12">
                                    <label for="lastname" class="form-label">Last Name : </label>
                                    <input type="text" name="lastname" class="form-control" id="lastname" required value="@isset($registerData['lastname']){{$registerData['lastname']}}@endisset">
                                    <div class="invalid-feedback">Please, enter your name!</div>
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label">Email : </label>
                                    <input type="email" name="email" class="form-control" id="email" required  value="@isset($registerData['email']){{$registerData['email']}}@endisset">
                                    <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                                </div>

                                {{--<div class="col-12">
                                    <label for="yourUsername" class="form-label">Username</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                                        <div class="invalid-feedback">Please choose a username.</div>
                                    </div>
                                </div>--}}

                                <div class="col-12">
                                    <label for="password" class="form-label">Password : </label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                    <div class="invalid-feedback">Please enter your password!</div>
                                </div>
                                <div class="col-12">
                                    <label for="confirm_password" class="form-label">Confirm Password : </label>
                                    <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
                                    <div class="invalid-feedback">Please enter your confirmation password!</div>
                                </div>


                                {{--<div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                                        <div class="invalid-feedback">You must agree before submitting.</div>
                                    </div>
                                </div>--}}
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0">Already have an account? <a href="/login">Log in</a></p>
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
