# Employee Directory Management System

## Project Overview

The **Employee Directory Management System** is a Laravel-based web application designed to demonstrate advanced **SELECT operations using Laravel ORM (Eloquent)**.

The system allows users to search, filter, sort, and paginate employee data efficiently while performing database operations at the query level.

This project was built as part of an assignment to strengthen understanding of **dynamic query building in Laravel**.


# Features

### 1. Employee Listing

Displays employees in a structured table showing:

* Name
* Email
* Department
* Salary
* Date Created

The system uses **pagination (10 records per page)** to improve performance when handling large datasets.



### 2. Search Functionality

Users can search employees by name using:


where('name','like','%value%')


The search works together with pagination and filtering.



### 3. Department Filter

Employees can be filtered by department:

* IT
* HR
* Finance
* Marketing

Filtering is performed directly at the **database level**.


### 4. Salary Sorting

Employees can be sorted by salary:

* Low → High
* High → Low

Sorting integrates with:

* search
* filters
* pagination



### 5. Dashboard Statistics

The system provides a dashboard displaying key statistics:

* Total Employees
* Total Salary Payout
* Highest Salary
* Lowest Salary
* Average Salary

These values are calculated using Eloquent methods:


count()
sum()
max()
min()
avg()



### 6. Top Earners Section

Displays the **Top 5 Highest Paid Employees** using:


orderBy('salary','desc')->take(5)




### 7. Employee Management

Users can:

* Edit employee details
* Delete employees



# Technologies Used

* Laravel
* PHP
* MySQL
* Blade Templates
* CSS

## Project Structure


EmployeeDirectorySystem
│
├── app
│   └── Http
│       └── Controllers
│           └── EmployeeController.php
│
├── database
│   └── migrations
│
├── resources
│   └── views
│       └── employees
│           ├── index.blade.php
│           └── edit.blade.php
│
├── routes
│   └── web.php
│
└── README.md



# Installation

1. Clone the repository


git clone https://github.com/YOUR_USERNAME/employee-directory-system.git


2. Navigate to the project folder


cd employee-directory-system


3. Install dependencies


composer install


4. Copy environment file


cp .env.example .env


5. Generate application key


php artisan key:generate


6. Configure your database in `.env`

7. Run migrations


php artisan migrate


8. Start the development server


php artisan serve




# Learning Objectives

This project demonstrates:

* Dynamic query building
* Advanced SELECT operations
* Laravel ORM (Eloquent)
* Pagination handling
* Database filtering
* Sorting and searching
* MVC architecture


# Author

Margaret Muthoni
Junior Software Developer


