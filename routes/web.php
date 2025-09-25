<?php

use Mzm\HtmlBuilder\Http\Livewire\FormBuilder;
use Illuminate\Support\Facades\Route;

Route::get('/forms', FormBuilder::class)->name('form-builder.forms');
Route::get('/form/{formId?}', FormBuilder::class)->name('form-builder.form');
