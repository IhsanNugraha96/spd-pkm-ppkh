{{-- <script> --}}
    <!-- jQuery -->
    <script src={{ asset("assets/jquery/dist/jquery.min.js") }}></script>
    <!-- Bootstrap -->
   <script src={{ asset("assets/bootstrap/dist/js/bootstrap.bundle.min.js") }}></script>
    <!-- FastClick -->
    <script src={{ asset("assets/fastclick/lib/fastclick.js") }}></script>
    <!-- NProgress -->
    <script src={{ asset("assets/nprogress/nprogress.js") }}></script>
    <!-- iCheck -->
    <script src={{ asset("assets/iCheck/icheck.min.js") }}></script>
    <!-- Datatables -->
    <script src={{ asset("assets/datatables.net/js/jquery.dataTables.min.js") }}></script>
    <script src={{ asset("assets/datatables.net-bs/js/dataTables.bootstrap.min.js") }}></script>
    <script src={{ asset("assets/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js") }}></script>
    <script src={{ asset("assets/datatables.net-keytable/js/dataTables.keyTable.min.js") }}></script>
    <script src={{ asset("assets/datatables.net-responsive/js/dataTables.responsive.min.js") }}></script>
    <script src={{ asset("assets/datatables.net-responsive-bs/js/responsive.bootstrap.js") }}></script>
    <script src={{ asset("assets/datatables.net-scroller/js/dataTables.scroller.min.js") }}></script>
    <script src={{ asset("assets/jszip/dist/jszip.min.js") }}></script>
    <script src={{ asset("assets/pdfmake/build/pdfmake.min.js") }}></script>
    <script src={{ asset("assets/pdfmake/build/vfs_fonts.js") }}></script>
    
{{-- </script> --}}

<script>
    $(document).ready( function() {
        getData();

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
                }, false);
            });
            }, false);
        })();
    });
        
    function getData(e = null) {
        if (e) {
            e.preventDefault();
        }
        var mainTable = $('#datatable');
        mainTable.DataTable().clear().destroy();

        mainTable.DataTable({
            ajax: "{{ route('kelompok') }}",
            bFilter: false,
            processing: true,
            serverSide: true,
            scrollX: true,
            scrollY: false,
            searching: true,
            language: {
                sEmptyTable: "Tidak ada data yang tersedia pada tabel ini",
                sProcessing: "Sedang memproses...",
                sLengthMenu: "Tampilkan data _MENU_",
                sZeroRecords: "Tidak ditemukan data yang sesuai",
                sInfo: "_START_ - _END_ dari _TOTAL_",
                sInfoEmpty: "0 - 0 dari 0",
                sInfoFiltered: "(disaring dari _MAX_ data keseluruhan)",
                sInfoPostFix: "",
                sSearch: "",
                searchPlaceholder: "Cari ...",
                sUrl: "",
                oPaginate: {
                    sFirst: "pertama",
                    sPrevious: "sebelumnya",
                    sNext: "selanjutnya",
                    sLast: "terakhir"
                }
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                },
                {
                    data: 'nama_kelompok',
                    name: 'nama_kelompok',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'name',
                    name: 'name',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'pembimbing',
                    name: 'pembimbing',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                },
                
            ],
            columnDefs: [{
                    width: '5%',
                    targets: 0
                },
                // {
                //     targets: [4], // Kolom ke-4 (mulai dari 0)
                //     render: function(data, type, row) {
                //         // Menggunakan moment.js untuk memformat tanggal dan waktu
                //         return moment(data).format('DD-MM-YYYY (HH:mm:ss)');
                //     }
                // }
            ]
        });
    }

    function loadingScreen(msg) {
        var $white = '#fff';
        var src = $("#logo_kai").attr('src');
        $.blockUI({
            message: '<img src="' + src + '" style="height: 80px; width: auto"> <hr> <h3>' + msg + '</h3>',
            timeout: 5000, //unblock after 5 seconds
            overlayCSS: {
                backgroundColor: $white,
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'transparent'
            }
        });
    }

    $('#editGroupModal').on('show.bs.modal', function (event) {
        var button  = $(event.relatedTarget) // Button that triggered the modal
        var data_id = button.data('id') // Extract info from data-* attributes
        var modal   = $(this)
        $('#data_id').val(data_id);
        $('#name').val('');
        
        $.ajax({
            type: 'GET',
            url: '{{ route('kelompok.getById') }}',
            dataType: 'json',
            data: {
                id: data_id
            },
            success: function(response) {
                console.log(response);
                $('#name').val(response[0]['nama_kelompok']);
                $("#akun_edit").val(response[0]['id_akun_user'])
            },
            error: function(xhr) {
                $('#name').val('insert new name');
            }
        });         
    });        

    $('#deleteGroupModal').on('show.bs.modal', function (event) {
        var button  = $(event.relatedTarget) // Button that triggered the modal
        var data_id = button.data('id') // Extract info from data-* attributes
        $('#id').val(data_id);
    });

</script>
