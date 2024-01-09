<?php
require_once('config.php');


//create db;

$sql = "CREATE DATABASE ".DBNAME."";
if ($create_db->query($sql) === TRUE) {
  echo "Database created successfully<br>";
} else {
  echo "Error creating database: " . $conn->error."<br>";
}

$create_db->close();

//create tables;
$create_judges = "CREATE TABLE `judges` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `court` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `join_date` varchar(50) NOT NULL
)";

$create_news = "CREATE TABLE `news` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(10) NOT NULL,
  `added_by` varchar(100) NOT NULL
)";

$create_users = "CREATE TABLE `users` (
  `user_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `join_date` varchar(50) NOT NULL,
  `state` varchar(20) NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `online_offline` int(11) NOT NULL
)";

$create_doc = "CREATE TABLE `documents` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `directory` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `added_by` varchar(50) NOT NULL
)";

$create_judgement = "CREATE TABLE `judgement` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `case_number` varchar(50) NOT NULL,
  `case_name` varchar(255) NOT NULL,
  `Judge` varchar(100) NOT NULL,
  `heard_date` varchar(50) NOT NULL,
  `delivered_date` varchar(50) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `court` varchar(100) NOT NULL,
  `year` varchar(20) NOT NULL,
  `judgement_number` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
)";

$create_messages = "CREATE TABLE `messages` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `date` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL
)";

$create_table = new mysqli(HOST, USER, PASSWORD, DBNAME);
if( $create_table->connect_error ) {
    die("error". $create_db->connect_error);
}

if ($create_table->query($create_judges) === TRUE) {
  echo "Table judges created successfully<br>";
} else {
  echo "Error creating table judges: " . $create_table->error."<br>";
}

if ($create_table->query($create_news) === TRUE) {
  echo "Table news created successfully <br>";
} else {
  echo "Error creating table news: " . $create_table->error."<br>";
}

if ($create_table->query($create_users) === TRUE) {
  echo "Table users created successfully<br>";
} else {
  echo "Error creating table users: " . $create_table->error."<br>";
}

if ($create_table->query($create_doc) === TRUE) {
  echo "Table documents created successfully<br>";
} else {
  echo "Error creating table documents: " . $create_table->error."<br>";
}

if ($create_table->query($create_judgement) === TRUE) {
  echo "Table judgement created successfully<br>";
} else {
  echo "Error creating table judgement: " . $create_table->error."<br>";
}

if ($create_table->query($create_messages) === TRUE) {
  echo "Table messages created successfully<br>";
} else {
  echo "Error creating table messages: " . $create_table->error."<br>";
}

// add user

$add_default_user = "INSERT INTO `users` (`username`, `Fullname`, `gender`, `email`, `password`, `role`, `img`, `join_date`, `state`, `create_by`, `online_offline`) VALUES
('".USER."', '".FULLNAME."', '".GENDER."', '".EMAIL."', '5d5b024200e3d57bfcf639c339266fdc', 'Administrator', './webfiles/users/pp/1.png', '".date("d-m-Y")."', 'active', 'self', 1)";

if ($create_table->query($add_default_user) === TRUE) {
  echo "User created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>

<a href="/">Home</a>