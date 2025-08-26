@extends('layouts.master-without-nav')
@section('title')
@lang('translation.reset-mail')
@endsection
@section('content')

<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="index" class="d-inline-block auth-logo">
                                <!-- <img src="{{ URL::asset('build/images/logo-light.png')}}" alt="" height="20"> -->
                                <div class="display-6 text-light text-opacity-75 fw-bolder">MCU-RS</div>
                            </a>
                        </div>
                        <p class="mt-3 fs-15 fw-medium">Medical CheckUp RSUD Bangil</p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">

                        <div class="card-body p-4">
                            <div class="mb-4">
                                <div class="avatar-lg mx-auto">
                                    <div class="avatar-title bg-light text-primary display-5 rounded-circle">
                                        <i class="ri-shield-user-line"></i>
                                    </div>
                                </div>
                            </div>
                            @if ($has_no_rm)
                            <div class="p-2 mt-4">
                                <div class="text-muted text-center mb-4 mx-lg-3">
                                    <h4 class="">Verifikasi Diri</h4>
                                    <p>Masukkan <span class="fw-semibold">No RM / Rekam Medik</span> untuk melihat hasil pemeriksaan</p>
                                </div>

                                <form id="two-step-verification-form" method="post" action="{{ route('portal.submit',$no_rm) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="no_rm" class="visually-hidden">No RM</label>
                                                <input type="text" name="no_rm" class="form-control form-control-lg bg-light border-light text-center" id="no_rm" placeholder="No RM" required>
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-success w-100">Confirm</button>
                                    </div>
                                </form>
                            </div>
                            @else
                            <div class="p-2 mt-4">
                                <div class="text-muted text-center mb-4 mx-lg-3">
                                    <h4 class="">Waduh, terjadi kesalahan</h4>
                                    <p>Silahkan kembali ke menu berikutnya</p>
                                </div>
                            </div>
                            @endif


                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        <p class="mb-0">No Rekam Medis tertera di dokumen hasil pemeriksaan atau pada form pendaftaran</p>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy; <script>
                                document.write(new Date().getFullYear())
                            </script> RSUD Bangil. Dibuat dengan <i class="mdi mdi-heart text-danger"></i> oleh Instalasi SIMRS</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->


@endsection
@section('script')
<script src="{{ URL::asset('build/libs/particles.js/particles.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/particles.app.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/two-step-verification.init.js') }}"></script>
@endsection