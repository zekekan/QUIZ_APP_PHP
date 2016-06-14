<?php
ob_start();
session_start();
require_once 'config.php';
?>
<?php
    $stduent_obj = NULL;
    if( !empty( $_POST ) && isset($_POST['loginButton'])){
        try {
            if ($stduent_obj == NULL)
                $stduent_obj = new PHPClasses_Student();
            $data = $stduent_obj->login( $_POST );
            if($data && isset($_SESSION['logged_in'])){
                $_SESSION['success'] = 'You are logged in successfully';
                header('Location: select-quizset.php');exit;
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            $_SESSION['error'] = $error;
        }
    }
    else if (!empty( $_POST ) && isset($_POST['signUpButton'])) {
        try {
            if ($stduent_obj == NULL)
                $stduent_obj = new PHPClasses_Student();
            $data = $stduent_obj->registration( $_POST );
            if($data){
                $_SESSION['success'] = USER_REGISTRATION_SUCCESS;
                header('Location: select-quizset.php');exit;
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            $_SESSION['error'] = $error;
        }
    }

    //print_r($_SESSION);
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
        header('Location: select-quizset.php');exit;
    }

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>QUIZ</title>

        <link rel="stylesheet" href="css/main.css" />
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	</head>
	<body>
		<header>
			<h1>
            QUIZ QUIZ QUIZ
            </h1>
		</header>
		<div class="front-bg">
			<img alt="" src="image/bg-image.jpg" />
		</div>

		<div id="main">

		<div id="left-control">
		<div>
 		<form id="sign-in" class="signin" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    		<div>
     			<input name="loginId" type="text" placeholder="Login ID" autocomplete="on" autofocus="true" class="inputField">
   			</div>

    	<table style="margin-top: 10px;">
      		<tbody>
      			<tr>
        			<td>
          				<div>
            				<input name="password" type="password" placeholder="Password" class="inputField" style="margin-left: -2px; width: 195px; margin-bottom: 0px !important;">
          				</div>
        			</td>
        				<td>
          					<button name ="loginButton" type="submit" class="login-bt" return false;>
								Log in
          					</button>
        				</td>
      			</tr>

      		</tbody>
   		 </table>
       <span class="e-message"><?php if (isset($_POST['loginButton']) && isset($_SESSION['error'])) { echo $_SESSION['error']; } ?></span>

  		</form>
		</div>

    	<div class="signup">
  			<h2>Not Signed Up Yet?</h2>

  		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="sign-up">

   			<div class="field">
      			<input type="text" placeholder="Login ID" maxlength="20" name="signupId" autocomplete="off" class="inputField" style="margin-top: 0 !important;">
    		</div>
    		<div class="field">
      			<input type="text" placeholder="Full name" name="fullname" autocomplete="off" class="inputField">
    		</div>
    		<div class="field">
      			<input type="password" placeholder="Password" name="user_password" class="inputField">
    		</div>
    		<div class="field">
      			<input type="password" placeholder="Confirm Password" name="confirm_password" class="inputField">
                <span class="e-message"><?php if (isset($_POST['signUpButton']) && isset($_SESSION['error'])) echo $_SESSION['error']; ?></span>
    		</div>

    		<button class="signup-btn" name="signUpButton" type="submit" return false;>
      			Sign up for Quiz
    		</button>

    	</form>
    	</div>
		</div>
			<div id="intro-text">
			<h2>Welcome to Quiz app</h2><br />
			<p class="desc">Greetings! We have 2 sets of quiz<br />which provide users 10 questions about<br />Canada and movies respectively.<br />We hope you enjoy the challenge.<br />Good Luck!!</p>
		</div>
		</div>
    <footer>
      <p>2015 Lambton - 3134 PHP ASSIGNMENT SEUNGCHUL HAN, SUNGKYOO JUN</p>
    </footer>
	</body>
</html>
<?php ob_end_flush(); ?>
<?php unset($_SESSION['success'] ); unset($_SESSION['error']);  ?>
