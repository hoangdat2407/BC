<?php
session_start();
include_once 'db.php';
if (!isset($_SESSION['username'])) {
    error_reporting(E_ALL);
ini_set("display_errors", 1);
    exit(header('Location: index.php'));
}
if (isset($_POST['add_task'])) {

    $task = $_POST['task'];
    $id = $_SESSION['id'];
    add_task($task, $id);
}
if (isset($_POST['task'])) {
    delete_task($_POST['task'], $_SESSION['id']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        margin: 50px;
        padding: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        gap: 50px;
        align-items: center;
        //height: 100vh;
        background-color: #f2f2f2;
    }

    .attributes {
        position: absolute;
        top:30px;
        right: 80px;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 700px
    }

    .task {
        background-color: #A9A9A9;
        padding: 20px;
        border-radius: 5px;
        border: solid 1px grey;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 600px;
    }

    button {
        border-radius: 3px;
        border: solid 1px grey;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: grey;
    }
</style>

<body>
    <div class="attributes">
        
            <form action="index.php" method="POST">
            <a href="index.php" name="Logout">Log out</a>
        </form> 
          
    </div>
    <div class="container">
        <?php
        echo '' . $_SESSION['username'] . '';
        ?>'s task list
    </div>

    <div class="container">
        <form action="mytask.php" method="POST">
            <input type="text" placeholder="Task" name="task" required>
            <br>
            <br>
            <button name="add_task">+ Add Task</button>
        </form>
    </div>
    <div class="container">
        <div>Current Tasks</div>
        <br>
        <div>
            <?php
            $id = $_SESSION['id'];
            $sql = 'SELECT * FROM tasks WHERE id = "' . $id . '"';
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $cnt = 0;
                $num = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <form action="mytask.php"  method="post">
                    <div class="task" style="background-color: #f2f2f2;" >' . $row['task'] . '</div>
                    <button  name="task" value="' . $row['num'] . '" style="background-color:red" >
                    Delete
                    </button>
                    </form>
                    ';
                }
            }
            ?>
        </div>
    </div>


</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>