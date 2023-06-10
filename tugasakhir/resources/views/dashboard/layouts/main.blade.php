<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />
  
    <title>Dashboard Admin</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="admin1/images/favicon.png">
    <!-- Pignose Calender -->
    <link href="admin1/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="admin1/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="admin1/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Datepicker -->
    <link rel="stylesheet" href="admin1/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="admin1/plugins/jqueryui/css/jquery-ui.min.css">
    <!-- Custom Stylesheet -->
    <link href="admin1/css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        @include('dashboard.layouts.header')

        @include('dashboard.layouts.sidebar')

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            @yield('container')
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">PNM</a> </p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="admin1/plugins/common/common.min.js"></script>
    <script src="admin1/js/custom.min.js"></script>
    <script src="admin1/js/settings.js"></script>
    <script src="admin1/js/gleek.js"></script>
    <script src="admin1/js/styleSwitcher.js"></script>

    <!-- Chartjs -->
    <script src="admin1/plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="admin1/plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <script src="admin1/plugins/d3v3/index.js"></script>
    <script src="admin1/plugins/topojson/topojson.min.js"></script>
    <script src="admin1/plugins/datamaps/datamaps.world.min.js"></script>
    <!-- Morrisjs -->
    <script src="admin1/plugins/raphael/raphael.min.js"></script>
    <script src="admin1/plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="admin1/plugins/moment/moment.min.js"></script>
    <script src="admin1/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <script src="admin1/plugins/chartist/js/chartist.min.js"></script>
    <script src="admin1/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
    <!-- Datepicker -->
    <script src="admin1/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="admin1/plugins/jqueryui/js/jquery-ui.min.js"></script>

</body>

</html>
