<?php
    defined ( 'BASEPATH' ) or exit( 'No direct script access allowed' );
    
    class Login extends CI_Controller {
        
        /**
         * -----------------
         * constructor function for login controller
         * to load libraries, models, helpers etc
         * -----------------
         */
        
        public function __construct () {
            parent ::__construct ();
            
            if ( is_user_logged_in () )
                return redirect ( base_url ( '/dashboard' ) );
            
            $this -> load -> model ( 'User' );
            $this -> load -> model ( 'LoginModel' );
        }
        
        /**
         * -----------------
         * loads the login form
         * -----------------
         */
        
        public function index () {
            $title = 'Login';
            
            if ( isset( $_POST[ 'action' ] ) and $_POST[ 'action' ] == 'authenticate-user' )
                $this -> process_authenticate_user ();
            
            login_header ( $title );
            $this -> load -> view ( 'login/login' );
            login_footer ();
        }
        
        /**
         * -----------------
         * authenticate user
         * by email and password
         * -----------------
         */
        
        private function process_authenticate_user () {
            $this -> form_validation -> set_rules ( 'email', 'email', 'required|trim|valid_email|xss_clean' );
            $this -> form_validation -> set_rules ( 'password', 'password', 'required|trim|xss_clean' );
            
            if ( $this -> form_validation -> run () ) {
                $email = $this -> input -> post ( 'email', true );
                $password = $this -> input -> post ( 'password', true );
                
                $user_id = $this -> LoginModel -> authenticate_user ( $email, $password );
                if ( $user_id > 0 ) {
                    $this -> session -> set_userdata ( 'user_id', encrypt_string ( $user_id ) );
                    return redirect ( base_url ( '/dashboard' ) );
                }
                else {
                    $this -> session -> set_flashdata ( 'error', 'Ops! Invalid credentials.' );
                    return;
                }
                
            }
        }
        
        /**
         * -----------------
         * loads the register form
         * -----------------
         */
        
        public function register () {
            $title = 'Create New Account';
            
            if ( isset( $_POST[ 'action' ] ) and $_POST[ 'action' ] == 'process-account-creation' )
                $this -> process_account_creation ();
            
            login_header ( $title );
            $this -> load -> view ( 'login/register' );
            login_footer ();
        }
        
        /**
         * -----------------
         * create new users
         * runs form validations
         * throws errors
         * -----------------
         */
        
        private function process_account_creation () {
            $this -> form_validation -> set_rules ( 'first_name', 'first name', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'last_name', 'last name', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'email', 'email', 'required|trim|valid_email|is_unique[users.email]|xss_clean' );
            $this -> form_validation -> set_rules ( 'password', 'password', 'required|trim|xss_clean' );
            
            if ( $this -> form_validation -> run () ) {
                $first_name = $this -> input -> post ( 'first_name', true );
                $last_name = $this -> input -> post ( 'last_name', true );
                $email = $this -> input -> post ( 'email', true );
                $password = $this -> input -> post ( 'password', true );
                
                $info = array (
                    'first_name' => $first_name,
                    'last_name'  => $last_name,
                    'email'      => $email,
                    'password'   => password_hash ( $password, PASSWORD_BCRYPT )
                );
                
                $user_id = $this -> User -> add ( $info );
                if ( $user_id > 0 ) {
                    $this -> session -> set_flashdata ( 'response', 'User has been created successfully.' );
                    return redirect ( base_url ( '/create-account' ) );
                }
                else {
                    $this -> session -> set_flashdata ( 'error', 'Ops! Something happened. Please try again.' );
                    return;
                }
                
            }
            
        }
        
        /**
         * -----------------
         * loads the password forgot form
         * -----------------
         */
        
        public function forgot_password () {
            $title = 'Password Forgot';
            login_header ( $title );
            $this -> load -> view ( 'login/password-forgot' );
            login_footer ();
        }
        
    }