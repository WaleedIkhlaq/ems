<?php
    
    class ShiftModel extends CI_Model {
        
        /**
         * -----------------
         * @param $info
         * @return mixed
         * creates a new shift into the database
         * -----------------
         */
        
        public function add ( $info ) {
            $this -> db -> insert ( 'shifts', $info );
            return $this -> db -> insert_id ();
        }
        
        /**
         * -----------------
         * @return mixed
         * gets all shifts from the database
         * -----------------
         */
        
        public function get_shifts () {
            $data = $this -> db -> get ( 'shifts' );
            return $data -> result ();
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * get shift by id from the database
         * -----------------
         */
        
        public function get_shift_by_id ( $id ) {
            $data = $this -> db -> get_where ( 'shifts', array ( 'id' => $id ) );
            return $data -> row ();
        }
        
        /**
         * -----------------
         * @param $info
         * @param $where
         * @return mixed
         * updates shift into the database
         * -----------------
         */
        
        public function edit ( $info, $where ) {
            $this -> db -> update ( 'shifts', $info, $where );
            return $this -> db -> affected_rows ();
        }
        
        /**
         * -----------------
         * @param $id
         * @return mixed
         * delete shift from the database
         * -----------------
         */
        
        public function delete ( $id ) {
            $this -> db -> delete ( 'shifts', array ( 'id' => $id ) );
            return $this -> db -> affected_rows ();
        }
        
    }