<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\ContactBranch;
use App\Models\ContactCustomer;
use App\Models\ContactEmployee;
use App\Models\ContactType;
use App\Models\ContactUser;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\EmployeeChildren;
use App\Models\JobEmployee;
use App\Models\JopEmployee;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\ProductLine;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         Country::factory(100)->create();
         JobEmployee::factory(100)->create();
         ContactType::factory(2)->create();
         ProductLine::factory(100)->create();
         Branch::factory(100)->create();
         Employee::factory(100)->create();
         EmployeeChildren::factory(100)->create();
         Customer::factory(100)->create();
        User::factory(5)->create();
         ContactType::factory(100)->create();
         ContactEmployee::factory(100)->create();
         ContactBranch::factory(100)->create();
         Product::factory(100)->create();
         Order::factory(100)->create();
         OrderDetails::factory(100)->create();
        ContactCustomer::factory(100)->create();
    }
}
