<?php
ob_start();
session_start();
require_once 'config.php';
?>
<?php
if( !empty( $_POST )){
    try {
        $question = new PHPClasses_Question();
        $result = $question->getAnswers($_POST);
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
}else{
    header('Location: home.php');exit;
}

if ($result['right_answer'] >= '8') {
  if ($result['category_id'] == "1") {
    $Quiz = "Canada";
  } else {
    $Quiz = "Movie";
  }
  $resultMessage = "You have successfully passes the test. You are now certified in QUIZ QUIZ QUIZ where \"$Quiz\" is the certification topic you have chosen for this assignment.";
} else {
  $resultMessage = constant('QUIZ_FAIL');
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Result</title>

        <link rel="stylesheet" href="css/result.css" />
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
      $('.score').each(function() {
        var $this = $(this);
        jQuery({
          Counter: 0
        }).animate({
          Counter: $this.text()
        }, {
          duration: 1000,
          easing: 'swing',
          step: function() {
            $this.text(Math.ceil(this.Counter));
          }
        });
      });
    });
    </script>
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
			<img alt="" src="image/result-image.jpg" />
		</div>
		<div class="result">

			<form>
				<h1>Your Result</h1>

        <br />
          <p style="font-size: 30px;"><span class="score"><?php echo strval((double)$result['right_answer']/10 * 100) ?></span>%</p>
        <br /><br />
                <div>
                    <p class="col-sm-7 control-label">Right Answers:</p>
                    <div class="col-sm-5">
								<span class="well ans"> <?php echo isset($result['right_answer'])? $result['right_answer']:''; ?>
								</span>
                    </div>
                </div>
                <div>
                    <p class="col-sm-7 control-label">Wrong Answers:</p>
                    <div class="col-sm-5">
								<span class="well ans"> <?php echo isset($result['wrong_answer'])? $result['wrong_answer']:''; ?>
								</span>
                    </div>
                </div>
                <div>
                    <p class="col-sm-7 control-label">Unanswered Questions:</p>
                    <div class="col-sm-5">
								<span class="well ans"> <?php echo isset($result['unanswered'])? $result['unanswered']:''; ?>
								</span>
                    </div>
                </div>
                <p id="result-message"><?php echo $resultMessage ?></p>
				<div id="button-wrap">
					<button type="submit" class="result-bt" onclick="javascript:window.location.href='select-quizset.php'; return false;">
								Try Again >
          			</button>
          			<button type="submit" class="result-bt" onclick="javascript:window.location.href='index.php'; return false;">
								Back to Home >
          			</button>
          		</div>
			</form>
		</div>
	</body>
</html>
<?php unset($_SESSION['success'] ); unset($_SESSION['error']);  ?>
