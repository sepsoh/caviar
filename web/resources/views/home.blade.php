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
    <section class="section dashboard">
        <div class="row">
                <div class="row">

                    <!-- Market index -->
                    <div class="col-12">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Market index <span>| Today</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: 'Today',
                                                data: [@foreach(\App\Server\Connector::method()->marketIndexThisDay()[1] as $item){{$item}},@endforeach]


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
                                                categories:  [@foreach(\App\Server\Connector::method()->marketIndexThisDay()[0] as $item)'{{$item}}',@endforeach]
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
                    </div><!-- End Market index -->

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
                                        <th scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(\App\Server\Connector::method()->raw_allStockInformation() as $item)
                                        <tr>
                                            <td><a href="/item/{{$item['symbol']}}" class="text-primary">{{$item['name']}}</a></td>
                                            <td>{{$item['symbol']}}</td>
                                            <td>{{$item['price']}}</td>
                                            <td><span class="badge {{$item['status'] == 'open' ? 'bg-success' : 'bg-danger'}}">{{$item['status']}}</span></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                </div>
            </div>

    </section>

</main>
@endsection
