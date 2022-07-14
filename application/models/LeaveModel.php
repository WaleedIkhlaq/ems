<?php
    
    class LeaveModel extends CI_Model {
        
        /**
         * -----------------
         * @param $info
         * @return mixed
         * creates a new leave into the database
         * -----------------
         */
        
        public function add ( $info ) {
            $this -> db -> insert ( 'leaves', $info );
            return $this -> db -> insert_id ();
        }
        
        /**
         * -----------------
         * @param $info
         * @return mixed
         * assign a new leave into the database
         * -----------------
         */
        
        public function assign ( $info ) {
            $this -> db -> insert ( 'employee_leaves', $info );
            return $this -> db -> insert_id ();
        }
        
        /**
         * -----------------
         * @return mixed
         * gets all leaves from the database
         * -----------------
         */
        
        public function get_leaves () {
            $data = $this -> db -> get ( 'leaves' );
            return $data -> result ();
        }
        
        /**
         * -----------------
         * @return mixed
         * gets all assigned leaves from the database
         * -----------------
         */
        
        public function get_assigned_leaves () {
            $data = $this -> db -> get ( 'employee_leaves' );
            return $data -> result ();
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * get leave by id from the database
         * -----------------
         */
        
        public function get_leave_by_id ( $id ) {
            $data = $this -> db -> get_where ( 'leaves', array ( 'id' => $id ) );
            return $data -> row ();
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * get assigned leave by id from the database
         * -----------------
         */
        
        public function get_assigned_leave_by_id ( $id ) {
            $data = $this -> db -> get_where ( 'employee_leaves', array ( 'id' => $id ) );
            return $data -> row ();
        }
        
        /**
         * -----------------
         * @param $info
         * @param $where
         * @return mixed
         * updates leave into the database
         * -----------------
         */
        
        public function edit ( $info, $where ) {
            $this -> db -> update ( 'leaves', $info, $where );
            return $this -> db -> affected_rows ();
        }
        
        /**
         * -----------------
         * @param $info
         * @param $where
         * @return mixed
         * updates assigned leave into the database
         * -----------------
         */
        
        public function edit_assigned_leave ( $info, $where ) {
            $this -> db -> update ( 'employee_leaves', $info, $where );
            return $this -> db -> affected_rows ();
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * delete leave from the database
         * -----------------
         */
        
        public function delete ( $id ) {
            $this -> db -> delete ( 'leaves', array ( 'id' => $id ) );
            return $this -> db -> affected_rows ();
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * delete assigned leave from the database
         * -----------------
         */
        
        public function delete_assigned_leave ( $id ) {
            $this -> db -> delete ( 'employee_leaves', array ( 'id' => $id ) );
            return $this -> db -> affected_rows ();
        }
    
        /**
         * ------------
         * @param $employee_id
         * @param $company_id
         * @param $shift_id
         * is employee on leave
         * ------------
         */
        
        public function is_employee_on_leave ( $employee_id, $company_id, $shift_id ) {
            $date = date ( 'Y-m-d' );
            
            $data = $this -> db -> query ( "Select * from ems_employee_leaves where employee_id=$employee_id and company_id=$company_id and shift_id=$shift_id and ('{$date}' between DATE(start_date) and DATE(end_date))" );
            return $data -> row ();
        }
        
    }