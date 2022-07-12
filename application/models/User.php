<?php
    
    class User extends CI_Model {
        
        /**
         * -----------------
         * @param $info
         * @return mixed
         * creates a new user into the database
         * -----------------
         */
        
        public function add ( $info ) {
            $this -> db -> insert ( 'users', $info );
            return $this -> db -> insert_id ();
        }
        
    }