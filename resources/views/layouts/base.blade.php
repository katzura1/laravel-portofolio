<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">

    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        {{-- Header --}}
        @include('components.admin.header')

        {{-- sidebar --}}
        @include('components.admin.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('header_title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            {{-- <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol> --}}
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        @include('components.admin.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('vendor/sweetalert2/sweetalert2.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js')}}"></script>

    <script>
        //swal loading
        const before_send = () => {
            Swal.fire({
            title: "Harap tunggu",
            text: "Memproses data...",
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            },
            });

            $("input.is-invalid").removeClass("is-invalid");
            $("select.is-invalid").removeClass("is-invalid");
        };

        //add invalid class
        const show_field_invalid = (id_form, data) => {
            $.each(data, function (index, key) {
                $("#" + id_form + " #" + key).addClass("is-invalid");
            });
        };

        //show success swal
        const show_success = (custom_option = {}) => {
            const option = {
                title: "Berhasil",
                html: "Berhasil",
                icon: "success",
                confirmButtonColor: "#007bff",
                cancelButtonColor: "#d33",
                cancelButtonText: "batal",
            };
            // console.log(option, 'success');
            Swal.fire({
                ...option,
                ...custom_option,
            });
        };

        //show error swal
        const show_error = (custom_option = {}) => {
            const option = {
                title: "Error",
                html: "Error",
                icon: "error",
                confirmButtonColor: "#007bff",
                cancelButtonColor: "#d33",
                cancelButtonText: "batal",
            };
            // console.log(option, 'error');
            Swal.fire({
                ...option,
                ...custom_option,
            });
        };

        //swal prompt object
        const prompt_swal = (confirm = () => {}, custom_option = {}) => {
            const option = {
                title: "Apakah anda yakin?",
                html: "Anda ingin menyimpan data ini.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#007bff",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, simpan data!",
                cancelButtonText: "batal",
                focusConfirm: true,
            };

            Swal.fire({
                ...option,
                ...custom_option,
            }).then((response) => {
                if (response.value) {
                confirm();
                }
            });

            $("button.swal2-confirm").focus();
        };

        //ajax object
        const ajax_post = (custom_option = {}) => {
            const option = {
                type: "POST",
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                dataType: "JSON",
                beforeSend: before_send(),
                success: (result) => {},
                error: (xhr) => {
                Swal.close();
                const error = xhr.responseJSON;
                const message =
                    error == undefined ? "Data gagal disimpan" : error.message;
                show_error({
                    html: message,
                });
                },
            };

            $.ajax({
                ...option,
                ...custom_option,
            });
        };
    </script>

    @yield('js')

</body>

</html>
