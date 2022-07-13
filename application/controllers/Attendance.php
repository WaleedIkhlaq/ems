<?php
    
    defined ( 'BASEPATH' ) or exit( 'No direct script access allowed' );
    
    require_once 'Base.php';
    
    class Attendance extends Base {
        
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
            $this -> load -> model ( 'ShiftModel' );
            $this -> load -> model ( 'AttendanceModel' );
        }
        
        /**
         * -----------------
         * show all attendances page
         * loads attendance by company & shift wise
         * performs edit & delete methods
         * also searches the attendance
         * -----------------
         */
        
        public function index () {
            $data[ 'title' ] = $title = 'All Attendances';
            dashboard_header ( $title );
            
            $company_id = $this -> input -> get ( 'company-id', true );
            if ( isset( $company_id ) and $company_id > 0 )
                $data[ 'shifts' ] = $this -> ShiftModel -> get_shifts_by_company ( $company_id );
            else
                $data[ 'shifts' ] = array ();
            
            $data[ 'companies' ] = $this -> CompanyModel -> get_companies ();
            $data[ 'attendances' ] = $this -> AttendanceModel -> get_attendances ();
            $this -> load -> view ( 'attendance/index', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * show mark attendance form
         * loads data using search results
         * show selected companies and shifts
         * process the form request
         * -----------------
         */
        
        public function mark () {
            $data[ 'title' ] = $title = 'Mark Attendance';
            $company_id = $this -> input -> get ( 'company-id', true );
            
            if ( isset( $_POST[ 'action' ] ) and $_POST[ 'action' ] == 'process-mark-attendance' )
                $this -> process_mark_attendance ();
            
            dashboard_header ( $title );
            $data[ 'companies' ] = $this -> CompanyModel -> get_companies ();
            
            if ( isset( $company_id ) and $company_id > 0 )
                $data[ 'shifts' ] = $this -> ShiftModel -> get_shifts_by_company ( $company_id );
            else
                $data[ 'shifts' ] = array ();
            
            $data[ 'employees' ] = $this -> EmployeeModel -> get_employees_for_attendance ();
            $this -> load -> view ( 'attendance/add', $data );
            dashboard_footer ();
        }
        
        /**
         * -----------------
         * process the attendance
         * marks the users as 0/1
         * 0=absent
         * 1=present
         * -----------------
         */
        
        private function process_mark_attendance () {
            $this -> form_validation -> set_rules ( 'company-id', 'company', 'required|trim|is_numeric|xss_clean' );
            $this -> form_validation -> set_rules ( 'shift-id', 'shift', 'required|trim|is_numeric|xss_clean' );
            
            if ( $this -> form_validation -> run () ) {
                $company_id = $this -> input -> post ( 'company-id', true );
                $shift_id = $this -> input -> post ( 'shift-id', true );
                $employees = $this -> input -> post ( 'employee-id', true );
                $status = $this -> input -> post ( 'status', true );
                $remarks = $this -> input -> post ( 'remarks', true );
                $late_hours = $this -> input -> post ( 'late-hours', true );
                
                if ( isset( $employees ) and count ( $employees ) > 0 ) {
                    
                    $attendances = array (
                        'user_id'         => get_logged_in_user_id (),
                        'company_id'      => $company_id,
                        'shift_id'        => $shift_id,
                        'attendance_date' => date ( 'Y-m-d H:i:s' ),
                    );
                    $attendance_id = $this -> AttendanceModel -> add ( $attendances );
                    
                    if ( $attendance_id > 0 ) {
                        foreach ( $employees as $employee_id ) {
                            if ( is_numeric ( $employee_id ) and $employee_id > 0 ) {
                                $info = array (
                                    'attendance_id' => $attendance_id,
                                    'employee_id'   => $employee_id,
                                    'status'        => $status[ $employee_id ],
                                    'remarks'       => $remarks[ $employee_id ],
                                    'late_hours'    => $status[ $employee_id ] == LATE_ARRIVAL_STATUS ? $late_hours[ $employee_id ] : '0',
                                );
                                $this -> AttendanceModel -> mark_attendance ( $info );
                            }
                        }
                    }
                    
                    $this -> session -> set_flashdata ( 'response', 'Attendance has been marked.' );
                    return redirect ( base_url ( '/attendance/index' ) );
                }
            }
        }
        
        /**
         * -----------------
         * loads the edit attendance form
         * -----------------
         */
        
        public function edit () {
            $data[ 'title' ] = $title = 'Edit Attendance';
            
            $id = validate_url_id ( 'attendances/index' );
            if ( isset( $_POST[ 'action' ] ) and $_POST[ 'action' ] == 'process-update-attendance' )
                $this -> process_update_attendance ();
            
            dashboard_header ( $title );
            $data[ 'attendances' ] = $this -> AttendanceModel -> get_attendances_by_id ( $id );
            $data[ 'attendance' ] = $this -> AttendanceModel -> get_attendance_by_attendance_id ( $id );
            $this -> load -> view ( 'attendance/edit', $data );
            dashboard_footer ();
        }
        
        private function process_update_attendance () {
            $this -> form_validation -> set_rules ( 'attendances-id', 'attendance id', 'required|trim|xss_clean' );
            
            if ( $this -> form_validation -> run () ) {
                $attendances = $this -> input -> post ( 'attendance-id', true );
                $status = $this -> input -> post ( 'status', true );
                $remarks = $this -> input -> post ( 'remarks', true );
                $late_hours = $this -> input -> post ( 'late-hours', true );
                
                if ( isset( $attendances ) and count ( $attendances ) > 0 ) {
                    foreach ( $attendances as $attendance_id ) {
                        if ( is_numeric ( $attendance_id ) and $attendance_id > 0 ) {
                            
                            $info = array (
                                'status'     => $status[ $attendance_id ],
                                'remarks'    => $remarks[ $attendance_id ],
                                'late_hours' => $status[ $attendance_id ] == LATE_ARRIVAL_STATUS ? $late_hours[ $attendance_id ] : '0',
                            );
                            
                            $where = array (
                                'id' => $attendance_id,
                            );
                            $this -> AttendanceModel -> update_attendance ( $info, $where );
                        }
                    }
                    
                    $this -> session -> set_flashdata ( 'response', 'Attendance has been updated.' );
                    return redirect ( $_SERVER[ 'HTTP_REFERER' ] );
                }
            }
        }
        
    }