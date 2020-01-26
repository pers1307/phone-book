$(document).ready(function() {

    /**
     * Remove item
     */
    $(document).on('click', '.js-row-phone-remove', function(event) {
        event.preventDefault();
        event.stopPropagation();

        var id = $(this).data('id');

        $.ajax({
            type: "POST",
            url: '/api/phone/remove',
            data: { id : id },
            success: function(response)
            {
                response = JSON.parse(response);
                if (response.result == 'ok') {
                    $('.js-row-phone[data-id=' + id + ']').fadeOut("slow");
                }
            },
            error: function(response)
            {
                response = JSON.parse(response.responseText);
                alert(response.error);
            }
        }); // $.ajax
    });

    /**
     * Add item template
     */
    $(document).on('click', '.js-phone-add', function(event) {
        event.preventDefault();
        event.stopPropagation();

        if ($('.js-new-row-phone').length > 0) {
            alert('Заполните уже добавленную форму');
            return;
        }

        $.ajax({
            type: "POST",
            url: '/api/phone/table/row/template',
            data: {},
            success: function(response)
            {
                response = JSON.parse(response);
                $(response.template).insertAfter($("#phone-table .js-row-phone:last"));
            }
        }); // $.ajax
    });

    /**
     * submit item
     */
    $(document).on('submit', '#js-new-row-phone-form', function(event) {
        event.preventDefault();

        var id = $(this).data('id');

        var furl = $(this).attr('action');
        var formData = new FormData($(this)[0]);

        $('.is-invalid').removeClass('is-invalid');
        $('.error').remove();

        $.ajax({
            url: furl,
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: 'POST',
            success: function(response)
            {
                response = JSON.parse(response);

                if (id !== undefined) {
                    $('.js-new-row-phone[data-id=' + id + ']').replaceWith(response.row);
                } else {
                    $('.js-new-row-phone').remove();
                    $(response.row).insertAfter($("#phone-table .js-row-phone:last"));
                }
            },
            error: function(response)
            {
                response = JSON.parse(response.responseText);

                if (response.errors !== undefined) {
                    for (var key in response.errors) {
                        $('input[name="' + key + '"]').addClass('is-invalid');
                        $('<span class="error invalid-feedback">' + response.errors[key] + '</span>')
                            .insertAfter($('input[name="' + key + '"]'));
                    }
                } else {
                    alert(response.error);
                }
            }
        }); // $.ajax
    });

    /**
     * Update button
     */
    $(document).on('click', '.js-row-phone-update', function(event) {
        event.preventDefault();
        event.stopPropagation();

        var id = $(this).data('id');

        $.ajax({
            type: "POST",
            url: '/api/phone/table/update/template',
            data: { id : id },
            success: function(response)
            {
                $('.js-new-row-phone').remove();
                response = JSON.parse(response);
                $('.js-row-phone[data-id=' + id + ']').replaceWith(response.row);
            },
            error: function(response)
            {
                response = JSON.parse(response.responseText);
                alert(response.error);
            }
        }); // $.ajax
    });

    /**
     * sort
     */
    $(document).on('click', '.js-sort', function(event) {
        event.preventDefault();
        event.stopPropagation();

        var name = $(this).data('name');
        var next = $(this).data('next');

        $.ajax({
            type: "POST",
            url: '/api/phone/sort',
            data: { name : name, next : next },
            success: function(response)
            {
                response = JSON.parse(response);
                $('#phone-table').replaceWith(response.table);
            },
            error: function(response)
            {
                response = JSON.parse(response.responseText);
                alert(response.error);
            }
        }); // $.ajax
    });
});