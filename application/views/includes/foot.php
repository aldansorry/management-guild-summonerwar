<script src="<?php echo base_url('assets/adminlte/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

<!-- DataTables -->
<script src="<?php echo base_url('assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('assets/js/custom.datatables.js'); ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/adminlte/bower_components/fastclick/lib/fastclick.js'); ?>"></script>
<!-- SweatAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- Toast -->
<script src="<?php echo base_url('assets/plugins/toast-master/js/jquery.toast.js'); ?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/adminlte/bower_components/select2/dist/js/select2.full.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/adminlte/dist/js/adminlte.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/adminlte/plugins/iCheck/icheck.min.js'); ?>"></script>
<script>
    window.base_url = '<?php echo base_url(); ?>';

    var filename = "<?php echo current_url(); ?>";
    $('a[href*="' + filename + '"]').parent().addClass('active').parents('.treeview').addClass('menu-open').find('.treeview-menu').css('display', 'block');
</script>
<!-- form -->
<script>
    function onlyAlphaSpace(e) {
        e = e || window.event;
        var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
        var charStr = String.fromCharCode(charCode);
        if (!/^[a-zA-Z ]*$/.test(charStr)) {
            e.preventDefault();
            return false;
        }
        return true;
    }

    function onlyNumber(e) {
        e = e || window.event;
        var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
        var charStr = String.fromCharCode(charCode);
        if (!/^[0-9]*$/.test(charStr)) {
            e.preventDefault();
            return false;
        }
        return true;
    }
</script>
<?php if (isset($script)) {
    $this->load->view($script);
} ?>