<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('translation.reset-mail'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

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
                                <!-- <img src="<?php echo e(URL::asset('build/images/logo-light.png')); ?>" alt="" height="20"> -->
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
                            <?php if($has_no_rm): ?>
                            <div class="p-2 mt-4">
                                <div class="text-muted text-center mb-4 mx-lg-3">
                                    <h4 class="">Verifikasi Diri</h4>
                                    <p>Masukkan <span class="fw-semibold">No RM / Rekam Medik</span> untuk melihat hasil pemeriksaan</p>
                                </div>


                                
                                <?php if($errors->any()): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0 list-unstyled" >
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><span class="fw-semibold">Terjadi Kesalahan : </span><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php endif; ?>

                                
                                <?php if(session('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo e(session('success')); ?>

                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php endif; ?>


                                <form id="two-step-verification-form" method="post" action="<?php echo e(route('portal.submit',$token)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="token" id="form-token" value="<?php echo e($token); ?>">

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="no_rm" class="visually-hidden">No RM</label>
                                                <input type="number"
                                                    name="no_rm"
                                                    class="form-control form-control-lg bg-light border-light text-center <?php $__errorArgs = ['no_rm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    id="no_rm" placeholder="No RM" required value="<?php echo e(old('no_rm')); ?>">
                                                <?php $__errorArgs = ['no_rm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-success w-100">Confirm</button>
                                    </div>
                                </form>

                            </div>
                            <?php else: ?>
                            <div class="p-2 mt-4">
                                <div class="text-center mb-4 mx-lg-3">
                                    <h4 class="text-danger">Terjadi Kesalahan</h4>
                                    <p class="text-muted">Data yang Anda minta tidak dapat diproses. Silakan kembali ke menu sebelumnya untuk melanjutkan.</p>

                                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline-primary mt-3">
                                        <i class="ri-arrow-go-back-line me-1"></i> Kembali
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>
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


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/libs/particles.js/particles.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/pages/particles.app.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/pages/two-step-verification.init.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master-without-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\mcu\resources\views/pages/portal.blade.php ENDPATH**/ ?>