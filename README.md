# CBR-EURO
***
## Сервис предназначен для сравнения курса евро за две определенные даты
***
### Для корректной работы приложения вам понадобится:
#### MySQL
#### PHP версии >= 7.0
***
#### Для того чтобы поднять и настроить приложение вам нужно сдлеать несколько простых шагов:
1. Для начала работы с проектом вам необходимо скачать проект с помощью команды ***git clone https://github.com/Koalex70/CBR-EURO.git***.
2. Далее необходимо изменить конфигурации подключения к базе данных в файле ***/core/Model.php***.
3. Далее после первой загрузки проекта ***(Открытия главной страницы)*** можете удалить из конструктора ***/application/controllers/Controller_main.php*** вызов метода ***$this->model = new Model_Main();*** (Опционально, т.к. работе проекта это не помешает, но может немного замедлить).
4. Поздравляю ваш проект готов к использованию. 