<div class="container-fluid">
    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4"><?= $title ?></h5>
            <!-- BATAS -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Dokumen Pengambilan</h5>
                            <p class="card-text">Cetak Dokumen Untuk Tanda Terima Honor</p>
                            <form class="row g-3 form-inline">
                                <div class="col-auto">
                                    <select name="bulan" class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected value="">-- Pilih Bulan -- </option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">Septmber</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <select name="tahun" class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected value="">-- Pilih Tahun --</option>
                                        <?php $tahun = date('Y');
                                        for ($i = 2022; $i < $tahun + 3; $i++) { ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button id="btCheck" class="btn btn-dark btn-sm" onclick="showBt()"><i class="ti ti-check"></i></button>
                                </div>
                            </form>

                            <?php if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && isset($_GET['tahun']) && $_GET['tahun'] != '') {
                                $bulan = $_GET['bulan'];
                                $tahun = $_GET['tahun'];
                                $bulantahun = $bulan . $tahun;
                            } else {
                                $bulan = date('m');
                                $tahun = date('Y');
                                $bulantahun = $bulan . $tahun;
                            } ?>
                            <div class="mt-3">
                                <button id="btPrint" class="btn btn-primary btn-sm" onclick="printPage1()" style="display: none;">Cetak Dokumen</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-sm-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Dokumen Data Absensi Pegawai</h5>
                            <p class="card-text">Laporan absensi pegawai</p>
                            <form class="row g-3 form-inline">
                                <div class="col-auto">
                                    <select name="bulan" class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected value="">-- Pilih Bulan -- </option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">Septmber</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <select name="tahun" class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected value="">-- Pilih Tahun --</option>
                                        <?php $tahun = date('Y');
                                        for ($i = 2022; $i < $tahun + 3; $i++) { ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button id="btCheck" class="btn btn-dark btn-sm" onclick="showBt2()"><i class="ti ti-check"></i></button>
                                </div>
                            </form>
                            <div class="mt-3">
                                <button id="btPrint2" class="btn btn-primary btn-sm" onclick="printPage2()" style="display: none;">Cetak Dokumen</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Dokumen Penghonoran</h5>
                            <p class="card-text">Laporan Honor Pegawai</p>
                            <form class="row g-3 form-inline">
                                <div class="col-auto">
                                    <select name="bulan" class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected value="">-- Pilih Bulan -- </option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">Septmber</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <select name="tahun" class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected value="">-- Pilih Tahun --</option>
                                        <?php $tahun = date('Y');
                                        for ($i = 2022; $i < $tahun + 3; $i++) { ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button id="btCheck" class="btn btn-dark btn-sm" onclick="showBt3()"><i class="ti ti-check"></i></button>
                                </div>
                            </form>
                            <div class="mt-3">
                                <button id="btPrint3" class="btn btn-primary btn-sm" onclick="printPage3()" style="display: none;">Cetak Dokumen</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Slip Gaji Pegawai</h5>
                            <p class="card-text">Gunakan ukuran A5 untuk layout terbaik</p>
                            <form class="row g-3 form-inline">
                                <div class="col-auto">
                                    <select name="bulan" class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected value="">-- Pilih Bulan -- </option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">Septmber</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <select name="tahun" class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected value="">-- Pilih Tahun --</option>
                                        <?php $tahun = date('Y');
                                        for ($i = 2022; $i < $tahun + 3; $i++) { ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button id="btCheck" class="btn btn-dark btn-sm" onclick="showBt4()"><i class="ti ti-check"></i></button>
                                </div>
                            </form>
                            <div class="mt-3">
                                <button id="btPrint4" class="btn btn-primary btn-sm" onclick="printPage4()" style="display: none;">Cetak Dokumen</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BATAS -->
        </div>
    </div>
</div>
<div id="printerDiv" style="display:none"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    function printPage1() {
        var div = document.getElementById("printerDiv");
        div.innerHTML = '<iframe src="<?= base_url('admin/laporan/print_pengambilan/') . $bulantahun ?>" onload="this.contentWindow.print();"></iframe>';
        $('#btPrint').hide();
        localStorage.removeItem("show");
    }

    function showBt() {
        $('#btPrint').show();
        $('#btPrint2').hide();
        localStorage.setItem('show', 'true'); //store state in localStorage
        localStorage.removeItem("tampil");
        localStorage.removeItem("show2");
    }

    $(document).ready(function(e) {

        var show = localStorage.getItem('show');
        if (show === 'true') {
            $('#btPrint').show();
        }
    });


    // print absensi

    function showBt2() {
        $('#btPrint2').show();
        localStorage.setItem('tampil', 'true'); //store state in localStorage
        localStorage.removeItem("show");
        localStorage.removeItem("show2");
        localStorage.removeItem("show3");
    }
    $(document).ready(function(e) {

        var tampil = localStorage.getItem('tampil');
        if (tampil === 'true') {
            $('#btPrint2').show();
        }
    });

    function printPage2() {
        var div = document.getElementById("printerDiv");
        div.innerHTML = '<iframe src="<?= base_url('admin/laporan/print_absensi/') . $bulantahun ?>" onload="this.contentWindow.print();"></iframe>';
        $('#btPrint2').hide();
        localStorage.removeItem("tampil");
    }

    // Print 3 hobor
    function showBt3() {
        $('#btPrint3').show();
        localStorage.setItem('show2', 'true'); //store state in localStorage
        localStorage.removeItem("show");
        localStorage.removeItem("show3");
        localStorage.removeItem("tampil");
    }
    $(document).ready(function(e) {

        var show2 = localStorage.getItem('show2');
        if (show2 === 'true') {
            $('#btPrint3').show();
        }
    });

    function printPage3() {
        var div = document.getElementById("printerDiv");
        div.innerHTML = '<iframe src="<?= base_url('admin/laporan/print_honor/') . $bulantahun ?>" onload="this.contentWindow.print();"></iframe>';
        $('#btPrint3').hide();
        localStorage.removeItem("show2");
    }

    // print 4 slip gaji

    function showBt4() {
        $('#btPrint4').show();
        localStorage.setItem('show3', 'true'); //store state in localStorage
        localStorage.removeItem("show");
        localStorage.removeItem("tampil");
        localStorage.removeItem("show2");
    }
    $(document).ready(function(e) {

        var show3 = localStorage.getItem('show3');
        if (show3 === 'true') {
            $('#btPrint4').show();
        }
    });

    function printPage4() {
        var div = document.getElementById("printerDiv");
        div.innerHTML = '<iframe src="<?= base_url('admin/laporan/print_slip/') . $bulantahun ?>" onload="this.contentWindow.print();"></iframe>';
        $('#btPrint4').hide();
        localStorage.removeItem("show3");
    }
</script>