# blacksport

seeding
php artisan db:seed --class=VoyagerDatabaseSeeder
php artisan db:seed

#refresh and seeding
- php artisan migrate:fresh
- php artisan voyager:install
- php artisan db:seed

#Default user
- login - tishmax@mail.ru
- password - bcRp45z4AtMgNMYE

 Create admin for Voyager
- php artisan voyager:admin your@mail.com --create
- вводишь имя потом
- вводишь пароль
- вводишь подтверждения пароля
