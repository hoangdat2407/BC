@extends('layouts.layout')
@section('content')
<head>
    
    <title>Modal Example</title>
    <link rel="stylesheet" href="{{asset('extend/style.css')}}">
</head>
<body>
    <div class="content">
        <h1>Thông tin bài thơ</h1>
        <button id="showHintBtn">Show hint 💡</button>
        <form action="{{url('user/challenges/answer/'.$challenge[0]->id)}}" method="post">
        <input type="text" placeholder="Type your answer"name="answer" >
        <button>Submit</button>
        @csrf
        </form>
    </div>
    
    <div id="myModal" class="modal">
        <div class="modal-content">
            <p>{{$challenge[0]->des}}</p>
            <button id="closeBtn">Cancel</button>
        </div>
    </div>
    @if ($mess !=null)
    <script>
            alert("{{$mess}}");
        </script>
        @if($mess == "Correct")
            <p>{{$challenge[0]->content}}</p>
        @endif
    @endif
    <script src="{{asset('extend/scripts.js')}}"></script>
</body>
</html>
@endsection