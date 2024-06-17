@extends('layouts.layout')
<style>
.form-container {
    width: 100%;
    max-width: 400px;
    padding: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    
} 
form {

    display: flex;
    flex-direction: column;

}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

input[type="submit"] {
    width: 100%;
    background-color: #007bff;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}</style>
@section('content')
<div class="form-container">
        <form action="{{url('admin/challenges/upload-challenge')}}" method="POST"  enctype="multipart/form-data">            
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">

            <label for="description">Description:</label>
            <textarea id="des" name="des" rows="4" required></textarea>

            <label for="file">File</label>
            <input type="file" id="file" name="file">
            <input type="submit" value="Submit">
            @csrf
        </form>
    </div>
@endsection