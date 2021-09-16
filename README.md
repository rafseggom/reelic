<p align="center"><img src="public/imgs/logo.png" width="400"></a></p>

## About Reelic

Reelic is a project made with Laravel, Docker Compose, LaravelMix and Artisan. Configured to be used with MySQL, heidisql and with a lot more work to do to implement Inertia.js and React.js. This project is for educational purposes.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

## Security

Authentication will be implemented via Sanctum with the OAuth standard, it is not the most secure but it is easier to get implemented than OAuth2 with Passport. 

## Database

The data will be stored in SQLite, using Factory and Seeders to create Loreimpsun data to populate tables. Artisan command line "migrate" helps us with migrations and creating those tables. Currently using Eloquent, ORM makes a easy to read and to maintain code. 

## API

API will be split in MVC as it is recommended, getting us a very clear and easy to read code.



## How to open the project

We can use the built-in tool to set up a server and run it. I will try to give some instructions and guide on the process:

- Download the code as zip (cloning the repo should also work).

- Open **Git Bash** (or any command window as PowerShell) while on the same folder, by right-clicking on an empty space and choosing *"Git Bash here"* or by opening *Git Bash* , typing *cd* and dragging the folder to this windows. This will make a cd route to the folder.

- Now we can type "*code .*" to open Visual Studio with the project, or you can use your preferred IDE. We can work from now on the same Git Bash we have already open or inside the Visual Code terminal, with "*Control+Ñ*".

- First thing is modifying the **.env** file by renaming **.env.example** and changing some parameters:
  
  - DB_CONNECTION= sqlite
  
  - DB_DATABASE = reelic --> #DB_DATABASE = /database/database.sqlite

- Next step is to create a file named "*database.sqlite*" file inside the folder */database*.

- Now we can download and update our dependencies by running the command "**composer update**", "**composer install**" is pretty similar for a first run so both should be okay, it will check composer.json and download whatever is needed.

- We need to create a symbolic link or our storage folder won't be able to pass any image to the public folder (security matters and checks). We can check "*app/config/filesystems.php*" and check if our disks are okay, but running a simple command such as *"php artisan storage:link"* should do the trick.

- Now we need to populate our tables by using "*php artisan migrate --seed*".

- The last and final step is to summon our server like if it were Cthulhu using the command *"php artisan serve"*. This should bring the app to the localhost and the URL should be brought in the console as an answer to the command.

- Now we should have our app working. You can always check for commands with "*php artisan --help*" and similar commands, it's pretty straightforward.

- Additional tips:
  
  - There is a list of useful commands down here, to check the most used one.
  - To check database I recommend to use SQLite, you can download it from [SQLite gui](https://sqlitestudio.pl/) (portable, free to download, easy to use GUI) or by extensions on Visual Code, or by using "*php artisan tinker*".
  - To seed the database we need to migrate it first and seed it later, we can do it at once with "*php artisan migrate:fresh --seed*".

## Useful to remember commands

- **php artisan tinker** --> Laravel console, useful to make DB requests.
  
  - Most common commands:
    
    - use App\Models\Model;
    
    - $ $ $photo = new Photo;
    
    - $photo -> name = "Foto";
    
    - $photo  -> save();
    
    - You can save, get, find, insert... whatever Eloquent lets you to do.

- **php artisan make:model** *Name --all --api*
  
  - *--all* makes "Model", "Controller", "Factory" and "Seeder".
  
  - *--api* automatically builds API methods on Controller.

- **php artisan migrate** --> creates DB with migration files.
  
  - **migrate:fresh** drops already migrated tables and migrates them again.
  
  - *--seed* seeds the table with DBSeeder. Also doable with **php artisan db:seed**

- **php artisan serve** builds up the server in localhost or 127.0.0.1, with Windows OS.
  
  - **down** mode are available too instead of serve, to shut down and set into maintenance mode.

- **php artisan route**:*list* lists all the routes in your application.
  
  - *clear* clears the cache and *cache* creates a cache.

- You can also install **sail** as a default Docker composer but not necessary if you're working with Docker Desktop and WSL2. 

- If you use sail, **sail up** sets the application in a container with WSL OS, not Windows. This is important because some things work differently, such as symbolic links.

- **php artisan storage:link** creates a symbolic link *(configured in config/filesystems.php)* between your private storage <u>Storage</u> and your public storage <u>Public</u>. Doing so allows you to use your files in your application and access them.



##### Work in progress.
