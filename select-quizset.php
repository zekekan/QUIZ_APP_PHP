<?php
ob_start();
session_start();
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>information</title>

        <link rel="stylesheet" href="css/select-quizset.css" />
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	</head>
	<body>
		<nav>
			<ul class="nav_left">
				<li><a href="select-quizset.php">Home</a></li>
				<li><a href="t-history.php">Test History</a></li>
			</ul>

			<ul class="nav_right">
				<li><a href="#"><u><?php if($_SESSION['logged_in']) { ?>
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

		<div class="box">
			<h1 style="text-align: center;">Choose a quizset below!</h1>
            <form method="post" id='select_quiz' name="category" action="questions.php">
				<div class="bt-wrap">
          			<button type="submit" name="QuizCategory" value="1" class="qs-button1" return false;">
								Quiz set 1 (CANADA)
          			</button>
          			<button type="submit" name="QuizCategory" value="2" class="qs-button2" return false;">
								Quiz set 2 (MOVIE)
          			</button>

          		</div>
            </form>
		</div>
	</body>
</html>
<?php unset($_SESSION['success'] ); unset($_SESSION['error']);  ?>
