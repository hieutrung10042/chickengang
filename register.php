<?php 
require_once 'code.php';    
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];

    $errors = array();

    // Kiểm tra đầu vào
    if (empty($username)) {
        $errors[] = "Tên người dùng là bắt buộc.";
    }

    if (empty($password)) {
        $errors[] = "Mật khẩu là bắt buộc.";
    }

    if ($password !== $passwordRepeat) {
        $errors[] = "Mật khẩu không khớp.";
    }

    require_once "db.php";

    // Kiểm tra nếu tên người dùng đã tồn tại
    $sql = "SELECT username FROM login WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $errors[] = "Tên người dùng đã tồn tại.";
        }
        mysqli_stmt_close($stmt);
    } else {
        $errors[] = "Lỗi: Không thể chuẩn bị câu lệnh SQL.";
    }

    // Nếu không có lỗi xác thực, tiến hành thêm người dùng vào cả hai bảng
    if(empty($errors)) {
        // Thêm người dùng vào bảng login
        $sql_login = "INSERT INTO login (username, password) VALUES (?, ?)";
        $stmt_login = mysqli_prepare($conn, $sql_login);
        mysqli_stmt_bind_param($stmt_login, "ss", $username, $password);
        mysqli_stmt_execute($stmt_login);
        
        // Lấy ID cuối cùng được chèn vào bảng login
        $login_id = mysqli_insert_id($conn);

        // Thêm người dùng vào bảng customer với khóa ngoại trỏ đến bảng login
        $sql_customer = "INSERT INTO customer (username, password, login_id) VALUES (?, ?, ?)";
        $stmt_customer = mysqli_prepare($conn, $sql_customer);
        mysqli_stmt_bind_param($stmt_customer, "ssi", $username, $password, $login_id);
        mysqli_stmt_execute($stmt_customer);
        
        echo "<div class='alert alert-success'>Bạn đã đăng ký thành công.</div>";
    } else {
        // Nếu có lỗi xác thực, hiển thị chúng
        foreach ($errors as $errMsg) {
            echo "<div class='alert alert-danger'>$errMsg</div>";
        }
    }
}
?>

<div class="form-container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <input type="text" name="username" placeholder="Username" class="box" required>
        </div>
        <div>
            <input type="password" name="password" placeholder="Password" class="box" required>        
        </div>
        <div>
            <input type="password" name="repeat_password" placeholder="Confirm Password" class="box" required>        
        </div>
        <div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
