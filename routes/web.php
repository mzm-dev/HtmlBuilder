<?php

use Illuminate\Support\Facades\Route;
use Mzm\HtmlBuilder\Http\Livewire\FormHome;
use Mzm\HtmlBuilder\Http\Livewire\FormBuilder;
use Mzm\HtmlBuilder\Http\Livewire\FormList;
use Mzm\HtmlBuilder\Http\Livewire\FormResponse;
use Mzm\HtmlBuilder\Http\Livewire\FormSubmit;

Route::get('/', FormHome::class)->name('form-builder.home');

Route::get('forms', FormList::class)->name('form-builder.list');

Route::get('form/{formId?}', FormBuilder::class)->name('form-builder.form');

Route::get('response/{form}', FormSubmit::class)->name('form-builder.response');

Route::get('response/list/{form}', FormResponse::class)->name('form-builder.response-list');
