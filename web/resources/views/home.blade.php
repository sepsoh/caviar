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
                                <h5 class="card-title">Market index <span>/Today</span></h5>

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
                                <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row"><a href="#">#2457</a></th>
                                        <td>Brandon Jacob</td>
                                        <td><a href="#" class="text-primary">At praesentium minu</a></td>
                                        <td>$64</td>
                                        <td><span class="badge bg-success">Approved</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#">#2147</a></th>
                                        <td>Bridie Kessler</td>
                                        <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                                        <td>$47</td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#">#2049</a></th>
                                        <td>Ashleigh Langosh</td>
                                        <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                                        <td>$147</td>
                                        <td><span class="badge bg-success">Approved</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#">#2644</a></th>
                                        <td>Angus Grady</td>
                                        <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                                        <td>$67</td>
                                        <td><span class="badge bg-danger">Rejected</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#">#2644</a></th>
                                        <td>Raheem Lehner</td>
                                        <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                                        <td>$165</td>
                                        <td><span class="badge bg-success">Approved</span></td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

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

                            <div class="card-body pb-0">
                                <h5 class="card-title">Top Selling <span>| Today</span></h5>

                                <table class="table table-borderless">
                                    <thead>
                                    <tr>
                                        <th scope="col">Preview</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Sold</th>
                                        <th scope="col">Revenue</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row"><a href="#"><img src="/assets/img/product-1.jpg" alt=""></a></th>
                                        <td><a href="#" class="text-primary fw-bold">Ut inventore ipsa voluptas nulla</a></td>
                                        <td>$64</td>
                                        <td class="fw-bold">124</td>
                                        <td>$5,828</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#"><img src="/assets/img/product-2.jpg" alt=""></a></th>
                                        <td><a href="#" class="text-primary fw-bold">Exercitationem similique doloremque</a></td>
                                        <td>$46</td>
                                        <td class="fw-bold">98</td>
                                        <td>$4,508</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#"><img src="/assets/img/product-3.jpg" alt=""></a></th>
                                        <td><a href="#" class="text-primary fw-bold">Doloribus nisi exercitationem</a></td>
                                        <td>$59</td>
                                        <td class="fw-bold">74</td>
                                        <td>$4,366</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#"><img src="/assets/img/product-4.jpg" alt=""></a></th>
                                        <td><a href="#" class="text-primary fw-bold">Officiis quaerat sint rerum error</a></td>
                                        <td>$32</td>
                                        <td class="fw-bold">63</td>
                                        <td>$2,016</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#"><img src="/assets/img/product-5.jpg" alt=""></a></th>
                                        <td><a href="#" class="text-primary fw-bold">Sit unde debitis delectus repellendus</a></td>
                                        <td>$79</td>
                                        <td class="fw-bold">41</td>
                                        <td>$3,239</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Top Selling -->

                </div>
            </div>

    </section>

</main>
@endsection
