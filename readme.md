# mzm/html-builder

A dynamic, Livewire-based form builder for Laravel applications.

## Introduction

`mzm/html-builder` is a Laravel package designed to simplify the creation of dynamic and interactive forms. Built on the TALL stack (Tailwind CSS, Alpine.js, Livewire, Laravel), it provides a component-based architecture that allows you to construct complex forms with ease.

The core of the package is a `FormBuilder` Livewire component that dynamically renders various form elements, such as text inputs, select boxes, and more. It's designed to be extensible, allowing you to create your own custom form elements.

## Features

- **Dynamic Form Generation**: Build forms from configuration arrays or database schemas.
- **Component-Based**: Each form element is a self-contained Livewire component.
- **Extensible**: Easily add your own custom form elements.
- **Tailwind CSS**: Comes with pre-compiled, customizable Tailwind CSS for a modern look.
- **Livewire Powered**: Enjoy real-time validation and interactive form elements without page reloads.

## Requirements
- PHP 8.2 or higher
- Laravel 11.x or higher
- Livewire 3 or higher

## Basic Usage

1.  **Installation**:
    ```bash
    composer require mzm/html-builder
    ```

2.  **Run Migrations**:
    The package may come with database migrations to manage its data. Run the standard migrate command to update your database schema.
    ```bash
    php artisan migrate
    ``` 
## Demo
    
1.  **Run From Browser**:    
    Please write the url with folowing example

    👉️ https://xxx.test/html-builder


2.  **Create New Form**:    
    Click menu Form -> Builder

3.  **To list kk creatd form**:    
    Click menu Form -> All Forms

3.  **Try submit new form**:    
    Click menu Form -> All Forms -> New Response (Actions Colmn)


## License

The MIT License (MIT). Please see [License File](https://github.com/mzm-dev/e-hierarchy/blob/master/LICENSE.md) for more information.
