$(document).ready(function () {
    alert(1);
    $("#dateFrom").mask("99-99-9999", {placeholder: "дд-мм-гггг" });
    $("#dateTo").mask("99-99-9999", {placeholder: "дд-мм-гггг" });
});