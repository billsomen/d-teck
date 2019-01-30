# D-Teck Full Stack Developper Test

The application process for the role **full stack developper** of D-Teck passes throught a technical test. 
The main goal is : **Build a REST API** 
* [TODO by DTeck](https://d-tecksolutions.github.io/full-stack-dev-test/)

### This is a [Symfony 3.1 project](https://symfony.com)
You can get more about it on the README-Symfony.md file
## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. 

### Prerequisites

What things you need to install the software and how to install them

```
PHP 5.5.9 or more
composer installed from link below
SQL server running on port 3306
```
[https://getcomposer.org/](https://getcomposer.org/)

### Installing
After cloning of downloading the repo open a *CLI* and point it to the root folder (the main foler containing folders as app/, web/...)


Install the dependencies by running

```
> composer install
```

Create the database on your **SQL DBMS**

```
create a database with the name : "dteck"
```

Create the data table schema (run his on your CLI)

```
> php bin/console doctrine:schema:create
```

Run the App 

```
> php bin/console server:run
```

Open the app at : [127.0.0.1:8000](http://127.0.0.1:8000)

## Running the tests

We provided 4 API methods : POST (to insert a user), PUT (to update user's informations), DELETE (to delete a user) and GET (to view informations of a user)

You can use [Postman](https://www.getpostman.com/) to run the tests on your own

**Anyway, the api response provide's details of the enitity (user) updated or inserted**
_The REST API is available at_  [ **/api** ]
```
main_uri = http://127.0.0.1:8000
```
| Method  | URI = [ main_uri/ ] | Details |
| ------ | ------------- | ------------- |
| POST  | /api/users/new/[name]  |  Insert a user|
| GET  | /api/users/[id]  |  View one user|
| GET  | /api/users  |  View all users|
| PUT  | /api/users/[id]?name=[new_name]  |  Update an user's information (name only for now)|
| DELETE  | /api/users/[id]  |  Delete a user|

in [ ] the parameters (API's URI input).


## Built With

* [Symfony 3.1 project](https://symfony.com) - The web framework used
* [PHP 7.2.10](https://php.net) - The web framework used
* [Doctrine](https://www.doctrine-project.org/projects/orm.html) - The Object Relational Mapper
* [FOSRestBundle](https://github.com/FriendsOfSymfony/FOSRestBundle) - Rest Bundle for Symfony

## Authors

* **Bill Somen** - *Initial work* - [www.billsomen.com](www.billsomen.com) | **30th January 2019**

## License

This project is licensed under the MIT License

## Acknowledgments

* Inspiration 1 : [diegonobre](https://gist.github.com/diegonobre) from his work at : https://gist.github.com/diegonobre/341eb7b793fc841c0bba3f2b865b8d66
*  Inspiration 2 : https://www.owasp.org/index.php/REST_Security_Cheat_Sheet
* HTTP Methods :  https://restfulapi.net/http-methods/
* HTTP Status Codes : https://restfulapi.net/http-status-codes/

## What next ?
Make it real and implement strong security frames
* Source : [OWASP - REST_Security_Cheat_Sheet](https://www.owasp.org/index.php/REST_Security_Cheat_Sheet) .

## Demo
None at the moment, everything should be run locally
