<?php
    
    defined ( 'BASEPATH' ) or exit( 'No direct script access allowed' );
    
    require_once 'Base.php';
    
    class Shifts extends Base {
        
        /**
         * -----------------
         * constructor function for login controller
         * to load libraries, models, helpers etc
         * -----------------
         */
        
        public function __construct () {
            parent ::__construct ();
            $this -> load -> model ( 'ShiftModel' );
        }
        
        /**
         * -----------------
         * loads the all shifts page
         * -----------------
         */
        
        public function index () {
            $data[ 'title' ] = $title = 'All Shifts';
            dashboard_header ( $title );
            $data[ 'shifts' ] = $this -> ShiftModel -> get_shifts ();
            $this -> load -> view ( 'shifts/index', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * loads the add shifts form
         * -----------------
         */
        
        public function add () {
            $data[ 'title' ] = $title = 'Create New Shift';
            
            if ( isset( $_POST[ 'action' ] ) and $_POST[ 'action' ] == 'process-create-shifts' )
                $this -> process_create_shifts ();
            
            dashboard_header ( $title );
            $this -> load -> view ( 'shifts/add', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * process the form validation
         * creates new shifts
         * -----------------
         */
        
        private function process_create_shifts () {
            $this -> form_validation -> set_rules ( 'title', 'title', 'required|trim|is_unique[shifts.title]|xss_clean' );
            $this -> form_validation -> set_rules ( 'start-time', 'start time', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'end-time', 'end time', 'required|trim|xss_clean' );
            
            if ( $this -> form_validation -> run () ) {
                $title = $this -> input -> post ( 'title', true );
                $start_time = $this -> input -> post ( 'start-time', true );
                $end_time = $this -> input -> post ( 'end-time', true );
                
                $info = array (
                    'user_id'    => get_logged_in_user_id (),
                    'title'      => $title,
                    'start_time' => date ( 'H:i:s', strtotime ( $start_time ) ),
                    'end_time'   => date ( 'H:i:s', strtotime ( $end_time ) ),
                );
                
                $shift_id = $this -> ShiftModel -> add ( $info );
                if ( $shift_id > 0 ) {
                    $this -> session -> set_flashdata ( 'response', 'Shift has been created.' );
                    return redirect ( base_url ( '/shifts/add' ) );
                }
                else {
                    $this -> session -> set_flashdata ( 'error', 'Ops! Something happened. Please try again' );
                    return;
                }
                
            }
        }
        
        /**
         * -----------------
         * loads the edit shifts form
         * -----------------
         */
        
        public function edit () {
            $data[ 'title' ] = $title = 'Edit Shift';
            
            $id = validate_url_id ( 'shifts/index' );
            if ( isset( $_POST[ 'action' ] ) and $_POST[ 'action' ] == 'process-update-shifts' )
                $this -> process_update_shifts ();
            
            dashboard_header ( $title );
            $data[ 'shift' ] = $this -> ShiftModel -> get_shift_by_id ( $id );
            $this -> load -> view ( 'shifts/edit', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * process the form validation
         * update shifts
         * -----------------
         */
        
        private function process_update_shifts () {
            $this -> form_validation -> set_rules ( 'id', 'shift id', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'title', 'title', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'start-time', 'start time', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'end-time', 'end time', 'required|trim|xss_clean' );
            
            if ( $this -> form_validation -> run () ) {
                $id = $this -> input -> post ( 'id', true );
                $title = $this -> input -> post ( 'title', true );
                $start_time = $this -> input -> post ( 'start-time', true );
                $end_time = $this -> input -> post ( 'end-time', true );
                
                $info = array (
                    'user_id'    => get_logged_in_user_id (),
                    'title'      => $title,
                    'start_time' => date ( 'H:i:s', strtotime ( $start_time ) ),
                    'end_time'   => date ( 'H:i:s', strtotime ( $end_time ) ),
                );
                $where = array (
                    'id' => decrypt_string ( $id ),
                );
                
                $isUpdated = $this -> ShiftModel -> edit ( $info, $where );
                if ( $isUpdated ) {
                    $this -> session -> set_flashdata ( 'response', 'Shift has been updated.' );
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
         * delete shifts
         * -----------------
         */
        
        public function delete () {
            $id = validate_url_id ( 'shifts/index' );
            $this -> ShiftModel -> delete ( $id );
            $this -> session -> set_flashdata ( 'response', 'Shift has been deleted.' );
            return redirect ( base_url ( '/shifts/index' ) );
        }
        
    }