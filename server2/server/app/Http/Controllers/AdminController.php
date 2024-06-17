<?php

namespace App\Http\Controllers;

use App\Models\Challenges;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Assignments;
use App\Models\Submissions;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //
    public function index()
    {
        $userTemp = new Users();
        $user = $userTemp->user_list();
        // dd($user);
        return view('admin.index', compact('user'));
    }
    public function create()
    {
        return view('admin.create');
    }
    public function submit_create()
    {
        $request = Request()->all();
        $userTemp = new Users();
        $user = $userTemp->create_user($request);
        //dd($user);  
        return redirect()->route('admin.index');
    }
    public function delete($id)
    {
        $userTemp = new Users();
        $user = $userTemp->delete_user($id);
        //dd($id);
        return $user;

    }
    public function edit($id)
    {
        $userTemp = new Users();
        $user = $userTemp->user_by_id($id);
        //dd($user);
        return view('admin.edit', compact('user'));
    }
    public function submit_edit($id)
    {
        $request = Request()->all();
        $userTemp = new Users();
        $user = $userTemp->edit_user($request, $id);
    }
    public function user_detail($id)
    {
        $userTemp = new Users();
        $user = $userTemp->user_by_id($id);
        $mess = $userTemp->get_data($id);
        return view('admin.detail', compact('user', 'mess'));
    }
    public function send_message($id)
    {
        $userTemp = new Users();
        //dd($_SESSION['id']);
        $user = $userTemp->insert_data($id);
        //dd($user);
        return redirect()->route('admin.detail', ['id' => $id]);
    }
    public function remove_message($id, $user_id)
    {
        $userTemp = new Users();
        $user = $userTemp->delete_data($id);
        return redirect()->route('admin.detail', ['id' => $user_id]);
    }
    public function assignment()
    {
        $aTemp = new Assignments();
        $assignments = $aTemp->get_data();
        //echo("hi");
        return view('admin.assignments.assignment', compact('assignments'));
    }

    public function create_assignment()
    {
        return view('admin.assignments.create');
    }
    public function edit_assignment($id_task)
    {
        $aTemp = new Assignments();
        $assignment = $aTemp->get_data_by_id($id_task);
        return view('admin.assignments.edit', compact('assignment'));
    }
    public function upload_assingment($id)
    {
        $request = Request();
        //Validate the request
        $request->validate([
            'file' => 'file|required|max:2048', // max size of 2MB, adjust as needed
        ]);

        // Store the file
        $file = $request['file'];
        $des = $request['des'];
        $title = $request['title'];
        $path = $file->store('assignment');
        // Save file information in the database
        $aTemp = new Assignments();

        $a = $aTemp->create([
            'id_user' => $id,
            'link' => $path,
            'title' => $title,
            'des' => $request->des,
        ]);
        //dd($file);
        // Redirect back with a success message
        return redirect()->route('admin.assignment');
    }
    public function update_assingment($id_task)
    {
        $request = Request();
        //Validate the request
        // Store the file
        $file = $request['file'];
        $des = $request['des'];
        $title = $request['title'];
        $path = null;
        if ($file == null) {
            $path = null;
        } else {
            $request->validate([
                'file' => 'required|file|max:2048', // max size of 2MB, adjust as needed
            ]);
            $path = $file->store('assignment');
        }
        //dd($file);  
        if ($file != null) {
            $aTemp = new Assignments();
            $a = $aTemp->get_data_by_id($id_task);
            Storage::delete($a[0]->link);
        }
        // Save file information in the database

        $aTemp = new Assignments();

        $a = $aTemp->edit([
            'id_task' => $id_task,
            'title' => $title,
            'des' => $request->des,
            'link' => $path
        ]);


        //dd($aTemp);
        // Redirect back with a success message
        return redirect()->route('admin.assignment');
    }
    public function dowload_assignment($id_task)
    {
        $aTemp = new Assignments();
        $a = $aTemp->get_data_by_id($id_task);
        return Storage::download($a[0]->link);
    }
    public function delete_assignment($id)
    {
        $aTemp = new Assignments();
        $a = $aTemp->get_data_by_id($id);
        Storage::delete($a[0]->link);
        $aTemp->delete_data_by_id($id);
        return redirect()->route('admin.assignment');
    }
    public function submission($id_task)
    {
        $aTemp = new Submissions();
        $submissions = $aTemp->get_data_by_id_task($id_task);
        $assignments = (new Assignments())->get_data_by_id($id_task);
        foreach ($submissions as $submission) {
            $submission->user = (new Users())->user_by_id($submission->id_user);

        }
        //dd($submissions);
        return view('admin.assignments.submission', compact('submissions', 'assignments'));
    }
    public function dowload_submission($id_task, $id_user)
    {
        $aTemp = new Submissions();
        $a = $aTemp->get_data_submission($id_task, $id_user);
        return Storage::download($a[0]->link);
    }
    public function challenge()
    {
        $aTemp = new Challenges();
        $challenges = $aTemp->get_data();
        return view('admin.challenges.challenge', compact('challenges'));
    }
    public function create_challenge()
    {
        return view('admin.challenges.create');
    }

    public function upload_challenge()
    {
        $request = Request();
        //Validate the request
        $request->validate([
            'file' => 'file|required|max:2048', // max size of 2MB, adjust as needed
        ]);

        // Store the file
        $file = $request['file'];
        $des = $request['des'];
        $name = $request['name'];
        $path = $file->store('challenges');
        // Save file information in the database
        $aTemp = new Challenges();
        //dd($des);
        $a = $aTemp->create([
            'link' => $path,
            'name' => $name,
            'des' => $des,
        ]);
        //dd($file);
        // Redirect back with a success message
        return redirect()->route('admin.challenge');
    }

    public function delete_challenge($id)
    {
        $aTemp = new Challenges();
        $a = $aTemp->get_data_by_id($id);
        Storage::delete($a[0]->link);
        $aTemp->delete_data_by_id($id);
        return redirect()->route('admin.challenge');
    }
    public function challenge_detail($id)
    {
        $aTemp = new Challenges();
        $challenge = $aTemp->get_data_by_id($id);
        $mess = null;
        return view('admin.challenges.detail', compact('challenge', 'mess'));
    }
    public function challenge_answer($id)
    {
        $request = Request();
        $aTemp = new Challenges();
        $challenge = $aTemp->get_data_by_id($id);
        $answer = $request['answer'];
        if ($answer == $challenge[0]->name) {
            $content = Storage::get($challenge[0]->link);
            $challenge[0]->content = $content;
            //dd($content);
            $mess = "Correct";
        } else {

            $mess = "Incorrect";

        }

        return view('admin.challenges.detail', compact('challenge', 'mess'));
    }
}