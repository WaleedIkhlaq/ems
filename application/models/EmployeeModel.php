<?php
    
    class EmployeeModel extends CI_Model {
        
        /**
         * -----------------
         * @param $info
         * @return mixed
         * creates a new employee into the database
         * -----------------
         */
        
        public function add ( $info ) {
            $this -> db -> insert ( 'employees', $info );
            return $this -> db -> insert_id ();
        }
        
        /**
         * -----------------
         * @param $info
         * @return mixed
         * assign employee companies, shifts & salary into the database
         * -----------------
         */
        
        public function addCompanies ( $info ) {
            $this -> db -> insert ( 'employee_companies', $info );
            return $this -> db -> insert_id ();
        }
        
        /**
         * -----------------
         * @return mixed
         * gets all employees from the database
         * -----------------
         */
        
        public function get_employees () {
            $data = $this -> db -> get ( 'employees' );
            return $data -> result ();
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * get employee companies from the database
         * -----------------
         */
        
        public function get_employee_companies ( $id ) {
            $data = $this -> db -> get_where ( 'employee_companies', array ( 'employee_id' => $id ) );
            return $data -> result ();
        }
    
        /**
         * -----------------
         * @return array
         * get employees for attendance
         * -----------------
         */
        
        public function get_employees_for_attendance () {
            $company_id = $this -> input -> get ( 'company-id', true );
            $shift_id = $this -> input -> get ( 'shift-id', true );
            
            if ( isset( $company_id ) and !empty( trim ( $company_id ) ) and isset( $shift_id ) and !empty( trim ( $shift_id ) ) ) {
                $employees = $this -> db -> query ( "Select ems_employees.* from ems_employee_companies INNER JOIN ems_employees ON ems_employee_companies.employee_id=ems_employees.id where ems_employee_companies.company_id=$company_id and ems_employee_companies.shift_id=$shift_id" );
                return $employees -> result ();
            }
            else
                return array ();
            
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * get employee by id from the database
         * -----------------
         */
        
        public function get_employee_by_id ( $id ) {
            $data = $this -> db -> get_where ( 'employees', array ( 'id' => $id ) );
            return $data -> row ();
        }
        
        /**
         * -----------------
         * @param $info
         * @param $where
         * @return mixed
         * updates employee into the database
         * -----------------
         */
        
        public function edit ( $info, $where ) {
            $this -> db -> update ( 'employees', $info, $where );
            return $this -> db -> affected_rows ();
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * delete employee companies from the database
         * -----------------
         */
        
        public function deleteCompanies ( $id ) {
            $this -> db -> delete ( 'employee_companies', array ( 'employee_id' => $id ) );
            return $this -> db -> affected_rows ();
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * delete employee from the database
         * -----------------
         */
        
        public function delete ( $id ) {
            $this -> db -> delete ( 'employees', array ( 'id' => $id ) );
            return $this -> db -> affected_rows ();
        }
        
    }