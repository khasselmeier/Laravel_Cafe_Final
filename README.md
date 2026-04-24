# Cafe Website

## Overview
This is a web-based cafe ordering system built using Laravel. The application allows users to browse menu items, customize drinks and food orders, and manage a shopping cart before checkout. It is designed to provide a smooth online ordering experience for customers.

## Features

### Customer Features
- Browse food and drink menu by category
- View product item details, including price and available sizes/options
- Add menu items to cart
- Update or remove items from cart
- View total order price
- Simple UI for desktop

## Tech Stack
- Backend: Laravel (PHP)
- Frontend: Blade templates, HTML, CSS, JavaScript
- Database: MySQL

## Project Structure
- `app/Http/Controllers` – Application logic (Cart, Menu, Orders)
- `app/Models` – Database models (Products, Orders, etc.)
- `resources/views` – Frontend Blade templates
- `routes/web.php` – Application routes

## Main Functionality Flow
1. User visits menu page
2. Selects food or drink item
3. Chooses options (size, quantity, etc.)
4. Adds item to cart
5. Cart updates dynamically
6. User reviews cart before checkout
7. User checks out and receives an update on when their order will be done
