<?php
    
    defined ( 'BASEPATH' ) or exit( 'No direct script access allowed' );
    
    require_once 'Base.php';
    
    class Companies extends Base {
        
        /**
         * -----------------
         * constructor function for login controller
         * to load libraries, models, helpers etc
         * -----------------
         */
        
        public function __construct () {
            parent ::__construct ();
            $this -> load -> model ( 'CompanyModel' );
            $this -> load -> model ( 'ShiftModel' );
        }
        
        /**
         * -----------------
         * loads the all companies page
         * -----------------
         */
        
        public function index () {
            $data[ 'title' ] = $title = 'All Companies';
            dashboard_header ( $title );
            $data = $this -> CompanyModel -> get_companies_with_shifts ();
            $this -> load -> view ( 'companies/index', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * loads the add companies form
         * -----------------
         */
        
        public function add () {
            $data[ 'title' ] = $title = 'Create New Company';
            
            if ( isset( $_POST[ 'action' ] ) and $_POST[ 'action' ] == 'process-create-companies' )
                $this -> process_create_companies ();
            
            dashboard_header ( $title );
            $data[ 'shifts' ] = $this -> ShiftModel -> get_shifts ();
            $this -> load -> view ( 'companies/add', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * process the form validation
         * creates new companies
         * -----------------
         */
        
        private function process_create_companies () {
            $this -> form_validation -> set_rules ( 'title', 'title', 'required|trim|is_unique[companies.title]|xss_clean' );
            
            if ( $this -> form_validation -> run () ) {
                $title = $this -> input -> post ( 'title', true );
                
                $info = array (
                    'user_id' => get_logged_in_user_id (),
                    'title'   => $title,
                );
                
                $company_id = $this -> CompanyModel -> add ( $info );
                if ( $company_id > 0 ) {
                    $this -> assignShiftToCompany ( $company_id );
                    
                    $this -> session -> set_flashdata ( 'response', 'Company has been created.' );
                    return redirect ( base_url ( '/companies/add' ) );
                }
                else {
                    $this -> session -> set_flashdata ( 'error', 'Ops! Something happened. Please try again' );
                    return;
                }
                
            }
        }
        
        /**
         * -----------------
         * @param $company_id
         * assign shifts to company
         * -----------------
         */
        
        private function assignShiftToCompany ( $company_id ) {
            $shifts = $this -> input -> post ( 'shift-id', true );
            if ( count ( $shifts ) > 0 ) {
                foreach ( $shifts as $shift_id ) {
                    if ( is_numeric ( $shift_id ) and $shift_id > 0 ) {
                        $info = array (
                            'user_id'    => get_logged_in_user_id (),
                            'company_id' => $company_id,
                            'shift_id'   => $shift_id,
                        );
                        
                        $this -> CompanyModel -> assignShiftToCompany ( $info );
                    }
                }
            }
        }
        
        /**
         * -----------------
         * loads the edit companies form
         * -----------------
         */
        
        public function edit () {
            $data[ 'title' ] = $title = 'Edit Company';
            
            $id = validate_url_id ( 'companies/index' );
            if ( isset( $_POST[ 'action' ] ) and $_POST[ 'action' ] == 'process-update-companies' )
                $this -> process_update_companies ();
            
            dashboard_header ( $title );
            $data = $this -> CompanyModel -> get_company_by_id_with_shifts ( $id );
            $data[ 'unSelectedShifts' ] = $this -> CompanyModel -> get_unselected_shifts ( $id );
            $this -> load -> view ( 'companies/edit', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * process the form validation
         * update companies
         * -----------------
         */
        
        private function process_update_companies () {
            $this -> form_validation -> set_rules ( 'id', 'id', 'required|trim|xss_clean' );
            $this -> form_validation -> set_rules ( 'title', 'title', 'required|trim|xss_clean' );
            
            if ( $this -> form_validation -> run () ) {
                $title = $this -> input -> post ( 'title', true );
                $id = $this -> input -> post ( 'id', true );
                
                $info = array (
                    'user_id' => get_logged_in_user_id (),
                    'title'   => $title,
                );
                $where = array (
                    'id' => decrypt_string ( $id )
                );
                
                $this -> CompanyModel -> edit ( $info, $where );
                
                $this -> CompanyModel -> deleteShiftsAssociatedToCompany ( decrypt_string ( $id ) );
                $this -> assignShiftToCompany ( decrypt_string ( $id ) );
                $this -> session -> set_flashdata ( 'response', 'Company has been updated.' );
                return redirect ( $_SERVER[ 'HTTP_REFERER' ] );
                
            }
        }
        
        /**
         * -----------------
         * delete companies
         * -----------------
         */
        
        public function delete () {
            $id = validate_url_id ( 'companies/index' );
            $this -> CompanyModel -> delete ( $id );
            $this -> session -> set_flashdata ( 'response', 'Company has been deleted.' );
            return redirect ( base_url ( '/companies/index' ) );
        }
        
        /**
         * -----------------
         * get shifts by company id
         * via ajax request
         * -----------------
         */
        
        public function getCompanyShifts () {
            $company_id = $this -> input -> get ( 'company_id', true );
            
            if ( isset( $company_id ) and $company_id > 0 ) {
                $data[ 'shifts' ] = $this -> ShiftModel -> get_shifts_by_company ( $company_id );
                $this -> load -> view ( 'shifts/company-shifts', $data );
            }
        }
        
        /**
         * -----------------
         * add more companies row
         * via ajax request
         * -----------------
         */
        
        public function addMoreCompanies () {
            $data[ 'row' ] = $this -> input -> get ( 'row', true );
            $data[ 'companies' ] = $this -> CompanyModel -> get_companies ();
            $this -> load -> view ( 'companies/add-more-companies', $data );
        }
        
    }