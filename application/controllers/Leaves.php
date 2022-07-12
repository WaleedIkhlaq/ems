<?php
    
    defined ( 'BASEPATH' ) or exit( 'No direct script access allowed' );
    
    require_once 'Base.php';
    
    class Leaves extends Base {
        
        /**
         * -----------------
         * constructor function for login controller
         * to load libraries, models, helpers etc
         * -----------------
         */
        
        public function __construct () {
            parent ::__construct ();
            $this -> load -> model ( 'LeaveModel' );
        }
        
        /**
         * -----------------
         * loads the all leaves page
         * -----------------
         */
        
        public function index () {
            $data[ 'title' ] = $title = 'All Leaves';
            dashboard_header ( $title );
            $data[ 'leaves' ] = $this -> LeaveModel -> get_leaves ();
            $this -> load -> view ( 'leaves/index', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * loads the add leaves form
         * -----------------
         */
        
        public function add () {
            $data[ 'title' ] = $title = 'Create New Leave';
            
            if ( isset( $_POST[ 'action' ] ) and $_POST[ 'action' ] == 'process-create-leaves' )
                $this -> process_create_leaves ();
            
            dashboard_header ( $title );
            $this -> load -> view ( 'leaves/add', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * process the form validation
         * creates new leaves
         * -----------------
         */
        
        private function process_create_leaves () {
            $this -> form_validation -> set_rules ( 'title', 'title', 'required|trim|is_unique[leaves.title]|xss_clean' );
            
            if ( $this -> form_validation -> run () ) {
                $title = $this -> input -> post ( 'title', true );
                
                $info = array (
                    'user_id'    => get_logged_in_user_id (),
                    'title'      => $title,
                );
                
                $leave_id = $this -> LeaveModel -> add ( $info );
                if ( $leave_id > 0 ) {
                    $this -> session -> set_flashdata ( 'response', 'Leave has been created.' );
                    return redirect ( base_url ( '/leaves/add' ) );
                }
                else {
                    $this -> session -> set_flashdata ( 'error', 'Ops! Something happened. Please try again' );
                    return;
                }
                
            }
        }
        
        /**
         * -----------------
         * loads the edit leaves form
         * -----------------
         */
        
        public function edit () {
            $data[ 'title' ] = $title = 'Edit Leave';
            
            $id = validate_url_id ( 'leaves/index' );
            if ( isset( $_POST[ 'action' ] ) and $_POST[ 'action' ] == 'process-update-leaves' )
                $this -> process_update_leaves ();
            
            dashboard_header ( $title );
            $data[ 'leave' ] = $this -> LeaveModel -> get_leave_by_id ( $id );
            $this -> load -> view ( 'leaves/edit', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * process the form validation
         * update leaves
         * -----------------
         */
        
        private function process_update_leaves () {
            $this -> form_validation -> set_rules ( 'id', 'leave id', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'title', 'title', 'required|trim|xss_clean' );
            
            if ( $this -> form_validation -> run () ) {
                $id = $this -> input -> post ( 'id', true );
                $title = $this -> input -> post ( 'title', true );
                
                $info = array (
                    'user_id'    => get_logged_in_user_id (),
                    'title'      => $title,
                );
                $where = array (
                    'id' => decrypt_string ( $id ),
                );
                
                $isUpdated = $this -> LeaveModel -> edit ( $info, $where );
                if ( $isUpdated ) {
                    $this -> session -> set_flashdata ( 'response', 'Leave has been updated.' );
                    return redirect ( $_SERVER[ 'HTTP_REFERER' ] );
                }
                else {
                    $this -> session -> set_flashdata ( 'error', 'Everything is upto date.' );
                    return;
                }
                
            }
        }
        
        /**
         * -----------------
         * delete leaves
         * -----------------
         */
        
        public function delete () {
            $id = validate_url_id ( 'leaves/index' );
            $this -> LeaveModel -> delete ( $id );
            $this -> session -> set_flashdata ( 'response', 'Leave has been deleted.' );
            return redirect ( base_url ( '/leaves/index' ) );
        }
        
    }