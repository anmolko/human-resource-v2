@include('admin.partials.header')
    <!-- Sidebar -->
    @include('admin.partials.sidebar')
    <!-- /Sidebar -->


    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        @yield('content')

        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->


@include('admin.partials.footer')

