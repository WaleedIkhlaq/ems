<?php
    
    defined ( 'BASEPATH' ) or exit( 'No direct script access allowed' );
    
    require_once 'Base.php';
    
    class Dashboard extends Base {
        
        /**
         * -----------------
         * constructor function for login controller
         * to load libraries, models, helpers etc
         * -----------------
         */
        
        public function __construct () {
            parent ::__construct ();
        }
    
        /**
         * -----------------
         * loads the login form
         * -----------------
         */
    
        public function index () {
            $title = 'Dashboard';
            dashboard_header ( $title );
            $this -> load -> view ( 'dashboard/index' );
            dashboard_footer ();
        }
        
    }