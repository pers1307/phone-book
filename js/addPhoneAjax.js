$(document).ready(function() {

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

    $(document).on('click', '.js-phone-add', function(event) {
        event.preventDefault();
        event.stopPropagation();

        var rowTemplateHtml = $('.js-new-row-phone-template').html();

        // debugger;

        $(rowTemplateHtml).insertAfter($(".js-row-phone").last());




        // var vars = $(this).serialize();
        // var furl = $(this).attr('action');
        //
        // $.ajax({
        //     type: "POST",
        //     url: furl,
        //     data: vars,
        //     success: function(response)
        //     {
        //         response = JSON.parse(response);
        //
        //         if (response.NoPostArgumentException != undefined) {
        //             alert('Something went wrong...');
        //             return;
        //         }
        //
        //         if (response.Exception != undefined) {
        //             alert('Something went wrong...');
        //             return;
        //         }
        //
        //         if (response.EmptyParameterException != undefined) {
        //             $('.js-alert').empty();
        //
        //             if (response.EmptyParameterException == 'Статья должна иметь название') {
        //                 $('.js-name').addClass('has-error');
        //             }
        //
        //             if (response.EmptyParameterException == 'Статья должна иметь автора') {
        //                 $('.js-author').addClass('has-error');
        //             }
        //
        //             if (response.EmptyParameterException == 'Статья должна иметь текст') {
        //                 $('.js-text').addClass('has-error');
        //             }
        //
        //             if (response.EmptyParameterException == 'Картинка не выбрана') {
        //                 $('.js-image').css('outline', '1px solid #A90006');
        //             }
        //
        //             $('.js-alert').append(error(response.EmptyParameterException));
        //
        //             return;
        //         }
        //
        //         if (response.success == 'success') {
        //             // удалить все содержимое input'ов
        //             $("input[name='name']").val('');
        //             $("textarea[name='text']").val('');
        //
        //             /**
        //              * todo: стилизовать эту надпись.
        //              */
        //             $('.js-alert').append('Статья успешно добавлена!');
        //         }
        //     }
        // }); // $.ajax
    });

    // function error(content)
    // {
    //     return '<div class="form-group alert-danger col-md-12">' +
    //         '<h4>' + content + '</h4>' +
    //         '</div>';
    // };

});