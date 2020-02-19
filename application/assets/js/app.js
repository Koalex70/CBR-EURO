$(document).ready(function ()
{
    $("#dateFrom").mask("99-99-9999", {placeholder: "дд-мм-гггг" });
    $("#dateTo").mask("99-99-9999", {placeholder: "дд-мм-гггг" });

    $("form").on("submit", function (event) {
        var $form = $(this);

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'Main/ajax',
            data: $form.serialize(),
            success: function (response) {
                console.log('success');
                console.log(response);
            },
            error: function (jqXhr, textStatus, errorThrown) {
                // alert("Ошибка '" + jqXhr.status + "' (textStatus: '" + textStatus + "', errorThrown: '" + errorThrown + "')");
                console.log(jqXhr);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });

        //отмена действия по умолчанию для кнопки submit
        event.preventDefault();
    });
});