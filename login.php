<?php
require_once "db.php";

session_start();

$conn = mysqli_connect($servername, $username, $password, $dbname);
if($conn == false) {
    die("Connection error: " . mysqli_connect_error());
}

// Kiểm tra xem có yêu cầu POST từ form login không
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Sử dụng Prepared Statements để tránh tấn công SQL Injection
    $sql = "SELECT * FROM login WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Kiểm tra xem có kết quả trả về từ truy vấn không
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $role = $row["role"];
        $login_id = $row["id_Login"];

        // Truy vấn để lấy id_User từ bảng customer dựa trên login_id
        $customer_query = "SELECT id_User FROM customer WHERE login_id = $login_id";
        $customer_result = mysqli_query($conn, $customer_query);
        $customer_row = mysqli_fetch_array($customer_result);
        $user_id = $customer_row["id_User"];

        if($role == "user") {
            $_SESSION["role"] = "user";
            $_SESSION["username"] = $username;
            $_SESSION["user_id"] = $user_id; // Gán id_User vào session
            header("location: index.php");
            exit(); // Kết thúc luồng xử lý sau khi chuyển hướng
        } elseif($role == "admin") {
            $_SESSION["role"] = "admin";
            $_SESSION["username"] = $username;
            header("location: adminhome.php");
            exit(); // Kết thúc luồng xử lý sau khi chuyển hướng
        } else {
            echo "Username or password incorrect";
        }
    } else {
        echo "Username or password incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>

<body>
    <center>
        <h1>Login Form</h1>
        <br><br><br><br>
        <div style="background-color: gray; width: 500px;">
            <br><br>
            <form action="#" method="POST">
                <div>
                    <label for="">Username</label>
                    <input type="text" name="username" required>
                </div>
                <br><br>
                <div>
                    <label for="">Password</label>
                    <input type="password" name="password" required>
                </div>
                <br><br>
                <div>
                    <input type="submit" value="Login">
                </div>
            </form>
            <br><br>
        </div>
    </center>
</body>

</html>
