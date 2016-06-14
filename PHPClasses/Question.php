<?php
/**
 * Created by PhpStorm.
 * User: schan
 * Date: 15-11-24
 * Time: 12:19 PM
 */

class PHPClasses_Question
{
    /**
     * @var will going contain database connection
     */
    protected $_con;

    /**
     * it will initalize DBclass
     */
    public function __construct()
    {
        $db = new PHPClasses_DBclass();
        $this->_con = $db->con;
    }

    public function getQuestions(array $data)
    {
        if( !empty( $data ) ){

            // escape variables for security
            $category_id = mysqli_real_escape_string( $this->_con, trim( $data['QuizCategory']));
            if((!$category_id) ) {
                throw new Exception( FIELDS_MISSING );
            }
            $user_id = $_SESSION['id'];
            $_SESSION['category_id'] = $category_id;
            $results = array();
            $rowcount = 10;
            $row = mysqli_query( $this->_con, "select * from questions where category_id=$category_id ORDER BY RAND() LIMIT $rowcount");
            $results['rowcount'] = $rowcount;
            while ( $result = mysqli_fetch_assoc($row) ) {
                $results['questions'][] = $result;
            }
            mysqli_close($this->_con);
            return $results;
        } else{
            throw new Exception( FIELDS_MISSING );
        }
    }

    public function getAnswers(array $data)
    {
        if( !empty( $data ) ){
            $total_questions = 10;
            $right_answer=0;
            $wrong_answer=0;
            $unanswered=0;
            $keys=array_keys($data);
            $order=join(",",$keys);
            $query = "select id,answer_index from questions where id IN($order) ORDER BY FIELD(id,$order)";
            $response=mysqli_query( $this->_con, $query) or die(mysqli_error());

            $user_id = $_SESSION['id'];
            $category_id = $_SESSION['category_id'];
            while($result=mysqli_fetch_array($response)){
                if($result['answer_index']+1 == $_POST[$result['id']]){
                    $right_answer++;
                }
                else{
                    $wrong_answer++;
                }
            }
            $unanswered = $total_questions - ($right_answer + $wrong_answer);
            $results = array();
            $results['right_answer'] = $right_answer;
            $results['wrong_answer'] = $wrong_answer;
            $results['unanswered'] = $unanswered;
            $query = "INSERT INTO `testhistory` (`category_id`, `right_answers`, `wrong_answers`, `unanswers`, `total_problems`, `student_id`) VALUES
            ($category_id, $right_answer, $wrong_answer, $unanswered, $total_questions, (SELECT id from students WHERE id = $user_id))";
            mysqli_query( $this->_con, $query)   or die(mysqli_error());
            mysqli_close($this->_con);
            return $results;
        }
    }
}