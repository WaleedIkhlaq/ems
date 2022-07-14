<?php
    
    class SalaryModel extends CI_Model {
        
        /**
         * -----------------
         * @param $info
         * @return mixed
         * creates a salary sheet into the database
         * -----------------
         */
        
        public function add ( $info ) {
            $this -> db -> insert ( 'salary_sheets', $info );
            return $this -> db -> insert_id ();
        }
        
        /**
         * -----------------
         * @param $info
         * @return mixed
         * add salaries into the database
         * -----------------
         */
        
        public function add_salaries ( $info ) {
            $this -> db -> insert ( 'salaries', $info );
            return $this -> db -> insert_id ();
        }
        
        /**
         * -----------------
         * @param $id
         * @return array
         * get salary sheet by id
         * -----------------
         */
        
        public function get_salary_sheet ( $id ) {
            $data = $this -> db -> get_where ( 'salary_sheets', array ( 'id' => $id ) );
            return $data -> row ();
        }
        
        /**
         * -----------------
         * @return array
         * get salary sheets
         * -----------------
         */
        
        public function get_salary_sheets () {
            $this -> db -> order_by ( 'id', 'DESC' );
            $data = $this -> db -> get ( 'salary_sheets' );
            return $data -> result ();
        }
        
        /**
         * -----------------
         * @param $salary_sheet_id
         * @return array
         * get salaries
         * -----------------
         */
        
        public function get_salaries ( $salary_sheet_id ) {
            $data = $this -> db -> get_where ( 'salaries', array ( 'salary_sheet_id' => $salary_sheet_id ) );
            return $data -> result ();
        }
        
        /**
         * -----------------
         * @return array
         * get employees for salary
         * -----------------
         */
        
        public function get_employees () {
            $company_id = $this -> input -> get ( 'company-id', true );
            $shift_id = $this -> input -> get ( 'shift-id', true );
            
            if ( isset( $company_id ) and !empty( trim ( $company_id ) ) and isset( $shift_id ) and !empty( trim ( $shift_id ) ) ) {
                
                $employees = $this -> db -> query ( "Select ems_employees.*, ems_employee_companies.salary as salary from ems_employee_companies INNER JOIN ems_employees ON ems_employee_companies.employee_id=ems_employees.id where ems_employee_companies.company_id=$company_id and ems_employee_companies.shift_id=$shift_id" );
                
                return $employees -> result ();
            }
            else
                return array ();
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * delete salaries from the database
         * -----------------
         */
        
        public function deleteSalaries ( $id ) {
            $this -> db -> delete ( 'salaries', array ( 'salary_sheet_id' => $id ) );
            return $this -> db -> affected_rows ();
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * delete salary sheet from the database
         * -----------------
         */
        
        public function delete ( $id ) {
            $this -> db -> delete ( 'salary_sheets', array ( 'id' => $id ) );
            return $this -> db -> affected_rows ();
        }
        
    }