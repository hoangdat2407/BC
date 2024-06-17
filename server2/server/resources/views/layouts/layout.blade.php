<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom Website</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
}
a{
    text-decoration: none;
    color: white;

}
.container {
    display: flex;
    height: 100vh;
}

.sidebar {
    width: 200px;
    background-color: #f8f9fa;
    border-right: 1px solid #dee2e6;
    padding: 20px;
}

.sidebar h2 {
    margin-bottom: 20px;
    color: #007bff;
    text-align: center;
}

.sidebar ul {
    list-style-type: none;
    padding-left: 0;
}

.sidebar ul li {
    margin-bottom: 15px;
}

.sidebar ul li a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}

.sidebar ul li a:hover {
    color: #007bff;
}

.content {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
}

.content section {
    margin-bottom: 20px;
}

.content section h2 {
    margin-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table, th, td {
    border: 1px solid #dee2e6;
}

th, td {
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f8f9fa;
}

td {
    vertical-align: middle;
}

button.btn {
    padding: 5px 10px;
    margin-right: 5px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
button.new {
    background-color: #28a745;
    color: white;
    margin-bottom: 10px;
}
button.detail {
    background-color: #17a2b8;
    color: white;
}

button.edit {
    background-color: #ffc107;
    color: black;
}

button.delete {
    background-color: #dc3545;
    color: white;
}

button.btn:hover {
    opacity: 0.8;
}
    .attributes {
        position: absolute;
        top: 10px;
        right: 5px;
        width: 100px;
        height: 50px;
        /* background-color: black; */
    }

</style>
<body>
<div class="attributes">
    <form action="{{url($_SESSION['role'].'/log_out')}}" method="POST">
            <a href="{{url($_SESSION['role'].'/log_out')}}"style="color:black;">Log out</a>
    </form>
</div> 
    <div class="container">
        <nav class="sidebar">
            <h2>Classroom</h2>
            <ul>
                <form action="" method="post">
                <li><a href="{{url($_SESSION['role'])}}/index">User</a></li>
                <!-- <li><a href="#message">Message</a></li> -->
                <li><a href="{{url($_SESSION['role'].'/assignments')}}">Assignment</a></li>
                <li><a href="{{url($_SESSION['role'].'/challenges')}}">Challenge</a></li>
                </form>
            </ul>
        </nav>
        @yield('content')
    </div>
</body>
<script>
    if (window.history.replaceState)
    {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>
