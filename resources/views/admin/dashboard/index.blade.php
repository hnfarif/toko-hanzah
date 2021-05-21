@extends('template_admin.layout')

@section('dashboard', 'active')


@section('content')

<div class="content">
    <!-- Top Statistics -->
    <div class="row">
        <div class="col-xl-3 col-sm-6">
            <div class="card card-mini mb-4">
                <div class="card-body">
                    <h2 class="mb-1">71,503</h2>
                    <p>Online Signups</p>
                    <div class="chartjs-wrapper">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card card-mini  mb-4">
                <div class="card-body">
                    <h2 class="mb-1">9,503</h2>
                    <p>New Visitors Today</p>
                    <div class="chartjs-wrapper">
                        <canvas id="dual-line"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card card-mini mb-4">
                <div class="card-body">
                    <h2 class="mb-1">71,503</h2>
                    <p>Monthly Total Order</p>
                    <div class="chartjs-wrapper">
                        <canvas id="area-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card card-mini mb-4">
                <div class="card-body">
                    <h2 class="mb-1">9,503</h2>
                    <p>Total Revenue This Year</p>
                    <div class="chartjs-wrapper">
                        <canvas id="line"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">

    </div>

    <div class="row">

    </div>

    <div class="row">
        <div class="col-12">
            <!-- Recent Order Table -->
            <div class="card card-table-border-none" id="recent-orders">
                <div class="card-header justify-content-between">
                    <h2>Recent Orders</h2>
                </div>


                <div class="card-body pt-0 pb-5">
                    <label for="" class="text-dark"><b>Filter Periode :</b></label>
                    <div class="row input-daterange mb-3">
                        <div class="col-3">
                            <input type="text" id="min" class="form-control" data-date-format="d M yyyy">
                        </div>
                        <div class="col-3">
                            <input type="text" id="max" class="form-control" data-date-format="d M yyyy">
                        </div>
                    </div>
                    {{-- <table border="0" style="border-spacing: 10px;" cellspacing="7" cellpadding="7" class="mb-3">
                        <tbody>
                            <tr>
                                <td><b>Filter Periode :</b> </td>
                            </tr>
                            <tr class="input-daterange">
                                <td>Minimum date:</td>
                                <td> <input type="text" id="min" class="form-control" data-date-format="d M yyyy">
                                </td>

                                <td>
                                    Maximum date:
                                </td>
                                <td> <input type="text" id="max" class="form-control" data-date-format="d M yyyy">
                                </td>
                            </tr>
                        </tbody>
                    </table> --}}
                    <table class="table card-table table-responsive table-responsive-large" style="width:100%"
                        id="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Product Name</th>
                                <th class="d-none d-lg-table-cell">Units</th>
                                <th class="d-none d-lg-table-cell">Order Date</th>
                                <th class="d-none d-lg-table-cell">Order Cost</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>24541</td>
                                <td>
                                    <a class="text-dark" href=""> Coach Swagger</a>
                                </td>
                                <td class="d-none d-lg-table-cell">1 Unit</td>
                                <td class="d-none d-lg-table-cell">Oct 20, 2018</td>
                                <td class="d-none d-lg-table-cell">$230</td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown show d-inline-block widget-dropdown">
                                        <a class="dropdown-toggle icon-burger-mini" href="" role="button"
                                            id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" data-display="static"></a>
                                        <ul class="dropdown-menu dropdown-menu-right"
                                            aria-labelledby="dropdown-recent-order1">
                                            <li class="dropdown-item">
                                                <a href="#">View</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="#">Remove</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>24541</td>
                                <td>
                                    <a class="text-dark" href=""> Coach Swagger</a>
                                </td>
                                <td class="d-none d-lg-table-cell">1 Unit</td>
                                <td class="d-none d-lg-table-cell">May 18, 2021</td>
                                <td class="d-none d-lg-table-cell">$230</td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown show d-inline-block widget-dropdown">
                                        <a class="dropdown-toggle icon-burger-mini" href="" role="button"
                                            id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" data-display="static"></a>
                                        <ul class="dropdown-menu dropdown-menu-right"
                                            aria-labelledby="dropdown-recent-order1">
                                            <li class="dropdown-item">
                                                <a href="#">View</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="#">Remove</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

    </div>

    <div class="row">

    </div>
</div>

@endsection

@section('script')

<script>
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('#min').val();
            var max = $('#max').val();
            var parseDate = moment(data[3]).format('YYYY/MM/DD')
            var date = new Date(parseDate);
            if (
                (min == "" || max == "") ||
                (moment(parseDate).isSameOrAfter(min) && moment(parseDate).isSameOrBefore(max))
            ) {
                return true;
            }
            return false;
        }
    );

    $(document).ready(function () {


        $('.input-daterange input').each(function () {
            $(this).datepicker('clearDates');
        });

        var table = $("#table").DataTable();

        $('#min, #max').on('change', function () {
            table.draw();
        })
    });

</script>

@endsection
