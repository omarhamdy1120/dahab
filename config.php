<?php

// Database Details

define( "DB_HOST", "localhost" );
define( "DB_USER", "root" );
define( "DB_PASSWORD", "" );
define( "DB_NAME", "dahabdb" );
$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
if ( !$connection ) {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
}
