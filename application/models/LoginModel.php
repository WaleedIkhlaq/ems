<?php
    
    class LoginModel extends CI_Model {
    
        /**
         * -----------------
         * @param $email
         * @param $password
         * @return false
         * authenticate user
         * -----------------
         */
        
        public function authenticate_user ( $email, $password ) {
            $result = $this -> db -> get_where ( 'users', array (
                'email' => $email,
            ) );
            if ( $result -> num_rows () == 1 ) {
                $user = $result -> row ();
                if ( password_verify ( $password, $user -> password ) ) {
                    unset( $user -> password );
                    return $user -> id;
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }
        
    }