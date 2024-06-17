<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Assignments;
use App\Models\Submissions;
use App\Models\Challenges;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    //
    public function index()
    {
        $userTemp = new Users();
        $user = $userTemp->user_list();
       // dd($user);
        return view('user.index',compact('user'));
    }
    public function edit($id)
    {
        $userTemp = new Users();
        $user = $userTemp->user_by_id($id);
        //dd($user);
        return view('user.edit',compact('user'));
    }
    public function submit_edit($id)
    {
        $request = Request()->all();
        $userTemp = new Users();
        $user = $userTemp->edit_user($request,$id);
    }
    public function user_detail($id)
    {
        $userTemp = new Users();
        $user = $userTemp->user_by_id($id);
        $mess = $userTemp->get_data($id);
        // echo($id.' ');
        // echo($_SESSION['id']);
        // dd($mess);
        //dd($user);
        return view('user.detail',compact('user','mess'));    
    }
    public function send_message($id)
    {
        $userTemp = new Users();
        //dd($_SESSION['id']);
        $user = $userTemp->insert_data($id);
        //dd($user);
        return redirect()->route('user.detail',['id'=>$id]);
    }
    public function remove_message($id,$user_id)
    {
        $userTemp = new Users();
        $user = $userTemp->delete_data($id);
        return redirect()->route('user.detail',['id'=>$user_id]);
    }
    public function assignment()
    {
        $aTemp = new Assignments();
        $assignments = $aTemp->get_data();
        //echo("hi");
        return view('user.assignments.assignment', compact('assignments'));
    }
public function upload_submission($id_task,$id)
    {
        $request = Request();
        //Validate the request
        $request->validate([
            'file' => 'file|required|max:2048', // max size of 2MB, adjust as needed
        ]);

        // Store the file
        $file = $request['file'];
        $path = $file->store('submissions');
        // Save file information in the database
        $aTemp = new Submissions();

        $a = $aTemp->create([
            'id_user' => $id,
            'id_task' =>$id_task,
            'link' => $path,
        ]);
       
        // Redirect back with a success message
        return redirect()->route('user.assignment');
    }
    public function dowload_assignment($id_task)
    {
        $aTemp = new Assignments();
        $a = $aTemp->get_data_by_id($id_task);
        return Storage::download($a[0]->link);
    }
public function dowload_submission($id)
    {
        $aTemp = new Submissions();
        $a = $aTemp->get_data_by_id($id);
        return Storage::download($a['link']);
    }
    public function challenge()
    {
        $aTemp = new Challenges();
        $challenges = $aTemp->get_data();
        return view('user.challenges.challenge', compact('challenges'));
    }
    public function challenge_detail($id)
    {
        $aTemp = new Challenges();
        $challenge = $aTemp->get_data_by_id($id);
        $mess = null;
        return view('user.challenges.detail', compact('challenge', 'mess'));
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

        return view('user.challenges.detail', compact('challenge', 'mess'));
    }
}