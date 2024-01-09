<?php

define("HOST","localhost");
define("USER","root");
define("PASSWORD","S");
define("DBNAME","myAdmin");

//defualt user config
// password is 123456 recommended to change after login;
define("USER","root");
define("FULLNAME","Sphamandla Nkambule");
define("GENDER","male");
define("EMAIL","nkambulesphamandla@gmail.com");


$create_db = new mysqli(HOST, USER, PASSWORD);

if ($create_db->connect_error) {
    die("Connection failed: " . $create_db->connect_error);
}
   
?>