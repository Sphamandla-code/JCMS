<?php
echo "1";
$username = "sphamandla";
$user_dir = "/webfiles/users/".$username;
if (!file_exists($user_dir)) {
    echo "2";
    if(mkdir($user_dir,0777)){
        echo "4";
    }else{
        echo "5";
    }
}else{
    echo "3";
}

$sqlitefi = "/webfiles/defaults/user.sql";
$sqlitefile =  "/".$user_dir."/user.sql";
copy($sqlitefi,$sqlitefile);
?>