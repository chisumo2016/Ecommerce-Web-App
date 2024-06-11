# ECOMMERCCE APPLICATION
    Make Multiple Authentication in Laravel using Breeze 
        . Admin  will go to  different dashboard afer login
                admin1234
        . User  will go to  different dashboard afer login
                user1234
    
    Loook on Laravel Breezae
        https://laravel.com/docs/11.x/starter-kits#laravel-breeze
        composer require laravel/breeze --dev    
        php artisan breeze:install

            php artisan migrate
            npm install
            npm run dev

    Add  the field in user table migration
        $table->string('userType')->default('user');
        $table->string('phone')->nullable();
        $table->string('address')->nullable();

    Add Mass Asiigment in User Model
    php artisan migrate:fresh

    Create a Controller for HomeController
        php artisan make:controller  Admin/DashboardController

    ISSUE
     When youu log in as user the url (http://ecoommerce-web.test/dashboard) is also access the url of http://ecoommerce-web.test/admin/dashboard
       It will take to admin which is wrong.    
    SOLUTION
    To write the code for middleware to protect the route access
    php artisan make:middleware Admin
    Register middlware 
    Apply to web route

                    modified:   app/Http/Controllers/Auth/AuthenticatedSessionController.php
                    modified:   app/Http/Controllers/Auth/RegisteredUserController.php
                    modified:   app/Models/User.php
                    modified:   bootstrap/app.php
                    modified:   database/migrations/0001_01_01_000000_create_users_table.php
                    modified:   resources/views/auth/register.blade.php
                    modified:   routes/web.php

                    app/Http/Controllers/Admin/
                    app/Http/Middleware/
                    notes.md
                    resources/views/admin/
            
    
# INTEGRATE HTML TEMPLATE IN LARAVEL PROJECT
    https://github.com/yaminshakil/ecom_project
    modified:   app/Http/Controllers/Auth/NewPasswordController.php
	modified:   notes.md
	modified:   routes/web.php

    app/Http/Controllers/Front/
	public/front-end/
	resources/views/front-end/

# INTEGRATE ADMIN TEMPLATE IN LARAVEL PROJECT
    https://github.com/yaminshakil/Admin_Template
