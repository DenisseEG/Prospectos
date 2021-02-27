        <script>
           const base_url = '<?= base_url(); ?>';
        </script>
        <!-- Essential javascripts for application to work-->
        <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
        <script src="<?= media(); ?>/js/popper.min.js"></script>
        <script src="<?= media(); ?>/js/bootstrap.min.js"></script>
        <script src="<?= media(); ?>/js/main.js"></script>
        <script src="<?= media(); ?>/js/functions.js"></script>
        <!-- The javascript plugin to display page loading on top-->
        <script src="<?= media(); ?>/js/plugins/pace.min.js"></script>
        <!-- SweetAlert2-->
        <script src="<?= media(); ?>/js/plugins/sweetalert2.all.min.js"></script>
        <!-- Data table plugin-->
        <script type="text/javascript" src="<?= media(); ?>/js/plugins/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?= media(); ?>/js/plugins/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= media(); ?>/js/plugins/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="<?= media(); ?>/js/plugins/jszip.min.js"></script>
        <script type="text/javascript" src="<?= media(); ?>/js/plugins/pdfmake.min.js"></script>
        <script type="text/javascript" src="<?= media(); ?>/js/plugins/vfs_fonts.js"></script>
        <script type="text/javascript" src="<?= media(); ?>/js/plugins/buttons.html5.min.js"></script>

        <script src="<?= media(); ?>/js/<?= $data['functions_js']; ?>"></script>
    </body>
</html>
