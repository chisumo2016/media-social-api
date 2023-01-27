#### Laravel installation | Laravel API
    - Install the Laravel Application
        laravel new music-social-network-api    
    - We gonna use an API tool called POSTMAN.

## Laravel Sanctum AuthController with Bearer Token
    - Objective is to create a AuthController, which consists of 
            Login Method
            Register Method
            Logout Method
    - Once use has been regisster - generate token -> Sanctum
    - Sanctum is already installed 
    - Create a AuthController inside a API folder
            php artisan make:controller API/AuthController 

    - Create a register method inside the Authcontroller, implement the logic to create a token
    - We use the user variable to ccreate a token
    - Create an api routes  
    - Modified slightly the user migration tablee
    - Modified slightly  in User Model 
    - Open the POSTMAN
           POST:  http://music-social-network-api.test/api/register
            Generate the api token.
            Copy API Token  and create a new request called inside-middlware
                save the token into Bearer Token
    - Implement the login functionality inside the AuthController
    - Implement the logout functionality inside the AuthController

## Laravel Validation in Auth Controller
    - Sample https://github.com/laravel/laravel/blob/5.5/app/Http/Controllers/Auth/RegisterController.php
    - Validation to our request 
              php artisan make:request Auth/RegisterRequest
              php artisan make:request Auth/LoginRequest
              php artisan make:request Auth/LogoutRequest
    - Implement the validation logic to each of request
    - Import all request inside the AuthController
    TEST API PASSED
       POST : http://music-social-network-api.test/api/register
       POST : http://music-social-network-api.test/api/login
       POST : http://music-social-network-api.test/api/logout

## Laravel Sanctum with User Controller
    - Objective is to create the  resource for UserController
    - Create a UserController  Resource
            php artisan make:controller API/userController --resource
    - Create a UpdateUserRequest via terminal
            php artisan make:request User/UpdateUserRequest
    - Add the routes in api file for show and update users
    - TEST WITH POSTMAN
        Update the user with laravel sanctumtoken
        Show the user with token

## Laravel Sanctum with Vue 3 and Axios to login
    - Objective is to hook the frontend with backend 
    - Hook with the front end social media network.

     PLEASE CROSSS CHECK WITH BACKEND NOTES 
    - php artisan migaret:reset 
    - Add a new column to existing users migrations
            php artisan make:migration add_description_to_users_table --table=users 
            $table->integer('paid')->after('whichever_column');
