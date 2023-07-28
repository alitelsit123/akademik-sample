<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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

Route::get('/forgot-password', function () {
  return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::get('/reset-password/{token}', function (string $token) {
  return view('auth.reset-password', ['token' => $token, 'email' => request('email')]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
  $request->validate([
      'token' => 'required',
      'email' => 'required|email',
      'password' => 'required|min:8|confirmed',
  ]);

  $status = Password::reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function (User $user, string $password) {
          $user->forceFill([
              'password' => Hash::make($password)
          ]);

          $user->save();

          // event(new PasswordReset($user));
      }
  );

  return $status === Password::PASSWORD_RESET
    ? redirect('login')->with(['status' => __($status), 'message' => 'Password berhasil diupdate.'])
    : back()->withErrors(['email' => __($status), 'error' => 'Error hubungi admin.']);
})->middleware('guest')->name('password.update');

Route::post('/forgot-password', function () {
  $request = request();
  $request->validate(['email' => 'required|email']);

  $status = Password::sendResetLink(
      $request->only('email')
  );
  return $status === Password::RESET_LINK_SENT
              ? back()->with(['status' => __($status), 'message' => 'Password reset link berhasil dikirim.'])
              : back()->withErrors(['email' => __($status), 'error' => 'Error hubungi admin.']);
})->middleware('guest')->name('password.email');

Route::middleware('auth')->group(function() {

  Route::get('/', function () {
    return redirect('login');
  });

  Route::prefix('admin')->group(function() {
    Route::get('/', [Admin\SchoolController::class,'index']);
    Route::get('s-induck', [Admin\SchoolController::class,'sInduck']);

    Route::prefix('student')->group(function() {
        Route::get('/', [Admin\StudentController::class,'index']);
        Route::post('/store', [Admin\StudentController::class,'store']);
        Route::post('/update', [Admin\StudentController::class,'update']);
        Route::get('/destroy/{id}', [Admin\StudentController::class,'destroy']);
    });

    Route::prefix('class')->group(function() {
        Route::get('/', [Admin\ClassController::class,'index']);
        Route::post('/store', [Admin\ClassController::class,'store']);
        Route::post('/store_teacher', [Admin\ClassController::class,'storeTeacher']);
        Route::post('/update', [Admin\ClassController::class,'update']);
        Route::get('/destroy/{id}', [Admin\ClassController::class,'destroy']);
    });

    Route::prefix('account')->group(function() {
        Route::get('/', [Admin\AccountController::class,'index']);
        Route::post('/store', [Admin\AccountController::class,'store']);
        Route::post('/update', [Admin\AccountController::class,'update']);
        Route::get('/destroy/{id}', [Admin\AccountController::class,'destroy']);
    });

    Route::prefix('mapel')->group(function() {
        Route::get('/', [Admin\MapelController::class,'index']);
        Route::post('/store', [Admin\MapelController::class,'store']);
        Route::post('/store_teacher', [Admin\MapelController::class,'storeTeacher']);
        Route::post('/update', [Admin\MapelController::class,'update']);
        Route::get('/destroy/{id}', [Admin\MapelController::class,'destroy']);
    });

    Route::prefix('project')->group(function() {
      Route::get('/', [Admin\ProjectController::class,'index']);
      Route::post('/store', [Admin\ProjectController::class,'store']);
      Route::post('/update', [Admin\ProjectController::class,'update']);
      Route::get('/destroy/{id}', [Admin\ProjectController::class,'destroy']);
    });

    Route::prefix('school')->group(function() {
        Route::get('/', [Admin\SchoolController::class,'index']);
        Route::post('/update', [Admin\SchoolController::class,'update']);
    });

    Route::prefix('report')->group(function() {
        Route::get('/', [Admin\ReportController::class,'index']);
        Route::get('/report_preview/{id}', [Admin\ReportController::class,'preview']);
    });

    Route::prefix('induck')->group(function() {
      Route::get('/', [Admin\InduckController::class,'index']);
      // Route::get('/report_preview/{id}', [Admin\ReportController::class,'preview']);
      Route::get('/detail/{id}', [Admin\InduckController::class, 'detail']);
      Route::get('/detail-proyek/{id}', [Admin\InduckController::class, 'detailProyek']);
      Route::post('/store_project', [Admin\InduckController::class, 'storeProject']);
    });

    Route::prefix('search')->group(function() {
      Route::get('/', [Admin\SearchController::class,'index']);
  });

  });

  Route::prefix('teacher')->group(function() {
    Route::get('/', function() {
      return redirect('teacher/evaluation');
    });

    Route::prefix('student')->group(function() {
        Route::get('/', [Teacher\StudentController::class,'index']);
    });

    Route::prefix('evaluation')->group(function() {
      Route::get('/', [Teacher\EvaluationController::class,'index']);
      Route::get('/history', function() {
        return view('teacher/evaluation-history');
      });
      Route::get('/print', function() {
        return view('teacher/report-preview');
      });
      Route::post('/store', [Teacher\EvaluationController::class,'store']);
    });

  });

  Route::prefix('head')->group(function() {
    Route::get('/', function() {
      return redirect('head/evaluation');
    });

    Route::get('/detail-proyek/{id}', function($id) {
      return view('head/induck-detail-proyek', compact('id'));
    });

    Route::prefix('evaluation')->group(function() {
      Route::get('/', [Head\EvaluationController::class,'index']);
      Route::get('/submit_rapor/{id}', [Head\EvaluationController::class,'submitRapor']);
      Route::post('/update', [Head\EvaluationController::class,'update']);
    });

  });

});

Route::get('login', [LoginController::class,'index'])->name('login')->middleware(['guest']);
Route::post('login-action', [LoginController::class,'login']);
Route::get('logout', [LoginController::class,'logout'])->name('logout');
