 <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <p style="font-size: 11px;">Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>. All rights reserved.</p>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- jQuery -->
<script src="<?php echo base_url(); ?>asset/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>asset/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>asset/plugins/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>asset/dist/js/pages/dashboard3.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>asset/dist/js/demo.js"></script>
<script src="<?php echo base_url(); ?>asset/dist/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>asset/dist/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>asset/dist/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>asset/dist/js/responsive.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>asset/dist/js/jquery-ui.js"></script>
  <script src="<?php echo base_url(); ?>asset/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>


 <script type="text/javascript">
     $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })


    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  </script>

<script type="text/javascript">

    
 $(document).ready(function() {
  $(".accordion").on("click", function() {
    $(this).toggleClass("active");
    $(this).next().slideToggle(200);
  });
});
$(document).ready(function() {
    $('#example').DataTable();
} );
$(document).ready(function() {
    $('#examples').DataTable();
} );
</script>

</body>
</html>