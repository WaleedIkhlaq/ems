<?php
    
    class CompanyModel extends CI_Model {
        
        /**
         * -----------------
         * @param $info
         * @return mixed
         * creates a new company into the database
         * -----------------
         */
        
        public function add ( $info ) {
            $this -> db -> insert ( 'companies', $info );
            return $this -> db -> insert_id ();
        }
        
        /**
         * -----------------
         * @param $info
         * @return mixed
         * assign shifts to company
         * -----------------
         */
        
        public function assignShiftToCompany ( $info ) {
            $this -> db -> insert ( 'company_shifts', $info );
            return $this -> db -> insert_id ();
        }
        
        /**
         * -----------------
         * @return mixed
         * gets all companies from the database
         * -----------------
         */
        
        public function get_companies () {
            $data = $this -> db -> get ( 'companies' );
            return $data -> result ();
        }
        
        /**
         * -----------------
         * get companies with shifts
         * -----------------
         */
        
        public function get_companies_with_shifts () {
            $sql = $this -> db -> query ( "SELECT ems_companies.*, GROUP_CONCAT(ems_company_shifts.shift_id) as shifts FROM ems_companies LEFT JOIN ems_company_shifts ON ems_companies.id=ems_company_shifts.company_id GROUP BY ems_company_shifts.company_id" );
            $data[ 'companies' ] = $companies = $sql -> result ();
            
            if ( count ( $companies ) > 0 ) {
                foreach ( $companies as $company ) {
                    $data[ 'shifts' ][ $company -> id ] = $this -> get_shifts ( $company -> shifts );
                }
            }
            
            return $data;
            
        }
        
        /**
         * -----------------
         * @param $shift_id
         * @return mixed
         * get shifts by company id
         * -----------------
         */
        
        public function get_shifts ( $shift_id ) {
            $data = $this -> db -> query ( "Select * from ems_shifts where id IN ($shift_id)" );
            return $data -> result ();
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * get company by id from the database
         * -----------------
         */
        
        public function get_company_by_id_with_shifts ( $id ) {
            $sql = $this -> db -> query ( "SELECT ems_companies.*, GROUP_CONCAT(ems_company_shifts.shift_id) as shifts FROM ems_companies LEFT JOIN ems_company_shifts ON ems_companies.id=ems_company_shifts.company_id where ems_companies.id=$id GROUP BY ems_company_shifts.company_id" );
            $data[ 'company' ] = $company = $sql -> row ();
            $data[ 'shifts' ] = $this -> get_shifts ( $company -> shifts );
            return $data;
        }
        
        /**
         * -----------------
         * @param $company_id
         * @return mixed
         * get unselected shifts
         * -----------------
         */
        
        public function get_unselected_shifts ( $company_id ) {
            $data = $this -> db -> query ( "Select * from ems_shifts where id NOT IN (Select shift_id from ems_company_shifts where company_id=$company_id)" );
            return $data -> result ();
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * get company by id from the database
         * -----------------
         */
        
        public function get_company_by_id ( $id ) {
            $data = $this -> db -> get_where ( 'companies', array ( 'id' => $id ) );
            return $data -> row ();
        }
        
        /**
         * -----------------
         * @param $info
         * @param $where
         * @return mixed
         * updates company into the database
         * -----------------
         */
        
        public function edit ( $info, $where ) {
            $this -> db -> update ( 'companies', $info, $where );
            return $this -> db -> affected_rows ();
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * delete company shifts from the database
         * -----------------
         */
        
        public function deleteShiftsAssociatedToCompany ( $id ) {
            $this -> db -> delete ( 'ems_company_shifts', array ( 'company_id' => $id ) );
            return $this -> db -> affected_rows ();
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * delete company from the database
         * -----------------
         */
        
        public function delete ( $id ) {
            $this -> db -> delete ( 'companies', array ( 'id' => $id ) );
            return $this -> db -> affected_rows ();
        }
        
    }