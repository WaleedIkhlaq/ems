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
            $this -> load -> model ( 'EmployeeModel' );
            $this -> load -> model ( 'CompanyModel' );
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
                    'user_id' => get_logged_in_user_id (),
                    'title'   => $title,
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
                    'user_id' => get_logged_in_user_id (),
                    'title'   => $title,
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
        
        /**
         * -----------------
         * loads the all assigned leaves page
         * -----------------
         */
        
        public function assigned () {
            $data[ 'title' ] = $title = 'All Assigned Leaves';
            dashboard_header ( $title );
            $data[ 'leaves' ] = $this -> LeaveModel -> get_assigned_leaves ();
            $this -> load -> view ( 'leaves/assigned', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * loads the assign leaves form
         * -----------------
         */
        
        public function assign () {
            $data[ 'title' ] = $title = 'Assign New Leave';
            
            if ( isset( $_POST[ 'action' ] ) and $_POST[ 'action' ] == 'process-assign-leaves' )
                $this -> process_assign_leaves ();
            
            dashboard_header ( $title );
            $data[ 'companies' ] = $this -> CompanyModel -> get_companies ();
            $this -> load -> view ( 'leaves/assign', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * process the form validation
         * assign new leaves
         * -----------------
         */
        
        private function process_assign_leaves () {
            $this -> form_validation -> set_rules ( 'company-id', 'company', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'shift-id', 'shift', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'employee-id', 'employee', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'start-date', 'start date', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'end-date', 'end date', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'approved', 'approved', 'required|trim|xss_clean' );
            
            if ( $this -> form_validation -> run () ) {
                $company_id = $this -> input -> post ( 'company-id', true );
                $shift_id = $this -> input -> post ( 'shift-id', true );
                $employee_id = $this -> input -> post ( 'employee-id', true );
                $start_date = $this -> input -> post ( 'start-date', true );
                $end_date = $this -> input -> post ( 'end-date', true );
                $approved = $this -> input -> post ( 'approved', true );
                $description = $this -> input -> post ( 'description', true );
                
                $info = array (
                    'user_id'     => get_logged_in_user_id (),
                    'employee_id' => $employee_id,
                    'company_id'  => $company_id,
                    'shift_id'    => $shift_id,
                    'start_date'  => date ( 'Y-m-d', strtotime ( $start_date ) ),
                    'end_date'    => date ( 'Y-m-d', strtotime ( $end_date ) ),
                    'description' => $description,
                    'approved'    => $approved,
                );
                
                $leave_id = $this -> LeaveModel -> assign ( $info );
                if ( $leave_id > 0 ) {
                    $this -> session -> set_flashdata ( 'response', 'Leave has been assigned.' );
                    return redirect ( base_url ( '/leaves/assign' ) );
                }
                else {
                    $this -> session -> set_flashdata ( 'error', 'Ops! Something happened. Please try again' );
                    return;
                }
                
            }
        }
        
        /**
         * -----------------
         * loads the edit assign leaves form
         * -----------------
         */
        
        public function edit_assigned () {
            
            $id = validate_url_id ( '/leaves/assigned' );
            
            $data[ 'title' ] = $title = 'Edit Assigned Leave';
            
            if ( isset( $_POST[ 'action' ] ) and $_POST[ 'action' ] == 'process-edit-assigned-leave' )
                $this -> process_edit_assigned_leave ();
            
            dashboard_header ( $title );
            $data[ 'leave' ] = $this -> LeaveModel -> get_assigned_leave_by_id ( $id );
            $data[ 'company' ] = get_company_by_id ( $data[ 'leave' ] -> company_id );
            $data[ 'shift' ] = get_company_by_id ( $data[ 'leave' ] -> shift_id );
            $data[ 'employee' ] = get_employee_by_id ( $data[ 'leave' ] -> employee_id );
            $this -> load -> view ( 'leaves/edit-assigned', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * process the form validation
         * edit assigned leaves
         * -----------------
         */
        
        private function process_edit_assigned_leave () {
            $this -> form_validation -> set_rules ( 'leave-id', 'leave', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'start-date', 'start date', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'end-date', 'end date', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'approved', 'approved', 'required|trim|xss_clean' );
            
            if ( $this -> form_validation -> run () ) {
                $leave_id = $this -> input -> post ( 'leave-id', true );
                $start_date = $this -> input -> post ( 'start-date', true );
                $end_date = $this -> input -> post ( 'end-date', true );
                $approved = $this -> input -> post ( 'approved', true );
                $description = $this -> input -> post ( 'description', true );
                
                $info = array (
                    'user_id'     => get_logged_in_user_id (),
                    'start_date'  => date ( 'Y-m-d', strtotime ( $start_date ) ),
                    'end_date'    => date ( 'Y-m-d', strtotime ( $end_date ) ),
                    'description' => $description,
                    'approved'    => $approved,
                );
                
                $where = array (
                    'id' => decrypt_string ( $leave_id ),
                );
                
                $this -> LeaveModel -> edit_assigned_leave ( $info, $where );
                
                $this -> session -> set_flashdata ( 'response', 'Leave has been updated.' );
                return redirect ( $_SERVER[ 'HTTP_REFERER' ] );
                
            }
        }
    
        /**
         * -----------------
         * delete assigned leaves
         * -----------------
         */
    
        public function delete_assigned_leave () {
            $id = validate_url_id ( 'leaves/assigned' );
            $this -> LeaveModel -> delete_assigned_leave ( $id );
            $this -> session -> set_flashdata ( 'response', 'Assigned Leave has been deleted.' );
            return redirect ( base_url ( '/leaves/assigned' ) );
        }
        
    }