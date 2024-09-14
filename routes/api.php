<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ContactBranchController;
use App\Http\Controllers\ContactCustomerController;
use App\Http\Controllers\ContactEmployeeController;
use App\Http\Controllers\ContactTypeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeChildrenController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobEmployeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductLineController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
//login
Route::post('login', [AuthController::class, 'login']);


//branchs
Route::prefix('branchs')->group(function () {
    Route::get('/delete/{branch}', [BranchController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/deleted', [BranchController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/restore/{branch}', [BranchController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{branch}', [BranchController::class, 'delete_from_trash'])->middleware('auth:sanctum');
    Route::get('/', [BranchController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{branch}', [BranchController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/update', [BranchController::class, 'update'])->middleware('auth:sanctum');
    Route::post('/add', [BranchController::class, 'store'])->middleware('auth:sanctum');
});


// //customer
Route::prefix('customers')->group(function () {
    Route::get('/delete/{Customer}', [CustomerController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/deleted', [CustomerController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/restore/{Customer}', [CustomerController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{Customer}', [CustomerController::class, 'delete_from_trash'])->middleware('auth:sanctum');
    Route::get('/', [CustomerController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{customer}', [CustomerController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/update', [CustomerController::class, 'update'])->middleware('auth:sanctum');
    Route::post('/add', [CustomerController::class, 'store']);
});

//  //employees
Route::prefix('employees')->group(function () {
    Route::get('/delete/{employee}', [EmployeeController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/deleted', [EmployeeController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/restore/{employee}', [EmployeeController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{employee}', [EmployeeController::class, 'delete_from_trash'])->middleware('auth:sanctum');
    Route::get('/', [EmployeeController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{employee}', [EmployeeController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/update', [EmployeeController::class, 'update'])->middleware('auth:sanctum');
    Route::post('/add', [EmployeeController::class, 'store'])->middleware('auth:sanctum');
});


//  //employeeChildrens
Route::prefix('employeechildrens')->group(function () {
    Route::get('/delete/{employeeChildren}', [EmployeeChildrenController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/deleted', [EmployeeChildrenController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/restore/{employeeChildren}', [EmployeeChildrenController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{employeeChildren}', [EmployeeChildrenController::class, 'delete_from_trash'])->middleware('auth:sanctum');
    Route::get('/', [EmployeeChildrenController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{employeeChildren}', [EmployeeChildrenController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/update', [EmployeeChildrenController::class, 'update'])->middleware('auth:sanctum');
    Route::post('/add', [EmployeeChildrenController::class, 'store'])->middleware('auth:sanctum');
});


//  //orders
Route::prefix('orders')->group(function () {
    Route::get('/delete/{order}', [OrderController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/deleted', [OrderController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/restore/{order}', [OrderController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{order}', [OrderController::class, 'delete_from_trash'])->middleware('auth:sanctum');
    Route::get('/', [OrderController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{order}', [OrderController::class, 'show'])->middleware('auth:sanctum');
    Route::post('/add', [OrderController::class, 'store'])->middleware('auth:sanctum');
});


//  //orderdetails
Route::prefix("orderdetails")->group(function () {
    Route::get('/delete/{orderdetail}', [OrderDetailsController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/deleted', [OrderDetailsController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/restore/{orderdetail}', [OrderDetailsController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{orderdetail}', [OrderDetailsController::class, 'delete_from_trash'])->middleware('auth:sanctum');
    Route::get('/', [OrderDetailsController::class, 'index'])->middleware('auth:sanctum');
    Route::put('/update', [OrderDetailsController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/{orderdetail}', [OrderDetailsController::class, 'show'])->middleware('auth:sanctum');
    Route::post('/add', [OrderDetailsController::class, 'store'])->middleware('auth:sanctum');
});


//  //products
Route::prefix('products')->group(function () {
    Route::get('/delete/{product}', [ProductController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/deleted', [ProductController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/restore/{product}', [ProductController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{product}', [ProductController::class, 'delete_from_trash'])->middleware('auth:sanctum');
    Route::get('/', [ProductController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{product}', [ProductController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/update', [ProductController::class, 'update'])->middleware('auth:sanctum');
    Route::post('/add', [ProductController::class, 'store'])->middleware('auth:sanctum');
});


//  //productlines
Route::prefix('productlines')->group(function () {
    Route::get('/delete/{productline}', [ProductLineController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/deleted', [ProductLineController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/restore/{productline}', [ProductLineController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{productline}', [ProductLineController::class, 'delete_from_trash'])->middleware('auth:sanctum');
    Route::get('/', [ProductLineController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{productLine}', [ProductLineController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/update', [ProductLineController::class, 'update'])->middleware('auth:sanctum');
    Route::post('/add', [ProductLineController::class, 'store'])->middleware('auth:sanctum');
});


//  //contactType
Route::prefix('contacttypes')->group(function () {
    Route::get('/delete/{contactType}', [ContactTypeController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/deleted', [ContactTypeController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/restore/{contactType}', [ContactTypeController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{contactType}', [ContactTypeController::class, 'delete_from_trash'])->middleware('auth:sanctum');
    Route::get('/', [ContactTypeController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{contactType}', [ContactTypeController::class, 'show'])->middleware('auth:sanctum');
    Route::post('/add', [ContactTypeController::class, 'store'])->middleware('auth:sanctum');
});


//  //ContactCustomers
Route::prefix('contactcustomers')->group(function () {
    Route::get('/delete/{ContactCustomer}', [ContactCustomerController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/deleted', [ContactCustomerController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/restore/{ContactCustomer}', [ContactCustomerController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{ContactCustomer}', [ContactCustomerController::class, 'delete_from_trash'])->middleware('auth:sanctum');
    Route::get('/', [ContactCustomerController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{contactcustomer}', [ContactCustomerController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/update', [ContactCustomerController::class, 'update'])->middleware('auth:sanctum');
    Route::post('/add', [ContactCustomerController::class, 'store'])->middleware('auth:sanctum');
});


//  //contactBranchs
Route::prefix('contactbranchs')->group(function () {
    Route::get('/delete/{contactBranch}', [ContactBranchController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/deleted', [ContactBranchController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/restore/{contactBranch}', [ContactBranchController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{contactBranch}', [ContactBranchController::class, 'delete_from_trash'])->middleware('auth:sanctum');
    Route::get('/', [ContactBranchController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{contactBranch}', [ContactBranchController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/update', [ContactBranchController::class, 'update'])->middleware('auth:sanctum');
    Route::post('/add', [ContactBranchController::class, 'store'])->middleware('auth:sanctum');
});


//  //contactEmployees
Route::prefix('contactemployees')->group(function () {
    Route::get('/delete/{contactemployee}', [ContactEmployeeController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/deleted', [ContactEmployeeController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/restore/{contactemployee}', [ContactEmployeeController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{contactemployee}', [ContactEmployeeController::class, 'delete_from_trash'])->middleware('auth:sanctum');
    Route::get('/', [ContactEmployeeController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{contactEmployee}', [ContactEmployeeController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/update', [ContactEmployeeController::class, 'update'])->middleware('auth:sanctum');
    Route::post('/add', [ContactEmployeeController::class, 'store'])->middleware('auth:sanctum');
});


//  //jopEmployees
Route::prefix('jobemployee')->group(function () {
    Route::get('/delete/{jobEmployee}', [JobEmployeeController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/deleted', [JobEmployeeController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/restore/{jobEmployee}', [JobEmployeeController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{jobEmployee}', [JobEmployeeController::class, 'delete_from_trash'])->middleware('auth:sanctum');
    Route::get('/', [JobEmployeeController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{jobEmployee}', [JobEmployeeController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/update', [JobEmployeeController::class, 'update'])->middleware('auth:sanctum');
    Route::post('/add', [JobEmployeeController::class, 'store'])->middleware('auth:sanctum');
});


//  //countries
Route::prefix('countries')->group(function () {
    Route::get('/delete/{country}', [CountryController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/deleted', [CountryController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/restore/{country}', [CountryController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{country}', [CountryController::class, 'delete_from_trash'])->middleware('auth:sanctum');
    Route::get('/', [CountryController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{country}', [CountryController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/update', [CountryController::class, 'update'])->middleware('auth:sanctum');
    Route::post('/add', [CountryController::class, 'store'])->middleware('auth:sanctum');
});
//users
Route::resource('users', UserController::class)->middleware('auth:sanctum');
