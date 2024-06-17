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
                <th>Your submission</th>
            </tr>
        </thead>
        <tbody>

            @foreach($assignments as $assignment)
                <tr>
                    <td>{{ $assignment->title }}</td>
                    <td>{{ $assignment->des }}</td>
                    <td>

                        <a href="{{ url('user/assignments/dowload/' . $assignment->id_task)}}" style="color:black;">
                            Download

                        </a>
                    </td>
                    <td>
                        <form action="{{url('user/assignments/upload-file/' .$assignment->id_task.'+from+'. $_SESSION['id'])}}" method="post"
                            enctype="multipart/form-data">
                            <label for="file">File</label>
                            <input type="file" id="file" name="file">
                            <input type="submit" value="Submit">
                            @csrf
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection