<!-- resources/views/user/show.blade.php -->

@extends('layouts.layout')

@section('content')
<style>
    /* public/css/app.css */

    /* Existing styles... */
    .send-message {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 600px;
        max-height: 300px;
        margin: 20px auto;
    }

    .send-message h2 {
        margin-bottom: 20px;
    }

    .send-message .form-group {
        margin-bottom: 15px;
        max-width: 500px;
        max-height: 200px;
    }

    .send-message label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .send-message textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
    }

    .send-message button {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .send-message button:hover {
        background-color: #0056b3;
    }

    .user-detail {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        height: 300px;
        margin: 20px auto;
    }

    .user-detail h1 {
        margin-bottom: 20px;
    }

    .user-detail p {
        margin: 10px 0;
        color: #333;
    }

    .user-detail strong {
        display: inline-block;
        width: 100px;
    }

    .render-task {
        position: absolute;
        top: 350px;
        left: 300px;
        background-color: white;
        padding: 50px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 900px;
        height: max-content;
        margin: 20px auto;
    }

    .render-task tr {
        padding: 50px;
    }
</style>
<div class="user-detail">
    <h1>User Details</h1>
    <p><strong>ID:</strong> {{ $user[0]->id }}</p>
    <p><strong>Username:</strong> {{ $user[0]->username }}</p>
    <p><strong>Name:</strong> {{ $user[0]->name }}</p>
    <p><strong>Email:</strong> {{ $user[0]->email }}</p>
    <p><strong>Phone:</strong> {{ $user[0]->phone }}</p>
</div>

<div class="send-message">
    <h2>Send a Message</h2>
    <form action="{{url("admin/send_message" . $user[0]->id)}}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user[0]->id }}">
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit">Send Message</button>
        </div>
    </form>
</div>
<div class="render-task">
    <h1>
        Your message to {{$user[0]->name}}.
    </h1>
    <br>
    <table>
        <thead>
            <tr>
                <th>Content</th>
                <th>From</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($mess as $item)
                <tr>

                    <td>{{$item->content}}</td>
                    <td>{{$_SESSION['name']}}</td>
                    <td>
                        <button class="btn delete">
                            <a href="{{url('admin/remove/'.$item->id .'+from+'.$user[0]->id)}}">Remove</a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection