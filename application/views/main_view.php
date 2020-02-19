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
    <h4>Значение курса евро на <?php echo $data['dateFrom']; ?>: <?php echo $data['valueDateFrom']; ?> руб.</h4>
    <h4>Значение курса евро на <?php echo $data['dateTo']; ?>: <?php echo $data['valueDateTo']; ?> руб.</h4>
    <h4>Разница между курсами за эти даты состовляет: <?php echo round($data['difference'], 4); ?> руб.</h4>
</div>

