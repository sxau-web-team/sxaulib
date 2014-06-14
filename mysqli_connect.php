<?php 
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'bulibuqi2013');
DEFINE ('DB_HOST', '127.0.0.1');
DEFINE ('DB_NAME', 'sxaulb');

// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');
