<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/jquery-bar-rating/css-stars.css" />
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/demo_2/style.css" />
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
    @yield('style')
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
        @include('blocks.header')
    </div>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- partial:partials/_footer.html -->
            @include('blocks.footer')
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
<script src="../assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
<script src="../assets/vendors/chart.js/Chart.min.js"></script>
<script src="../assets/vendors/flot/jquery.flot.js"></script>
<script src="../assets/vendors/flot/jquery.flot.resize.js"></script>
<script src="../assets/vendors/flot/jquery.flot.categories.js"></script>
<script src="../assets/vendors/flot/jquery.flot.fillbetween.js"></script>
<script src="../assets/vendors/flot/jquery.flot.stack.js"></script>
<script src="../assets/js/off-canvas.js"></script>
<script src="../assets/js/hoverable-collapse.js"></script>
<script src="../assets/js/misc.js"></script>
<script src="../assets/js/settings.js"></script>
<script src="../assets/js/todolist.js"></script>
<script src="../assets/js/dashboard.js"></script>
@yield('script')
</body>
</html>
