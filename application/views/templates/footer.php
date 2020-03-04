
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="<?= base_url('vendor/') ?>vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?= base_url('vendor/') ?>vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/slick/slick.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/wow/wow.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/animsition/animsition.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/circle-progress/circle-progress.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/select2/select2.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/datatables/datatables.min.js"></script>
    <script src="<?= base_url('vendor/') ?>vendor/mousetrap/mousetrap.min.js"></script>

    <!-- Main JS-->
    <script src="<?= base_url('vendor/') ?>js/main.js"></script>
    <script>

        $(function() {
            
            $('#colls-first').click(function(){
                $(this).fadeOut();
                $('#colls').removeClass('is-active');
                $('.rivaldi').fadeOut();
                return false;

            });
            $('#colls').click(function(){
                $('.rivaldi').fadeToggle();
                $('#colls-first').fadeIn();
                $(this).hide();
                return false;

            });
            $('#colls').on('click', function () {
              $(this).toggleClass('is-active');
            });

            // menu
            $('.form-menu').click(function() {

                var id = $(this).data('id');
                var role = $(this).data('role');

                $.ajax({
                    url: "<?= base_url('akses/ubah_akses') ?>",
                    type : 'post',
                    data : {
                        id_menu : id,
                        id_role : role
                    },
                    success: function() {
                    }

                });
            });

            // sub menu
            $('.form-sub').click(function() {

                var id = $(this).data('id');
                var role = $(this).data('role');

                $.ajax({
                    url: "<?= base_url('akses/ubah_akses_sub') ?>",
                    type : 'post',
                    data : {
                        id_submenu : id,
                        id_role : role
                    },
                    success: function() {
                    }

                });
            });

            // get harga
             $('#nm_barang').on("keydown",function(e){


                   if(e.which==13){  
                    
                        e.preventDefault();

                        var id = $(this).val();

                        $.ajax({

                            url: "<?= base_url('transaksi/getharga') ?>",
                            method : "post",
                            data: {id : id},
                            dataType : "json",
                            success : function(data){
                                $("#harga").val(data.harga_jual);
                            }
                        });

                        $("#qty").focus();
                   }  
              });  

            $('#nm_barang').change(function(){

                var id = $(this).val();

                $.ajax({

                    url: "<?= base_url('transaksi/getharga') ?>",
                    method : "post",
                    data: {id : id},
                    dataType : "json",
                    success : function(data){
                        $("#harga").val(data.harga_jual);
                    }
                });
            });

            // total harga
            $('#qty').keyup(function(){
                
                if ($(this).val() == "") {
                    var qty = 1;
                }else{
                    var qty = $(this).val();
                }
                var harga = $("#harga").val();

                var hasil = qty * harga;

                $("#total_harga").val(hasil);
                $(".harga").text('Rp. ' + hasil);
            });

            // bayar
            $("#tunai").keyup(function(){
                var tunai = $(this).val();
                var total = $(".t_harga").val();
                var hasil = tunai - total;
                $("#kembalian").val(hasil);
            });

            // data tables
            $('.Tables').dataTable();

            // select2
            $('.select2').select2();


            $("#kd_departemen").on('change', function(){

                var kd = $(this).val();

                $.ajax({
                    url: '<?= base_url('Master/getSelectKelas') ?>',
                    data: {kd_departemen: kd},
                    method: 'post',
                    success: function(data){
                        $('#kd_kelas').html(data);
                    }

                });

            });


        // tambah barang tanpa barcode

        $('.brgNoBcd').click(function(e){
            e.preventDefault()

            var kd_barang = $(this).data('kd');

            $('#nm_barang').val(kd_barang);
            $('#nm_barang').focus();

        })

        // bind on keydown
        $('input').on('keydown', function(e) {

            // if we pressed the tab
            if (e.keyCode == 121) {
                // prevent default tab action
                e.preventDefault();
                $('#nm_barang').focus();

            }

            // if we pressed the tab
            if (e.keyCode == 192) {
                // prevent default tab action
                e.preventDefault();
                $('#tunai').focus();

            }

            // if we pressed the tab
            if (e.keyCode == 123) {
                // prevent default tab action
                e.preventDefault();
                $('input[type="search"]').focus();

            }
        });

        Mousetrap.bind('f110', function(e) { 
                e.preventDefault();
                $('#nm_barang').focus();
        });


        Mousetrap.bind('`', function(e) { 
                e.preventDefault();
                $('#tunai').focus();
        });

        
        Mousetrap.bind('f12', function(e) { 
                e.preventDefault();
                $('input[type="search"]').focus();
        });

    });




    </script>
    

</body>

</html>
<!-- end document-->
