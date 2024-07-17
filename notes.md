# ECOMMERCCE APPLICATION
    https://fajarwz.com/blog/laravel-10-crud-and-image-upload-tutorial-with-laravel-breeze-and-repo-example/

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

# ADDING CATEGORY FROM ADMIN DASHBOARD
    CRUD Complete
    php artisan make:model Category -mcrf
    php artisan make:factory CategoryFactory --model=Category
    php  artisan make:seeder CategorySeeder
    php artisan db:seed --class=CategorySeeder
    php artisan make:request CategoryRequest
    php artisan make:request CategoryUpdateRequest

# SHOW TOASTR MESSAGE IN LARAVEL
    https://php-flasher.io/library/toastr/
        composer require php-flasher/flasher-toastr-laravel
        php artisan vendor:publish --tag=flasher-config
        
        use Flasher\Laravel\Facade\Flasher;

        Flasher::addSuccess('Success message!');

# PRODUCT  CRUD TO DATABASE TABLE 
    php artisan make:model Product -mcrf
    php artisan make:seeder ProductSeeder
    php artisan make:request ProductStoreRequest
    php artisan make:request ProductUpdateRequest

# PAGINATION ON PRODUCT
     $products = Product::paginate(3);
     {{ $products->onEachSide(1)->links() }}
    Paginator::useBootstrap();

# HOW TO SHOW SHORT DESCRIPTION
         <td>{{ $product->description }}</td>

            <td>{!! Str::limit($product->description , 50) !!}</td>

# SEARCH FUNCTIONALITY

# HOW TO REDIRECT USER  TO DIFFERENT PAGE AFTER LOGIN 
    - Work on front end  part of the application 
    - Logout from admin section
    - Redirect  the user to the same page when login
       email: user@mailinator.com
       password: admin1234

# DISPLAYING PRODUCT DATA IN HOMEPAGE 
    - log as normal user  ,you will gett an error ,solutiion is fix on web route
        http://ecoommerce-web.test/dashboard
        Undefined variable $products

#  DISPLAY PRODUCT DETAILS IN LARAVEL PROJECT
    - Add the Button

# HOW TO ADD PRODUCT TO CART 
    - user will click the Add to Cart Button
    - User must be logged in .
    - Make the model of Cart
    - foreign id - user_id
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
    - foreign id - product_id

             $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
    -Add the relationships 
    - To add the cart , user must be loged in .
    - Other wise it will send the user to the loggin page
    - We  need to get the product-id to add to  cart
    - Track the product id
    - Track the user id who added the product to the cart
            
            LONG CODE

                        $user = Auth::user();
                        $user_id = $user->id;
                
                        // Now you have the $product instance directly
                        $product_id = $product->id;
                
                        $cart = new Cart;
                        $cart->user_id =  $user_id ;
                        $cart->product_id =  $product_id ;
                
                        $cart->save();

            SHORT VERSION
                    Auth::user()->carts()->create([
                        'product_id' => $product->id,
                    ]);
            
                    Flasher::addSuccess('Product Added to the Cart Created Successfully!');
                    return redirect()->back();
                
# SHOW TOTAL NUMBER OF PRODUCT ADDED TO THE CART FOR A USER
    - Show number of  product added to the cart in UI
    - Login as user 
    - To write the logic in HomeController to count the number of product
    - If you access the detail page , u get Undefined variable $count
    - If you logout you get an error Attempt to read property "id" on null
                Attempt to read property "id" on null
        When u logout ,there's no login user .

            $userId = Auth::user()->id;
            $count = Cart::where('user_id', $userId)->count();

    NB:
    we are already logged in as admin and again perform artisan serve ....
    then after login as admin it is taking us to the url /dashboard.....
    every time i need to customize the url like admin/dashboard...please fix the issue

# SHOW PRODUCT CART DATA USING FK 
    - View mycart 
        user_id and product_id

        modified:   app/Http/Controllers/Admin/CartController.php
        modified:   app/Models/Cart.php
        modified:   notes.md
        modified:   resources/views/front-end/layouts/master.blade.php
        modified:   resources/views/front-end/partials/_header.blade.php
        modified:   routes/web.php

         resources/views/front-end/myCart.blade.php

# HOW  TO DISPLAY TOTAL PRICE FOR A CART 
        modified:   app/Http/Controllers/Admin/CartController.php
        modified:   notes.md
        modified:   resources/views/front-end/myCart.blade.php
        modified:   routes/web.php

# HOW TO MOVE  CART DATA TO ORDER TABLE
    - Create  the order table 
        php  artisan make:model order -mc

            public function confirm_order(Request $request)
    {
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;

        $userId = Auth::user()->id;
        $carts  = Cart::where('user_id', $userId)->get();

        foreach ($carts   as $cart){

            $order = new Order;
            $order->name = $name;
            $order->shipping_address = $address;
            $order->phone = $phone;
            $order->user_id = $userId;
            $order->product_id = $cart->product_id;

            $order->save();
        }

        $cart_remove = Cart::where('user_id', $userId)->get();

        foreach ($cart_remove  as $remove){
            $data = Cart::find($remove->id);
            $data->delete();
        }

        Flasher::addSuccess('Product Ordered  successfully.');
        return redirect()->back();
    }

             modified:   notes.md
             modified:   resources/views/front-end/myCart.blade.php
             modified:   routes/web.php
             app/Http/Controllers/OrderController.php
             app/Models/order.php
             database/migrations/2024_07_10_164435_create_orders_table.php

# DISPLAY ORDER DATA IN ADMIN PANEL
        modified:   app/Models/order.php
        modified:   notes.md
        modified:   resources/views/admin/partials/_sidebar.blade.php
        modified:   routes/web.php
        app/Http/Controllers/Admin/OrderController.php
        resources/views/admin/orders/

# CHANGING ORDER  STATUS IN ADMIN PANEL
        modified:   app/Http/Controllers/Admin/OrderController.php
        modified:   resources/views/admin/orders/index.blade.php
        modified:   routes/web.php

# HOW TO PRINT & DOWNLOAD PDF FROM DATABASE TABLE.
    https://github.com/barryvdh/laravel-dompdf
        composer require barryvdh/laravel-dompdf
            php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"

    modified:   app/Http/Controllers/Admin/OrderController.php
	modified:   composer.json
	modified:   composer.lock
	modified:   notes.md
	modified:   resources/views/admin/orders/index.blade.php
	modified:   routes/web.php

    config/dompdf.php
	resources/views/admin/invoice.blade.php
	storage/fonts/

# DISPLAY TOTAL COUNT  OF DATA IN ADMIN  HOME
    http://ecoommerce-web.test/admin/dashboard

    modified:   app/Http/Controllers/Admin/DashboardController.php
	modified:   notes.md
	modified:   resources/views/admin/index.blade.php
	modified:   resources/views/admin/partials/_sidebar.blade.php
	modified:   routes/web.php



