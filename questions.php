<?php
ob_start();
session_start();
require_once 'config.php';
?>
<?php
    if( !empty( $_POST )){
        try {
            $question = new PHPClasses_Question();
            $results = $question->getQuestions($_POST);
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

    }else{
        $_SESSION['error'] = CHOOSE_CATEGORY;
        header('Location: home.php');exit;
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Questions</title>
        
        <link rel="stylesheet" href="css/questions.css" />
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
			<img alt="" src="image/q-image.jpg" />
		</div>
		<div class="q1">
			
			<form id='quiz_form' method="post" action="result.php">
                <?php
                    $rowcount =  $results['rowcount'];
                    $i = 0;
                    $j = 1; $k = 1;
                ?>
                <?php foreach ($results['questions'] as $result) {
                    if ($i == 0) {
                        echo "<div id='question_splitter_$j'>";
                    } else {
                        echo "<div id='question_splitter_$j' style='display:none'>";
                    }
                    ?>
                    <p class='questions' id="qname<?php echo $j;?>"> <?php echo $k?>.<?php echo ' '.$result['question_name'];?></p>
                    <input type="radio" value="1" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['choice1'];?>
                    <br/>
                    <input type="radio" value="2" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['choice2'];?>
                    <br/>
                    <input type="radio" value="3" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['choice3'];?>
                    <br/>
                    <input type="radio" value="4" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['choice4'];?>
                    <br/>
                <?php
                     $i++;
                     if ( ( $i == $rowcount) ) {
                         echo " <button id='".$j."' class='previous next-bt' type='button'>Previous</button>
                                        <button id='".$j."' class='next next-bt' type='submit'>Finish</button>";
                         echo "</div>";
                     }  elseif ( $i < $rowcount  ) {
                         if ( $j == 1) {
                             echo "<button id='".$j."' class='next next-bt' type='button'>Next</button>";
                             echo "</div>";
                             //$i = 0;
                             $j++;
                         }
                         elseif ( $j > 1) {
                             echo "<button id='".$j."' class='previous next-bt' type='button'>Previous</button>
                                        <button id='".$j."' class='next next-bt' type='button' >Next</button>";
                             echo "</div>";
                             //$i = 0;
                             $j++;
                         }
                     }
                     $k++;
                    } ?>
            </form>
		</div>
	</body>

    <script>
        $(document).on('click', '.next', function () {
            last = parseInt($(this).attr('id'));
            next = last + 1;
            $('#question_splitter_' + last).css("display", "none");
            $('#question_splitter_' + next).css("display", "block");
        });

        $(document).on('click', '.previous', function () {
            last = parseInt($(this).attr('id'));
            pre = last - 1;
            $('#question_splitter_' + last).css("display", "none");

            $('#question_splitter_' + pre).css("display", "block");
        });
    </script>
</html>
<?php unset($_SESSION['success'] ); unset($_SESSION['error']); ?>