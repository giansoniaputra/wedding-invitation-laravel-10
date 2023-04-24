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
        "ajax": {
            url: '/dataTablesStory',
            type: 'GET',
            data: function (d) {
                d.id = $("#id_mempelai").val();
            }
        },
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
                "data": "tgl_kisah"
            },
            {
                "data": "story"
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

    $("#btn-tambah").on("click", function () {
        $(".btn-update").addClass("d-none")
        $(".btn-add").removeClass("d-none")
    })

    $("#btn-close").on("click", function () {
        $("#tanggal").val('')
        $("#story").val('')
    })

    $("#btn-x").on("click", function () {
        $("#tanggal").val('')
        $("#story").val('')
    })

    $("#tanggal").on("click", function () {
        $("#tanggal").removeClass('is-invalid')
    })

    $("#story").on("click", function () {
        $("#story").removeClass('is-invalid')
    })

    $(".btn-add").on("click", function () {
        var formdata = $("#modal-story form").serializeArray();
        var data = {};
        $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value;
        });
        $.ajax({
            data: $('#modal-story form').serialize(),
            url: "/mempelai/" + $('#slug').val() + "/story",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                // console.log(data);
                if (response.errors) {
                    // Jika ada pesan error, tampilkan pesan error pada form
                    displayErrors(response.errors);
                } else {
                    // Jika tidak ada pesan error, tampilkan pesan sukses pada form
                    $('#modal-story').modal('hide');
                    $("#tanggal").val('')
                    $("#story").html('')
                    $("#story").val('')
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
    })

    $("#dataTables").on("click", ".edit-button", function () {
        $(".btn-update").removeClass("d-none")
        $(".btn-add").addClass("d-none")
        let id = $(this).attr("data-id");
        $.ajax({
            url: "/getIdStory/"+id,
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.errors) {
                    // Jika ada pesan error, tampilkan pesan error pada form
                    // displayErrors(response.errors);
                } else {
                    // Jika tidak ada pesan error, tampilkan pesan sukses pada form
                    // console.log(response.success);
                    $(".current-id").html('<input type="hidden" name="id_story" id="id_story" value="'+response.success.id+'">')
                    $("#tanggal").val(response.success.tanggal)
                    $("#story").html(response.success.story)
                    $('#modal-story').modal('show');
                }
                
            }
        })
    })
    // UPDATE DATA
    $(".btn-update").on("click",function(){
        var formdata = $("#modal-story form").serializeArray();
        var data = {};
        $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value;
        });
        $.ajax({
            data: $('#modal-story form').serialize(),
            url: "/updateStory",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                // console.log(data);
                if (response.errors) {
                    // Jika ada pesan error, tampilkan pesan error pada form
                    displayErrors(response.errors);
                } else {
                    console.log(response.success);
                    // Jika tidak ada pesan error, tampilkan pesan sukses pada form
                    $('#modal-story').modal('hide');
                    $(".current-id").html('');
                    $("#tanggal").val('')
                    $("#story").val('')
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
    })

    // HAPUS DATA
    $("#dataTables").on("click", ".delete-button" ,function(){
        let id = $(this).attr("data-id");
        let token = $(this).attr("data-token");

        $.ajax({
            data: {
                id: id,
                _token : token,
            },
            url: "/deleteStory",
            type: "POST",
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    table.ajax.reload()
                    Swal.fire(
                        'Good job!',
                        response.success,
                        'success'
                    )
                } else if (response.errors) {

                }
            }
        })
    })

    function displayErrors(errors) {
        // menghapus class 'is-invalid' dan pesan error sebelumnya
        $('input.form-control').removeClass('is-invalid');
        $('div.invalid-feedback').remove();

        // menampilkan pesan error baru
        $.each(errors, function (field, messages) {
            var inputElement = $('input[name=' + field + ']');
            var feedbackElement = $('<div class="invalid-feedback"></div>');

            $.each(messages, function (index, message) {
                feedbackElement.append($('<p>' + message + '</p>'));
            });

            if (inputElement.length > 0) {
                inputElement.addClass('is-invalid');
                inputElement.after(feedbackElement);
            }
        });
    }

});
