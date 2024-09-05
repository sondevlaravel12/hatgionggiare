<!doctype html>
<html lang="en">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />


        <!-- App favicon -->
        {{-- <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}"> --}}
        {{-- website favicon  --}}
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="/favicon/site.webmanifest">

        <!-- jquery.vectormap css -->
        <link href="{{asset('backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="{{asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        {{-- like qlshop.net  included Responsive datatable--}}
        {{-- <link href="https://cdn.datatables.net/v/bs/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/r-3.0.2/sl-2.0.3/datatables.min.css" rel="stylesheet"> --}}

        <!-- Responsive datatable examples -->
        <link href="{{asset('backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Taginput -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" >
        <!-- Bootstrap Css -->
        <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <!-- Icons Css -->
        <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('backend/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
        <!-- select2 for dropdown search -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Jquery ui mostly used autocomplete for search product,post... -->
        {{-- <link rel="stylesheet" href="{{ asset('backend/assets/jquery-ui-1.11.4/jquery-ui.css') }}"></link> --}}
        <link rel="stylesheet" href="{{ asset('backend/assets/jquery-ui-1.14.0-beta2/jquery-ui.min.css') }}"></link>
        <link rel="stylesheet" href="{{asset('backend/assets/image-uploader/image-uploader.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/custome.css') }}" >


        @stack('stylesheets')
    </head>

    <body data-topbar="dark" >
    {{-- <body data-topbar="light" data-sidebar="dark" data-sidebar-size="small" > --}}



    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">


            @include('admin.body.header')

            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.body.sidebar')
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>

                <!-- End Page-content -->

                @include('admin.body.footer')

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->

        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('backend/assets/libs/jquery/jquery.min.js?3.6.')}}"></script>
        <script src="{{asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/node-waves/waves.min.js')}}"></script>

        <!-- Jquery ui mostly used autocomplete for search product,post... -->
        {{-- <script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js')}}"></script> --}}

        {{-- <script src="{{ asset('backend/assets/jquery-ui-1.11.4/jquery-ui.js') }}" ></script> --}}
        <script src="{{ asset('backend/assets/jquery-ui-1.14.0-beta2/jquery-ui.min.js') }}" ></script>


        <!-- apexcharts -->
        <script src="{{asset('backend/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

        <!-- jquery.vectormap map -->
        <script src="{{asset('backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js')}}"></script>

        <!-- Required datatable js -->
        <script src="{{asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <!-- Datatable modify sorting with non english language : not work-->
        <script src="//cdn.datatables.net/plug-ins/1.12.1/sorting/intl.js"></script>
        <!-- Responsive examples -->
        <script src="{{asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

        {{-- like qlshop.net included Responsive datatable--}}
        {{-- <script src="https://cdn.datatables.net/v/bs/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/r-3.0.2/sl-2.0.3/datatables.min.js"></script> --}}
        <!-- Datatable init js -->
        <script src="{{asset('backend/assets/js/pages/datatables.init.js')}}"></script>


        {{-- <script src="{{asset('backend/assets/js/pages/datatables_default_setting.js')}}"></script> --}}


        <!-- Responsive examples -->
        {{-- <script src="{{asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script> --}}
        {{-- <script src="{{asset('backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script> --}}

        {{-- <script src="{{asset('backend/assets/js/pages/dashboard.init.js')}}"></script> --}}

        <!-- App js -->
        <script src="{{asset('backend/assets/js/app.js')}}"></script>


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
         @if(Session::has('message'))
         var type = "{{ Session::get('alert-type','info') }}"
         switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
         }
         @endif
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script src="{{ asset('backend/assets/js/sweetalert.js') }}"></script>

         <!--tinymce js 5.3 version-->
         <script src="{{ asset('backend/assets/libs/tinymce/tinymce.min.js') }}"></script>

         <!-- init js -->
         <script src="{{ asset('backend/assets/js/pages/form-editor.init.js?33') }}"></script>
         <!-- Taginput -->
         <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js" ></script>
         <script src="{{asset('backend/assets/js/typeahead.bundle.js')}}"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Image-Uploader -->
        {{-- https://christianbayer.github.io/image-uploader/ --}}
        <script type="text/javascript" src="{{asset('backend/assets/image-uploader/image-uploader.min.js')}}"></script>

        <script src="{{ asset('backend/assets/js/custom/admin_master_page.js?2') }}"></script>

        @stack('scripts')
    </body>

</html>
