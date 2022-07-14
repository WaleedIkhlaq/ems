<?php
    defined ( 'BASEPATH' ) or exit( 'No direct script access allowed' );
    
    $route[ 'default_controller' ] = 'login';
    $route[ 'logout' ] = 'dashboard/logout';
    $route[ 'leaves/assigned/edit' ] = 'leaves/edit_assigned';
    $route[ 'leaves/assigned/delete' ] = 'leaves/delete_assigned_leave';
    $route[ '404_override' ] = '';
    $route[ 'translate_uri_dashes' ] = FALSE;
