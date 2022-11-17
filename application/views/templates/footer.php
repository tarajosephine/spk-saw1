</div>
<!-- content -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin keluar?</h5>
                <button class="btn btn-close" type="button" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Klik tombol keluar untuk logout dari aplikasi.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="<?= base_url(); ?>auth/logout">Keluar</a>
            </div>
        </div>
    </div>
</div>

<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <script>
                document.write(new Date().getFullYear())
                </script> © idPlay - Developer
            </div>
            <div class="col-md-6">
                <div class="text-md-end footer-links d-none d-md-block">
                    <a href="javascript: void(0);">About</a>
                    <a href="javascript: void(0);">Support</a>
                    <a href="javascript: void(0);">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Right Sidebar -->
<div class="end-bar">

    <div class="rightbar-title">
        <a href="javascript:void(0);" class="end-bar-toggle float-end">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0">Settings</h5>
    </div>

    <div class="rightbar-content h-100" data-simplebar="">

        <div class="p-3">
            <div class="alert alert-warning" role="alert">
                <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
            </div>

            <!-- Settings -->
            <h5 class="mt-3">Color Scheme</h5>
            <hr class="mt-1">

            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="light"
                    id="light-mode-check" checked="">
                <label class="form-check-label" for="light-mode-check">Light Mode</label>
            </div>

            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="dark"
                    id="dark-mode-check">
                <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
            </div>


            <!-- Width -->
            <h5 class="mt-4">Width</h5>
            <hr class="mt-1">
            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="width" value="fluid" id="fluid-check" checked="">
                <label class="form-check-label" for="fluid-check">Fluid</label>
            </div>

            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="width" value="boxed" id="boxed-check">
                <label class="form-check-label" for="boxed-check">Boxed</label>
            </div>


            <!-- Left Sidebar-->
            <h5 class="mt-4">Left Sidebar</h5>
            <hr class="mt-1">
            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="theme" value="default" id="default-check">
                <label class="form-check-label" for="default-check">Default</label>
            </div>

            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="theme" value="light" id="light-check" checked="">
                <label class="form-check-label" for="light-check">Light</label>
            </div>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" name="theme" value="dark" id="dark-check">
                <label class="form-check-label" for="dark-check">Dark</label>
            </div>

            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="compact" value="fixed" id="fixed-check"
                    checked="">
                <label class="form-check-label" for="fixed-check">Fixed</label>
            </div>

            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="compact" value="condensed" id="condensed-check">
                <label class="form-check-label" for="condensed-check">Condensed</label>
            </div>

            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="compact" value="scrollable" id="scrollable-check">
                <label class="form-check-label" for="scrollable-check">Scrollable</label>
            </div>

            <div class="d-grid mt-4">
                <button class="btn btn-primary" id="resetBtn">Reset to Default</button>

                <a href="../../product/hyper-responsive-admin-dashboard-template/index.htm" class="btn btn-danger mt-3"
                    target="_blank"><i class="mdi mdi-basket me-1"></i> Purchase Now</a>
            </div>
        </div> <!-- end padding-->

    </div>
</div>

<div class="rightbar-overlay"></div>
<!-- /End-bar -->

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- bundle -->
<script src="<?= base_url(); ?>assets/js/vendor.min.js"></script>
<script src="<?= base_url(); ?>assets/js/app.min.js"></script>

<!-- third party js -->
<script src="<?= base_url(); ?>assets/js/vendor/apexcharts.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
<!-- third party js ends -->

<!-- demo app -->
<script src="<?= base_url(); ?>assets/js/pages/demo.dashboard.js"></script>
<!-- end demo js-->

<!-- Typehead -->
<script src="<?= base_url(); ?>assets/js/vendor/handlebars.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/typeahead.bundle.min.js"></script>

<!-- Demo -->
<script src="<?= base_url(); ?>assets/js/pages/demo.typehead.js"></script>

<!-- Timepicker -->
<script src="<?= base_url(); ?>assets/js/pages/demo.timepicker.js"></script>

<!-- third party js -->
<script src="<?= base_url(); ?>assets/js/vendor/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/dataTables.bootstrap5.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/responsive.bootstrap5.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/buttons.flash.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/dataTables.keyTable.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/dataTables.select.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<!-- third party js ends -->

<!-- demo app -->
<script src="<?= base_url(); ?>assets/js/pages/demo.form-wizard.js"></script>
<!-- end demo js-->

<!-- demo app -->
<script src="<?= base_url(); ?>assets/js/pages/demo.datatable-init.js"></script>
<!-- end demo js-->

<script src="<?= base_url(); ?>assets/js/script.js"></script>

<script>
// angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
setTimeout(function() {
    $(".alert").fadeOut('slow');
}, 3000);
</script>
</body>

</html>