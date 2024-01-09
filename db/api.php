<?php
session_start();
require_once("action.php");
$messages = array();

if($_GET['action'] == "signup"){

    $fullname = $_GET["fullname"];
    $username = $_GET["username"];
    $role = $_GET["role"];
    $email = $_GET['email'];
    $gender = $_GET["gender"];
    $password = md5($_GET["password"].md5($_GET["password"])."deercodes@deer.com");
    $joinDate = $_GET["jdate"];
    $createdBy = $_SESSION['judiciary_user'];
    $img = "./webfiles/defaults/m_avator.png";

    if($gender == "Male"){
        $img = "./webfiles/defaults/m_avator.png";
    }else{
        $img = "./webfiles/defaults/f_avator.png";
    }
   
    $user_dir = "webfiles/users/".$username;
    if (!file_exists($user_dir)) {
        mkdir($user_dir, 0777, true);
    }

    $sqlitefi = "/webfiles/defaults/user.sql";
    $sqlitefile =  "/".$user_dir."/user.sql";
    copy($sqlitefi,$sqlitefile);

    $condition_adduser = "username = '".clean($conn,$username)."'";
    $result = selectData("users","*",$condition_adduser);

    if($result->num_rows > 0){
       $messages[] = "username exist";
    }else{
        
        $user_val = "'".clean($conn,$username)."','".clean($conn,$fullname)."','".clean($conn,$gender)."','".clean($conn,$email)."','".clean($conn,$password)."','".clean($conn,$role)."','".clean($conn,$img)."','".clean($conn,$joinDate)."','inactive','".clean($conn,$createdBy)."','1'";
        $user_db_val = "username,Fullname,gender,email,password,role,img,join_date,state,create_by,online_offline";

        if(insertData("users",$user_db_val,$user_val)){
            $messages = "added_user";
        }else{
            $messages[] = "failed_user";
        }

    }

}


if($_GET['action'] == "login"){

    $password = md5($_GET["password"].md5($_GET["password"])."deercodes@deer.com");
    $username = $_GET["username"];

    $condition_adduser = "username = '".clean($conn,$username)."' and password = '".clean($conn,$password)."'";
    $result = selectData("users","*",$condition_adduser);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if($row['state'] == "inactive"){
            $messages[] = "inactive";
        }else{
            $_SESSION['judiciary_user'] = $row['username'];
            $_SESSION['judiciary_ID'] = $row['user_id'];
            $messages[] = "ok";
        }
    }else{
        $messages[] = "failed";
    }
}

if($_GET['action'] == "logout"){
    $_SESSION['judiciary_user'] = "";
    $_SESSION['judiciary_ID'] = "";
    $messages[] = "ok";
}

if($_GET['action'] == "addnews"){
    $title = $_GET['title'];
    $news = $_GET['news'];
    $adate = $_GET['adate'];
    $atime = $_GET['atime'];

    $field_data = "title,message,date,time,added_by";
    $values = "'".clean($conn,$title)."','".clean($conn,$news)."','".clean($conn,$adate)."','".clean($conn,$atime)."','".clean($conn,$_SESSION['judiciary_user'])."'";
    if(insertData("news",$field_data,$values)){
         $messages[] = "ok";
    }else{
        $messages[] = "failed";
    }

}

if($_GET['action'] == "getnews"){
    $id = $_GET['id'];
    $condition = "id = '".clean($conn,$id)."'";
    $result = selectData("news","*",$condition);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $messages[] = $row['message'];
    }else{
        $messages[] = "failed";
    }

}

if($_GET['action'] == "del_judge"){
    $id = $_GET['id'];
    $del_con = "id = '".clean($conn,$id)."'";

    if(deleteData("judges",$del_con)){
        $messages[] = "ok";
    }else{
        $messages[] = "failed";
    }

}

if($_GET['action'] == "jupdate"){
    $id = $_GET['id'];

    $condition_adduser = "id = '".clean($conn,$id)."'";
    $result = selectData("judges","*",$condition_adduser);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $messages[] = $row;
    }else{
        $messages[] = "failed";
    }

}

if($_GET['action'] == "add_doc"){
    $title = $_GET['doc'];
    $url = $_GET['link'];
    $date = $_GET["date_"];

    $field_data = "title,directory,date,added_by";
    $values = "'".clean($conn,$title)."','".clean($conn,$url)."','".clean($conn,$date)."','".clean($conn,$_SESSION['judiciary_user'])."'";
    if(insertData("documents",$field_data,$values)){
         $messages[] = "ok";
    }else{
        $messages[] = "failed";
    }
}

if($_GET['action'] == "del_doc"){
    $id = $_GET['id'];
    $del_con = "id = '".clean($conn,$id)."'";

    if(deleteData("documents",$del_con)){
        $messages[] = "Data Deleted";
    }else{
        $messages[] = "Failed to Delete Data";
    }
}

if($_GET['action'] == "mymessage"){
    $id = clean($conn,$_GET['id']);
    if(updateData("messages","status = 1","id = '".$id."'")){
        $result = selectData("messages","*","id = '".$id."'");
        $row = $result->fetch_assoc();
        $messages[] ="<p><i>Form : </i> ".$row['name']."</p>
        <p>".$row['email']."</p>
        <p>".$row['phone']."</p>
        <p><i>date : </i> ".$row['date']."</p>
        <p>".$row['message']."</p>";
    }else{
        $messages[] = "failed to mark as read";
    }
}

if($_GET['action'] == "del_message"){
    $id = $_GET['id'];
    $del_con = "id = '".clean($conn,$id)."'";

    if(deleteData("messages",$del_con)){
        $messages[] = "Data Deleted";
    }else{
        $messages[] = "Failed to Delete Data";
    }
}

if($_GET['action'] == "del_user"){
    $id = $_GET['id'];
    $del_con = "user_id = '".clean($conn,$id)."'";

    if(deleteData("users",$del_con)){
        $messages[] = "User Deleted";
    }else{
        $messages[] = "Failed to Delete Data";
    }
}

if($_GET['action'] == 'getUserInfo'){

    $condition_adduser = "user_id = '".clean($conn,$_GET['id'])."'";
    $result = selectData("users","*",$condition_adduser);
    if($result->num_rows > 0){
        $me = $result->fetch_assoc();
        $messages[] = $me;
     }else{
        $messages[] = "failed";
     }

}

if($_GET['action'] == 'state_change'){

    $condition = "user_id = '".clean($conn,$_GET['id'])."'";
    $sss = "";
    if($_GET['state'] == "active"){
        $field_data = "state = 'active'";
        $sss = "actite";
    }else{
        $field_data = "state = 'inactive'";
        $sss = "inactite";
    }
    
    if(updateData("users",$field_data,$condition)){
        $messages[] = "State changed to ".$sss." for ".$_GET['id'];
     }else{
        $messages[] = "State change failed";
     }

}

if($_GET['action'] == 'updatme'){

    $old_pass = $_GET['old_pass'];
    $new_pass = $_GET['new_pass'];
    $newrole = $_GET['newrole'];
    $newname = $_GET['new_name'];
    $username = $_GET["id"];
    $old_passm = md5($_GET['old_pass'].md5($_GET['old_pass'])."deercodes@deer.com");
    $new_passm = md5($_GET['new_pass'].md5($_GET['new_pass'])."deercodes@deer.com");

    if($new_pass != "" && $old_pass != ""){
        
        $condition_adduser = "user_id = '".clean($conn,$username)."' and password = '".clean($conn,$old_passm)."'";
        $result = selectData("users","*",$condition_adduser);

        if($result->num_rows == 0){
            $ok = false;
        }else{
            $ok = true;
        }
    }

    $condition = "user_id = '".clean($conn,$username)."'";
    $field_data = "password = '".clean($conn,$new_passm)."'";
   
   if($ok){
    if(updateData("users",$field_data,$condition)){
        $messages[] = "Update was a success";
     }else{
        $messages[] = "Update failed 2";
     }
   }else{
    $messages[] = "Update Failed 1 - ".$condition_adduser;
   }
    

}

if($_GET['action'] == 'search'){

    $search_val = clean($conn,$_GET['val']);
    $condition_adduser = "username like '".$search_val."%' or email like '".$search_val."%' or Fullname like '".$search_val."%' or created_by like '".$search_val."%'";
    $result = selectData("users","*",$condition_adduser);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $messages [] = '
        <tr>
        <td>'.$row['user_id'].'</td>
        <td>
          <div class="row">
            <div class="col s2 m2"><img src="'.$row['img'].'" width="40px" alt="" class="responsive-img circle"></div>
            <div class="col s10 m10" style="margin-top:10px;">'.$row['Fullname'].'</div>
          </div>
        </td>
        <td>'.$row['role'].'</td>
        <td>'.$row['join_date'].'</td>
        <td>'.$row['create_by'].'</td>
        <td>
          <div class="row">
            <div page="user_info_page" my_id="'.$row['user_id'].'" class="pager col s6"><a href="#" class="blue-text"><i class="material-icons">settings</i></a></div>
            <div user_id="'.$row['user_id'].'" class="col s6 del_user"><a href="#" class="red-text"><i class="material-icons">delete</i></a></div>
          </div>
        </td>
      </tr>
        ';
    }else{
        $messages[] = "No match";
    }

}

if($_GET['action'] == 'remove_pp'){

    $condition = "user_id = '".clean($conn,$_GET['id'])."'";
    $field_data = "img = './webfiles/defaults/m_avator.png'";
    
    if(updateData("users",$field_data,$condition)){
        $messages[] = "Photo changed";
    }else{
        $messages[] = "Failed to changed photo";
    }

}

if(isset($_FILES['file']['name'])){

    $filename = $_FILES['file']['name'];
    $name = $_POST['id'];
    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

    if(move_uploaded_file($_FILES["file"]["tmp_name"], "../webfiles/users/pp/".$name.".".$extension)){
        $mypath = "./webfiles/users/pp/".$name.".".$extension;
        $condition = "user_id = '".clean($conn,$name)."'";
        $field_data = "img = '".$mypath."'";
        if(updateData("users",$field_data,$condition)){
            $messages[] = "PP Changed";
        }else{
            $messages[] = "Failed to change PP";
        }
    }else{
        $messages[] = "Failed to change PP";
    }

}

if(isset($_FILES['file1']['name'])){

    $filename = $_FILES['file1']['name'];
    $name = $_POST['id'];
    $extension = pathinfo($_FILES["file1"]["name"], PATHINFO_EXTENSION);

    if(move_uploaded_file($_FILES["file1"]["tmp_name"], "../webfiles/judgements/".$name.".".$extension)){
        $mypath = "./webfiles/judgements/".$name.".".$extension;
        $condition = "id = '".clean($conn,$name)."'";
        $field_data = "url = '".$mypath."'";
        if(updateData("judgement",$field_data,$condition)){
            $messages[] = "Judgement Uploaded";
        }else{
            $messages[] = "Failed to Upload Judgement";
        }
    }else{
        $messages[] = "Failed to Upload Judgement ".$filename;
    }

}

if($_GET['action'] == 'resetPassword'){

    $password = md5($_GET["val"].md5($_GET["val"])."deercodes@deer.com");
    $condition = "user_id = '".clean($conn,$_GET['id'])."'";
    $field_data = "password = '".$password."'";

    if(updateData('users',$field_data,$condition)){
        $messages[] = "ok";
    }else{
        $messages[] = "error";
    }
    // oa_143Zl
}

if($_GET['action'] == '_add_judgements'){

    $number = clean($conn,$_GET['_Num']);
    $name = clean($conn,$_GET['name']);
    $judge = clean($conn,$_GET['judge']);
    $h_date = clean($conn,$_GET['h_date']);
    $d_date = clean($conn,$_GET['d_date']);
    $court = clean($conn,$_GET['court']);
    $year = clean($conn,$_GET['year']);
    $user_id = $_SESSION['judiciary_ID'];

    $cond = "year = '$year' and court = '$court'";
    $jnum = 0;
    $result = selectData("judgement","COUNT(id) AS MID",$cond);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $jnum = $row["MID"] + 1;
    }else{
        $jnum = 1;
    }

    $field_data = "case_number,case_name,judge,heard_date,delivered_date,court,year,judgement_number,user_id";
    $values = "'$number','$name','$judge','$h_date','$d_date','$court','$year','$jnum','$user_id'";

    if(insertData("judgement",$field_data,$values)){
        $messages[] = "Judgement Number = ".$jnum."";
    }else{
        $messages[] = "Failed to Add Judgement. Please retry";
    }

}

if($_GET['action'] == '_get_judgements'){

    $year = clean($conn,$_GET['year']);

    $cond = "year = '$year' and user_id = '".$_SESSION['judiciary_ID']."'";
    $me_url = "";
    $result = selectData("judgement","*",$cond);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            if($row['url'] == NULL){
                $me_url = '<td><button class="btn btn-flat" disabled>pending</button></td>';
            }else{
                $me_url = '<td><a href="'.$row['url'].'" target="blank" class="btn btn-flat" >Open</a></td>';
            }
            $messages[] = '
            <tr class="tooltipped" data-position="top" data-tooltip="'.$row['court'].'">
                <td>'.$row['judgement_number'].'</td>
                <td>'.$row['case_number'].'</td>
                <td>'.$row['case_name'].'</td>
                <td>'.$row['Judge'].'</td>
                <td>'.$row['heard_date'].'</td>
                <td>'.$row['delivered_date'].'</td>
                '.$me_url.'
                <td><a class="btn orange">update</a></td>
            </tr>
            ';
        }
    }else{
        $messages[] = "No Judgements Found";
    }
}

// try sync

if($_GET['action'] == "syncdata_news"){
    $condition = "1";
    $result = selectData("news","*",$condition);

    if($result->num_rows > 0){
        $da = "";
        while($row = $result->fetch_assoc()){
            $messages[] = "'".$row['title']."','".$row["message"]."','".$row['date']."','".$row["time"]."'";
        }
         
    }else{
        $messages[] = "failed";
    }

}

if(array_key_exists('callback', $_GET)){
    header('Content-Type: text/javascript; charset=utf8');
    header('Access-Control-Allow-Origin: http://example.com/');
    header('Access-Control-Allow-Max-Age: 3628800');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

    $callback = $_GET['callback'];
    echo $callback.'('.json_encode($messages).')';

}else{
    header('Content-Type: application/json; charset=utf8');
    echo json_encode($messages);
}

?>