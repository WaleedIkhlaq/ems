<?php
    
    /**
     * -----------------
     * @param $string
     * converts string into readable array
     * -----------------
     */
    
    function print_data ( $string ) {
        echo '<pre>';
        print_r ( $string );
        echo '</pre>';
    }
    
    /**
     * -----------------
     * @param $title
     * loads the header file for login
     * -----------------
     */
    
    function login_header ( $title ) {
        $data[ 'title' ] = $title;
        $ci = &get_instance ();
        $ci -> load -> view ( 'includes/login/header', $data );
    }
    
    /**
     * -----------------
     * loads the footer file for login
     * -----------------
     */
    
    function login_footer () {
        $ci = &get_instance ();
        $ci -> load -> view ( 'includes/login/footer' );
    }
    
    /**
     * -----------------
     * @param $title
     * loads the header file for dashboard
     * -----------------
     */
    
    function dashboard_header ( $title ) {
        $data[ 'title' ] = $title;
        $ci = &get_instance ();
        $data[ 'parent_uri' ] = $ci -> uri -> segment ( 1 );
        $data[ 'child_uri' ] = $ci -> uri -> segment ( 2 );
        $ci -> load -> view ( 'includes/dashboard/header', $data );
    }
    
    /**
     * -----------------
     * @param $title
     * loads the footer file for dashboard
     * -----------------
     */
    
    function dashboard_footer () {
        $ci = &get_instance ();
        $ci -> load -> view ( 'includes/dashboard/footer' );
    }
    
    /**
     * ----------------
     * generate csrf field
     * ----------------
     */
    
    function csrf_field () {
        $ci = &get_instance ();
        $name = $ci -> security -> get_csrf_token_name ();
        $hash = $ci -> security -> get_csrf_hash ();
        echo '<input type="hidden" name="' . $name . '" value="' . $hash . '" id="csrf_field" />';
    }
    
    /**
     * ----------------
     * hidden form action field
     * ----------------
     */
    
    function hidden_action_field ( $value ) {
        echo '<input type="hidden" name="action" value="' . $value . '">';
    }
    
    /**
     * ----------------
     * loads the errors file
     * ----------------
     */
    
    function form_validations () {
        $ci = &get_instance ();
        $ci -> load -> view ( 'errors/responses' );
    }
    
    /**
     * ----------------
     * @param $string
     * @return mixed
     * encrypts the string
     * ----------------
     */
    
    function encrypt_string ( $string ) {
        $encrypt_method = "AES-256-CBC";
        $secret_key = secret_key;
        $secret_iv = secret_iv;
        $key = hash ( 'sha256', $secret_key );
        $iv = substr ( hash ( 'sha256', $secret_iv ), 0, 16 );
        $output = openssl_encrypt ( $string, $encrypt_method, $key, 0, $iv );
        return base64_encode ( $output );
    }
    
    /**
     * ----------------
     * @param $string
     * @return mixed
     * decrypts the string
     * ----------------
     */
    
    function decrypt_string ( $string ) {
        $encrypt_method = "AES-256-CBC";
        $secret_key = secret_key;
        $secret_iv = secret_iv;
        $key = hash ( 'sha256', $secret_key );
        $iv = substr ( hash ( 'sha256', $secret_iv ), 0, 16 );
        return openssl_decrypt ( base64_decode ( $string ), $encrypt_method, $key, 0, $iv );
    }
    
    /**
     * ----------------
     * @return bool
     * check if user is logged in
     * ----------------
     */
    
    function is_user_logged_in () {
        $ci = &get_instance ();
        if ( empty( $ci -> session -> userdata ( 'user_id' ) ) )
            return false;
        else
            return true;
    }
    
    /**
     * ----------------
     * @return mixed
     * get logged in user id
     * ----------------
     */
    
    function get_logged_in_user_id () {
        $ci = &get_instance ();
        return decrypt_string ( $ci -> session -> userdata ( 'user_id' ) );
    }
    
    /**
     * ----------------
     * redirect if user not logged in
     * ----------------
     */
    
    function redirect_if_not_logged_in () {
        $ci = &get_instance ();
        if ( empty( $ci -> session -> userdata ( 'user_id' ) ) )
            return redirect ( base_url ( '/' ) );
    }
    
    /**
     * ------------
     * @param string $redirect
     * @return false|string|void
     * validate url id
     * ------------
     */
    
    function validate_url_id ( $redirect = '' ) {
        $ci = &get_instance ();
        $id = $ci -> input -> get ( 'id', true );
        if ( !isset( $id ) or empty( trim ( $id ) ) or !is_numeric ( decrypt_string ( $id ) ) or decrypt_string ( $id ) < 1 )
            return redirect ( base_url ( $redirect ) );
        else
            return decrypt_string ( $id );
    }
    
    /**
     * ------------
     * @param $time
     * @return false|string
     * format time to 12 hours
     * ------------
     */
    
    function time_format ( $time ) {
        return date ( 'h:i A', strtotime ( $time ) );
    }
    
    /**
     * ------------
     * @param $company_id
     * @return mixed
     * get company by id
     * ------------
     */
    
    function get_company_by_id ( $company_id ) {
        $ci = &get_instance ();
        $ci -> load -> model ( 'CompanyModel' );
        return $ci -> CompanyModel -> get_company_by_id ( $company_id );
    }
    
    /**
     * ------------
     * @param $shift_id
     * @return mixed
     * get shift by id
     * ------------
     */
    
    function get_shift_by_id ( $shift_id ) {
        $ci = &get_instance ();
        $ci -> load -> model ( 'ShiftModel' );
        return $ci -> ShiftModel -> get_shift_by_id ( $shift_id );
    }
    
    /**
     * ------------
     * @param $attendance_id
     * @param $status
     * @return mixed
     * count attendance based on status
     * ------------
     */
    
    function get_attendance_statues ( $attendance_id, $status ) {
        $ci = &get_instance ();
        $ci -> load -> model ( 'AttendanceModel' );
        return $ci -> AttendanceModel -> get_attendance_statues ( $attendance_id, $status );
    }
    
    /**
     * ------------
     * @param $date
     * @return false|string
     * formats the date and time
     * ------------
     */
    
    function date_setter ( $date ) {
        return date ( 'Y-m-d g:i A', strtotime ( $date ) );
    }
    
    /**
     * ------------
     * @param $date
     * @return bool
     * check if the date is valid
     * ------------
     */
    
    function is_valid_date ( $date ) {
        return (bool)strtotime ( $date );
    }
    
    /**
     * ------------
     * @param $employee_id
     * @return mixed
     * get employee by id
     * ------------
     */
    
    function get_employee_by_id ( $employee_id ) {
        $ci = &get_instance ();
        $ci -> load -> model ( 'EmployeeModel' );
        return $ci -> EmployeeModel -> get_employee_by_id ( $employee_id );
    }
    
    /**
     * ------------
     * @param $employee_id
     * @param $company_id
     * @param $shift_id
     * @return mixed
     * is employee on leave
     * ------------
     */
    
    function is_employee_on_leave ( $employee_id, $company_id, $shift_id ) {
        $ci = &get_instance ();
        $ci -> load -> model ( 'LeaveModel' );
        return $ci -> LeaveModel -> is_employee_on_leave ( $employee_id, $company_id, $shift_id );
    }
    
    /**
     * ------------
     * @param $year
     * @param $month
     * @param false $ignore
     * @return int
     * count no of working days in a month
     * ------------
     */
    
    function countWorkingDays ( $year, $month, $ignore = array (
        0,
        6
    ) ) {
        $count = 0;
        $counter = mktime ( 0, 0, 0, $month, 1, $year );
        while ( date ( "n", $counter ) == $month ) {
            if ( in_array ( date ( "w", $counter ), $ignore ) == false ) {
                $count++;
            }
            $counter = strtotime ( "+1 day", $counter );
        }
        return $count;
    }
    
    /**
     * ------------
     * @param $employee_id
     * @param $date
     * @param $status
     * @return mixed
     * get attendance count by date
     * ------------
     */
    
    function get_attendance_count_by_month_year ( $employee_id, $date, $status ) {
        $ci = &get_instance ();
        $ci -> load -> model ( 'AttendanceModel' );
        return $ci -> AttendanceModel -> get_attendance_count_by_month_year ( $employee_id, $date, $status );
    }
    
    /**
     * ------------
     * @param $employee_id
     * @param $date
     * @param $status
     * @return mixed
     * get attendance late arrivals count by date
     * ------------
     */
    
    function get_attendance_late_arrivals_count_by_month_year ( $employee_id, $date, $status ) {
        $ci = &get_instance ();
        $ci -> load -> model ( 'AttendanceModel' );
        return $ci -> AttendanceModel -> get_attendance_late_arrivals_count_by_month_year ( $employee_id, $date, $status );
    }