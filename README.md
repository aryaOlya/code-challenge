# vana task

## getting start

````
git clone https://github.com/vanaco/code-challenge.git
````

````
cp .env.example .env
````

````
composer install
````

````
php artisan key:generate
````

````
php artisan migrate
````

````
php artisan db:seed
````

## description

this task is going to make a bill every month for the user to use this platform as 
"pay as go".this platform make logs for every service such as company internal service 
or message
brooker and use these logs to make bill-items that are related (OneToMany) to Bills 
that generate automatically by laravel schedule every month.

````
php artisan schedule:work
````
the upper command execute ````PublishBill.php```` in ````app\Helpers```` that change 
the ````published_at```` from null to current time in bills table.so the columns 
with not null published_at are published and users can read them.

<div>
also you can publish bill by yourself with artisan command

````
php artisan bill:publish
````
</div>
