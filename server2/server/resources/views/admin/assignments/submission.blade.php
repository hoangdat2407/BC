@extends('layouts.layout')
@section('content')
<style>
    /* public/css/app.css */

    /* Existing styles... */

    .file-upload,
    .file-list {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 20px auto;
    }

    .file-upload h2,
    .file-list h2 {
        margin-bottom: 20px;
    }

    display:;

    .file-upload .form-group,
    .file-list .form-group {
        margin-bottom: 15px;
    }

    .file-upload label,
    .file-list label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .file-upload input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .file-upload button,
    .file-list button {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .file-upload button:hover,
    .file-list button:hover {
        background-color: #0056b3;
    }

    .file-list ul {
        list-style-type: none;
        padding: 0;
    }

    .file-list li {
        margin: 10px 0;
    }

    .file-list a {
        color: #007bff;
        text-decoration: none;
    }

    .file-list a:hover {
        text-decoration: underline;
    }

    .form-container {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

    }
</style>


<div class="assignments">
    <h1>Assignments</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Assignment File</th> 
            </tr>
        </thead>
        <tbody>
            <form action="" method="post"  enctype="multipart/form-data">
                    <tr>
                        <td>{{ $assignments[0]->title }}</td>
                        <td>{{ $assignments[0]->des }}</td>
                        <td>
                             <a href="{{ url('admin/assignments/dowload/' . $assignments[0]->id_task)}}" style="color:black;" >
                                Download
                             </a> 
                        </td>
                    </tr>
                    @csrf
            </form>
        </tbody>
    </table>
    <table>
        <thead>
            <tr> 
                <th>User's submission</th>
                <th>Submission File</th>
            </tr>
        </thead>
        <tbody>
            <form action="" method="post"  enctype="multipart/form-data">
                @foreach($submissions as $submission)
                    <tr>
                    <td>
                    {{$submission->user[0]->name}}
                    </td>
                    <td>
                        <a href="{{ url('admin/assignments/dowload-submission/' . $submission->id_task.'+from+'. $submission->id_user)}}" style="color:black;" >
                            Download
                         </a>
                    </td>
                    </tr>
                @endforeach
            </form>
        </tbody>
    </table>
</div>
@endsection