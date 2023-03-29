$(document).ready(function () {
    //Deklarasi DataTables
    let table = $('#dataTables').DataTable({
        "processing": true,
        "responsive": true,
        "searching": true,
        "bLengthChange": true,
        "info": false,
        "ordering": true,
        "serverSide": true,
        "ajax": "dataTablesMempelai",
        "columnDefs": [{
            "targets": [3], // index kolom atau sel yang ingin diatur
            "className": 'text-center' // kelas CSS untuk memposisikan isi ke tengah
        }],
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {
                "data": "pria"
            },
            {
                "data": "wanita"
            },
            {
                "data": "action",
                "orderable": true,
                "searchable": true
            },
        ],
        "order": [
            [0, 'desc']
        ]
    });
    // RESET
    $("#btn-tambah").on('click', function () {

        $("#nama_wanita").val('')
        $("#nama_pria").val('')
        $("#slug").val('')
        $("#template").val('')
    })
    $("#btn-close").on('click', function () {

        $("#nama_wanita").val('')
        $("#nama_pria").val('')
        $("#slug").val('')
        $("#template").val('')
    })
    $("#btn-x").on('click', function () {

        $("#nama_wanita").val('')
        $("#nama_pria").val('')
        $("#slug").val('')
        $("#template").val('')
    })
    // ACTION SAVE
    $('.btn-save').on('click', function (e) {
        var formdata = $("#modal-mempelai form").serializeArray();
        var data = {};
        $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value;
        });
        $.ajax({
            data: $('#modal-mempelai form').serialize(),
            url: "/mempelai",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                // console.log(data);
                if (response.errors) {
                    // Jika ada pesan error, tampilkan pesan error pada form
                    displayErrors(response.errors);
                } else {
                    // Jika tidak ada pesan error, tampilkan pesan sukses pada form
                    $('#modal-mempelai').modal('hide');
                    table.ajax.reload()
                    Swal.fire(
                        'Good job!',
                        response.success,
                        'success'
                    )
                }
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                displayErrors(errors);
            }
        });
    });
    // SLUGGEBLE
    $("#nama_wanita").on('change', function () {
        let title = $("#nama_pria").val() + " " + $("#nama_wanita").val();
        let token = $("#token").val();
        $.ajax({
            data: {
                title: title,
                _token: token
            },
            url: "/createSlug",
            type: "GET",
            dataType: 'json',
            success: function (data) {
                $("#slug").val(data.slug);
            }
        })
    })
    $("#nama_pria").on('change', function () {
        let title = $("#nama_pria").val() + " " + $("#nama_wanita").val();
        let token = $("#token").val();
        $.ajax({
            data: {
                title: title,
                _token: token
            },
            url: "createSlug",
            type: "GET",
            dataType: 'json',
            success: function (data) {
                $("#slug").val(data.slug);
            }
        })
    })


    function displayErrors(errors) {
        // menghapus class 'is-invalid' dan pesan error sebelumnya
        $('input.form-control').removeClass('is-invalid');
        $('select.form-control').removeClass('is-invalid');
        $('div.invalid-feedback').remove();

        // menampilkan pesan error baru
        $.each(errors, function (field, messages) {
            var inputElement = $('input[name=' + field + ']');
            var selectElement = $('select[name=' + field + ']');
            var feedbackElement = $('<div class="invalid-feedback"></div>');

            $.each(messages, function (index, message) {
                feedbackElement.append($('<p>' + message + '</p>'));
            });

            if (inputElement.length > 0) {
                inputElement.addClass('is-invalid');
                inputElement.after(feedbackElement);
            }

            if (selectElement.length > 0) {
                selectElement.addClass('is-invalid');
                selectElement.after(feedbackElement);
            }
        });
    }
})
