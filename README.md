Cделать для запуска:
 выполнить в терминале куда будет скопирован проект команду «git clone https://github.com/Elvis97rus/tickets-api.git tickets-api» репозитория
выполнить команду «cd tickets-api» 
выполнить команду «composer install»  в терминале в папке проекта
скопировать файл .env.example в .env
выполнить команду «php artisan key:generate» в терминале в папке проекта
добавить в файл .env строки:
TICKET_API_BASE_URI=https://leadbook.ru/test-task-api/ TICKET_API_TOKEN=pmN3TQFQalcOhCwZc18KcPMWZyG2EQHz8al9sCYw
L5_SWAGGER_GENERATE_ALWAYS=true
изменить строку в .env:
SESSION_DRIVER=file
выполнить команду в терминале в папке проекта «php artisan config:cache»
выполнить команду в терминале в папке проекта «php artisan serve»


