<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/app/config.php";
include_once CLASS_PATH."Database.php"; 
include_once CLASS_PATH."User.php"; 
$db = new Database("localhost", "root", "", "inventaris");
$user = new User($db);

if(isset($_POST["submit"])){
	$username = $_POST["username"];
	$pass = $_POST["pass"];
	if ($user->login($username, $pass) == 1) {
		header("Location: index.php");
	}
}
$_SESSION['username'] = "";
$_SESSION['pass'] = "";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventaris </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
  </head>
  <body>
<style>
	body, h2, p, input, button {
	  margin: 0;
	  padding: 0;
	  box-sizing: border-box;
	  font-family: 'Poppins', sans-serif;
	}

	body {
	  display: flex;
	  justify-content: center;
	  align-items: center;
	  min-height: 100vh;
	  background: linear-gradient(135deg, #6C63FF, #4ADEDE, #FF6584);
	  background-size: 300% 300%;
	  animation: gradient-bg 8s infinite;
	}

	/* Gradient Animation */
	@keyframes gradient-bg {
	  0% { background-position: 0% 50%; }
	  50% { background-position: 100% 50%; }
	  100% { background-position: 0% 50%; }
	}

	/* Main Container */
	.main-container {
	  width: 100%;
	  max-width: 400px;
	  backdrop-filter: blur(10px);
	  background: rgba(255, 255, 255, 0.15);
	  border-radius: 15px;
	  padding: 20px;
	  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
	}

	/* Form Wrapper */
	.form-wrapper {
	  overflow: hidden;
	  position: relative;
	}

	.form-content {
	  display: flex;
	  transition: transform 0.6s ease-in-out;
	  width: 200%;
	}

	.form {
	  width: 50%;
	  padding: 30px;
	  background: white;
	  border-radius: 10px;
	  opacity: 0;
	  transform: translateY(30px);
	  transition: all 0.6s ease;
	}

	.form.active {
	  opacity: 1;
	  transform: translateY(0);
	}

	h2 {
	  margin-bottom: 10px;
	  font-weight: 600;
	  color: #333;
	  font-size: 24px;
	}

	p {
	  font-size: 14px;
	  color: #777;
	  margin-bottom: 20px;
	}

	.input-group {
	  position: relative;
	  margin-bottom: 20px;
	}

	.input-group input {
	  width: 100%;
	  padding: 10px 40px;
	  border: 1px solid #ddd;
	  border-radius: 5px;
	  font-size: 14px;
	}

	.input-group .input-icon {
	  position: absolute;
	  top: 50%;
	  left: 10px;
	  transform: translateY(-50%);
	  font-size: 16px;
	  color: #aaa;
	}

	.btn {
	  width: 100%;
	  padding: 12px 0;
	  border: none;
	  border-radius: 5px;
	  background: linear-gradient(120deg, #6C63FF, #FF6584);
	  color: white;
	  font-size: 14px;
	  font-weight: bold;
	  cursor: pointer;
	  transition: 0.3s;
	}

	.btn:hover {
	  background: linear-gradient(120deg, #FF6584, #4ADEDE);
	}

	.switch-text {
	  text-align: center;
	  font-size: 13px;
	  color: #555;
	}

	.switch-text .toggle-form {
	  color: #6C63FF;
	  font-weight: bold;
	  cursor: pointer;
	  transition: 0.3s;
	}

	.switch-text .toggle-form:hover {
	  text-decoration: underline;
	}
</style>
<div class="main-container">
    <div class="form-wrapper">
	    <div class="form-content">
	        <!-- Login Form -->
	        <form class="form login-form active" method="post" action="">
	          <h2>Welcome Back!</h2>
	          <p>Login to your account to continue</p>
	          <div class="input-group">
	          	<?php  if ($_SESSION['username'] == 0) : ?>
	          	⛔ username not found
	        	<?php endif; ?>
	            <input type="username" placeholder="username" name="username" required>
	            <span class="input-icon">📧</span>
	          </div>
	          <div class="input-group">
	          	<?php  if ($_SESSION['pass'] == 0) : ?>
	          	⛔ password not matched
	        	<?php endif; ?>
	            <input type="password" placeholder="Password" name="pass" required>
	            <span class="input-icon">🔒</span>
	          </div>
	          <button type="submit" class="btn" name="submit">Login</button>
	        </form>
	    </div>
    </div>
</div>

<?php include_once LAYOUTS_PATH."footer.php";?>