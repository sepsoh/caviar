@extends('layouts.master')
@section('title', 'Home')

@section('header')
    @include('include.header')
@endsection


@section('main')
<main id="main" class="main">
    <section class="section">
        @if(!empty($query))
            <div class="card-body">
                <h5 class="card-title">
                    Search Results :
                </h5>
                <!-- List group with custom content -->
                <div class="list-group">
                    <a href="#" class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{$query}}
                                <span class="badge bg-primary rounded-pill ">FAKE RESULT</span>
                            </div>

                            {{--
                                                    <span class="badge bg-black rounded-pill ">Price 0</span>
                            --}}
                        </div>
                    </a>
                    <a href="#" class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">

                            <div class="fw-bold">
                                Apple Corporation
                                <span class="badge bg-primary rounded-pill ">APPL</span>
                            </div>

                            {{--
                                                    <span class="badge bg-black rounded-pill ">Price $3658</span>
                            --}}
                        </div>
                    </a>
                    <a href="#" class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Nokia Technologies
                                <span class="badge bg-primary rounded-pill ">NKA</span>
                            </div>
                            {{--
                                                    <span class="badge bg-black rounded-pill ">Price $308</span>
                            --}}
                        </div>
                    </a>
                    <a href="#" class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">NVIDA Lab
                                <span class="badge bg-primary rounded-pill ">NVDA</span>
                            </div>
                            {{--
                                                    <span class="badge bg-black rounded-pill ">Price $55</span>
                            --}}
                        </div>
                    </a>
                </div><!-- End with custom content -->
            </div>
        @endif
    </section>
</main>
@endsection
