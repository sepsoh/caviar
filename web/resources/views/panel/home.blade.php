@extends('layouts.master')
@section('title', 'Panel')

@section('header')
    @include('include.header')
@endsection


@section('main')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- User info Card -->
                        <div class="col-12">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Info</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{\App\Server\Connector::method()->getUserData()['name']}}</h6>
                                           <span class="text-muted small pt-2 ps-1">{{\App\Server\Connector::method()->getUserData()['email']}}</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End User info Card -->
                        <!-- Revenue Card -->
                        <div class="col-12">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Revenue <span>| All</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>${{\App\Server\Connector::method()->getUserData()['revenue']}}</h6>
                                            <span class="text-success small pt-1 fw-bold">{{\App\Server\Connector::method()->getUserData()['revenue_percent']}}%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->


                        <!-- Stock Percent -->
                        <div class="col-12">
                            <div class="card">
                            </div>

                            <div class="card-body pb-0">
                                <h5 class="card-title">Stocks Percent <span>| All update at {{\App\Server\Connector::method()->getUserData()['update_at']}}</span></h5>

                                <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        echarts.init(document.querySelector("#trafficChart")).setOption({
                                            tooltip: {
                                                trigger: 'item'
                                            },
                                            legend: {
                                                top: '5%',
                                                left: 'center'
                                            },
                                            series: [{
                                                name: 'Access From',
                                                type: 'pie',
                                                radius: ['40%', '70%'],
                                                avoidLabelOverlap: false,
                                                label: {
                                                    show: false,
                                                    position: 'center'
                                                },
                                                emphasis: {
                                                    label: {
                                                        show: true,
                                                        fontSize: '18',
                                                        fontWeight: 'bold'
                                                    }
                                                },
                                                labelLine: {
                                                    show: false
                                                },
                                                data: [@php echo \App\Server\Connector::method()->getUserData()['stock_percent_data']; @endphp]
                                        });
                                    });
                                </script>

                            </div>
                        </div>
                        <!-- End Percent -->

                        <!-- Reports -->
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Reports <span>| update at {{\App\Server\Connector::method()->getUserData()['update_at']}}</span></h5>

                                    <!-- Line Chart -->
                                    <div id="reportsChart"></div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            new ApexCharts(document.querySelector("#reportsChart"), {
                                                series: [{
                                                    name: 'OMI',
                                                    data: [31, 40, 28, 51, 42, 82, 56],
                                                }, {
                                                    name: 'KAL',
                                                    data: [11, 32, 45, 32, 34, 52, 41]
                                                }, {
                                                    name: 'ABM',
                                                    data: [15, 11, 32, 18, 9, 24, 11]
                                                }],
                                                chart: {
                                                    height: 350,
                                                    type: 'area',
                                                    toolbar: {
                                                        show: false
                                                    },
                                                },
                                                markers: {
                                                    size: 4
                                                },
                                                colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                                fill: {
                                                    type: "gradient",
                                                    gradient: {
                                                        shadeIntensity: 1,
                                                        opacityFrom: 0.3,
                                                        opacityTo: 0.4,
                                                        stops: [0, 90, 100]
                                                    }
                                                },
                                                dataLabels: {
                                                    enabled: false
                                                },
                                                stroke: {
                                                    curve: 'smooth',
                                                    width: 2
                                                },
                                                xaxis: {
                                                    type: 'datetime',
                                                    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                                                },
                                                tooltip: {
                                                    x: {
                                                        format: 'dd/MM/yy HH:mm'
                                                    },
                                                }
                                            }).render();
                                        });
                                    </script>
                                    <!-- End Line Chart -->

                                </div>

                            </div>
                        </div><!-- End Reports -->

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Symbol</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Changes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(\App\Server\Connector::method()->raw_allStockInformation() as $item)
                                            <tr>
                                                <td><a href="/item/{{$item['symbol']}}" class="text-primary">{{$item['name']}}</a></td>
                                                <td>{{$item['symbol']}}</td>
                                                <td>{{$item['price']}}</td>
                                                <td><span class="badge bg-success">+{{rand(10,1000)/10.00}}%</span></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->


                    </div>
                </div>


            </div>
        </section>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Your Strategis</h5>
                            @foreach(\App\Server\Connector::method()->getUserStrategies('') as $item)
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
