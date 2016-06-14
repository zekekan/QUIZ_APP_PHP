<?php
ob_start();
session_start();
require_once 'config.php';
?>
<?php
    if($_SESSION['logged_in']) {
        try {
            $test_history = new PHPClasses_TestHistory();
            $results = $test_history->getTestHistory();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>information</title>

        <link rel="stylesheet" href="css/t-history.css" />
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
		<div class="information">

			<form>

          		<div id="form1">
          			<h1>Test History</h1>
					<br />
                    <?php
                        $i = 0;
                        if ($results['rowcount'] > 0) { ?>
                            <table border="1px">
                            <thead>
                                <td>Number</td>
                                <td>Test Set</td>
                                <td>Right answers</td>
                                <td>Wrong answers</td>
                                <td>Unanswered</td>
                                <td>Total problems</td>
                                <td>Percentage</td>
                            </thead>
                            <?php foreach ($results['history'] as $result) { ?>
                                <tr name="row_<?php echo ($i+1); ?>">
                                    <td>
                                        <?php echo ($i+1); ?>
                                    </td>
                                    <td>
                                        <?php echo $result['category_name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $result['right_answers'] ?>
                                    </td>
                                    <td>
                                        <?php echo $result['wrong_answers'] ?>
                                    </td>
                                    <td>
                                        <?php echo $result['unanswers'] ?>
                                    </td>
                                    <td>
                                        <?php echo $result['total_problems'] ?>
                                    </td>
                                    <td>
                                        <?php echo ((double)$result['right_answers']/$result['total_problems'] * 100).'%' ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            </table>
                        <?php
                        }
                        else {
                            echo "<h3>You don't have any test history. Try your first test!</h3>";
                        }
                        ?>
                    <php }?>
          		</div>

          		<div id="form-btn">

          		<button type="submit" class="button" onclick="javascript:window.location.href='select-quizset.php'; return false;">
								Back to Home
          		</button>
          		</div>
			</form>
		</div>
	</body>
</html>
<?php unset($_SESSION['success'] ); unset($_SESSION['error']);  ?>
