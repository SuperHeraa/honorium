<div class="container">

    <div class="mb-3">
        <form class="row g-3 d-flex justify-content-end">
            <div class="col-auto">
                <input type="text" name="formCari" id="formCari" placeholder="bulan+tahun: 092023" class="form-control" maxlength="6" onkeypress="return hanyaAngka(event)">
            </div>
            <div class="col-auto">
                <button type="submit" id="cari" class="btn btn-primary me-2"><i class="ti ti-search"></i></button>
                <button id="refresh" class="btn btn-danger"><i class="ti ti-refresh"></i></button>
            </div>
        </form>
    </div>
    <div class="alert alert-success" role="alert">
        <h5><span class="fs-5 fw-bolder"><i class="ti ti-alert-triangle"></i> Honor Bulan</span> <span class="fw-bolder" id="alert-bulantahun"></span></h5>
    </div>
    <div id="errMessage"></div>
    <div class="card" id="content">
        <div class="card-body">
            <h5 class="fw-bolder mb-4">Rincian Pendapatan</h5>
            <div class="d-inline" id="other">
                <!-- content here -->
            </div>
            <div class="d-inline" id="other2">
                <!-- content here -->
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-6 mb-3">
                    <h6 class="fw-bolder fs-4">Jabatan</h6>
                    <hr class="dashed">
                    <div id="jabatan">
                        <!-- content here -->
                    </div>
                    <div id="walas"></div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <h6 class="fw-bolder fs-4">Mengajar <span id="totalJam"></span></h6>
                    <hr class="dashed">
                    <div class="mb-3" id="jam">
                        <!-- content here -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 mb-3">
                    <h6 class="fw-bolder fs-4">Transport</h6>
                    <hr class="dashed">
                    <div class="mb-3" id="transport">
                        <!-- content here -->
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <h6 class="fw-bolder fs-4">Kegiatan</h6>
                    <hr class="dashed">
                    <div class="mb-3" id="kegiatan">
                        <!-- content here -->
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h6 class="fw-bolder mb3">Perhitungan</h6>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <button class="btn btn-primary btn-sm" id="showRumus" type="button" data-bs-toggle="collapse" data-bs-target="#rumus" aria-expanded="false" aria-controls="collapseExample">
                                Lihat rumus
                            </button>
                        </div>
                    </div>
                    <hr class="dashed">
                    <div class="collapse" id="rumus">
                        <div class="card card-body">
                            <span><strong>Jabatan :</strong> sum jumlah jabatan</span>
                            <span><strong>Mengajar :</strong> jumlah jam * honor perjam</span>
                            <span><strong>Transport :</strong> honor * kehadiran</span>
                            <span><strong>Kegiatan :</strong> sum jumlah kegiatan</span>
                        </div>
                    </div>
                    <div class="mb-3 font-monospace" id="hitung">
                        <!-- content here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  html hasil cari -->
    <div class="card" id="content2" style="display:none">
        <div class="card-body">
            <h5 class="fw-bolder mb-4">Rincian Pendapatan</h5>
            <div class="d-inline" id="srcother">
                <!-- content here -->
            </div>
            <div class="d-inline" id="srcother2">
                <!-- content here -->
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-6 mb-3">
                    <h6 class="fw-bolder fs-4">Jabatan</h6>
                    <hr class="dashed">
                    <div id="srcjabatan">
                        <!-- content here -->
                    </div>
                    <div id="srcwalas"></div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <h6 class="fw-bolder fs-4">Mengajar <span id="srctotalJam"></span></h6>
                    <hr class="dashed">
                    <div class="mb-3" id="srcjam">
                        <!-- content here -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 mb-3">
                    <h6 class="fw-bolder fs-4">Transport</h6>
                    <hr class="dashed">
                    <div class="mb-3" id="srctransport">
                        <!-- content here -->
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <h6 class="fw-bolder fs-4">Kegiatan</h6>
                    <hr class="dashed">
                    <div class="mb-3" id="srckegiatan">
                        <!-- content here -->
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h6 class="fw-bolder mb3">Perhitungan</h6>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <button class="btn btn-primary btn-sm" id="srcshowRumus" type="button" data-bs-toggle="collapse" data-bs-target="#srcrumus" aria-expanded="false" aria-controls="collapseExample">
                                Lihat rumus
                            </button>
                        </div>
                    </div>
                    <hr class="dashed">
                    <div class="collapse" id="srcrumus">
                        <div class="card card-body">
                            <span><strong>Jabatan :</strong> sum jumlah jabatan</span>
                            <span><strong>Mengajar :</strong> jumlah jam * honor perjam</span>
                            <span><strong>Transport :</strong> honor * kehadiran</span>
                            <span><strong>Kegiatan :</strong> sum jumlah kegiatan</span>
                        </div>
                    </div>
                    <div class="mb-3 font-monospace" id="srchitung">
                        <!-- content here -->
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


<script>
    $(document).ready(function() {
        myhonor();

        function rupiah(angka = 0) {
            let result = angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            return result;
        }

        function bulan(nomor) {
            if (nomor === '01') {
                let nama_bulan = 'Januari';
                return nama_bulan;
            } else if (nomor === '02') {
                let nama_bulan = 'Februari';
                return nama_bulan;
            } else if (nomor === '03') {
                let nama_bulan = 'Maret';
                return nama_bulan;
            } else if (nomor === '04') {
                let nama_bulan = 'April';
                return nama_bulan;
            } else if (nomor === '05') {
                let nama_bulan = 'Mei';
                return nama_bulan;
            } else if (nomor === '06') {
                let nama_bulan = 'Juni';
                return nama_bulan;
            } else if (nomor === '07') {
                let nama_bulan = 'Juli';
                return nama_bulan;
            } else if (nomor == '08') {
                let nama_bulan = 'Agustus';
                return nama_bulan;
            } else if (nomor == '09') {
                let nama_bulan = 'September';
                return nama_bulan;
            } else if (nomor == '10') {
                let nama_bulan = 'Oktober';
                return nama_bulan;
            } else if (nomor == '11') {
                let nama_bulan = 'November';
                return nama_bulan;
            } else if (nomor == '12') {
                letnama_bulan = 'Desember';
                return nama_bulan;
            }
        }

        // fungsi tampil data
        function myhonor() {
            $.ajax({
                type: "post",
                url: "<?= base_url('pegawai/honor/show') ?>",
                dataType: "json",
                success: function(data) {
                    let monthYear = data.bulantahun;
                    let month = monthYear.substring(0, 2);
                    let year = monthYear.substring(2, 6);

                    let html_alert = "";
                    html_alert +=
                        bulan(month) + ' ' + year;
                    $("#alert-bulantahun").html(html_alert);

                    $("#slip").val(data.bulantahun);

                    $("#content").css('display', 'block');
                    $("#errMessage").css('display', 'none');
                    // info kehadiran dan honor perjam
                    $("#other").html('<span class="text-info"><i class="ti ti-layout-list"></i></span> Keadiran : ' + data.other.hadir);
                    $("#other2").html('<span class="text-success ms-2"><i class="ti ti-layout-list"></i></span> Honor Perjam : Rp. ' + rupiah(data.hitungan.perjam));

                    // jabatan
                    let jml_jabatan = data.jabatan.length;
                    if (jml_jabatan == 0 && data.other.status_walas != 1) {
                        $("#jabatan").html('<span class="text-danger fw-bolder">Tidak ada data</span>');
                    } else {
                        let i;
                        let html_jabatan = "";
                        for (i = 0; i < jml_jabatan; i++) {
                            html_jabatan += '<h6><i class="ti ti-chevron-right"></i> ' +
                                data.jabatan[i].nama_jabatan +
                                ' [Rp. ' + rupiah(data.jabatan[i].honor_jabatan) + ']' +
                                '</h6>';
                            $("#jabatan").html(html_jabatan);
                        }
                        let status_walas = data.other.status_walas;
                        if (status_walas == 1) {
                            $("#walas").html('<h6><i class="ti ti-chevron-right"></i> Walas [Rp. ' + rupiah(data.other.honor_walas) + ']</h6>');
                        }
                    }

                    // jam mengajar
                    let jml_jam = data.jam.length;
                    if (jml_jam == 0) {
                        $("#jam").html('<span class="text-danger fw-bolder">Tidak ada data</span>');
                    } else {
                        let j;
                        let html_jam = "";
                        for (j = 0; j < jml_jam; j++) {
                            html_jam +=
                                '<h6><i class="ti ti-chevron-right"></i> ' +
                                data.jam[j].mapel +
                                ' [' + data.jam[j].jumlah_jam + ' Jam' + ']' +
                                '</h6>';
                            $("#jam").html(html_jam);
                        }

                        $("#totalJam").html('[' + data.hitungan.jumlah_jam + ']');
                    }

                    // transport
                    let html_transport = "";
                    html_transport +=
                        '<h6><i class="ti ti-chevron-right"></i> ' +
                        'Jarak Tempuh : ' + data.other.jarak_transport +
                        '</h6>' +
                        '<h6><i class="ti ti-chevron-right"></i> ' +
                        'Honor : Rp. ' + rupiah(data.other.honor_transport) +
                        '</h6>';
                    $("#transport").html(html_transport);

                    // Kegiatan
                    let jml_kegiatan = data.kegiatan.length;
                    let k;
                    let html_kegiatan = "";
                    if (jml_kegiatan == 0) {
                        $("#kegiatan").html('<span class="text-danger fw-bolder">Tidak ada data</span>');
                    } else {
                        for (k = 0; k < jml_kegiatan; k++) {
                            html_kegiatan +=
                                '<h6><i class="ti ti-chevron-right"></i> ' +
                                data.kegiatan[k].nama_kegiatan +
                                ' [Rp. ' + rupiah(data.kegiatan[k].honor_kegiatan) + ']' +
                                '</h6>';
                            $("#kegiatan").html(html_kegiatan);
                        }
                    }


                    // hitung total pendapatan
                    let html_pendapatan = "";
                    html_pendapatan +=
                        '<h6><span class="text-success"><i class="ti ti-discount-check"></i></span> ' + 'Honor Jabatan : Rp.' + rupiah(data.hitungan.total_jabatan) + '</h6>' +
                        '<h6><span class="text-success"><i class="ti ti-discount-check"></i></span> ' + 'Honor Mengajar : Rp.' + rupiah(data.hitungan.total_jam) + '</h6>' +
                        '<h6><span class="text-success"><i class="ti ti-discount-check"></i></span> ' + 'Honor Transport : Rp.' + rupiah(data.hitungan.total_transport) + '</h6>' +
                        '<h6><span class="text-success"><i class="ti ti-discount-check"></i></span> ' + 'Honor Kegiatan : Rp.' + rupiah(data.hitungan.total_kegiatan) + '</h6>' +
                        '<hr class="dashed">' +
                        '<h6 class="fw-bolder">Total : Rp. ' + rupiah(data.hitungan.total_pendapatan) + '</h6>' +
                        '<hr class="dashed">';
                    $("#hitung").html(html_pendapatan);
                },
                error: function() {
                    $("#content").css('display', 'none');
                    let html_err = "";
                    html_err +=
                        '<div class="card">' +
                        '<div class="card-body">' +
                        '<h6 class="text-danger fw-bolder"> Data Bulan Ini Belum Di Inputkan! </h6>' +
                        '</div>' +
                        '</div>';
                    $("#errMessage").html(html_err);
                    $("#errMessage").css('display', 'block');
                }
            });
        }

        // show hide rumus text
        $("#showRumus").click(function() {
            $(this).text($(this).text() == 'tutup' ? 'Lihat rumus' : 'tutup');
        });
        $("#srcshowRumus").click(function() {
            $(this).text($(this).text() == 'tutup' ? 'Lihat rumus' : 'tutup');
        });

        // function cari
        $("#cari").click(function() {
            let search = $("#formCari").val();
            $.ajax({
                type: 'POST',
                url: "<?= base_url('pegawai/honor/search') ?>",
                dataType: "json",
                data: {
                    search: search
                },
                beforeSend: function() {
                    $("#overlay").fadeIn(300);
                },
                success: function(data) {

                    let monthYear = data.bulantahun;
                    let month = monthYear.substring(0, 2);
                    let year = monthYear.substring(2, 6);

                    let html_alert = "";
                    html_alert +=
                        bulan(month) + ' ' + year;
                    $("#alert-bulantahun").html(html_alert);

                    $("#overlay").fadeOut(300);
                    $("#content").css('display', 'none');
                    $("#content2").css('display', 'block');

                    $("#errMessage").css('display', 'none');
                    // info kehadiran dan honor perjam
                    $("#srcother").html('<span class="text-info"><i class="ti ti-layout-list"></i></span> Keadiran : ' + data.other.hadir);
                    $("#srcother2").html('<span class="text-success ms-2"><i class="ti ti-layout-list"></i></span> Honor Perjam : Rp. ' + rupiah(data.hitungan.perjam));

                    // jabatan
                    let jml_jabatan = data.jabatan.length;
                    if (jml_jabatan == 0 && data.other.status_walas != 1) {
                        $("#srcjabatan").html('<span class="text-danger fw-bolder">Tidak ada data</span>');
                    } else {
                        let i;
                        let html_jabatan = "";
                        for (i = 0; i < jml_jabatan; i++) {
                            html_jabatan += '<h6><i class="ti ti-chevron-right"></i> ' +
                                data.jabatan[i].nama_jabatan +
                                ' [Rp. ' + rupiah(data.jabatan[i].honor_jabatan) + ']' +
                                '</h6>';
                            $("#srcjabatan").html(html_jabatan);
                        }
                        let status_walas = data.other.status_walas;
                        if (status_walas == 1) {
                            $("#srcwalas").html('<h6><i class="ti ti-chevron-right"></i> Walas [Rp. ' + rupiah(data.other.honor_walas) + ']</h6>');
                        }
                    }

                    // jam mengajar
                    let jml_jam = data.jam.length;
                    if (jml_jam == 0) {
                        $("#srcjam").html('<span class="text-danger fw-bolder">Tidak ada data</span>');
                    } else {
                        let j;
                        let html_jam = "";
                        for (j = 0; j < jml_jam; j++) {
                            html_jam +=
                                '<h6><i class="ti ti-chevron-right"></i> ' +
                                data.jam[j].mapel +
                                ' [' + data.jam[j].jumlah_jam + ' Jam' + ']' +
                                '</h6>';
                            $("#srcjam").html(html_jam);
                        }

                        $("#srctotalJam").html('[' + data.hitungan.jumlah_jam + ']');
                    }

                    // transport
                    let html_transport = "";
                    html_transport +=
                        '<h6><i class="ti ti-chevron-right"></i> ' +
                        'Jarak Tempuh : ' + data.other.jarak_transport +
                        '</h6>' +
                        '<h6><i class="ti ti-chevron-right"></i> ' +
                        'Honor : Rp. ' + rupiah(data.other.honor_transport) +
                        '</h6>';
                    $("#srctransport").html(html_transport);

                    // Kegiatan
                    let jml_kegiatan = data.kegiatan.length;
                    let k;
                    let html_kegiatan = "";
                    if (jml_kegiatan == 0) {
                        $("#srckegiatan").html('<span class="text-danger fw-bolder">Tidak ada data</span>');
                    } else {
                        for (k = 0; k < jml_kegiatan; k++) {
                            html_kegiatan +=
                                '<h6><i class="ti ti-chevron-right"></i> ' +
                                data.kegiatan[k].nama_kegiatan +
                                ' [Rp. ' + rupiah(data.kegiatan[k].honor_kegiatan) + ']' +
                                '</h6>';
                            $("#srckegiatan").html(html_kegiatan);
                        }
                    }


                    // hitung total pendapatan
                    let html_pendapatan = "";
                    html_pendapatan +=
                        '<h6><span class="text-success"><i class="ti ti-discount-check"></i></span> ' + 'Honor Jabatan : Rp.' + rupiah(data.hitungan.total_jabatan) + '</h6>' +
                        '<h6><span class="text-success"><i class="ti ti-discount-check"></i></span> ' + 'Honor Mengajar : Rp.' + rupiah(data.hitungan.total_jam) + '</h6>' +
                        '<h6><span class="text-success"><i class="ti ti-discount-check"></i></span> ' + 'Honor Transport : Rp.' + rupiah(data.hitungan.total_transport) + '</h6>' +
                        '<h6><span class="text-success"><i class="ti ti-discount-check"></i></span> ' + 'Honor Kegiatan : Rp.' + rupiah(data.hitungan.total_kegiatan) + '</h6>' +
                        '<hr class="dashed">' +
                        '<h6 class="fw-bolder">Total : Rp. ' + rupiah(data.hitungan.total_pendapatan) + '</h6>' +
                        '<hr class="dashed">';
                    $("#srchitung").html(html_pendapatan);
                },
                error: function() {
                    $("#overlay").fadeOut(300);
                    $("#content").css('display', 'none');
                    let html_err = "";
                    html_err +=
                        '<div class="card">' +
                        '<div class="card-body">' +
                        '<h6 class="text-danger fw-bolder"> Data Bulan Ini Belum Di Inputkan! </h6>' +
                        '</div>' +
                        '</div>';
                    $("#errMessage").html(html_err);
                    $("#errMessage").css('display', 'block');

                    let monthYear = $("#formCari").val();
                    let month = monthYear.substring(0, 2);
                    let year = monthYear.substring(2, 6);
                    let html_alert = "";
                    html_alert +=
                        bulan(month) + ' ' + year;
                    $("#alert-bulantahun").html(html_alert);

                }
            });
            return false;
        });

        $('#srefresh').click(function() {
            location.reload();
        });
    });
</script>