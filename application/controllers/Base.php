<?php
    
    class Base extends CI_Controller {
    
        /**
         * -----------------
         * checks if the user is logged in
         * if not, redirect back to main login page
         * -----------------
         */
        
        public function __construct () {
            parent ::__construct ();
            redirect_if_not_logged_in ();
        }
        
    }