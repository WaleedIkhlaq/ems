<?php
    
    defined ( 'BASEPATH' ) or exit( 'No direct script access allowed' );
    
    require_once 'Base.php';
    
    class Salaries extends Base {
        
        /**
         * -----------------
         * constructor function for login controller
         * to load libraries, models, helpers etc
         * -----------------
         */
        
        public function __construct () {
            parent ::__construct ();
            $this -> load -> model ( 'SalaryModel' );
            $this -> load -> model ( 'ShiftModel' );
            $this -> load -> model ( 'CompanyModel' );
        }
        
        /**
         * -----------------
         * loads the all salaries page
         * -----------------
         */
        
        public function index () {
            $data[ 'title' ] = $title = 'All Salary Sheets';
            dashboard_header ( $title );
            $data[ 'salaries' ] = $this -> SalaryModel -> get_salary_sheets ();
            $this -> load -> view ( 'salaries/index', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * loads the add salaries form
         * -----------------
         */
        
        public function add () {
            $data[ 'title' ] = $title = 'Add Salary Sheet';
            $company_id = $this -> input -> get ( 'company-id', true );
            $shift_id = $this -> input -> get ( 'shift-id', true );
            
            if ( isset( $_POST[ 'action' ] ) and $_POST[ 'action' ] == 'process-add-salary-sheet' )
                $this -> process_add_salary_sheet ();
            
            dashboard_header ( $title );
            $data[ 'companies' ] = $this -> CompanyModel -> get_companies ();
            $data[ 'employees' ] = $this -> SalaryModel -> get_employees ();
            
            if ( isset( $company_id ) and $company_id > 0 )
                $data[ 'shifts' ] = $this -> ShiftModel -> get_shifts_by_company ( $company_id );
            else
                $data[ 'shifts' ] = array ();
            
            if ( !empty( trim ( $shift_id ) ) and $shift_id > 0 )
                $data[ 'shiftInfo' ] = get_shift_by_id ( $shift_id );
            else
                $data[ 'shiftInfo' ] = '';
            
            $this -> load -> view ( 'salaries/add', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * process the form validation
         * creates new salaries
         * -----------------
         */
        
        private function process_add_salary_sheet () {
            $this -> form_validation -> set_rules ( 'company-id', 'company', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'shift-id', 'shift', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'salary-date', 'salary date', 'required|trim|xss_clean' );
            
            if ( $this -> form_validation -> run () ) {
                $company_id = $this -> input -> post ( 'company-id', true );
                $shift_id = $this -> input -> post ( 'shift-id', true );
                $salary_date = $this -> input -> post ( 'salary-date', true );
                
                $info = array (
                    'user_id'     => get_logged_in_user_id (),
                    'company_id'  => $company_id,
                    'shift_id'    => $shift_id,
                    'salary_date' => date ( 'Y-m-d', strtotime ( $salary_date ) ),
                );
                
                $salary_sheet_id = $this -> SalaryModel -> add ( $info );
                if ( $salary_sheet_id > 0 ) {
                    $this -> addSalaries ( $salary_sheet_id );
                    $this -> session -> set_flashdata ( 'response', 'Salary sheet has been created.' );
                    return redirect ( base_url ( '/salaries/index' ) );
                }
                else {
                    $this -> session -> set_flashdata ( 'error', 'Ops! Something happened. Please try again' );
                    return;
                }
                
            }
        }
        
        /**
         * -----------------
         * @param $salary_sheet_id
         * add salaries
         * -----------------
         */
        
        public function addSalaries ( $salary_sheet_id ) {
            $employees = $this -> input -> post ( 'employee-id', true );
            $net_salary = $this -> input -> post ( 'net-salary', true );
            $total_hours = $this -> input -> post ( 'total-hours', true );
            $days_present = $this -> input -> post ( 'days-present', true );
            $days_absent = $this -> input -> post ( 'days-absent', true );
            $days_leave = $this -> input -> post ( 'days-leave', true );
            $late_arrivals = $this -> input -> post ( 'late-arrivals', true );
            $late_arrival_hours = $this -> input -> post ( 'late-arrival-hours', true );
            $hours_worked = $this -> input -> post ( 'hours-worked', true );
            $gross_salary = $this -> input -> post ( 'gross-salary', true );
            
            if ( isset( $employees ) and count ( $employees ) > 0 ) {
                foreach ( $employees as $key => $employee_id ) {
                    $info = array (
                        'salary_sheet_id'    => $salary_sheet_id,
                        'employee_id'        => $employee_id,
                        'net_salary'         => $net_salary[ $key ],
                        'total_hours'        => $total_hours[ $key ],
                        'days_present'       => $days_present[ $key ],
                        'days_absent'        => $days_absent[ $key ],
                        'days_leave'         => $days_leave[ $key ],
                        'late_arrivals'      => $late_arrivals[ $key ],
                        'late_arrival_hours' => $late_arrival_hours[ $key ],
                        'hours_worked'       => $hours_worked[ $key ],
                        'gross_salary'       => $gross_salary[ $key ],
                    );
                    $this -> SalaryModel -> add_salaries ( $info );
                }
            }
            
        }
        
        /**
         * -----------------
         * loads the edit salary sheet form
         * -----------------
         */
        
        public function edit () {
            $data[ 'title' ] = $title = 'Edit Salary Sheet';
            
            $id = validate_url_id ( 'salaries/index' );
            if ( isset( $_POST[ 'action' ] ) and $_POST[ 'action' ] == 'process-update-salaries' )
                $this -> process_update_salaries ();
            
            dashboard_header ( $title );
            $data[ 'salary_sheet' ] = $this -> SalaryModel -> get_salary_sheet ( $id );
            $data[ 'salaries' ] = $this -> SalaryModel -> get_salaries ( $id );
            $this -> load -> view ( 'salaries/edit', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * process the form validation
         * update salaries
         * -----------------
         */
        
        private function process_update_salaries () {
            $this -> form_validation -> set_rules ( 'salary-sheet-id', 'salary sheet id', 'required|numeric|trim|xss_clean' );
            
            if ( $this -> form_validation -> run () ) {
                $salary_sheet_id = $this -> input -> post ( 'salary-sheet-id', true );
                
                $this -> SalaryModel -> deleteSalaries ( $salary_sheet_id );
                $this -> addSalaries ( $salary_sheet_id );
                $this -> session -> set_flashdata ( 'response', 'Salary sheet has been updated.' );
                return redirect ( $_SERVER[ 'HTTP_REFERER' ] );
            }
        }
        
        /**
         * -----------------
         * delete salaries
         * -----------------
         */
        
        public function delete () {
            $id = validate_url_id ( 'salaries/index' );
            $this -> SalaryModel -> delete ( $id );
            $this -> session -> set_flashdata ( 'response', 'Salary sheet has been deleted.' );
            return redirect ( base_url ( '/salaries/index' ) );
        }
        
    }