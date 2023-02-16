@extends('layouts.master')
@section('title', 'Shop')

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
                            <h5 class="card-title">Buy a Strategy</h5>
                            @foreach(\App\Server\Connector::method()->getAllStrategies() as $item)
                            <div class="col-auto">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Strategy</h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-gear-wide-connected"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6><a href="/pay/{{$item['id']}}">{{$item['name']}}</a></h6>
                                                <span class="text-muted small pt-2 ps-1">
                                                    {{$item['description']}}
                                                    <hr>
                                                    Price per month :
                                                </span>
                                                <span class="text-success small pt-1 fw-bold">${{$item['price']}}</span>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
