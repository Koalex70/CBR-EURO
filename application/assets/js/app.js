$(document).ready(function () {
    $("#dateFrom").mask("99-99-9999", {placeholder: "дд-мм-гггг"});
    $("#dateTo").mask("99-99-9999", {placeholder: "дд-мм-гггг"});

    $("form").on("submit", function (event) {
        var $form = $(this);

        if ($('#dateFrom').val() === '') {
            $('#error').text("Ошибка!!! Не заполнено поле 'Дата с'!!! ");
            return false;
        } else {
            $('#error').text("");
        }

        if ($('#dateTo').val() === '') {
            $('#error').text("Ошибка!!! Не заполнено поле 'Дата по'!!! ");
            return false;
        } else {
            $('#error').text("");
        }

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'Main/ajax',
            data: $form.serialize(),
            success: function (response) {
                console.log(response);
                $('#value-date-from').text(
                    `Значение курса евро на ${response.dateFrom}: ${response.valueDateFrom} ₽`
                );

                $('#value-date-to').text(
                    `Значение курса евро на ${response.dateTo}: ${response.valueDateTo} ₽`
                );

                $('#difference').text(
                    `Разница между курсами за эти даты составляет: ${response.difference.toFixed(4)} ₽`
                );
            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.log(jqXhr);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });

        event.preventDefault();
    });
});