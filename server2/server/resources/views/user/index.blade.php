@extends('layouts.layout')
@section('content')

<main class="content">
<!-- <div class="attributes">
    <form action="{{url('user/log_out')}}" method="POST">
            <a href="{{url('user/log_out')}}"style="color:black;">Log out</a>
    </form>
</div> -->
    <section id="user">
        <h2>User</h2>
            @csrf
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

                            <button class="btn detail" >
                            <a href="{{url('user/detail/'.$item->id)}}">Detail</a>    
                            </button>
                            @if($item->id  == $_SESSION['id'])
                            
                                <button class="btn edit">
                                <a href="{{url('user/edit/' . $item->id)}}">Edit</a>
                            </button>
                            
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</main>
@endsection