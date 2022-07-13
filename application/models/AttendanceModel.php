<?php
    
    class AttendanceModel extends CI_Model {
        
        /**
         * -----------------
         * @param $info
         * @return mixed
         * add attendances into the database
         * -----------------
         */
        
        public function add ( $info ) {
            $this -> db -> insert ( 'attendances', $info );
            return $this -> db -> insert_id ();
        }
        
        /**
         * -----------------
         * @param $info
         * @return mixed
         * mark attendance into the database
         * -----------------
         */
        
        public function mark_attendance ( $info ) {
            $this -> db -> insert ( 'attendance', $info );
            return $this -> db -> insert_id ();
        }
        
        /**
         * -----------------
         * @param $info
         * @param $where
         * @return mixed
         * updates attendance into the database
         * -----------------
         */
        
        public function update_attendance ( $info, $where ) {
            $this -> db -> update ( 'attendance', $info, $where );
            return $this -> db -> affected_rows ();
        }
        
        /**
         * -----------------
         * @return mixed
         * gets attendances
         * applies filter
         * -----------------
         */
        
        public function get_attendances () {
            $company_id = $this -> input -> get ( 'company-id', true );
            $shift_id = $this -> input -> get ( 'shift-id', true );
            $attendance_date = $this -> input -> get ( 'attendance-date', true );
            
            $sql = "Select * from ems_attendances where 1";
            
            if ( isset( $company_id ) and !empty( trim ( $company_id ) ) and is_numeric ( $company_id ) and $company_id > 0 ) {
                $sql .= " and company_id=$company_id";
            }
            
            if ( isset( $shift_id ) and !empty( trim ( $shift_id ) ) and is_numeric ( $shift_id ) and $shift_id > 0 ) {
                $sql .= " and shift_id=$shift_id";
            }
            
            if ( isset( $attendance_date ) and !empty( trim ( $attendance_date ) ) and is_valid_date ( $attendance_date ) ) {
                $attendance_date = date ( 'Y-m-d', strtotime ( $attendance_date ) );
                $sql .= " and DATE(attendance_date)='$attendance_date'";
            }
            
            $sql .= " order by attendance_date DESC";
            $data = $this -> db -> query ( $sql );
            return $data -> result ();
        }
        
        /**
         * -----------------
         * @param $attendance_id
         * @return mixed
         * count attendance based on status
         * -----------------
         */
        
        public function get_attendance_statues ( $attendance_id, $status ) {
            $data = $this -> db -> query ( "SELECT COUNT(*) as noOfRows FROM `ems_attendance` where attendance_id=$attendance_id and status='$status'" );
            return $data -> row () -> noOfRows;
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * get attendances by id
         * return only id
         * -----------------
         */
        
        public function get_attendances_by_id ( $id ) {
            $data = $this -> db -> get_where ( 'attendances', array ( 'id' => $id ) );
            return $data -> row ();
        }
        
        /**
         * -----------------
         * @param $attendance_id
         * @return mixed
         * get attendance by attendance_id
         * -----------------
         */
        
        public function get_attendance_by_attendance_id ( $attendance_id ) {
            $data = $this -> db -> get_where ( 'attendance', array ( 'attendance_id' => $attendance_id ) );
            return $data -> result ();
        }
        
    }