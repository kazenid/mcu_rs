@extends('layouts.master')
@section('title') @lang('translation.visit-history') @endsection
@section('css')
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') @lang('translation.visit-history') @endslot
@slot('title')@lang('translation.medical-checkup') @endslot
@endcomponent



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">@lang('translation.medical-checkup') Data</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <button class="btn btn-primary"><i class=" ri-download-cloud-2-fill"></i> @lang('translation.download')</button>
                </div>
                @if(isset($error))
                <div class="alert alert-danger">{{ $error }}</div>
                @elseif(isset($data['data']) && count($data['data']) > 0)
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
                        @foreach ($data['data'] as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['no_rm']  ?? '-'}}</td>
                            <td>{{ $item['nama_px']  ?? '-'}}</td>
                            <td>{{ $item['alamat']  ?? '-'}}</td>
                            <!-- <td>{{ $item['tgl_kunjungan']  ?? '-'}}</td> -->
                            <td>{{ $item['nama_penjamin']  ?? '-'}}</td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-sm btn-info"
                                    data-nama="{{ $item['nama_px'] }}"
                                    data-norm="{{ $item['no_rm'] }}"
                                    data-alamat="{{ $item['alamat'] }}"
                                    data-token="{{ $item['token'] }}"

                                    onclick="tampilmodalKunjunganFromThis(this)">
                                    @lang('translation.lab-results')
                                </button>
                                <!-- <button class="btn btn-sm btn-primary">Hasil Lab</button>
                                <button class="btn btn-sm btn-success">CT Scan</button> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-warning">Tidak ada data ditampilkan.</div>
                @endif

            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalKunjungan" tabindex="-1" aria-labelledby="modalKunjunganLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKunjunganLabel">@lang('translation.lab-results')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">

                <p><strong>Nama:</strong> <span id="modalNama"></span></p>
                <p><strong>No. RM:</strong> <span id="modalNoRM"></span></p>
                <p><strong>Alamat:</strong> <span id="modalAlamat"></span></p>
                <!-- <p><strong>Tanggal Kunjungan:</strong> <span id="modalTanggal"></span></p> -->
                <p class="mt-4 text-muted">@lang('translation.pacs-result') :</p>
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
                <h5 class="modal-title" id="modalRiwayatLabel">@lang('translation.lab-results') <span class="fw-bolder text-primary" id="modalNama"></span></h5>
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
                <p class="mt-4 text-muted">@lang('translation.pacs-result') :</p>
                <div class="mt-3 col-lg-6 hstack gap-2 flex-wrap" id="btncontainer">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


@endsection
@section('script')

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

<script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>

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
        document.getElementById('pdfcontainer').innerHTML = `<iframe src="{{ asset('storage/pdf/buku.pdf') }}" width="100%" height="600px"></iframe>`;
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
        // document.getElementById('pdfcontainer').innerHTML = `<iframe src="{{ asset('storage/pdf/buku.pdf') }}" width="100%" height="600px"></iframe>`;
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

@endsection