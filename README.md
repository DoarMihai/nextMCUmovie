# Next MCU movie

![nextMCUmovie](https://github.com/DoarMihai/nextMCUmovie/tree/main/public/img/nextMCUmovie.png)

## About the project
Next MCU movie is a simple Symfony 5.4.x application that gets and displays the next Marvel Movie to be released.

## Installation
The project dos not need a database connection and is fairly simple to install.

Clone the project:
```
git clone https://github.com/DoarMihai/nextMCUmovie.git
```
Navigate to the project root and run the symfony server:
```
symfony server:start
```
Now you cand access the website at http://localhost:8000/

Fetch the next movie:
```
php bin/console fetch:movie
```
