@extends('layouts.layout')
@section('content')
<style>
    .attributes {
        position: absolute;
        top: 10px;
        right: 5px;
        width: 100px;
        height: 50px;
        /* background-color: black; */
    }
</style>
</style>
<main class="content">

    <section id="user">
        <h2>User</h2>
        <button type="button" class="new">
            <a href="{{url('admin/create')}}" >+New</a>
        </button>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $item)
                    <tr>

                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->role}}</td>
                        <td>

                            <button class="btn detail">
                                <a href="{{url('admin/detail/'.$item->id)}}">Detail</a>
                            </button>
                            <button class="btn edit">
                                <a href="{{url('admin/edit/' . $item->id)}}">Edit</a>
                            </button>
                            <button class="btn delete">
                                <a href="{{url('admin/delete/' . $item->id)}}">Delete</a>
                            </button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</main>
@endsection