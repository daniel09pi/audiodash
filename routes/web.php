<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/login', 'home', ['isLogin' => true])->name('login');
Route::inertia('/register', 'home', ['isLogin' => false])->name('register');

Route::inertia('/dashboard', 'dashboard')->middleware('auth');
