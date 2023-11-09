</div>
</div>
<!-- <script src="<?= base_url('assets/') ?>libs/jquery/dist/jquery.min.js"></script> -->
<script src="<?= base_url('assets/') ?>libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/') ?>js/sidebarmenu.js"></script>
<script src="<?= base_url('assets/') ?>js/app.min.js"></script>
<script src="<?= base_url('assets/') ?>libs/simplebar/dist/simplebar.js"></script>

<!-- DATA TABLE -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script src="<?= base_url('assets/') ?>js/croppie.min.js"></script>

<!-- convert form to rupiah ketika mengetik -->
<script src="<?= base_url('assets/'); ?>js/convertRupiah.js"></script>

<script>
    // SCRIPT DATA TABEL JABATAN
    $('#myTable').DataTable({
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        }
    });

    $('#tbreset').DataTable({
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        }
    });

    // SCRIPT DATA TABEL JAM MENGAJAR
    $('#myTableMapel').DataTable({
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        }
    });

    // SCRIPT DATA TABEL PEGAWAI
    $('#tablePegawai').DataTable({
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        }
    });

    // SCRIPT DATA TABEL JARAK
    $('#tabel_jarak').DataTable({
        searching: false,
        paging: false,
        info: false,
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        }
    });

    // SCRIPT DATA TABEL HONOR
    $('#tabel_honor').DataTable({
        searching: true,
        paging: false,
        info: false,
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        }
    });

    // SCRIPT DATA TABEL PILIH PEGAWAI
    $('#tbPilihPegawai').DataTable({
        searching: true,
        paging: false,
        info: false,
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        }
    });

    // SCRIPT DATA TABEL ARSIP
    $('#tbArsip').DataTable({
        searching: true,
        paging: true,
        info: false,
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        }
    });


    // SCRIPT INPUTAN FORM HANYA ANGKA

    function hanyaAngka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }

    // SCRIPT JQUERY UNTUK MEMILIH PEGAWAI (TAMBAH HONOR KEGIATAN)
    $(document).ready(function() {

        $(document).on('click', '#row_pegawai', function(e) {
            document.getElementById("id_pegawai").value = $(this).attr('data-id_pegawai');
            document.getElementById("nama_pegawai").value = $(this).attr('data-nama');
            $('#cariPegawai').modal('hide');
        });

    });

    // SCRIPT AUTOCLOSE FLASH DATA

    setTimeout(function() {
        $('.flash').hide('slow');
    }, 3000);


    // SCRIPT UNTUK MENAMBAH FORM DINAMIS
    $(document).ready(function(e) {

        $('#addMore').click(function(e) {

            e.preventDefault();
            $('#groupKegiatan').append(`
                <div class="row mb-3 divList">
                <div class="col-3">
                    <label class="form-label">Nama Kegiatan</label>
                    <input type="text" class="form-control" name="nama_kegiatan[]" maxlength="20" required>
                </div>
                <div class="col-3">
                    <label class="form-label">Honor</label>
                    <div class="input-group">
                        <span class="input-group-text text-dark" id="basic-addon1">Rp.</span>
                        <input type="text" class="form-control" name="honor_kegiatan[]" onkeypress="return hanyaAngka(event)" onkeyup="convertToRupiah(this);" required>
                    </div>
                </div>
                <div class="col mt-1">
                    <br>
                    <button type="button" id="removeList" class="btn btn-danger mt-1"><i class="ti ti-minus"></i></button>
                </div>
                </div>
            `);
        });

    });

    $(document).on('click', '#removeList', function(e) {
        e.preventDefault();
        $(this).parents('.divList').remove();
    });


    // SAKLAR CHECK ALL

    $("button[name='submitBtn']").prop('disabled', true);
    $(function() {
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
            if ($(this).is(':checked')) {
                $('#arsipkan').removeAttr('disabled');
            } else {
                $('#arsipkan').attr('disabled', 'disabled');
            }
        });
    });


    if ($("#checkArsip").is(":checked")) {
        $("#checkAll").attr('disabled', true);
        $("#checkAll").attr('checked', true);
        $("#arsipkan").hide();
        $("#addKegiatan").hide();
        $(".peringatan").hide();
        $("label[for='checkAll']").text('Semua data telah di arsipkan!');
        $("label[for='checkAll']").addClass('text-dark');
        $("label[for='checkAll']").css('opacity', '1');
    } else {
        $("#arsipkan").show();
    }
</script>
</body>

</html>