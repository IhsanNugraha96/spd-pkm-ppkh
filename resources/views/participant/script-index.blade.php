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
            ajax: "{{ route('participants') }}",
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
                    data: 'nik',
                    name: 'nik',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'nama',
                    name: 'nama',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'alamat',
                    name: 'alamat',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    orderable: true,
                    searchable: true,
                    className: "text-center"
                },
                {
                    data: 'name',
                    name: 'name',
                    orderable: true,
                    searchable: true,
                    className: "text-center"
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                },
                
            ],
            // columnDefs: [{
            //     width: '10%',
            //     targets: 0
            // },
            // {
            //     width: '40%',
            //     targets: 1
            // },
            // {
            //     width: '30%',
            //     targets: 2
            // }]
            columnDefs: [
                {
                    targets: [4], // Kolom ke-4 (mulai dari 0)
                    render: function(data, type, row) {
                        // Menggunakan moment.js untuk memformat tanggal dan waktu
                        return moment(data).format('DD-MM-YYYY (HH:mm:ss)');
                    }
                }
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

    $('#editParticipantModal').on('show.bs.modal', function (event) {
        var button  = $(event.relatedTarget) // Button that triggered the modal
        var data_id = button.data('id') // Extract info from data-* attributes
        var modal   = $(this)
        $('#data_id').val(data_id);
        $('#nik').val('');
        $('#name').val('');
        $('#tmp_lahir').val('');
        $('#tgl_lahir').val('');
        $('#alamat').val('');
        $('#rt').val('');
        $('#rw').val('');
        $('#agama').val('');
        $('#kawin').val('');
        $('#pekerjaan').val('');
        $('#negara').val('');
        $('#kk').val('');
        $('#kpl_kk').val('');
        $('#thn_peserta').val('');
        $('#thn_peserta').val('');
        
console.log(button.data('id'));        
        $.ajax({
            type: 'GET',
            url: '{{ route('participant.getById') }}',
            dataType: 'json',
            data: {
                id: button.data('id')
            },
            success: function(response) {
console.log(response);
                $('#nik_lama').val(response[0]['id_ktp']);
                $('#nik').val(response[0]['nik']);
                $('#name').val(response[0]['nama']);
                $('#tmp_lahir').val(response[0]['tempat_lahir']);
                $('#tgl_lahir').val(response[0]['tgal_lahir']);
                $('#alamat').val(response[0]['alamat']);
                $('#rt').val(response[0]['rt']);
                $('#rw').val(response[0]['rw']);
                $('#agama').val(response[0]['id_agama']);
                $('#kawin').val(response[0]['status_perkawinan']);
                $('#pekerjaan').val(response[0]['pekerjaan']);
                $('#negara').val(response[0]['kewarganegaraan']);
                $('#kk_lama').val(response[0]['id_kk']);
                $('#kk').val(response[0]['no_kk']);
                $('#kpl_kk').val(response[0]['kepala_keluarga']);
                $('#thn_peserta').val(response[0]['tahun_kepesertaan']);
                $('#ibu').val(response[0]['nama_ibu']);                
                $('#provinsi').val(response[0]['id_provinsi']);        
                $('#kota').val(response[0]['id_kota']);        
                $('#kec').val(response[0]['id_kecamatan']);        
                $('#kel').val(response[0]['id_kelurahan']); 
                
                var id_kota = response[0]['id_kota'];
                
                $.ajax({
                    url: '{{ route("list-kota.prov") }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'id': response[0]['id_provinsi'],
                    },
                    error: function (data, textStatus, errorThrown) {
                        console.log(data);
                    },
                    success: function (data) {
                        $.each(data, function (index) {
                            var option = $('<option>').addClass('kotaOption').val(data[index].id).text(convertToCamelCase(data[index].nama_kota));
                            if (data[index].id == id_kota) {
                                option.prop('selected', true);
                            }
                            $('#kota').append(option);
                        });
                    }
                });

                var id_kecamatan = response[0]['id_kecamatan'];
                $.ajax({
                    url: '{{ route("list-kec.kota") }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'id': id_kota,
                    },
                    error: function (data, textStatus, errorThrown) {
                        console.log(data);
                    },
                    success: function (data) {
                        $.each(data, function (index) {
                            var option = $('<option>').addClass('kecOption').val(data[index].id).text(convertToCamelCase(data[index].nama_kecamatan));
                            if (data[index].id == id_kecamatan) {
                                option.prop('selected', true);
                            }
                            $('#kec').append(option);
                        });
                    }
                });

                var id_kelurahan = response[0]['id_kelurahan'];
                $.ajax({
                    url: '{{ route("list-kel.kec") }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'id': id_kecamatan,
                    },
                    error: function (data, textStatus, errorThrown) {
                        console.log(data);
                    },
                    success: function (data) {
                        console.log(data);
                        $.each(data, function (index) {
                            var option = $('<option>').addClass('kelOption').val(data[index].id).text(convertToCamelCase(data[index].nama_kelurahan));
                            if (data[index].id == id_kelurahan) {
                                option.prop('selected', true);
                            }
                            $('#kel').append(option);
                        });
                        
                    }
                });
            },
            error: function(xhr) {
                
            }
        });         
    });        

    $('#deleteUserModal').on('show.bs.modal', function (event) {
        var button  = $(event.relatedTarget) // Button that triggered the modal
        var data_id = button.data('id') // Extract info from data-* attributes
        $('#id').val(data_id);
    });

    function viewDetail(id)
    {
        window.location.href = "{{ route('participant.view-detail') }}?id=" + id;
    }

    $("#provinsi").change(function () {
        $('#placeKota').text("pilih kota");
        $('#kota').val(null).trigger('change');
        // $('label.error').remove();
        $("#kota").attr("disabled", true);
        $('.kotaOption').remove();
        $("#kec").attr("disabled", true);
        $('.kecOption').remove();
        $("#kel").attr("disabled", true);
        $('.kelOption').remove();
            var parents = $("#kota").parent();
            var childFocus = parents.find('.select2');
            var childChild = childFocus.find('.select2-selection');
            var childArrow = childFocus.find('.select2-selection__arrow');
            childChild.removeClass("empty");
            childArrow.removeClass("d-none");
            $.ajax({
                url: '{{ route("list-kota.prov") }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    'id': $('#provinsi').val(),
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
                success: function (data) {
                    $("#placeKota").removeAttr("hidden");
                    $.each(data, function (index) {
                        $('#kota').append('<option class="kotaOption" value="' + data[index].id_kota + '">' + convertToCamelCase(data[index].nama_kota) + '</option>')
                    });

                    $('#kota').val(null).trigger('change');
                    var parents = $("#kota").parent();
                    var childFocus = parents.find('.select2');
                    var childChild = childFocus.find('.select2-selection');
                    var childArrow = childFocus.find('.select2-selection__arrow');
                    childChild.addClass("empty");
                    childArrow.addClass("d-none");
                    if (data.length == 0) {
                        $('#placeKota').text(
                            "Tidak ada data kota pada provinsi tersebut");
                        $('#kota').select2({
                            minimumResultsForSearch: -1
                        });
                        $('.select2-selection__rendered').hover(function () {
                            $(this).removeAttr('title');
                        });
                        var parents = $("#kota").parent();
                        var childFocus = parents.find('.select2');
                        var childChild = childFocus.find('.select2-selection');
                        var childArrow = childFocus.find('.select2-selection__arrow');
                        childChild.addClass("empty");
                        childArrow.addClass("d-none");
                    } else {
                        $('#placeKota').text("pilih kota");
                        $("#kota").attr("disabled", false);
                        $("#placeKota").prop("selected", true);
                    }
                }
            });
        });

        $("#kota").change(function () {
        $('#placeKecamatan').text("pilih kecamatan");
        $('#kec').val(null).trigger('change');
        $("#kec").attr("disabled", true);
        $('.kecOption').remove();
            var parents = $("#kec").parent();
            var childFocus = parents.find('.select2');
            var childChild = childFocus.find('.select2-selection');
            var childArrow = childFocus.find('.select2-selection__arrow');
            childChild.removeClass("empty");
            childArrow.removeClass("d-none");
            $.ajax({
                url: '{{ route("list-kec.kota") }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    'id': $('#kota').val(),
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
                success: function (data) {
                    $("#placeKecamatan").removeAttr("hidden");
                    $.each(data, function (index) {
                        $('#kec').append('<option class="kecOption" value="' + data[index].id_kecamatan + '">' + convertToCamelCase(data[index].nama_kecamatan) + '</option>')
                    });

                    $('#kec').val(null).trigger('change');
                    var parents = $("#kec").parent();
                    var childFocus = parents.find('.select2');
                    var childChild = childFocus.find('.select2-selection');
                    var childArrow = childFocus.find('.select2-selection__arrow');
                    childChild.addClass("empty");
                    childArrow.addClass("d-none");
                    if (data.length == 0) {
                        $('#placeKecamatan').text(
                            "Tidak ada data kecamatan pada kota tersebut");
                        $('#kec').select2({
                            minimumResultsForSearch: -1
                        });
                        $('.select2-selection__rendered').hover(function () {
                            $(this).removeAttr('title');
                        });
                        var parents = $("#kec").parent();
                        var childFocus = parents.find('.select2');
                        var childChild = childFocus.find('.select2-selection');
                        var childArrow = childFocus.find('.select2-selection__arrow');
                        childChild.addClass("empty");
                        childArrow.addClass("d-none");
                    } else {
                        $('#placeKecamatan').text("pilih kecamatan");
                        $("#kec").attr("disabled", false);
                        $("#placeKecamatan").prop("selected", true);
                    }
                }
            });
        });

    $("#kec").change(function () {
        $('#placeKelurahan').text("pilih kelurahan");
        $('#kel').val(null).trigger('change');
        $("#kel").attr("disabled", true);
        $('.kelOption').remove();
            var parents = $("#kel").parent();
            var childFocus = parents.find('.select2');
            var childChild = childFocus.find('.select2-selection');
            var childArrow = childFocus.find('.select2-selection__arrow');
            childChild.removeClass("empty");
            childArrow.removeClass("d-none");
            $.ajax({
                url: '{{ route("list-kel.kec") }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    'id': $('#kec').val(),
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
                success: function (data) {
console.log(data);
                    $("#placeKelurahan").removeAttr("hidden");
                    $.each(data, function (index) {
                        $('#kel').append('<option class="kelOption" value="' + data[index].id_kelurahan + '">' + convertToCamelCase(data[index].nama_kelurahan) + '</option>')
                    });

                    $('#kel').val(null).trigger('change');
                    var parents = $("#kel").parent();
                    var childFocus = parents.find('.select2');
                    var childChild = childFocus.find('.select2-selection');
                    var childArrow = childFocus.find('.select2-selection__arrow');
                    childChild.addClass("empty");
                    childArrow.addClass("d-none");
                    if (data.length == 0) {
                        $('#placeKelurahan').text(
                            "Tidak ada data kelurahan pada kecamatan tersebut");
                        // $('#kel').select2({
                        //     minimumResultsForSearch: -1
                        // });
                        $('.select2-selection__rendered').hover(function () {
                            $(this).removeAttr('title');
                        });
                        var parents = $("#kel").parent();
                        var childFocus = parents.find('.select2');
                        var childChild = childFocus.find('.select2-selection');
                        var childArrow = childFocus.find('.select2-selection__arrow');
                        childChild.addClass("empty");
                        childArrow.addClass("d-none");
                        $("#kel").attr("disabled", false);
                        $("#placeKelurahan").prop("selected", true);
                    } else {
                        $('#placeKelurahan').text("pilih kelurahan");
                        $("#kel").attr("disabled", false);
                        $("#placeKelurahan").prop("selected", true);
                    }
                }
            });
        });

    function convertToCamelCase(text) {
        var words = text.split(' ');            
        var camelCaseWords = words.map(function(word, index) {                
            return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
        });            
        return camelCaseWords.join(' ');
    }
</script>
