<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;

if(!isset($_SESSION)){
    session_start();
}
Route::get('/', function () {
    if (!isset ($_SESSION['username'])) {
        return view('login');
    } else if ($_SESSION['role'] == 'admin') {
        return redirect()->route('admin.index');
    } else if ($_SESSION['role'] == 'user') {
        return redirect()->route('user.index');
    }
})->name('login');
Route::get('/login', function () {
    Controller::class;
    $login = new Controller();
    return $login->login();

    //return $flag;
    //return view('login');
})->name('submit_login');
Route::post('/login', function () {
    Controller::class;
    $login = new Controller();
    return $login->login();

    //return view('login');
})->name('submit_login');

//admin
Route::prefix('admin')->group(function () {
    if (!isset ($_SESSION['username'])) {
        return view('login');
    } else if ($_SESSION['role'] == 'admin') {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/index', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/create', [AdminController::class, 'create']);
        Route::post(
            '/submit_create',
            function () {
                $request = new AdminController();
                return $request->submit_create();
                //return redirect()->route('admin.index');
            }
        );
        Route::get('/delete/{id}', function ($id) {
            //return view('admin.index');
            $request = new AdminController();
            $request->delete($id);
            return redirect()->route('admin.index');
        });

        Route::get(
            'edit/{id}',
            function ($id) {
                $user = new AdminController();
                return $user->edit($id);
                //return view('admin.edit');
            }
        ); 
        Route::post('submit_edit{id}', function ($id) {
            $user = new AdminController();
            $user->submit_edit($id);
            return redirect()->route('admin.index');
        });
        Route::get('/log_out', function () {
            session_unset();
            session_destroy();
            //session_start();
            return redirect()->route('login');
        });
        Route::get('/detail/{id}', function ($id) {
            $user = new AdminController();
            return $user->user_detail($id);
            //return view('admin.detail');
        })->name('admin.detail');
        Route::post('/send_message{id}', function ($id) {

            //return view('admin.index');
            $user = new AdminController();
            return $user->send_message($id);
            //return view('admin.send_message');
        });
        Route::get('/remove/{id}+from+{user_id}', function ($id, $user_id) {
            $user = new AdminController();
            return $user->remove_message($id, $user_id);
        });
       Route::prefix('/assignments')->group(function () {    
        Route::any('/', function () {
            $user = new AdminController();
            return $user->assignment();
        })->name('admin.assignment');
        Route::any('/create', function () {
            $user = new AdminController();
            return $user->create_assignment();
        })->name('admin.create_assignment');

        Route::any('/edit/{id_task}', function ($id_task) {
            $user = new AdminController();
            return $user->edit_assignment($id_task);
        })->name('admin.edit_assignment');

        Route::any('/update_assignment/{id_task}',function($id_task){
            $user = new AdminController();
            echo('hi');
            return $user->update_assingment($id_task);
        })->name('admin.update_assignment');

        Route::any('/delete/{id}', function ($id) {
            $user = new AdminController();
            return $user->delete_assignment($id);
        })->name('admin.delete_assignment');

        Route::any('/upload-file/{id}', function ($id) {
            $user = new AdminController();
            return $user->upload_assingment($id);
        })->name('admin.upload_assignment');

        Route::any('/dowload/{id_task}', function ($id_task) {
            $user = new AdminController();
            return $user->dowload_assignment($id_task);
        })->name('assignments.download');
        Route::any('/submission/{id_task}', function ($id_task) {
            $user = new AdminController();
            return $user->submission($id_task);
        })->name('admin.submission');
        Route::any('/dowload-submission/{id_task}+from+{id_user}', function ($id_task,$id_user) {
            $user = new AdminController();
            return $user->dowload_submission($id_task,$id_user);
        });
       });
       Route::prefix('challenges')->group(function(){
        Route::any('/',function(){
            $user = new AdminController();
            return $user->challenge();
        })->name('admin.challenge');
        Route::any('/create',function(){
            $user = new AdminController();
            return $user->create_challenge();
        });
        Route::any('/delete/{id}', function ($id) {
            $user = new AdminController();
            return $user->delete_challenge($id);
        });

        Route::any('/upload-challenge', function () {
            $user = new AdminController();
            return $user->upload_challenge();
        });
        Route::any('/detail/{id}',function ($id){
            $user = new AdminController();
            return $user->challenge_detail($id);
        });
        Route::any('/answer/{id}',function($id){
            $user = new AdminController();
            return $user->challenge_answer($id);
        
        });

       });

    }

});

//user
Route::prefix('user')->group(function () {
    if (!isset ($_SESSION['username'])) {
        return view('login');
    } else if ($_SESSION['role'] == 'user') {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::post('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/index', [UserController::class, 'index'])->name('user.index');
        Route::post('/index', [UserController::class, 'index'])->name('user.index');
        Route::get(
            'edit/{id}',
            function ($id) {
                $user = new UserController();
                return $user->edit($id);
                //return view('admin.edit');
            }
        );
        Route::any('submit_edit{id}', function ($id) {
            $user = new UserController();
            $user->submit_edit($id);
            return redirect()->route('user.index');
          
        });
        // Route::post('/submit', [AdminController::class, 'submit']);
        Route::get('/log_out', function () {
            session_unset();
            session_destroy();
            //session_start();
            return redirect()->route('login');
        });

        Route::get('/detail/{id}', function ($id) {
            $user = new UserController();
            return $user->user_detail($id);
            //return view('admin.detail');
        })->name('user.detail');
        Route::post('/send_message{id}', function ($id) {

            //return view('admin.index');
            $user = new UserController();
            return $user->send_message($id);
            //return view('admin.send_message');
        });
        Route::get('/remove/{id}+from+{user_id}', function ($id, $user_id) {
            $user = new UserController();
            return $user->remove_message($id, $user_id);
        });

        Route::prefix('/assignments')->group(function () {    
            Route::any('/', function () {
                $user = new UserController();
                return $user->assignment();
            })->name('user.assignment');

            Route::any('/dowload/{id_task}', function ($id_task) {
                $user = new UserController();
                return $user->dowload_assignment($id_task);
            })->name('assignments.download');
            Route::any('/upload-file/{id_task}+from+{id}', function ($id_task,$id) {
                $user = new UserController();
                return $user->upload_submission($id_task,$id);
            })->name('user.upload_submission');
           
        });
        Route::prefix('challenges')->group(function(){
            Route::any('/',function(){
                $user = new UserController();
                return $user->challenge();
            })->name('user.challenge');
            Route::any('/detail/{id}',function ($id){
                $user = new UserController();
                return $user->challenge_detail($id);
            });
            Route::any('/answer/{id}',function($id){
                $user = new UserController();
                return $user->challenge_answer($id);
            
            });
    
           });
    }

});