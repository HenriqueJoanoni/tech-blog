<p align="center" style="font-size: 70px"><strong>TechBlog</strong></p>

<p align="center"><img src="resources/img/virtual-reality.png" alt="Virtual Reality" width="300" /></p>

<p align="center">
<img src="https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Logo"/>
<img src="https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwindcss Logo"/>
<img src="https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E" alt="Javascript Logo"/>
<img src="https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white" alt="MariaDB Logo"/>
</p>

# Installation
This project is develop with Laravel, follow the tutorial below to install and set-up this website.

### 1. Clone the repo
```
git https://github.com/HenriqueJoanoni/tech-blog.git
```

### 2. Go to the project folder
```
cd tech-blog
```

### 3. Install the initial dependencies from composer
```
composer install
```

### 4. Install NPM dependencies
```
npm install
```

### 5. Create a copy of .env.example
.env files are not commited to this repo for security purposes, but there's a .env.example file that you can use as a base

```
cp .env.example .env
```

### 6. Generate the encryption project key
```
php artisan key:generate
```

### 7. Create a new empty database
This project is using MySQ, open your DBMS and create a database called tech_blog. You can check the migrations to see
all the tables that will be created.

### 8. Don't forget to update your constants inside .env
`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD`<br>
Update these constants to make sure they're matching your credentials

### 9. Migrate the database
```
php artisan migrate:fresh --seed
```

# Running the project

### Compiling assets
To compile all the assets using Vite, execute the command below:
```
npm run dev
```

### Start your local development server
```
php artisan serve
```



## License

Logo: <a href="https://www.flaticon.com/free-icons/technology" title="technology icons">Technology icons created by Freepik - Flaticon</a>
