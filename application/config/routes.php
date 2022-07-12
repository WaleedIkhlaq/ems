<?php
    defined ( 'BASEPATH' ) or exit( 'No direct script access allowed' );
    
    $route[ 'default_controller' ] = 'login';
    $route[ 'create-account' ] = 'login/register';
    $route[ 'password-forgot' ] = 'login/forgot_password';
    $route[ '404_override' ] = '';
    $route[ 'translate_uri_dashes' ] = FALSE;
