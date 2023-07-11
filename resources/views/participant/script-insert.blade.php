<script>
    $("#provinsi").change(function () {
        $('#placeKota').text("pilih kota");
        $('#kota').val(null).trigger('change');
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
console.log(data);
                    $("#placeKota").removeAttr("hidden");
                    $.each(data, function (index) {
                        $('#kota').append('<option class="kotaOption" value="' + data[index].id + '">' + convertToCamelCase(data[index].nama_kota) + '</option>')
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
            console.log($('#kota').val())
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
                        $('#kec').append('<option class="kecOption" value="' + data[index].id + '">' + convertToCamelCase(data[index].nama_kecamatan) + '</option>')
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
                        $('#kel').append('<option class="kelOption" value="' + data[index].id + '">' + convertToCamelCase(data[index].nama_kelurahan) + '</option>')
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