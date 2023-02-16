@extends('layouts.master')
@section('title', 'Payment')

@section('header')
    @include('include.header')
@endsection


@section('main')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Complete Payment</h5>
                            <div class="col-auto">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        @php
                                        $strategy = [];
                                        foreach(\App\Server\Connector::method()->getAllStrategies() as $item){
                                               if($item['id'] == $id){
                                                   $strategy = $item;

                                               }

                                        }

                                        @endphp
                                        <h5 class="card-title">{{$strategy['name']}}</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-credit-card"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>Pay with credit card</h6>
                                                <span class="text-muted small pt-2 ps-1">
                                                    Price per month :
                                                </span>
                                                <span class="text-success small pt-1 fw-bold">${{$strategy['price']}}</span>
                                                <div class="col-sm-10">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected="">1 Month</option>
                                                    <option value="1">3 Month</option>
                                                    <option value="2">6 Month</option>
                                                    <option value="3">1 Year</option>
                                                </select>
                                                    <br>
                                                </div>
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-primary">Pay with credit card</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
