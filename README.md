<<<<<<<< Update Guide >>>>>>>>>>>  
Immediate Older Version: 1.1.0
Current Version: 1.2.0

Feature Update:
1. New payment gateways added
    a.Tatum Gateway.
    b.Coingate Gateway.
    c.Pagadito Paymnet Gateway.
    d.Perfect Money Gateway.
    e.Qrpay Gateway.

2. Language Update


Please Use Those Command On Your Terminal To Update Full System
1. To Run project Please Run This Command On Your Terminal for new project
    composer update && composer dumpautoload && php artisan migrate && php artisan passport:install --force

2.  php artisan db:seed --class=Database\\Seeders\\Update\\BasicSettingsSeeder 
3.  php artisan db:seed --class=Database\\Seeders\\Update\\AppSettingsSeeder  
4.  php artisan db:seed --class=Database\\Seeders\\Update\\PaymentGatewaySeeder 
 


