<?php
/**
 * Created by PhpStorm.
 * User: schan
 * Date: 15-12-01
 * Time: 9:22 AM
 */

class PHPClasses_TestHistory {
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

    public function getTestHistory() {
        if ($_SESSION['logged_in'] && isset($_SESSION['id'])) {
            $stu_id = $_SESSION['id'];
            $query = "SELECT testhistory.id, categories.category_name, testhistory.right_answers, testhistory.wrong_answers, testhistory.unanswers, testhistory.total_problems FROM testhistory LEFT JOIN categories ON testhistory.category_id = categories.id where testhistory.student_id = '$stu_id' ORDER BY testhistory.created DESC";
            $result = mysqli_query($this->_con, $query) or die("Couldn t execute query.".mysqli_error($this->_con));
            $results = array();
            $results['rowcount'] = mysqli_num_rows($result);
            while($row = mysqli_fetch_assoc($result)) {
                $results['history'][] = $row;
            }
            mysqli_close($this->_con);
            return $results;
        } else{
            throw new Exception( USER_REGISTRATION_FAIL );
        }
    }
} 