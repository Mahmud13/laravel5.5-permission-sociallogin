<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('page-title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset("css/dashboard.css") }}" rel="stylesheet" type="text/css" />
    @stack('styles')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Header -->
    @include('partials.dashboard.header')

    <!-- Sidebar -->
    @include('partials.dashboard.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="font-size:36px">
                @yield('page-title')
                <small>{{ $page_description or "" }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Footer -->
    @include('partials.dashboard.footer')

    <!-- Control sidebar -->
    @include('partials.dashboard.control-panel')
</div><!-- ./wrapper -->

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="{{asset("js/fastclick.min.js") }}"></script>
<script src="{{asset("js/jquery.sparkline.min.js") }}"></script>
<script src="{{asset("js/jquery.slimscroll.min.js") }}"></script>
<script src="{{asset("js/dashboard.min.js") }}"></script>
  <script src="{{ asset('js/jquery.LoadingBox.js')}}"></script>
        <script>
        var lb;
        function ajaxLoadingStart() {
            lb = new $.LoadingBox({
                // if the element doesn't exist, it will create a one new with the predefined html structure and css
                mainElementID: 'loading-box',

                // animation speed
                fadeInSpeed: 'normal',
                fadeOutSpeed: 'normal',

                // opacity
                opacity: 0.3,

                // background color
                backgroundColor: "#000",

                // width / height of the loading GIF
                loadingImageWitdth: "60px",
                loadingImageHeigth: "60px",

                // path to the loading gif
                loadingImageSrc: "{{ asset('img/ajax-loading.gif')}}"
            });
        }
        function ajaxLoadingStop(){
            lb.close();
        }
        </script>
@stack('scripts')

</bdoy>
</html>
