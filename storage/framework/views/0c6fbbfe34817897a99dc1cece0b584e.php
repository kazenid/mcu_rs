
<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.visit-history'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> <?php echo app('translator')->get('translation.visit-history'); ?> <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?><?php echo app('translator')->get('translation.medical-checkup'); ?> <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><?php echo app('translator')->get('translation.medical-checkup'); ?> Data</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <button class="btn btn-primary"><i class=" ri-download-cloud-2-fill"></i> <?php echo app('translator')->get('translation.download'); ?></button>
                </div>
                <?php if(isset($error)): ?>
                <div class="alert alert-danger"><?php echo e($error); ?></div>
                <?php elseif(isset($data['data']) && count($data['data']) > 0): ?>
                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. RM</th>
                            <th>Nama Pasien</th>
                            <th>Alamat</th>
                            <!-- <th>Tgl Kunjungan</th> -->
                            <th>Penjamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($item['no_rm']  ?? '-'); ?></td>
                            <td><?php echo e($item['nama_px']  ?? '-'); ?></td>
                            <td><?php echo e($item['alamat']  ?? '-'); ?></td>
                            <!-- <td><?php echo e($item['tgl_kunjungan']  ?? '-'); ?></td> -->
                            <td><?php echo e($item['nama_penjamin']  ?? '-'); ?></td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-sm btn-info"
                                    data-nama="<?php echo e($item['nama_px']); ?>"
                                    data-norm="<?php echo e($item['no_rm']); ?>"
                                    data-alamat="<?php echo e($item['alamat']); ?>"
                                    data-token="<?php echo e($item['token']); ?>"

                                    onclick="tampilmodalKunjunganFromThis(this)">
                                    <?php echo app('translator')->get('translation.lab-results'); ?>
                                </button>
                                <!-- <button class="btn btn-sm btn-primary">Hasil Lab</button>
                                <button class="btn btn-sm btn-success">CT Scan</button> -->
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="alert alert-warning">Tidak ada data ditampilkan.</div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalKunjungan" tabindex="-1" aria-labelledby="modalKunjunganLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKunjunganLabel"><?php echo app('translator')->get('translation.lab-results'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">

                <p><strong>Nama:</strong> <span id="modalNama"></span></p>
                <p><strong>No. RM:</strong> <span id="modalNoRM"></span></p>
                <p><strong>Alamat:</strong> <span id="modalAlamat"></span></p>
                <!-- <p><strong>Tanggal Kunjungan:</strong> <span id="modalTanggal"></span></p> -->
                <p class="mt-4 text-muted"><?php echo app('translator')->get('translation.pacs-result'); ?> :</p>
                <div class="mt-3">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Nama Unit</th>
                                <th>Hasil Pemeriksaan</th>
                            </tr>
                        </thead>
                        <tbody id="tabel_kunjungan">

                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalRiwayat" tabindex="-1" aria-labelledby="modalRiwayatLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRiwayatLabel"><?php echo app('translator')->get('translation.lab-results'); ?> <span class="fw-bolder text-primary" id="modalNama"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mt-3" id="pdfcontainer">
                    <!-- <div class="fs-5">Belum ada data pemeriksaan lab</div> -->
                </div>
                <!-- <p><strong>Nama:</strong> <span id="modalNama"></span></p>
                <p><strong>No. RM:</strong> <span id="modalNoRM"></span></p>
                <p><strong>Alamat:</strong> <span id="modalAlamat"></span></p>
                <p><strong>Tanggal Kunjungan:</strong> <span id="modalTanggal"></span></p> -->
                <p class="mt-4 text-muted"><?php echo app('translator')->get('translation.pacs-result'); ?> :</p>
                <div class="mt-3 col-lg-6 hstack gap-2 flex-wrap" id="btncontainer">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="<?php echo e(URL::asset('build/js/pages/datatables.init.js')); ?>"></script>

<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>

<script>
    function tampilmodalFromThis(btn) {
        const nama = btn.dataset.nama;
        const norm = btn.dataset.norm;
        const alamat = btn.dataset.alamat;
        const tglkunjungan = btn.dataset.tglkunjungan;

        document.getElementById('modalNama').textContent = nama;
        // document.getElementById('modalNoRM').textContent = norm;
        // document.getElementById('modalAlamat').textContent = alamat;
        // document.getElementById('modalTanggal').textContent = tglkunjungan;
        document.getElementById('pdfcontainer').innerHTML = `<iframe src="<?php echo e(asset('storage/pdf/buku.pdf')); ?>" width="100%" height="600px"></iframe>`;
        document.getElementById('btncontainer').innerHTML = ``;
        document.getElementById('btncontainer').innerHTML += `<button class="btn btn-dark"><i class=" ri-share-circle-line"></i> Coxae AP / Pelvis AP</button>`;
        document.getElementById('btncontainer').innerHTML += `<button class="btn btn-dark"><i class=" ri-share-circle-line"></i> Thoracolumbal AP</button>`;

        var myModal = new bootstrap.Modal(document.getElementById('modalRiwayat'));
        myModal.show();
    }

    function tampilmodalKunjunganFromThis(btn) {
        const nama = btn.dataset.nama;
        const norm = btn.dataset.norm;
        const alamat = btn.dataset.alamat;
        const tglkunjungan = btn.dataset.tglkunjungan;

        document.getElementById('modalNama').textContent = nama;
        document.getElementById('modalNoRM').textContent = norm;
        document.getElementById('modalAlamat').textContent = alamat;
        // document.getElementById('modalTanggal').textContent = tglkunjungan;
        // document.getElementById('pdfcontainer').innerHTML = `<iframe src="<?php echo e(asset('storage/pdf/buku.pdf')); ?>" width="100%" height="600px"></iframe>`;
        document.getElementById('btncontainer').innerHTML = ``;
        document.getElementById('btncontainer').innerHTML += `<button class="btn btn-dark"><i class=" ri-share-circle-line"></i> Coxae AP / Pelvis AP</button>`;
        document.getElementById('btncontainer').innerHTML += `<button class="btn btn-dark"><i class=" ri-share-circle-line"></i> Thoracolumbal AP</button>`;

        var myModal = new bootstrap.Modal(document.getElementById('modalKunjungan'));
        myModal.show();
        filltabelkunjungan(btn.dataset.token);
    }

    function filltabelkunjungan(token) {
        console.log('call ajax');
         $('#tabel_kunjungan').html('Memuat...');

        $.ajax({
            url: 'getkunjungan?token=' + token,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let rows = '';
                if (response.data && response.data.length > 0) {
                    let promises = []; // simpan semua request tindakan

                    response.data.forEach(function(item, idx) {
                        // buat promise untuk ambil tindakan
                        let p = $.getJSON('gettindakan?kso='+item.id_kso+'&id=' + item.id_kunjungan)
                            .then(function(tindakanRes) {
                                let btns = '';
                                if (tindakanRes.data && tindakanRes.data.length > 0) {
                                    tindakanRes.data.forEach(function(t) {
                                        btns += `<button type="button" class="btn btn-sm btn-info m-1"
                                                    onclick="bukapacs('${t.id}')">
                                                    ${t.nama_tindakan}
                                              </button>`;
                                    });
                                } else {
                                    btns = `<span class="text-muted">Tidak ada</span>`;
                                }

                                rows += `<tr>
                                <td>${idx + 1}</td>
                                <td>${item.tgl_kunjungan ?? '-'}</td>
                                <td>${item.nama_unit ?? '-'}</td>
                                <td>${btns}</td>
                            </tr>`;
                            });
                        promises.push(p);
                    });

                    // setelah semua request tindakan selesai
                    Promise.all(promises).then(function() {
                        $('#tabel_kunjungan').html(rows);
                    });

                } else {
                    rows = `<tr><td colspan="6" class="text-center">Tidak ada data kunjungan.</td></tr>`;
                    $('#tabel_kunjungan').html(rows);
                }
            },
            error: function() {
                $('#tabel_kunjungan').html('<tr><td colspan="6" class="text-center text-danger">Gagal mengambil data kunjungan.</td></tr>');
            }
        });
    }

    function bukapacs(id) {
        const uri = 'https://appacs.rsudbangil.pasuruankab.go.id/externalinterface/viewexi?MODE=UL&TYPE=V&LID=his&LPW=1234&AN=';
        window.open(uri + id, '_blank');
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\mcu\resources\views/pages/medical-checkup.blade.php ENDPATH**/ ?>