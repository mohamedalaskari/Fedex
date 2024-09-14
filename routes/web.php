<?php

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
use App\Models\ContactCustomer;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
//branchs
// Route::get('branchs/delete/{branch}', [BranchController::class, 'delete']);
// Route::get('branchs/deleted', [BranchController::class, 'deleted']);
// Route::get('branchs/restore/{branch}', [BranchController::class, 'restore']);
// Route::get('branchs/delete_from_trash/{branch}', [BranchController::class, 'delete_from_trash']);
// Route::resource('branchs', BranchController::class);

// //users
//  Route::get('customers/delete/{Customer}',[CustomerController::class,'delete']);
//  Route::get('customers/deleted',[CustomerController::class,'deleted']);
//  Route::get('customers/restore/{Customer}',[CustomerController::class,'restore']);
//  Route::get('customers/delete_from_trash/{Customer}',[CustomerController::class,'delete_from_trash']);
// Route::resource('customers',CustomerController::class);


//  //employees
//  Route::get('employees/delete/{employee}',[EmployeeController::class,'delete']);
//  Route::get('employees/deleted',[EmployeeController::class,'deleted']);
//  Route::get('employees/restore/{employee}',[EmployeeController::class,'restore']);
//  Route::get('employees/delete_from_trash/{employee}',[EmployeeController::class,'delete_from_trash']);
 //Route::resource('employees',EmployeeController::class);


//  //employeeChildrens
//  Route::get('employeeChildrens/delete/{employeeChildren}',[EmployeeChildrenController::class,'delete']);
//  Route::get('employeeChildrens/deleted',[EmployeeChildrenController::class,'deleted']);
//  Route::get('employeeChildrens/restore/{employeeChildren}',[EmployeeChildrenController::class,'restore']);
//  Route::get('employeeChildrens/delete_from_trash/{employeeChildren}',[EmployeeChildrenController::class,'delete_from_trash']);
 //Route::resource('employeeChildrens',EmployeeChildrenController::class);


//  //orders
//  Route::get('orders/delete/{order}',[OrderController::class,'delete']);
//  Route::get('orders/deleted',[OrderController::class,'deleted']);
//  Route::get('orders/restore/{order}',[OrderController::class,'restore']);
//  Route::get('orders/delete_from_trash/{order}',[OrderController::class,'delete_from_trash']);
//  Route::resource('orders',OrderController::class);


//  //orderdetails
//  Route::get('orderdetails/delete/{orderdetail}',[OrderDetailsController::class,'delete']);
//  Route::get('orderdetails/deleted',[OrderDetailsController::class,'deleted']);
//  Route::get('orderdetails/restore/{orderdetail}',[OrderDetailsController::class,'restore']);
//  Route::get('orderdetails/delete_from_trash/{orderdetail}',[OrderDetailsController::class,'delete_from_trash']);
//  Route::resource('orderdetails',OrderDetailsController::class);


//  //products
//  Route::get('products/delete/{product}',[ProductController::class,'delete']);
//  Route::get('products/deleted',[ProductController::class,'deleted']);
//  Route::get('products/restore/{product}',[ProductController::class,'restore']);
//  Route::get('products/delete_from_trash/{product}',[ProductController::class,'delete_from_trash']);
//  Route::resource('products',ProductController::class);


//  //productlines
//  Route::get('productlines/delete/{productline}',[ProductLineController::class,'delete']);
//  Route::get('productlines/deleted',[ProductLineController::class,'deleted']);
//  Route::get('productlines/restore/{productline}',[ProductLineController::class,'restore']);
//  Route::get('productlines/delete_from_trash/{productline}',[ProductLineController::class,'delete_from_trash']);
//  Route::resource('productlines',ProductLineController::class);


//  //contactType
//  Route::get('contactTypes/delete/{contactType}',[ContactTypeController::class,'delete']);
//  Route::get('contactTypes/deleted',[ContactTypeController::class,'deleted']);
//  Route::get('contactTypes/restore/{contactType}',[ContactTypeController::class,'restore']);
//  Route::get('contactTypes/delete_from_trash/{contactType}',[ContactTypeController::class,'delete_from_trash']);
//  Route::resource('contactTypes',ContactTypeController::class);


//  //ContactCustomers
//  Route::get('contactcustomers/delete/{ContactCustomer}',[ContactCustomerController::class,'delete']);
//  Route::get('contactcustomers/deleted',[ContactCustomerController::class,'deleted']);
//  Route::get('contactcustomers/restore/{ContactCustomer}',[ContactCustomerController::class,'restore']);
//  Route::get('contactcustomers/delete_from_trash/{ContactCustomer}',[ContactCustomerController::class,'delete_from_trash']);
//  Route::resource('contactcustomers',ContactCustomerController::class);


//  //contactBranchs
//  Route::get('contactBranchs/delete/{contactBranch}',[ContactBranchController::class,'delete']);
//  Route::get('contactBranchs/deleted',[ContactBranchController::class,'deleted']);
//  Route::get('contactBranchs/restore/{contactBranch}',[ContactBranchController::class,'restore']);
//  Route::get('contactBranchs/delete_from_trash/{contactBranch}',[ContactBranchController::class,'delete_from_trash']);
//  Route::resource('contactBranchs',ContactBranchController::class);


//  //contactEmployees
//  Route::get('contactEmployees/delete/{contactemployee}',[ContactEmployeeController::class,'delete']);
//  Route::get('contactEmployees/deleted',[ContactEmployeeController::class,'deleted']);
//  Route::get('contactEmployees/restore/{contactemployee}',[ContactEmployeeController::class,'restore']);
//  Route::get('contactEmployees/delete_from_trash/{contactemployee}',[ContactEmployeeController::class,'delete_from_trash']);
//  Route::resource('contactEmployees',ContactEmployeeController::class);


//  //jopEmployees
//  Route::get('jobEmployees/delete/{jobEmployee}',[JobEmployeeController::class,'delete']);
//  Route::get('jobEmployees/deleted',[JobEmployeeController::class,'deleted']);
//  Route::get('jobEmployees/restore/{jobEmployee}',[JobEmployeeController::class,'restore']);
//  Route::get('jobEmployees/delete_from_trash/{jobEmployee}',[JobEmployeeController::class,'delete_from_trash']);
//  Route::resource('jobEmployees',JobEmployeeController::class);


//  //countries
//  Route::get('countries/delete/{country}',[CountryController::class,'delete']);
//  Route::get('countries/deleted',[CountryController::class,'deleted']);
//  Route::get('countries/restore/{country}',[CountryController::class,'restore']);
//  Route::get('countries/delete_from_trash/{country}',[CountryController::class,'delete_from_trash']);
//Route::resource('countries',CountryController::class);
 //Route::resource('users',UserController::class);

