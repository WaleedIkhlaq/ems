<?php
    
    defined ( 'BASEPATH' ) or exit( 'No direct script access allowed' );
    
    require_once 'Base.php';
    
    class Employees extends Base {
        
        /**
         * -----------------
         * constructor function for login controller
         * to load libraries, models, helpers etc
         * -----------------
         */
        
        public function __construct () {
            parent ::__construct ();
            $this -> load -> model ( 'EmployeeModel' );
            $this -> load -> model ( 'CompanyModel' );
        }
        
        /**
         * -----------------
         * loads the all employees page
         * -----------------
         */
        
        public function index () {
            $data[ 'title' ] = $title = 'All Employees';
            dashboard_header ( $title );
            $data[ 'employees' ] = $this -> EmployeeModel -> get_employees ();
            $this -> load -> view ( 'employees/index', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * loads the add employees form
         * -----------------
         */
        
        public function add () {
            $data[ 'title' ] = $title = 'Create New Employee';
            
            if ( isset( $_POST[ 'action' ] ) and $_POST[ 'action' ] == 'process-create-employee' )
                $this -> process_create_employee ();
            
            dashboard_header ( $title );
            $data[ 'companies' ] = $this -> CompanyModel -> get_companies ();
            $this -> load -> view ( 'employees/add', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * process the form validation
         * creates new employees
         * -----------------
         */
        
        private function process_create_employee () {
            $this -> form_validation -> set_rules ( 'first-name', 'first name', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'last-name', 'last name', 'required|trim|xss_clean' );
            
            if ( $this -> form_validation -> run () ) {
                $first_name = $this -> input -> post ( 'first-name', true );
                $last_name = $this -> input -> post ( 'last-name', true );
                $email = $this -> input -> post ( 'email', true );
                $contact_no = $this -> input -> post ( 'contact-no', true );
                $address = $this -> input -> post ( 'address', true );
                
                $info = array (
                    'user_id'    => get_logged_in_user_id (),
                    'first_name' => $first_name,
                    'last_name'  => $last_name,
                    'email'      => $email,
                    'contact_no' => $contact_no,
                    'address'    => $address,
                );
                
                $employee_id = $this -> EmployeeModel -> add ( $info );
                if ( $employee_id > 0 ) {
                    $this -> addCompanies ( $employee_id );
                    $this -> session -> set_flashdata ( 'response', 'Employee has been created.' );
                    return redirect ( base_url ( '/employees/add' ) );
                }
                else {
                    $this -> session -> set_flashdata ( 'error', 'Ops! Something happened. Please try again' );
                    return;
                }
                
            }
        }
        
        /**
         * -----------------
         * @param $employee_id
         * add employee companies, shifts & salary
         * -----------------
         */
        
        public function addCompanies ( $employee_id ) {
            $companies = $this -> input -> post ( 'company-id', true );
            $shift = $this -> input -> post ( 'shift-id', true );
            $salary = $this -> input -> post ( 'salary', true );
            
            if ( isset( $companies ) and count ( $companies ) > 0 ) {
                foreach ( $companies as $key => $company_id ) {
                    if ( is_numeric ( $company_id ) and $company_id > 0 and isset( $shift[ $key ] ) and $shift[ $key ] > 0 ) {
                        $info = array (
                            'user_id'     => get_logged_in_user_id (),
                            'employee_id' => $employee_id,
                            'company_id'  => $company_id,
                            'shift_id'    => $shift[ $key ],
                            'salary'      => $salary[ $key ],
                        );
                        $this -> EmployeeModel -> addCompanies ( $info );
                    }
                }
            }
            
        }
        
        /**
         * -----------------
         * loads the edit employees form
         * -----------------
         */
        
        public function edit () {
            $data[ 'title' ] = $title = 'Edit Employee';
            
            $id = validate_url_id ( 'employees/index' );
            if ( isset( $_POST[ 'action' ] ) and $_POST[ 'action' ] == 'process-update-employees' )
                $this -> process_update_employees ();
            
            dashboard_header ( $title );
            $data[ 'employee' ] = $this -> EmployeeModel -> get_employee_by_id ( $id );
            $data[ 'companies' ] = $this -> EmployeeModel -> get_employee_companies ( $id );
            $this -> load -> view ( 'employees/edit', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * process the form validation
         * update employees
         * -----------------
         */
        
        private function process_update_employees () {
            $this -> form_validation -> set_rules ( 'id', 'employee id', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'first-name', 'first name', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'last-name', 'last name', 'required|trim|xss_clean' );
            
            if ( $this -> form_validation -> run () ) {
                $id = $this -> input -> post ( 'id', true );
                $first_name = $this -> input -> post ( 'first-name', true );
                $last_name = $this -> input -> post ( 'last-name', true );
                $email = $this -> input -> post ( 'email', true );
                $contact_no = $this -> input -> post ( 'contact-no', true );
                $address = $this -> input -> post ( 'address', true );
                
                $info = array (
                    'user_id'    => get_logged_in_user_id (),
                    'first_name' => $first_name,
                    'last_name'  => $last_name,
                    'email'      => $email,
                    'contact_no' => $contact_no,
                    'address'    => $address,
                );
                $where = array (
                    'id' => decrypt_string ( $id )
                );
                
                $this -> EmployeeModel -> edit ( $info, $where );
                $this -> EmployeeModel -> deleteCompanies ( decrypt_string ( $id ) );
                $this -> addCompanies ( decrypt_string ( $id ) );
                $this -> session -> set_flashdata ( 'response', 'Employee has been updated.' );
                return redirect ( $_SERVER[ 'HTTP_REFERER' ] );
                
            }
        }
        
        /**
         * -----------------
         * delete employees
         * -----------------
         */
        
        public function delete () {
            $id = validate_url_id ( 'employees/index' );
            $this -> EmployeeModel -> delete ( $id );
            $this -> session -> set_flashdata ( 'response', 'Employee has been deleted.' );
            return redirect ( base_url ( '/employees/index' ) );
        }
        
        /**
         * -----------------
         * get employees by shift & company id
         * via ajax request
         * -----------------
         */
        
        public function getEmployeesByShiftAndCompany () {
            $company_id = $this -> input -> get ( 'company_id', true );
            $shift_id = $this -> input -> get ( 'shift_id', true );
            
            if ( isset( $company_id ) and $company_id > 0 and isset( $shift_id ) and $shift_id > 0 ) {
                $data[ 'employees' ] = $this -> EmployeeModel -> get_employees_by_company_shift ( $company_id, $shift_id );
                $this -> load -> view ( 'employees/employees-company-shifts', $data );
            }
        }
        
    }