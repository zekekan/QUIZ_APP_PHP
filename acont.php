<?php
ob_start();
session_start();
require_once 'config.php';
?>
<?php
    $stduent_obj = NULL;
    if( !empty( $_POST ) && isset($_POST['saveButton'])){
        try {
            if ($stduent_obj == NULL)
                $stduent_obj = new PHPClasses_Student();
            if(isset($_SESSION['logged_in'])){
                $stduent_obj->updateInformation($_POST);
            } else {
                $_SESSION['error'] = 'You are not logged in';
                header('Location: index.php');exit;
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            $_SESSION['error'] = $error;
        }
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>information</title>

        <link rel="stylesheet" href="css/acont.css" />
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	</head>
	<body>
		<nav>
			<ul class="nav_left">
				<li><a href="select-quizset.php">Home</a></li>
				<li><a href="t-history.php">Test History</a></li>
			</ul>

			<ul class="nav_right">
				<li><a href="#"><u>
                            <?php if($_SESSION['logged_in']) { ?>
                            <?php echo $_SESSION['fullname']; } ?></u></a>
				<ul class="dropdown">
					<li><a href="acont.php">My info</a></li>
					<li><a href="logout.php">Log-out</a></li>
				</ul>
				</li>
			</ul>
		</nav>
		<div class="front-bg">
			<img alt="" src="image/info-image.jpg" />
		</div>
		<div class="information">

			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

          			<h1>Your Information</h1><br />
                <div id="form1">
          			<label>Username: </label><input type="text" name="username" value="<?php echo $_SESSION['login_id'] ?>" readonly />
					<br />
					<span class="message"></span>
					<label>Full name: </label><input type="text" name="name" value="<?php echo $_SESSION['fullname']; ?>" />
					<br />
					<label>E-mail: </label><input type="text" name="email" value="<?php echo $_SESSION['email']; ?>" />
					<br />
					<label>address: </label><input type="text" name="address" value="<?php echo $_SESSION['address']; ?>" />
					<br />
					<label>Password: </label><input type="password" placeholder="Password" name="user_password" />
					<br />
					<label></label><input type="password" placeholder="Confirm Password" name="confirm_password" />
					<br />
					<span class="message"><?php echo $_SESSION['error'] ?></span>
        	  	</div>
          		<div id="form-btn">
          		<button type="submit" name="saveButton" class="button" return false;>
								Save the change
          		</button>
          		<button type="submit" class="button" onclick="javascript:window.location.href='select-quizset.php'; return false;">
								Back to Home
          		</button>
          		</div>
			</form>
		</div>
	</body>
</html>
<?php ob_end_flush(); ?>
<?php unset($_SESSION['success'] ); unset($_SESSION['error']);  ?>
