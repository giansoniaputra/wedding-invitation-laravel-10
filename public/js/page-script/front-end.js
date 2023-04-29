$(document).ready(function () {
    $(".send-ucapan").on("click", function () {
        var formdata = $("#doa form").serializeArray();
        var data = {};
        $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value;
        });
        // console.log(formdata);
        $.ajax({
            data: $('#doa form').serialize(),
            url: "/kirimUcapan",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                if (response.errors) {
                    //Jika ada pesan error, tampilkan pesan error pada form
                    displayErrors(response.errors);
                } else {
                    // Jika tidak ada pesan error, tampilkan pesan sukses pada form
                    // console.log(response.success.mempelai_id);
                    $(".terkirim").html(response.success.pesan)
                    $.ajax({
                        url: '/load-ucapan',
                        data: {
                            id: response.success.id
                        },
                        success: function (data) {
                            $('.refresh').html(data);
                        }
                    });
                    $("#nama-pengirim").val('');
                    $("#pesan").html('');
                    $("#kehadiran").val('');
                }
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                displayErrors(errors);
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
            var selectElement = $('select[name=' + field + ']');
            var textAreaElement = $('textarea[name=' + field + ']');
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
            if (textAreaElement.length > 0) {
                textAreaElement.addClass('is-invalid');
                textAreaElement.after(feedbackElement);
            }
        });
    }

    $("#nama-pengirim").on("click", function () {
        $("#nama-pengirim").removeClass("is-invalid");
        $("#pesan").removeClass("is-invalid");
        $("#kehadiran").removeClass("is-invalid");
    })
    $("#pesan").on("click", function () {
        $("#pesan").removeClass("is-invalid");
        $("#nama-pengirim").removeClass("is-invalid");
        $("#kehadiran").removeClass("is-invalid");
    })
    $("#kehadiran").on("click", function () {
        $("#pesan").removeClass("is-invalid");
        $("#nama-pengirim").removeClass("is-invalid");
        $("#kehadiran").removeClass("is-invalid");
    })
})
