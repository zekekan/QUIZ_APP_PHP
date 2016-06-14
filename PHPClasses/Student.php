<?php
/**
 * Created by PhpStorm.
 * User: schan
 * Date: 15-11-24
 * Time: 12:19 PM
 */

class PHPClasses_Student {
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

    /**
     * this will handles user registration process
     * @param array $data
     * @return boolean true or false based success
     */
    public function registration( array $data )
    {
        if( !empty( $data ) ){

            // Trim all the incoming data:
            $trimmed_data = array_map('trim', $data);

            // escape variables for security
            $loginId = mysqli_real_escape_string( $this->_con, $trimmed_data['signupId'] );
            $stduent_name = mysqli_real_escape_string( $this->_con, $trimmed_data['fullname'] );
            $password = mysqli_real_escape_string( $this->_con, $trimmed_data['user_password'] );
            $cpassword = mysqli_real_escape_string( $this->_con, $trimmed_data['confirm_password'] );

            if (empty($loginId)) {
                $_SESSION['error'] = constant('ID_MISSING');
                return false;
            }

            if (empty($stduent_name)) {
                $_SESSION['error'] = constant('NAME_MISSING');
                return false;
            }

            if (empty($password)) {
                $_SESSION['error'] = constant('PW_MISSING');
                return false;
            }

            if (empty($cpassword)) {
                $_SESSION['error'] = constant('PW_MISSING');
                return false;
            }

            if ($password !== $cpassword) {
                $_SESSION['error'] = constant('PASSWORD_NOT_MATCH');
                return false;
            }

            $query = "SELECT * FROM students WHERE login_id = '$loginId'";
            $checkid = mysqli_query($this->_con, $query);
            if (mysqli_num_rows($checkid) == 1) {
                $_SESSION['error'] = constant('ID_TAKEN');
                return false;
            }

            $password = md5( $password );
            $query = "INSERT INTO students (login_id, fullname, password, created) VALUES ('$loginId', '$stduent_name', '$password', CURRENT_TIMESTAMP)";
            if(mysqli_query($this->_con, $query)){
                $query = "SELECT id, login_id, fullname, created FROM students where login_id = '$loginId'";
                $result = mysqli_query($this->_con, $query);
                $data = mysqli_fetch_assoc($result);
                $_SESSION = $data;
                $_SESSION['logged_in'] = true;
                mysqli_close($this->_con);
                return true;
            };
        } else{
            throw new Exception( USER_REGISTRATION_FAIL );
        }
    }

    /**
     * This method will handle user login process
     * @param array $data
     * @return boolean true or false based on success or failure
     */
    public function login( array $data )
    {
        $_SESSION['logged_in'] = false;
        if( !empty( $data ) ){

            // Trim all the incoming data:
            $trimmed_data = array_map('trim', $data);

            // escape variables for security
            $loginId = mysqli_real_escape_string( $this->_con,  $trimmed_data['loginId'] );
            $password = mysqli_real_escape_string( $this->_con,  $trimmed_data['password'] );

            if (empty($loginId)) {
                $_SESSION['error'] = constant('ID_MISSING');
                return false;
            }

            if (empty($password)) {
                $_SESSION['error'] = constant('PW_MISSING');
                return false;
            }

            $query = "SELECT * FROM students where login_id = '$loginId' ";
            $checkid = mysqli_query($this->_con, $query);
            $checkdata = mysqli_fetch_assoc($checkid);

            $password = md5( $password );
            $inputPw = $checkdata['password'];

            if( mysqli_num_rows($checkid) == 1 ) {
                if ( $password !== $inputPw ) {
                    $_SESSION['error'] = constant('WRONG_PASSWORD');
                    return false;
                }
            } else {
                $_SESSION['error'] = constant('WRONG_ID');
                return false;
            }

            $query = "SELECT id, login_id, email, address, fullname, created FROM students where login_id = '$loginId' and password = '$password' ";
            $result = mysqli_query($this->_con, $query);
            $data = mysqli_fetch_assoc($result);
            $count = mysqli_num_rows($result);
            mysqli_close($this->_con);
            if( $count == 1){
                $_SESSION = $data;
                $_SESSION['logged_in'] = true;
                return true;
            }else{
                throw new Exception( LOGIN_FAIL );
            }
        } else{
            throw new Exception( LOGIN_FIELDS_MISSING );
        }
    }

    public function updateInformation( array $data )
    {
        if( !empty( $data ) ) {

            $trimmed_data = array_map('trim', $data);
            $username = mysqli_real_escape_string( $this->_con,  $trimmed_data['username'] );
            $fullname = mysqli_real_escape_string( $this->_con,  $trimmed_data['name'] );
            $email = mysqli_real_escape_string( $this->_con,  $trimmed_data['email'] );
            $address = mysqli_real_escape_string( $this->_con,  $trimmed_data['address'] );
            $user_password = mysqli_real_escape_string( $this->_con,  $trimmed_data['user_password'] );
            $confirm_password = mysqli_real_escape_string( $this->_con,  $trimmed_data['confirm_password'] );

            if ( (!empty($username)) && (!empty($fullname)) && (!empty($email)) && (!empty($address)) && (!empty($user_password)) && (!empty($confirm_password)) ) {

                if ($user_password !== $confirm_password) {
                    $_SESSION['error'] = constant('PASSWORD_NOT_MATCH');
                } else {
                    $password = md5($confirm_password);
                    $update= mysqli_query($this->_con, "UPDATE students SET fullname = '$fullname', email = '$email', address = '$address', password = '$password' WHERE login_id = '$username'");

                    if ($update) {
                        $row = mysqli_fetch_array('$update');

                        $_SESSION['login_id'] = $username;
                        $_SESSION['fullname'] = $fullname;
                        $_SESSION['email'] = $email;
                        $_SESSION['address'] = $address;

                        $_SESSION['error'] = constant('USERINFO_CHANAGE_SUCCESS');
                        return true;
                    }
                }
            }

            if (empty($fullname)) {
                $_SESSION['error'] = constant('NAME_MISSING');
            }

            if (empty($user_password)) {
                $_SESSION['error'] = constant('PW_MISSING');
            }

            if (empty($user_password)) {
                $_SESSION['error'] = constant('EMAIL_MISSING');
            }

            if (empty($user_password)) {
                $_SESSION['error'] = constant('ADDRESS_MISSING');
            }

            if (empty($confirm_password)) {
                $_SESSION['error'] = constant('PW_MISSING');
            }

        }
    }

    /**
     * This handle sign out process
     */
    public function logout()
    {
        session_unset();
        session_destroy();
        session_start();
        $_SESSION['success'] = LOGOUT_SUCCESS;
        header('Location: index.php');
    }


}
