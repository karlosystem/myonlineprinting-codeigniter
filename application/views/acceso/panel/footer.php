<footer class="py-4 bg-light mt-auto">
  <div class="container-fluid px-4">
    <div class="d-flex align-items-center justify-content-between small">
      <div class="text-muted">Copyright &copy; Myonlineprinting 2022</div>
      <div>
        <a href="#">Privacy Policy</a>
        &middot;
        <a href="#">Terms &amp; Conditions</a>
      </div>
    </div>
  </div>
</footer>
</div>
</div>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/acceso/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/acceso/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/acceso/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/acceso/js/dataTables.bootstrap4.js"></script>

<script src="<?php echo base_url(); ?>assets/acceso/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/acceso/js/general.js"></script>
<script src="<?php echo base_url(); ?>assets/acceso/js/ankit.js"></script>


<script>
  jQuery.noConflict();
  jQuery(function() {
    jQuery('#datatablesSimple').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>assets/acceso/js/scripts.js"></script>
</body>

</html>