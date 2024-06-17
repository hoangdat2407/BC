<?php
$servername = "localhost";
$username = "root";
$dbname = "server1";
$pass = "";
$conn = new mysqli($servername, $username, $pass, $dbname);

global $sql;
global $cur_user;
if ($conn->connect_error) {
    echo 'fail';
    exit();
}
function check($user)
{
    global $conn;
    $sql = 'SELECT * FROM user WHERE username = "' . $user . '"';
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}
function regist($user, $pass)
{
    global $conn;
    global $sql;
     if(check($user) == false)
     {
        
            $num = mysqli_num_rows(mysqli_query($conn, 'SELECT * FROM user'));
            $num++;
            $sql = 'INSERT INTO user (id,username, password) VALUES ("' . $num . '","' . $user . '","' . $pass . '")';
    
            if (mysqli_query($conn, $sql)) {
                return true;
            } else {
               return false;
            }
        
     }
     else return false;
}
function login($user, $pass)
{
    if (check($user)) {
        global $conn;
        global $sql;
        $sql = 'SELECT * FROM user WHERE username = "' . $user . '"';
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row['password'] == $pass) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
function get_id($user)
{
    global $conn;
    global $sql;
    $sql = 'SELECT * FROM user WHERE username = "' . $user . '"';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return $row['id'];
}
function add_task($task,$id)
{
    global $conn;
    global $sql;
    $num = mysqli_num_rows(mysqli_query($conn, 'SELECT * FROM tasks'));
    $num++;
    $sql = 'INSERT INTO tasks (id,num,task) VALUES ("' . $id . '","'.$num.'","' . $task . '")';
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}
function delete_task($task,$id)
{
    global $conn;
    global $sql;
    $sql = 'DELETE FROM tasks WHERE num = "' . $task . '" ';
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}
