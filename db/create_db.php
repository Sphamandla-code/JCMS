<?php

$create_db = new mysqli(HOST, USER, PASSWORD);

if ($create_db->connect_error) {
    die("Connection failed: " . $create_db->connect_error);
}

$retval = mysqli_select_db( $create_db, DBNAME );

if( !$retval ) {
    header("location:make.php");
    die("error");
}

?>