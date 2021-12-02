1. запустить composer install
2. в .env файле задать параметры для подключения к БД 
   в env.example приведены настройки тестовой БД
3. запустить миграции
4. в env файле прописать второго сервиса для получения данных в параметре SERVICE_SEND_URL


Для создание приватного и публичного ключа для генерации подписис необходимо запустить комманду 
php artisan key:generate.
В папке storege/app будут созданы ключи с именами указанными в директивах
PRIVATE_FILENAME=private_key.pem
PUBLIC_FILENAME=public_key.pem

Публичный ключ должен быть скопирован в папку storage/app для верификации запросов

Запуск генерации трензакций php artisan transaction:generate
Запуск отправки данных php artisan task:send
