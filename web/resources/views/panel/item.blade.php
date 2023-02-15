@extends('layouts.master')
@section('title', $item.' Info')

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
        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Sales <span>| Today</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{\App\Server\Connector::method()->getStockInfo($item)['price']}}</h6>
                                            <span class="text-success small pt-1 fw-bold">{{\App\Server\Connector::method()->getStockInfo($item)['price_percent']}}%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">


                                <div class="card-body">
                                    <h5 class="card-title">Revenue <span>| This Month</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>${{\App\Server\Connector::method()->getStockInfo($item)['profit']}}</h6>
                                            <span class="text-success small pt-1 fw-bold">{{\App\Server\Connector::method()->getStockInfo($item)['profit_percent']}}%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Holders Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Holders <span>| All</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{\App\Server\Connector::method()->getStockInfo($item)['holders']}}</h6>
                                            <span class="text-danger small pt-1 fw-bold">{{\App\Server\Connector::method()->getStockInfo($item)['holders_percent']}}%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{$item}} Candle Stick Chart</h5>

                                    <!-- Candle Stick Chart -->
                                    <div id="candleStickChart" style="min-height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);" class="echart" _echarts_instance_="ec_1676441549139"><div style="position: relative; width: 721px; height: 400px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;"><canvas data-zr-dom-id="zr_0" width="721" height="400" style="position: absolute; left: 0px; top: 0px; width: 721px; height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas></div></div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            echarts.init(document.querySelector("#candleStickChart")).setOption({
                                                xAxis: {
                                                    data: @php echo \App\Server\Connector::method()->getStockInfo($item)['date']; @endphp
                                                },
                                                yAxis: {},
                                                series: [{
                                                    type: 'candlestick',
                                                    data: [
                                                        {{\App\Server\Connector::method()->getStockInfo($item)['data']}}
                                                    ]
                                                }]
                                            });
                                        });
                                    </script>
                                    <!-- End Candle Stick Chart -->

                                </div>
                            </div>
                        </div>


                    </div>
                </div>


            </div>
        </section>

    </main>
@endsection
