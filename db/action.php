<?php

require_once('config.php');

// create db

$retval = mysqli_select_db( $create_db, DBNAME );

if( !$retval ) {
    header("location: ./db/make.php");
    die("error");
}

// create db ends

$conn = new mysqli(HOST, USER, PASSWORD, DBNAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function insertData($table,$field_data,$values){

    $ok = false;

    $sql = "INSERT INTO ".$table." (".$field_data.")
    VALUES (".$values.")";

    if ($GLOBALS['conn']->query($sql) === TRUE) {
       $ok = true;
    } else {
        echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
        $ok = false;
    }

    $GLOBALS['conn']->close();
    return $ok;
}

function clean($link,$str){
    return mysqli_real_escape_string($link,$str);
}

function selectData($table,$field_data,$condition){

    $sql = "SELECT ".$field_data." FROM ".$table." WHERE ".$condition;
    $result = $GLOBALS['conn']->query($sql);

    return $result;
}

function deleteData($table,$condition){
    $sql = "DELETE FROM ".$table." WHERE ".$condition;
    $result = $GLOBALS['conn']->query($sql);
    return $result;
}
function updateData($table,$field_data,$condition){
    $sql = "UPDATE ".$table." SET ".$field_data." WHERE ".$condition;
    $result = $GLOBALS['conn']->query($sql);
    return $result;
}

function _file_exists($target_file){
    if (file_exists($target_file)) {
        return false;
    }
    return true;
}

function _checkSize($target_file){
    if ($target_file > 500000) {
        return false;
    }
    return true;
}

function _allowed_type($imageFileType){
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        return false;
    }
    return true;
}

function _isImage($check){
    if($check !== false) {
        return true;
    } else {
        return false;
    }
}

?>