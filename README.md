<p  align="center"><a  href="https://laravel.com"  target="_blank"><img  src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg"  width="400"  alt="Laravel Logo"></a></p>

  

<p  align="center">

<a  href="https://github.com/laravel/framework/actions"><img  src="https://github.com/laravel/framework/workflows/tests/badge.svg"  alt="Build Status"></a>

<a  href="https://packagist.org/packages/laravel/framework"><img  src="https://img.shields.io/packagist/dt/laravel/framework"  alt="Total Downloads"></a>

<a  href="https://packagist.org/packages/laravel/framework"><img  src="https://img.shields.io/packagist/v/laravel/framework"  alt="Latest Stable Version"></a>

<a  href="https://packagist.org/packages/laravel/framework"><img  src="https://img.shields.io/packagist/l/laravel/framework"  alt="License"></a>

</p>


# Welcome to JadiDomashno!
Follow the steps in order to setup and start the project!

# Step #1 [ setting up the env file ]
--In the root folder there is a file named: ".envexample", rename it to ".env"
--Next click CTRL + F to search in the file: "DB_DATABASE=laravel" rename the "laravel"  it to: "jadidomashno"
--Next you will need to setup mailtrap in order to receive emails: [How to Send Mail or Email in Laravel 9 | Laravel 9 Send Mail Tutorial - YouTube](https://www.youtube.com/watch?v=WU4_HzTa6PM)
--Open your terminal and type: `composer install`
--After it's done installing, type: `php artisan key:generate`
# Step #2 [ setting up the database ]
--Firstly you will need to migrate the database by typing in the terminal: `php artisan migrate`
--You will be asked the following: 

> The database 'jadidomashno' does not exist on the 'mysql' connection. 
> Would you like to create it? (yes/no) [no],

  type **yes**
  If you are not asked this question then go to your mySQL workbench and create the database with: `CREATE DATABASE jadidomashno;`
  
  --After it's done migrating you will need to seed it by typing: `php artisan db:seed`
# Step #3 [ setting up the environment ]
--You will need to setup development environment by firstly typing: `npm install`
--After it's done install run the environment by typing: `npm run dev`
--Now open a new terminal and type: `php artisan serve` and open the server.

**And here you have it!**

This project was build using:

 1. [Laravel 10](https://laravel.com/) with [Livewire](https://laravel-livewire.com/)
 2. [Tailwind](https://tailwindcss.com/) with [Flowbite](https://flowbite.com/)
 3. JavaScript
 4. [Toastr](https://github.com/CodeSeven/toastr)
 5. [Loading.io](https://loading.io/)
 6. [HeroIcons](https://heroicons.com/)
 7. [CSS Sinners](https://labs.danielcardoso.net/load-awesome/animations.html)