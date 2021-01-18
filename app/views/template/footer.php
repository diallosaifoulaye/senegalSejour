



<!-- /.container-fluid -->
<footer class="footer text-center">
    <img src="<?php echo WEBROOT ?>assets/images/by_numherit.png" class="img-responsive" title="<?php echo $this->lang['numheritby'] ; ?>" style="height: 30px; display: block; margin-left: auto; margin-right: auto;">
</footer>
</div>
<!-- ============================================================== -->
<!-- End Page Content -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<!-- jQuery -->

<script src="<?= ASSETS ?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?= ASSETS ?>bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?= ASSETS ?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="<?= ASSETS ?>js/jquery.slimscroll.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?= ASSETS ?>js/custom.min.js"></script>
<script src="<?= ASSETS ?>js/mask.js"></script>

<!-- Datatables JavaScript -->
<script src="<?= ASSETS ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= ASSETS ?>plugins/datatables/dataTables.bootstrap.js"></script>
<!-- bootstrap time picker -->
<script type="text/javascript" src="<?= WEBROOT;?>theme/js/datetimepicker/moment.js"></script>
<script src="<?= ASSETS ?>plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?= ASSETS ?>plugins/datatables/extensions/Responsive/js/dataTables.responsive.js"></script>
<!-- Telephone -->
<script src="<?= ASSETS ?>plugins/telPlug/js/intlTelInput.js"></script>
<script src="<?= ASSETS ?>plugins/telPlug/js/utils.js"></script>
<!-- Jquery-confirm JS -->
<script src="<?= ASSETS ?>plugins/jconfirm/js/jquery-confirm.js"></script>
<script src="<?= ASSETS ?>plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js"></script>
<!-- DATE -->
<!--<script src="--><?//= ASSETS; ?><!--plugins/jquery-timepicker-1.3.5/jquery.timepicker.min.js"></script>-->
<!--<script src="--><?//= ASSETS; ?><!--js/bootstrap-datepicker.min.js"></script>-->
<!--<script src="--><?//= ASSETS; ?><!--datetimepicker/jquery.js"></script>-->
<script src="<?= ASSETS; ?>datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
<!--<script src="--><?//= ASSETS; ?><!--datetimepicker/build/jquery.datetimepicker.min.js"></script>-->





<!-- Sweet-Alert  -->
<script src="<?= ASSETS ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>

<script src="<?= ASSETS ?>plugins/select2/select2.full.min.js"></script>

<!-- SunuFramework JavaScript -->
<script src="<?= ASSETS ?>_main_/main.js"></script>
<script>
    $(".select2").select2();
</script>

<script type="text/javascript">
    var specialKeys = new Array();
    specialKeys.push(8); //Backspace
    function IsNumeric(e) {
        var keyCode = e.which ? e.which : e.keyCode
        var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
        /*document.getElementById("error").style.display = ret ? "none" : "inline";*/
        return ret;
    }
</script>


<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-2JBCbWoMJPH+Uj7Wq5OLub8E5edWHlTM4ar/YJkZh3plwB2INhhOC3eDoqHm1Za/ZOSksrLlURLoyXVdfQXqwg==" crossorigin="anonymous"></script>-->






</body>

</html>