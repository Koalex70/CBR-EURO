<div class="container">
    <h1>Курс Евро</h1>
    <h3>Вводите дату в формате "дд-мм-гггг"</h3>
    <h4 id="error-log"></h4>
    <form method="post">
        <label for="dateFrom">Дата с: </label>
        <input type="text" name="dateFrom" id="dateFrom" value="<?php echo $data['dateFrom']; ?>">
        <label for="dateTo">Дата по: </label>
        <input type="text" name="dateTo" id="dateTo" value="<?php echo $data['dateTo']; ?>">
        <input type="submit" value="Выбрать" id="submit-button">
    </form>
    <h4 id="value-date-from">Значение курса евро на <?php echo $data['dateFrom']; ?>: <?php echo $data['valueDateFrom']; ?> ₽</h4>
    <h4 id="value-date-to">Значение курса евро на <?php echo $data['dateTo']; ?>: <?php echo $data['valueDateTo']; ?> ₽</h4>
    <h4 id="difference">Разница между курсами за эти даты состовляет: <?php echo round($data['difference'], 4); ?> ₽</h4>
</div>

