<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>
    @include('admin.layout.styles')
</head>

<body id="page-top">
    <div id="wrapper">
        @include('admin.layout.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                @include("admin.layout.navbar")
                <div class="container-fluid">
                    @include('admin.component.alert')
                </div>
                <div class="container-fluid">
                    @yield('breadcrumb')
                </div>
                @yield('content')
            </div>
            @include('admin.layout.footer')
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    @include('admin.layout.scripts')
</body>

</html>
