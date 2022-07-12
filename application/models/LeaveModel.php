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
         * @param $id
         * @return mixed
         * delete leave from the database
         * -----------------
         */
        
        public function delete ( $id ) {
            $this -> db -> delete ( 'leaves', array ( 'id' => $id ) );
            return $this -> db -> affected_rows ();
        }
        
    }