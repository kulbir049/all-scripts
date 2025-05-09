<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SuperAdmin\Dashboard;
use App\Http\Livewire\Auth\Signin;
use App\Http\Livewire\AttendanceComponent;
use App\Http\Livewire\PermissionManager;
use App\Http\Livewire\RoleManager;
use App\Http\Livewire\Companies;
use App\Http\Livewire\AssignPermissionToUser;
use App\Http\Livewire\AssignPermissionManage;
use App\Http\Livewire\Pages\Signup;
use App\Http\Livewire\Pages\Loginpage;
use App\Http\Livewire\Modules\SuperAdmin\Dashboard as SuperAdminDashboard;
use App\Http\Livewire\Modules\CompanyAdmin\Dashboard as CompanyAdminDashboard;
use App\Http\Livewire\Modules\CompanyHr\Dashboard as CompanyHrDashboard;
use App\Http\Livewire\Modules\Manager\Dashboard as ManagerDashboard;
use App\Http\Livewire\Modules\Employee\Dashboard as EmployeeDashboard;
use App\Http\Livewire\Modules\SuperAdmin\SignupList;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

 


Route::get('/', Signin::class)->name('login');
Route::get('/signup', Signup::class)->name('signup');
Route::get('login/google', [Signin::class, 'redirectToGoogle'])->name('login.google');
Route::get('loginWithGamil', [Signin::class, 'handleGoogleCallback']);
Route::post('logout', [Signin::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:1'])->group(function () {
        Route::get('/admin/rolemanagement', RoleManager::class)->name('superadmin.role-management');
        Route::get('/admin/companies', Companies::class)->name('superadmin.companies');
    });
    Route::middleware(['role:2'])->group(function () {
        Route::get('/admin/permissions', AssignPermissionManage::class)->name('admin.permissions');
    });
   //  only for admin


    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/attendance', AttendanceComponent::class)->name('attendance');
    Route::post('/update-attendance-status', [AttendanceComponent::class,'updateStatus'])->name('update-attendance-status');

});



// Super Admin
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/superadmin/dashboard', SuperAdminDashboard::class)->name('superadmin.dashboard');
    Route::get('/superadmin/signups', SignupList::class)->name('superadmin.signups.list');

});

// Company Admin
Route::middleware(['auth', 'role:company-admin'])->group(function () {
    Route::get('/company-admin/dashboard', CompanyAdminDashboard::class)->name('companyadmin.dashboard');
});

// Company HR
Route::middleware(['auth', 'role:company-hr'])->group(function () {
    Route::get('/company-hr/dashboard', CompanyHrDashboard::class)->name('companyhr.dashboard');
});

// Manager
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager/dashboard', ManagerDashboard::class)->name('manager.dashboard');
});

// Employee
Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/employee/dashboard', EmployeeDashboard::class)->name('employee.dashboard');
});