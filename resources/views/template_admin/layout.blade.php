<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">


    <title>Toko Hanzah - Admin Dashboard</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
        rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

    <link href="{{ URL::asset('admin/assets/plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('admin/assets/css/sleek.min.css')}}" rel="stylesheet">
    <!-- PLUGINS CSS STYLE -->
    <link href="{{ URL::asset('admin/assets/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />



    <!-- No Extra plugin used -->



    <link href="{{ URL::asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />



    <link href="{{ URL::asset('admin/assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />



    <link href="{{ URL::asset('admin/assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet" />



    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="{{ URL::asset('admin/assets/css/sleek.css') }}" />

    <!-- FAVICON -->
    <link href="{{ URL::asset('admin/assets/img/favicon.png') }}" rel="shortcut icon" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
        integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ=="
        crossorigin="anonymous" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" />

    <script src="{{ URL::asset('admin/assets/plugins/nprogress/nprogress.js') }}"></script>
</head>


<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">

    <script>
        NProgress.configure({
            showSpinner: false
        });
        NProgress.start();

    </script>


    <div class="wrapper">

        <aside class="left-sidebar bg-sidebar">
            @include('template_admin.sidebar')
        </aside>


        <div class="page-wrapper">
            <!-- Header -->
            <header class="main-header " id="header">
                @include('template_admin.header')
            </header>


            <div class="content-wrapper">
                @yield('content')

            </div>

            <footer class="footer mt-auto">
                @include('template_admin.footer')
            </footer>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
    </script>

    <script src="{{ URL::asset('admin/assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/plugins/slimscrollbar/jquery.slimscroll.min.js') }}"></script>
    {{-- @yield('script') --}}
    <script src="{{ URL::asset('admin/assets/plugins/jekyll-search.min.js') }}"></script>



    <script src="{{ URL::asset('admin/assets/plugins/charts/Chart.min.js') }}"></script>



    <script src="{{ URL::asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>



    <script src="{{ URL::asset('admin/assets/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        jQuery(document).ready(function () {
            jQuery('input[name="dateRange"]').daterangepicker({
                autoUpdateInput: false,
                singleDatePicker: true,
                locale: {
                    cancelLabel: 'Clear'
                }
            });
            jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
                jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
            });
            jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
                jQuery(this).val('');
            });
        });

    </script>



    <script src="{{ URL::asset('admin/assets/plugins/toastr/toastr.min.js') }}"></script>

    <script src="{{ URL::asset('admin/assets/plugins/data-tables/jquery.datatables.min.js')}}"></script>
    <script src="{{ URL::asset('admin/assets/plugins/data-tables/datatables.bootstrap4.min.js')}}"></script>

    <script>
        jQuery(document).ready(function () {
            jQuery('#basic-data-table').DataTable({
                "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">'
            });
        });

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous"></script>



    <script script src="{{ URL::asset('admin/assets/js/sleek.bundle.js') }}"></script>

    <script script src="{{ URL::asset('admin/assets/js/sweetalert.min.js')}}"></script>

    @yield('script')
</body>

</html>
