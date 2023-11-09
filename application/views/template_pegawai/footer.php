<script src="<?= base_url('assets/') ?>libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- DATA TABLE -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script src="<?= base_url('assets/') ?>js/croppie.min.js"></script>

<!-- convert form to rupiah ketika mengetik -->
<script src="<?= base_url('assets/'); ?>js/convertRupiah.js"></script>
<script>
    function hanyaAngka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }
</script>

</body>

</html>