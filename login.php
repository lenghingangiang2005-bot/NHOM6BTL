<?php
session_start();
include "config.php";

// Nếu đã đăng nhập
if(isset($_SESSION['user_id']))
{
    header("Location: trangchu.php");
    exit();
}

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(empty($username) || empty($password))
    {
        $error = "Vui lòng nhập đầy đủ thông tin!";
    }
    else
    {
        $sql = "SELECT * FROM users WHERE username = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if($stmt)
        {
            mysqli_stmt_bind_param(
                $stmt,
                "s",
                $username
            );

            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) > 0)
            {
                $user = mysqli_fetch_assoc($result);

                // Kiểm tra mật khẩu mã hoá
                if(password_verify($password, $user['password']))
{
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];
$_SESSION['ma_nv'] = $user['ma_nv'];
$_SESSION['ma_cn'] = $user['ma_cn'];
    header("Location: trangchu.php");
    exit();
}
                else
                {
                    $error = "Sai mật khẩu!";
                }
            }
            else
            {
                $error = "Tài khoản không tồn tại!";
            }

            mysqli_stmt_close($stmt);
        }
        else
        {
            $error = "Lỗi truy vấn SQL!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Bloom Café Management</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}
body{
    margin:0;
    padding:0;
    min-height:100vh;
    overflow:hidden;
    font-family:'Segoe UI',sans-serif;
}

.login-container{
    width:100vw;
    height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    background:
    linear-gradient(
        rgba(0,0,0,0.45),
        rgba(0,0,0,0.45)
    ),
    url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1920&q=80');

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    background-attachment:fixed;
}

.login-box{
    width:420px;
    background:rgba(255,255,255,0.12);
    backdrop-filter:blur(15px);
    -webkit-backdrop-filter:blur(15px);

    padding:40px;
    border-radius:25px;

    border:1px solid rgba(255,255,255,.2);

    box-shadow:
    0 15px 40px rgba(0,0,0,.35);

    color:#fff;
}

.logo{
text-align:center;
font-size:42px;
margin-bottom:10px;
}

.title{
text-align:center;
font-size:24px;
font-weight:700;
margin-bottom:25px;
/* color:#333; */
    color:#fff;
}

.form-group{
margin-bottom:15px;
}

.form-group label{
display:block;
margin-bottom:8px;
font-weight:600;
    color:#fff;
}

.form-group input{
    width:100%;
    padding:14px;
    border:1px solid rgba(255,255,255,.25);
    border-radius:12px;
    font-size:15px;
    outline:none;

    background:rgba(255,255,255,.15);
    color:#fff;
}

.form-group input::placeholder{
    color:#ddd;
}

.form-group input:focus{
    border-color:#C49A6C;
}

.btn-login{
    width:100%;
    padding:14px;
    border:none;
    border-radius:12px;

    background:linear-gradient(
        135deg,
        #8B5E3C,
        #C49A6C
    );

    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
}

.btn-login:hover{
    transform:translateY(-2px);
}

.error{
background:#FEE2E2;
color:#DC2626;
padding:10px;
border-radius:10px;
margin-bottom:15px;
}
.password-box{
    position:relative;
}

.password-box input{
    width:100%;
    padding:14px 50px 14px 14px;
}

.toggle-password{
    position:absolute;
    right:15px;
    top:50%;
    transform:translateY(-50%);
    cursor:pointer;
    font-size:20px;
    color:#ddd;
    user-select:none;
    transition:.3s;
}

.toggle-password:hover{
    color:#fff;
}
.footer{
margin-top:20px;
text-align:center;
font-size:13px;
/* color:#666; */
color: #ddd;
}

</style>

</head>

<body>
<div class="login-container">
<div class="login-box">

<div class="logo">
☕
</div>

<div class="title">
Bloom Cafe Management
</div>

<?php if(!empty($error)): ?>

<div class="error">
<?= $error ?>
</div>

<?php endif; ?>

<form method="POST">

<div class="form-group">
<label>Tên đăng nhập</label>
<input
type="text"
name="username"
required>
</div>

<div class="form-group">
    <label>Mật khẩu</label>

    <div class="password-box">
        <input
        type="password"
        name="password"
        id="password"
        required>

        <span
        class="toggle-password"
        onclick="togglePassword()">

        👁

        </span>
    </div>
</div>

<button
type="submit"
class="btn-login">

Đăng nhập

</button>

</form>

<div class="footer">
© Bloom Café Chain Management
</div>
</div>
</div>
<script>
function togglePassword()
{
    const password =
        document.getElementById('password');

    const icon =
        document.querySelector(
            '.toggle-password'
        );

    if(password.type === "password")
    {
        password.type = "text";
        icon.innerHTML = "🙈";
    }
    else
    {
        password.type = "password";
        icon.innerHTML = "👁";
    }
}
</script>
</body>
</html> 
