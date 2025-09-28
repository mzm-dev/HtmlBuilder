<?php

use Illuminate\Support\Facades\Route;
use Mzm\HtmlBuilder\Http\Livewire\FormHome;
use Mzm\HtmlBuilder\Http\Livewire\FormBuilder;
use Mzm\HtmlBuilder\Http\Livewire\FormList;
use Mzm\HtmlBuilder\Http\Livewire\FormResponse;

Route::get('home/', FormHome::class)->name('form-builder.home');

Route::get('forms/', FormList::class)->name('form-builder.list');

Route::get('form/{formId?}', FormBuilder::class)->name('form-builder.form');

Route::get('form/response/{formId}', FormResponse::class)->name('form-builder.response');
