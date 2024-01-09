<!DOCTYPE html>
<?php
require_once("./db/action.php");
session_start();
if(!isset($_SESSION['judiciary_user']) || empty($_SESSION['judiciary_user'])){
  header("location:login.php");
}
$_me = selectData("users","*","user_id = '".$_SESSION['judiciary_ID']."'");
if($_me->num_rows > 0){
  $me = $_me->fetch_assoc();
}else{
  $me = "";
}
$current_year = date("Y");
$_news = selectData("news","*","1");
$_judges = selectData("judges","*","1");
$_doc = selectData("documents","*","1");
$_unread_news = selectData("messages","*","status = 0");
$_read_news = selectData("messages","*","status = 1");
$users = selectData("users","*","1");
$year_folder = selectData("judgement","year","1 GROUP BY year");
$count_new_messages = selectData("messages","COUNT(`id`) AS cnm","status = 0");
$count_user = selectData("users","COUNT(`user_id`) AS cu","1");
$_count_all_judges = selectData("judges","COUNT(`id`) AS c_j","1");
$count_my_judgement = selectData("judgement","COUNT(`id`) AS cmj","year = '$current_year'");
$get_few_judgement = selectData("judgement","*","1 ORDER BY 'id' DESC LIMIT 3");
$get_few_messages = selectData("messages","*","1 ORDER BY 'id' DESC LIMIT 3");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Static/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="Static/fonts/material.css">
    <link rel="stylesheet" href="Static/css/style.css">
    <link rel="stylesheet" href="Static/dist/css/winbox.min.css">
    <title>MyAdmin</title>
</head>
<body>
    <div class="navbar-fix" style="position: fixed; width: 100%;">
        <nav>
          <div class="nav-wrapper blue">
            <a href="#!" class="brand-logo"></a>
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
              <li>
                <a id="user_dialog_tool" class=""><img src="<?php echo $me['img'] ?>" width="40px" class="user_img responsive-img circle" alt=""></a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
<br><br>
      <!-- side nav -->
      <ul id="slide-out" class="sidenav black-text">
        <?php if($me['role'] == "Administrator"){ ?>
          <li><a class="waves-effect waves-light btn blue load_new_mail"><i class="material-icons left">add</i>compose new mail</a></li>
        <?php } ?> 
        <br><br>
        <li><a page="dashboard" href="#" class="pager collection-item transparent black-text"><i class="material-icons">dashboard</i> Dashboard</a></li>
          <?php if($me['role'] == "Administrator"){ ?>
          <li><a page="newspage" href="#" class="pager collection-item transparent black-text"><i class="material-icons">fiber_new</i> News</a></li>
          <li><a page="judges_page" href="#" class="pager collection-item transparent black-text"><i class="material-icons">person</i> Judges</a></li>
          <li><a page="documents_page" href="#" class="pager collection-item transparent black-text"><i class="material-icons">folder_shared</i> Documents</a></li>
          <li><a page="message_page" href="#" class="pager collection-item transparent black-text"><i class="material-icons">mail</i> Messages</a></li>
          <li><a page="users_page" href="#" class="pager collection-item transparent black-text"><i class="material-icons">group</i> Users</a></li>
          <div class="divider"></div>
          <?php } ?>
          <li><a page="myjadgementpage" href="#" class="pager collection-item transparent black-text"><i class="material-icons">folder</i> My Judgments</a></li>
          <li><a page="no_document_judgement" href="#" class="pager collection-item transparent black-text"><i class="material-icons">upload</i> Add Documents</a></li>
          <li><a class="subheader">Account</a></li>
          <li><a my_id="<?php echo  $_SESSION['judiciary_ID']; ?>" page="user_info_page" href="#" class="pager collection-item transparent black-text"><i class="material-icons">person</i> Account Info</a></li>
          <li><a my_id="<?php echo  $_SESSION['judiciary_ID']; ?>" page="user_info_page" href="#" class="pager collection-item transparent black-text"><i class="material-icons">settings</i> Account Settings</a></li>
          <li><a href="#" class="logout_mybtn collection-item transparent black-text"><i class="material-icons">lock</i> LogOut</a></li>
          
      </ul>
      <!-- side nav end -->
    <!-- user small dialog -->
      <div id="user_dialog" class="card-panel center">
        <span class="right close_user_dialog"><i class="material-icons">close</i></span>
        <p><img src="<?php echo $me['img']; ?>" width="100px" class="responsive-img circle" alt="user"></p>
        <p><?php echo $me['Fullname']; ?></p>
        <p><?php echo $me['email']; ?></p>
        <p><button page="user_info_page" class="pager btn btn-flat mybtn">Account Info</button></p>
        <div class="row">
            <div class="col s6 pager" page="user_info_page">
               <span><i class="material-icons">settings</i><br><small>settings</small></span>
            </div>
            <div class="col s6 logout_mybtn">
                <span><i class="material-icons">lock_outline</i><br><small>logout</small></span>
             </div>
        </div>
      </div>
<!-- end user small dialog -->
<!-- body -->
      <div class="section fullsideView hide-on-med-and-down">
        <!-- big screen side menu -->
        <br>
        <?php if($me['role'] == "Administrator"){ ?>
        <a class="waves-effect waves-light btn blue load_new_mail"><i class="material-icons left">add</i>compose new mail</a>
        <?php } ?>
        <ul class="collection with-header transparent menu-items">
          <li class="collection-header transparent menu-item"><h5 class="grey-text"></h5></li>
          <li><a page="dashboard" href="#" class="pager collection-item transparent white-text"><i class="material-icons">dashboard</i> Dashboard</a></li>
          <?php if($me['role'] == "Administrator"){ ?>
          <li><a page="newspage" href="#" class="pager collection-item transparent white-text"><i class="material-icons">fiber_new</i> News</a></li>
          <li><a page="judges_page" href="#" class="pager collection-item transparent white-text"><i class="material-icons">person</i> Judges</a></li>
          <li><a page="documents_page" href="#" class="pager collection-item transparent white-text"><i class="material-icons">folder_shared</i> Documents</a></li>
          <li><a page="message_page" href="#" class="pager collection-item transparent white-text"><i class="material-icons">mail</i> Messages</a></li>
          <li><a page="users_page" href="#" class="pager collection-item transparent white-text"><i class="material-icons">group</i> Users</a></li>
          <div class="divider"></div>
          <?php } ?>
          <li><a page="myjadgementpage" href="#" class="pager collection-item transparent white-text"><i class="material-icons">folder</i> My Judgments</a></li>
          <li><a page="no_document_judgement" href="#" class="pager collection-item transparent white-text"><i class="material-icons">upload</i> Add Documents</a></li>
          <li class="collection-header grey-text transparent"><b>ACCOUNT</b></li>
          <li><a my_id="<?php echo  $_SESSION['judiciary_ID']; ?>" page="user_info_page" href="#" class="pager collection-item transparent white-text"><i class="material-icons">person</i> Account Info</a></li>
          <li><a my_id="<?php echo  $_SESSION['judiciary_ID']; ?>" page="user_info_page" href="#" class="pager collection-item transparent white-text"><i class="material-icons">settings</i> Account Settings</a></li>
          <li><a href="#" class="logout_mybtn collection-item transparent white-text"><i class="material-icons">lock</i> LogOut</a></li>
          
        </ul>
        <!-- big screen side menu ends -->
      </div>
      <div class="section fullView">

        <!-- dashboard -->
        <div id="dashboard" class="page-data">
         <br><br>
          <!-- admin -->
          <?php if($me['role'] == "Administrator"){ ?>
           <div class="row">
            <div class="col m3">
              <div class="card-panel myItems">
                <div class="row">
                  <div class="col s4 m5 l3">
                    <img class="responsive-img" src="Static/imgs/icon/messages-icon.png" alt="">
                  </div>
                  <div class="col s8 m7 l9">
                    <b class="red-text lighten-2">
                      <?php 
                        $cnm = $count_new_messages->fetch_assoc();
                        echo $cnm['cnm'];
                      ?>
                    </b>
                    <br>
                    <b>NEW MESSAGES</b>
                    <br>
                    <a href="#" page="message_page" class="pager">Open</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col m3">
              <div class="card-panel myItems">
                <div class="row">
                  <div class="col s4 m5 l3">
                    <img class="responsive-img" src="Static/imgs/icon/User.png" alt="">
                  </div>
                  <div class="col s8 m7 l9">
                    <b class="red-text lighten-2">
                    <?php 
                        $c_u = $count_user->fetch_assoc();
                        echo $c_u['cu'];
                      ?>
                    </b>
                    <br>
                    <b>USERS</b>
                    <br>
                    <a href="#"  page="users_page" class="pager">Open</a>
                  </div>
                </div>
              </div>
            </div>

            <!-- <div class="col m3">
              <div class="card-panel myItems">
                <div class="row">
                  <div class="col s4 m5 l3">
                    <img class="responsive-img" src="Static/imgs/icon/user-settings.png" alt="">
                  </div>
                  <div class="col s8 m7 l9">
                    <b class="red-text lighten-2"></b>
                    
                    <b>USER RESET</b>
                    <br><br>
                    <a id="open-user-reset-win" href="#">Open</a>
                  </div>
                </div>
              </div>
            </div> -->
            <div class="col m3">
              <div class="card-panel myItems">
                <div class="row">
                  <div class="col s4 m5 l3">
                    <img class="responsive-img" src="Static/imgs/icon/user-settings.png" alt="">
                  </div>
                  <div class="col s8 m7 l9">
                    <b class="red-text lighten-2"></b>
                    
                    <b>SYNC DB</b>
                    <br><br>
                    <a id="syncdb" href="#">sync</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col m3">
              <div class="card-panel myItems">
                <div class="row">
                  <div class="col s4 m5 l3">
                    <img class="responsive-img" src="Static/imgs/icon/JUDGE.png" alt="">
                  </div>
                  <div class="col s8 m7 l9">
                    <b class="red-text lighten-2">
                     <?php 
                        $_c_j = $_count_all_judges->fetch_assoc();
                        echo $_c_j['c_j'];
                      ?>
                    </b>
                    <br>
                    <b>jUDGES</b>
                    <br>
                    <a href="#" page="judges_page" class="pager">Open</a>
                  </div>
                </div>
              </div>
            </div>

           </div>
          <?php } ?>
          <!-- admin -->

          <!-- all users -->

          <div class="container-flex">

            <div class="card-panel myItems">
              <div class="row">
                <div class="col m8 s12">
                  <h4 class="grey-text">Welcome</h4>
                  <p>You Are Logged In As <b class=""><?php echo $me['Fullname'] ?></b>.</p>
                </div>
                <div class="col m4 hide-on-small-only">
                  <center><h2 class="digital mytime">1 0 : 1 0</h2><p class="digital mydate">20/06/2022</p></center>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col m6 s12">
                <div class="col m6 s12">
                  <div class="myItems card-panel" id="coverme">
                    <div class="coverme_overlay">
                    <center>
                    <P><h4 class="white-text"><b>Open Full Site</b></h4></P>
                    <p><a class="btn blue" href="http://judiciary.org.sz">OPEN</a></p>
                    </center>
                    </div>
                  </div>
                </div>
                <div class="col m6 s12">
                  <div class="myItems card-panel center">
                    <h1 class="grey-text">
                    <?php 
                      $cmj = $count_my_judgement->fetch_assoc();
                      echo $cmj['cmj'];
                    ?></h1>
                    <h4 class="grey-text">JUDGEMENTS</h4>
                    <br><br>
                  </div>
                </div>
              </div>
              <div class="col m6 s12">
                <div class="myItems card-panel">
                  <h5 class="grey-text collection-item"><span class="badge"><?php echo $cmj['cmj']; ?></span>Judgments</h5>
                  
                  <?php while($gfj = $get_few_judgement->fetch_assoc()) {?>
                    <div class="mylist">
                      <b>case <?php echo $gfj['case_number']; ?></b><br>
                      <span class="truncate"><?php echo $gfj['case_name']; ?></span>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col s12 card-panel">
                <div class="cols12"><b>ME</b></div>
                  <div class="col s4 m4">
                    <img src="<?php echo $me['img'] ?>" width="50px" class="user_img responsive-img circle" alt="">
                  </div>
                  <div class="col s8 m4">
                    <br>
                    <?php echo $me['Fullname']; ?>
                  </div>
                  <div class="col s12 m4">
                    <br>
                  <?php echo $me['email']; ?>
                  </div>
              </div>
            </div>
          </div>

          <!-- all users -->

          <!-- Admin -->
          <?php if($me['role'] == "Administrator"){ ?>
              <div class="row">
                <div class="col s12 m6">
                  <div class="card-panel myItems">
                    <h5 class="grey-text">Messages</h5>
                    <?php while($gfm = $get_few_messages->fetch_assoc()) {?>
                      <div class="row valign-wrapper">
                        <div class="col s2">
                          <div class="blue circle-avater white-text center"><?php echo $gfm['name'][0]; ?></div>
                        </div>
                        <div class="col s10">
                          <span class="black-text truncate">
                           <?php echo $gfm['message']; ?>
                          </span>
                        </div>
                      </div>
                    <?php } ?>
                   
                  </div>
                </div>
                <div class="col s12 m6">
                  <div class="card-panel myItems">
                    <b class="center">Gallary</b>
                    <div class="carousel">
                      <a class="carousel-item" href="#one!"><img src="Static/imgs/R.png"></a>
                      <a class="carousel-item" href="#two!"><img src="Static/imgs/high1.jpg"></a>
                      <a class="carousel-item" href="#three!"><img src="Static/imgs/entrance.jpg"></a>
                      <a class="carousel-item" href="#four!"><img src="Static/imgs/legal.jpg"></a>
                      <a class="carousel-item" href="#five!"><img src="Static/imgs/pig1.jpg"></a>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
          <!-- admin -->
        </div>
        <!-- end dashboard -->
        <div class="clear"></div>
      <?php if($me['role'] == "Administrator"){ ?>
        <!-- news -->
        <div id="newspage" class="container-flex page-data">
          <div class="center">
            <br><br>
            <a id="open-add-news-win" class="waves-effect waves-light btn blue white-text"><i class="material-icons left">add</i>ADD NEWS</a>
            <a id="news_to_delete" class="waves-effect waves-light btn red white-text"><i class="material-icons left">delete</i>Delete NEWS</a>
            <div class="delete_form confirm_form z-depth-3 white">
              <form method="post">
                <input type="hidden" id="news_to_delete_input" name="news_to_delete" value="0">
                <div class="row">
                  <div class="col s12"><p>YOU ARE ABOUT TO DELETE NEWS ITEM.</p></div>
                  <div class="col s6">
                    <a class="btn cancel blue">Cancel</a>
                  </div>
                  <div class="col s6">
                    <button class="btn red proceed" type="submit" name="delete_news_btn">Proceed</button>
                  </div>
                </div>
              </form>
            </div>
            <br><br>
          </div>
          <hr>
          <div class="row">
            <div class="col s12 m4">
              <div class="new-list">
               
                <?php while($news = $_news->fetch_assoc()){ ?>
                  <div news_id="<?php echo $news['id']; ?>" class="mynewsid news-item">
                    <div class="row">
                      <div class="col m2">
                        <img src="Static/imgs/news.jpg" width="100px" class="responsive-img" alt="">
                      </div>
                      <div class="col m10">
                        <p class="item truncate"><?php echo $news['title']; ?></p>
                        <p><small><?php echo $news['date']." | ".$news['time']." BY ".$news['added_by']; ?></small></p>
                      </div>
                    </div>
                  </div>
                 <?php } ?>
               
              </div>
            </div>
            <div class="col m8 s12 hide-on-small-only">
            
            <?php 
              if(isset($_POST['delete_news_btn'])){
                $del_con = "id = '".clean($conn,$_POST['news_to_delete'])."'";

                if(deleteData("news",$del_con)){
                  echo "data deleted";
                }else{
                  echo "Failed to delete";
                }

              }
            ?>
            
            <div class="text_news"></div>
            </div>
          </div>
        </div>
        <!-- end news -->
        <div class="clear"></div>

        <!-- Judges page -->
          <br><br>
        <div class="container-flex">
          <?php

              if(isset($_POST['save_judge'])){

                $target_dir = "webfiles/defaults/Judges/";
                $target_file = $target_dir . basename($_FILES["file"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $check = getimagesize($_FILES["file"]["tmp_name"]);

                if(_isImage($check)){
                  if(_file_exists($target_file)){
                    if(_checkSize($_FILES['file']['size'])){
                      if(_allowed_type($imageFileType)){
                        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                          echo "<div class='succes_message green message_state'><i>The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.</i></div>";
                          $_jdate = date("Y-m-d");
                          $judge_val = "'".clean($conn,$_POST['jname'])."','".clean($conn,$_POST['jposition'])."','".clean($conn,$_POST['jcourt'])."','".clean($conn,$target_file)."','".clean($conn,$_SESSION['judiciary_user'])."','".clean($conn,$_jdate)."'";
                          $fild = "Name,position,court,img,added_by,join_date";
                          if(insertData("judges",$fild,$judge_val)){
                            echo "<div class='succes_message green message_state'><i>File type ok</i>Data Save</div>";
                          }else{
                            echo '<div class="error_message red message_state"><i>Sorry, there was an error saving data.</i></div>';
                          }
                        } else {
                          echo '<div class="error_message red message_state"><i>Sorry, there was an error uploading your file.</i></div>';
                        }
                      }else{
                        echo '<div class="error_message red message_state"><i>File type error</i></div>';
                      }
                    }else{
                      echo '<div class="error_message red message_state"><i>File size too large</i></div>';
                    }
                  }else{
                    echo '<div class="error_message red message_state"><i>File already exist</i></div>';
                  }
                }else{
                  echo '<div class="error_message red message_state"><i>File is not an image</i></div>';
                }
              }

          ?>
        </div>
          <div class="row page-data" id="judges_page">
            <div class="col s12 m5">
              <div class="card-panel myItems">
                <h4 class="grey-text">Add Judge</h4>
                <hr>
                <form method="post" enctype="multipart/form-data">
                  <div class="input-field">
                    <input type="text" id="jname" name="jname" class="jname">
                    <label for="jname">Name:</label>
                  </div>
                  <div class="input-field">
                    <input type="text" id="position" name="jposition" class="position">
                    <label for="position">Position:</label>
                  </div>
                  <div class="input-field">
                    <select name="jcourt" id="jcourt">
                      <option value="" disabled selected>Choose your option</option>
                      <option value="Supreme Court">Supreme Court</option>
                      <option value="High Court">High Court</option>
                      <option value="Industrail Court Of Appeal">Industrail Court Of Appeal</option>
                      <option value="Industrail Court">Industrail Court</option>
                      <option value="Commercial Court">Commercial Court</option>
                    </select>
                    <label>Materialize Select</label>
                  </div>
                  <div class="input-field">
                    <input type="file" name="file" placeholder="Choose Img" id="file" class="file">
                  </div>
                  <div class="input-field">
                    <button class="btn blue" name="save_judge">Save</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col s12 m7">
              <div class="card-panel myItems">
                <div class="mylist">

                  <?php  while($judge = $_judges->fetch_assoc()) { ?>
                      
                    <div class="row">
                      <div class="col s3 m2">
                        <img src="<?php echo $judge['img']; ?>" width="100px" alt="img">
                      </div>
                      <div class="col s9 m10">
                        <span>
                          <b><?php echo $judge['position']." ".$judge['Name']; ?></b> <br> <?php echo $judge['court']; ?> <br> 
                          <div judge_id="<?php echo $judge['id']; ?>" class="col s2 delete_judge btn-flat red-text"><i class="material-icons">delete</i></div>
                          <div judge_id="<?php echo $judge['id'] ?>" class="col s2 update_judge btn-flat orange-text"><i class="material-icons">update</i></div>
                          <div class="col s8"></div>
                        </span>
                      </div>
                    </div>
                      
                 <?php } ?>

                  
                </div>
              </div>
            </div>
          </div>
          <div class="judge_delete_form confirm_form z-depth-3 white">
            <form method="post">
              <center>
              <input type="hidden" id="judge_to_delete_input" name="news_to_delete" value="0">
              <div class="row">
                <div class="col s12"><p>YOU ARE ABOUT TO DELETE Judge.</p></div>
                <div class="col s6">
                  <a class="btn jcancel blue">Cancel</a>
                </div>
                <div class="col s6">
                  <a class="btn red proceed jproceed">Proceed</a>
                </div>
              </div>
              </center>
            </form>
          </div>
        <!-- Judges page end -->
        <div class="clear"></div>

        <!-- Documents pages -->
        <div class="row page-data" id="documents_page">
          <div class="col s12 m6">
            <div class="card-panel myItems">
              <div class="input-field">
                <input type="text" name="dname" id="dname" class="dname">
                <label for="dname">Name</label>
              </div>
              <div class="input-field">
                <input type="text" name="dlink" id="dlink" class="dlink">
                <label for="dlink">Link (url)</label>
              </div>
              <div class="input-field">
                <button class="btn blue white-text" onclick="save_doc();">Save</button>
              </div>
            </div>
          </div>
          <div class="col s12 m6">
            <ul class="collection with-header">
              <li class="collection-header"><h4>Saved Documents</h4></li>
              <?php
                while($mydoc = $_doc->fetch_assoc()){
                  echo '<li class="collection-item truncate"><div>'.$mydoc['title'].'<a href="#!" class="secondary-content del_doc" doc_id="'.$mydoc['id'].'"><i class="material-icons">delete</i></a></div></li>';
                }
              ?>
            </ul>
          </div>
        </div>
        <!-- Documents page end -->
        <div class="clear"></div>

        <!-- messages news -->
        <div class="row page-data message_page" id="message_page">
          <div class="col s12 m4">
            new messages
            <div class="myItems card-panel new-messages">
              <ul class="collection">
                <?php 
                  while($unread = $_unread_news->fetch_assoc()){
                    echo '<li class="collection-item mymessages" mymessages="'.$unread['id'].'"><div>'.$unread['name'].'<a href="#!" class="secondary-content"><i class="material-icons">send</i></a></div></li>';
                  }
                ?>
              </ul>
            </div>
            read messages
            <div class="myItems card-panel old-messages">
              <ul class="collection">
                <?php 
                  while($read = $_read_news->fetch_assoc()){
                    echo '<li class="collection-item mymessages" mymessages="'.$read['id'].'"><div>'.$read['name'].'<a href="#!" class="secondary-content"><i class="material-icons">send</i></a></div></li>';
                  }
                ?>
              </ul>
            </div>
          </div>
          <div class="col s12 m8">
          <p><a class='btn del_message red'>remove</a></p>
            <div class="messages_show">
              
            </div>
          </div>
        </div>
        <!-- message news end -->
        <div class="clear"></div>
        <!-- users page -->
          <div class="users_page page-data" id="users_page">
            <div class="container-flex">
              <div class="card-panel myItems">
                <div class="blue white-text">
                  <div class="row">
                    <div class="col m8 s12">
                      <h4>User Management</h4>
                    </div>
                    <div class="col m4 s12" style="padding-top: 15px;">
                      <div class="col s12 m6"><a class="waves-effect waves-light btn white blue-text open_add_user_win modal-trigger" href="#add-user-win"><i class="material-icons left">add</i>Add User</a></div>
                      <div class="col s12 m6"><a class="waves-effect waves-light btn white blue-text seach_user_input_show"><i class="material-icons left">search</i>Find User</a></div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="center seach_user_input">
                  <div class="input-field">
                    <input onchange="searchUser(this.value);" type="text" placeholder="find user">
                  </div>
                </div>
                <br>
                <table class="highlight">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Created Date</th>
                        <th>Added By</th>
                        <th>Action</th>
                    </tr>
                  </thead>
          
                  <tbody style="overflow-y: hidden;" class="user_search_list">
                    <?php while($myusers = $users->fetch_assoc()){ ?>
                      <tr>
                        <td><?php echo $myusers['user_id']; ?></td>
                        <td>
                          <div class="row">
                            <div class="col s2 m2"><img src="<?php echo $myusers['img']; ?>" width="40px" alt="" class="responsive-img circle"></div>
                            <div class="col s10 m10" style="margin-top:10px;"><?php echo $myusers['Fullname']; ?></div>
                          </div>
                        </td>
                        <td><?php echo $myusers['role']; ?></td>
                        <td><?php echo $myusers['join_date']; ?></td>
                        <td><?php echo $myusers['create_by']; ?></td>
                        <td>
                          <div class="row">
                            <div page="user_info_page" my_id="<?php echo $myusers['user_id']; ?>" class="pager col s6"><a href="#" class="blue-text"><i class="material-icons">settings</i></a></div>
                            <div user_id="<?php echo $myusers['user_id']; ?>" class="col s6 del_user"><a href="#" class="red-text"><i class="material-icons">delete</i></a></div>
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <div class="clear"></div>
              </div>
            </div>
          </div>
        <!-- users page -->
      <?php } ?>
        <div class="clear"></div>
        <!-- user info -->
        <div page="user_info_page" id="user_info_page" class="page-data container-flex">
          <div class="row">
            <div class="col m8">
              <div class="card-panel myItems">
                <h4 class="grey-text getfullname">Sphamandla Nkambule</h4>
                <p><i>username : </i><span class="getusername">Sphamandla</span></p>
                <p><i>role : </i> <span class="getrole">Administrator</span></p>
                <p><i>Created date : </i> <span class="getcdate">20/07/2022</span></p>
                <p><i>Created by : </i><span class="getcby">sphamandla</span></p>
                <br><br>
                <p><i>user details</i></p>
                <div class="input-field col s12 m6">
                  <input type="text" name="" id="new_name">
                  <label for="new_name">Name</label>
                </div>
              <?php if($me['role'] == "Administrator"){ ?>
                <div class="input-field col s12 m6">
                  <select id="newrole" name="newrole">
                  <option value="" disabled selected>Choose your option</option>
                  <option value="Administrator">Administrator</option>
                  <option value="User">User</option>
                  <option value="Clerk">Clerk</option>
                  <option value="Secritery">Secritery</option>
                  <option value="Chief_Secritery">Chief Secritery</option>
                  <option value="Other">Other</option>
                  </select>
                  <label>Role</label>
                </div>
              <?php } ?>
                <div class="col s12 m12"><p><i>Change Password</i></p></div>
                <div class="input-field col s12 m6">
                  <input type="text" name="old_change_password" id="old_change_password">
                  <label for="old_change_password">Old Password</label>
                </div>
                <div class="col s12"></div>
                <div class="input-field col s12 m6">
                  <input type="text" name="change_password" id="change_password">
                  <label for="change_password">New Password</label>
                </div>
                <div class="col s12"></div>
                <div class="col s12 btn" id="save_new_password">Save</div>
                <div class="clear"></div>
                <br>
              </div>
            </div>
            <div class="col s12 m4">
              <div class="card-panel center myItems">
                <center class="getImage"><img src="Static/imgs/R.png" class="responsive-img materialboxed" alt="user-img"></center>
                <form method="post" enctype="multipart/form-data">
                  <input type="file" name="file" class="upload_pp" accept="image/*">
                </form>
                <div class="row">
                  <div class="col s6"><a href="#" class="btn blue upload-button white-text">change Image</a></div>
                  <div class="col s6"><a href="#" user_id="<?php echo  $_SESSION['judiciary_ID']; ?>" class="btn remove_pp_btn red white-text">Remove Image</a></div>
                </div>
              </div>
            </div>
          </div>
        <?php if($me['role'] == "Administrator"){ ?>
          <div class="card-panel myItems">
            <div class="row">
              <div class="col s12 m10">
               <p>
                <div class="switch">
                  Account is : 
                  <label>
                    Inactive
                    <input id="state_cheker" type="checkbox">
                    <span class="lever"></span>
                    Active
                  </label>
                </div></p>
              </div>
              <div class="col s12 m2">
                  <a href="#" class="btn reset_password_btn">Reset Password</a>
              </div>
            </div>
          </div>
        <?php } ?>
        <input type="hidden" id="getnewUser">
        </div>
        <!-- user info -->
        <div class="clear"></div>
        <!-- my judgement page -->
        <div class="page-data" id="myjadgementpage">
          <div class="container-flex">
            <div class="col s6 m2"><a href="#add-judgement-win" class="waves-effect waves-light btn blue modal-trigger"><i class="material-icons left">add</i>Add Judgements</a></div>
            <div class="card-panel myItems"><b>3 Judgements This Year </b></div>
            <div class="row">
              <?php while($myfolder = $year_folder->fetch_assoc()){ ?>
                <div class="col s6 m2"><a class="waves-effect year_folder waves-light btn grey" folder_name="<?php echo $myfolder['year'] ?>"><i class="material-icons left">folder</i><?php echo $myfolder['year'] ?></a></div>
              <?php } ?>
            </div>
            <div>
              <center>
                <br>
                <p><b>Find Judgement</b></p>
                <input type="text" name="" id="" class="search-input" placeholder="Search">
              </center>
            </div>
            <h4 class="grey-text myfolder_year"><?php echo $current_year ?></h4>
            <table>
              <thead>
                <tr>
                    <th>Judgement #</th>
                    <th>case #</th>
                    <th>Case Name</th>
                    <th>Judge</th>
                    <th>Heard Date</th>
                    <th>Deliver Date</th>
                    <th>Document</th>
                    <th></th>
                </tr>
              </thead>
      
              <tbody class="row_judgement_list">
                
              </tbody>
            </table>
            <!-- cj sec -->
              <?php if($me['role'] == "Administrator" || $me['role'] == "Chief_Secritery"){ ?>
                <div class="row">
                  <div class="col s12">
                    <ul class="tabs">
                      <li class="tab col s2"><a href="#test1">Supreme</a></li>
                      <li class="tab col s2"><a class="active" href="#test2">High</a></li>
                      <li class="tab col s3"><a href="#test3">Court Of Appeal</a></li>
                      <li class="tab col s2"><a href="#test4">Industrail</a></li>
                      <li class="tab col s3"><a href="#test5">Commercial</a></li>
                    </ul>
                  </div>
                  <div id="test1" class="col s12">
                    <table>
                      <thead>
                        <tr>
                            <th>Judgement #</th>
                            <th>case #</th>
                            <th>Case Name</th>
                            <th>Judge</th>
                            <th>Heard Date</th>
                            <th>Deliver Date</th>
                            <th>Document</th>
                            <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $get_judgement_supreme = selectData("judgement","*","court = 'Supreme Court'");
                          if($get_judgement_supreme->num_rows > 0){
                              while($row = $get_judgement_supreme->fetch_assoc()){
                                  if($row['url'] == NULL){
                                      $me_url = '<td><button class="btn btn-flat" disabled>pending</button></td>';
                                  }else{
                                      $me_url = '<td><a href="'.$row['url'].'" target="blank" class="btn btn-flat" >Open</a></td>';
                                  }
                                echo '
                                  <tr class="tooltipped" data-position="top" data-tooltip="'.$row['court'].'">
                                      <td>'.$row['judgement_number'].'</td>
                                      <td>'.$row['case_number'].'</td>
                                      <td>'.$row['case_name'].'</td>
                                      <td>'.$row['judge'].'</td>
                                      <td>'.$row['heard_date'].'</td>
                                      <td>'.$row['delivered_date'].'</td>
                                      '.$me_url.'
                                      <td><a href="" class="btn orange">update</a></td>
                                  </tr>
                                  ';
                              }
                          }else{
                              echo "No Judgements Found";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div id="test2" class="col s12">
                  <table>
                      <thead>
                        <tr>
                            <th>Judgement #</th>
                            <th>case #</th>
                            <th>Case Name</th>
                            <th>Judge</th>
                            <th>Heard Date</th>
                            <th>Deliver Date</th>
                            <th>Document</th>
                            <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $get_judgement_supreme = selectData("judgement","*","court = 'High Court'");
                          if($get_judgement_supreme->num_rows > 0){
                              while($row = $get_judgement_supreme->fetch_assoc()){
                                  if($row['url'] == NULL){
                                      $me_url = '<td><button class="btn btn-flat" disabled>pending</button></td>';
                                  }else{
                                      $me_url = '<td><a href="'.$row['url'].'" target="blank" class="btn btn-flat" >Open</a></td>';
                                  }
                                echo '
                                  <tr class="tooltipped" data-position="top" data-tooltip="'.$row['court'].'">
                                      <td>'.$row['judgement_number'].'</td>
                                      <td>'.$row['case_number'].'</td>
                                      <td>'.$row['case_name'].'</td>
                                      <td>'.$row['judge'].'</td>
                                      <td>'.$row['heard_date'].'</td>
                                      <td>'.$row['delivered_date'].'</td>
                                      '.$me_url.'
                                      <td><a href="" class="btn orange">update</a></td>
                                  </tr>
                                  ';
                              }
                          }else{
                              echo "No Judgements Found";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div id="test3" class="col s12">
                  <table>
                      <thead>
                        <tr>
                            <th>Judgement #</th>
                            <th>case #</th>
                            <th>Case Name</th>
                            <th>Judge</th>
                            <th>Heard Date</th>
                            <th>Deliver Date</th>
                            <th>Document</th>
                            <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $get_judgement_supreme = selectData("judgement","*","court = 'Industrial Court of Appeal'");
                          if($get_judgement_supreme->num_rows > 0){
                              while($row = $get_judgement_supreme->fetch_assoc()){
                                  if($row['url'] == NULL){
                                      $me_url = '<td><button class="btn btn-flat" disabled>pending</button></td>';
                                  }else{
                                      $me_url = '<td><a href="'.$row['url'].'" target="blank" class="btn btn-flat" >Open</a></td>';
                                  }
                                echo '
                                  <tr class="tooltipped" data-position="top" data-tooltip="'.$row['court'].'">
                                      <td>'.$row['judgement_number'].'</td>
                                      <td>'.$row['case_number'].'</td>
                                      <td>'.$row['case_name'].'</td>
                                      <td>'.$row['judge'].'</td>
                                      <td>'.$row['heard_date'].'</td>
                                      <td>'.$row['delivered_date'].'</td>
                                      '.$me_url.'
                                      <td><a href="" class="btn orange">update</a></td>
                                  </tr>
                                  ';
                              }
                          }else{
                              echo "No Judgements Found";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div id="test4" class="col s12">
                  <table>
                      <thead>
                        <tr>
                            <th>Judgement #</th>
                            <th>case #</th>
                            <th>Case Name</th>
                            <th>Judge</th>
                            <th>Heard Date</th>
                            <th>Deliver Date</th>
                            <th>Document</th>
                            <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $get_judgement_supreme = selectData("judgement","*","court = 'Industrail Court'");
                          if($get_judgement_supreme->num_rows > 0){
                              while($row = $get_judgement_supreme->fetch_assoc()){
                                  if($row['url'] == NULL){
                                      $me_url = '<td><button class="btn btn-flat" disabled>pending</button></td>';
                                  }else{
                                      $me_url = '<td><a href="'.$row['url'].'" target="blank" class="btn btn-flat" >Open</a></td>';
                                  }
                                echo '
                                  <tr class="tooltipped" data-position="top" data-tooltip="'.$row['court'].'">
                                      <td>'.$row['judgement_number'].'</td>
                                      <td>'.$row['case_number'].'</td>
                                      <td>'.$row['case_name'].'</td>
                                      <td>'.$row['judge'].'</td>
                                      <td>'.$row['heard_date'].'</td>
                                      <td>'.$row['delivered_date'].'</td>
                                      '.$me_url.'
                                      <td><a href="" class="btn orange">update</a></td>
                                  </tr>
                                  ';
                              }
                          }else{
                              echo "No Judgements Found";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div id="test5" class="col s12">
                  <table>
                      <thead>
                        <tr>
                            <th>Judgement #</th>
                            <th>case #</th>
                            <th>Case Name</th>
                            <th>Judge</th>
                            <th>Heard Date</th>
                            <th>Deliver Date</th>
                            <th>Document</th>
                            <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $get_judgement_supreme = selectData("judgement","*","court = 'Commercial Court'");
                          if($get_judgement_supreme->num_rows > 0){
                              while($row = $get_judgement_supreme->fetch_assoc()){
                                  if($row['url'] == NULL){
                                      $me_url = '<td><button class="btn btn-flat" disabled>pending</button></td>';
                                  }else{
                                      $me_url = '<td><a href="'.$row['url'].'" target="blank" class="btn btn-flat" >Open</a></td>';
                                  }
                                echo '
                                  <tr class="tooltipped" data-position="top" data-tooltip="'.$row['court'].'">
                                      <td>'.$row['judgement_number'].'</td>
                                      <td>'.$row['case_number'].'</td>
                                      <td>'.$row['case_name'].'</td>
                                      <td>'.$row['judge'].'</td>
                                      <td>'.$row['heard_date'].'</td>
                                      <td>'.$row['delivered_date'].'</td>
                                      '.$me_url.'
                                      <td><a href="" class="btn orange">update</a></td>
                                  </tr>
                                  ';
                              }
                          }else{
                              echo "No Judgements Found";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              <?php } ?>
            <!-- cj sec -->
          </div>
        </div>
        <!-- myjudgement page -->
        <!-- no document judgement -->
        <div id="no_document_judgement" class="page-data container-flex">
          <h4 class="center">Judgements With Pending Document Upload</h4>
          <br>
          <table>
            <thead>
              <tr>
                  <th>Judgement #</th>
                  <th>case #</th>
                  <th>Case Name</th>
                  <th>Judge</th>
                  <th>Heard Date</th>
                  <th>Deliver Date</th>
                  <th>Document</th>
                  <th></th>
              </tr>
            </thead>
    
            <tbody>
              <?php
              
              $cond_noDoc = "user_id = '".$_SESSION['judiciary_ID']."'";
              $me_url = "";
              $result_noDoc = selectData("judgement","*",$cond_noDoc);

              if($result_noDoc->num_rows > 0){
                while($row_noDoc = $result_noDoc->fetch_assoc()){
                  if($row_noDoc['url'] == NULL){
                    $me_url = '<td><button class="update_add_doc btn btn-flat" doc_id="'.$row_noDoc['id'].'">pending</button></td>';
                    echo '
                          <tr class="tooltipped" data-position="top" data-tooltip="'.$row_noDoc['court'].'">
                              <td>'.$row_noDoc['judgement_number'].'</td>
                              <td>'.$row_noDoc['case_number'].'</td>
                              <td>'.$row_noDoc['case_name'].'</td>
                              <td>'.$row_noDoc['Judge'].'</td>
                              <td>'.$row_noDoc['heard_date'].'</td>
                              <td>'.$row_noDoc['delivered_date'].'</td>
                              '.$me_url.'
                          </tr>
                          ';
                  }
                }
              }else{
                  echo "It Seem All Judgment have Documents attached to then :)";
              }
              ?>
            </tbody>
          </table>
          <form method="post" enctype="multipart/form-data">
              <input type="text" name="mydoc_jID" class="hide_me" id="mydoc_jID">
              <input type="file" name="file1" class="hide_me upload_docJudgement" accept="application/pdf">
          </form>
        </div>
        <!-- no document judgement -->
        <div class="clear"></div>
        <!-- <div class="blue footer">
          <center>
            <h5 class="white-text">Judiciary of Eswatini &copy; 2022</h5>
          </center>
        </div> -->
      </div>


      <!-- new mail window -->
      <div id="backstore" style="display: none;">
          <div id="content" style="padding:10px;">
              <form method="post" enctype="multipart/form-data">
                <div class="input-field">
                  <input type="text" name="subject" id="subject">
                  <label for="subject">Subject</label>
                </div>
                <div class="input-field col s12">
                  <textarea id="textarea1" name="message" class="materialize-textarea"></textarea>
                  <label for="textarea1">Textarea</label>
                </div>
                <div class="input-field col s12">
                  <input type="file" name="files[]" multiple>
                </div>
                <div class="input-field col s12">
                  <button type="submit" name="send_mail" value="UPLOAD" class="btn blue">Send</button>
                </div>
              </form>

              <?php include "./db/mail.php"; ?>

          </div>
      </div>
      <!-- new mail window -->
      <!-- user reset window -->
      <div class="mywin">
        <div id="user-reset-win" class="mywin-win">
          <center>
            <br><br>
            <input type="text" class="search-input" placeholder="Search user...">
          </center>
          <br><br>
          12 users
          <hr>
          <br><br>
          <div class="z-depth-2">
            <div class="row">
              <div class="col m3 s3 l1">
                <img src="Static/imgs/R.png" class="responsive-img circle" width="50px" alt="">
              </div>
              <div class="col m6 s6 l8">
                <span>sphamandla</span><br>
                <span>Sphamandla Nkambule</span>
              </div>
              <div class="col m3 s3 l3">
                <button class="btn btn-flat">Reset</button>
                <button class="btn btn-flat">Delete</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- user reset window -->

      <!-- add news window -->
      <div class="mywin">
        <div id="add-news-win" class="mywin-win">
         <iframe id="myiframe" src="Static/js/tinymce/new.php" width="100%" frameborder="0"></iframe>
        </div>
      </div>
      <!-- add news window -->
      <!-- add user win -->
      <div id="add-user-win" class="modal">
        <div class="modal-content">
          <h4 class="grey-text">Add User</h4>
          
            <div class="input-field">
              <input type="text" name="fullname" id="fullname" class="fullname">
              <label for="fullname">Enter Full Name</label>
            </div>
             <div class="input-field">
               <input type="text" name="username" id="username" class="username">
               <label for="username">Enter Username</label>
             </div>
             <div class="input-field">
              <select id="role" name="role">
                <option value="" disabled selected>Choose your option</option>
                <option value="Administrator">Administrator</option>
                <option value="User">User</option>
                <option value="Clerk">Clerk</option>
                <option value="Secritery">Secritery</option>
                <option value="Chief_Secritery">Chief Secritery</option>
                <option value="Other">Other</option>
              </select>
              <label>Role</label>
            </div>
            <div class="input-field">
              <select id="gender" name="gender">
                <option value="" disabled selected>Choose your option</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
              <label>Gender</label>
            </div>
            <div class="input-field">
              <input type="email" name="email" id="email" class="email">
              <label for="email">email</label>
            </div>
             <div class="input-field">
              <input type="text" name="password" id="password" class="password">
              <label for="password">Password</label>
            </div>
            <div class="input-field">
              <input type="text" name="vpassword" id="vpassword" class="vpassword">
              <label for="vpassword">Verify Password</label>
            </div>
            <div class="joindate" style="display:none;"></div>
            <div class="input-field">
              <button id="send_adduser_data" class="btn blue">Save</button>
            </div>
         
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
      </div>
      <!-- add user win -->
      <!-- add judgements -->
      <div id="add-judgement-win" class="modal">
        <div class="modal-content">
          <h4 class="grey-text">Add Judgement</h4>
            <div class="input-field">
              <input type="text" name="casenumber" id="casenumber" class="casenumber">
              <label for="casenumber">Case Number</label>
            </div>
             <div class="input-field">
               <input type="text" name="casename" id="casename" class="casename">
               <label for="casename">Case Name</label>
             </div>
             <div class="input-field">
              <input type="text" name="judgement_judge" id="judgement_judge" class="judgement_judge">
              <label for="judgement_judge">Judge</label>
            </div>
             <div class="input-field">
              <select name="court" id="court">
                <option value="" disabled selected>Choose your option</option>
                <option value="Supreme Court">Supreme Court</option>
                <option value="High Court">High Court</option>
                <option value="Industrial Court of Appeal">Industrial Court of Appeal</option>
                <option value="Industrail Court">Industrail Court</option>
                <option value="Commercial Court">Commercial Court</option>
              </select>
              <label>Court</label>
            </div>
            <div class="input-field">
              <input type="text" name="head_date" id="head_date" class="datepicker head_date">
              <label for="head_date">Head Date</label>
            </div>
            <div class="input-field">
              <input type="text" name="delieved_date" id="delieved_date" class="datepicker delieved_date">
              <label for="delieved_date">Delieved Date</label>
            </div>
            <div class="input-field">
              <button class="btn blue judgement_save">Save</button>
            </div>
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
      </div>
      <!-- add judgement -->
      <!-- alert -->
      <div class="doc_delete_form confirm_form z-depth-3 white">
        <form method="post">
          <center>
          <input type="hidden" id="doc_to_delete_input" value="0">
          <input type="hidden" id="todelitem" value="">
          <div class="row">
            <div class="col s12"><p>YOU ARE ABOUT TO DELETE <span id="note_val"></span>.</p></div>
            <div class="col s6">
              <a class="btn dcancel blue">Cancel</a>
            </div>
            <div class="col s6">
              <a class="btn red proceed dproceed">Proceed</a>
            </div>
          </div>
          </center>
        </form>
      </div>
      <!-- alert end -->

      <input id="logged_in_id" type="hidden" value="<?php echo $_SESSION['judiciary_ID']; ?>">
    <script src="Static/js/jquery-3.2.1.min.js"></script>
    <script src="Static/materialize/js/materialize.min.js"></script>
    <script src="Static/js/api.js"></script>
    <script src="Static/js/main.js"></script>
    <script src="Static/js/deer.js"></script>
    <script src="Static/dist/js/winbox.min.js"></script>
    <script>
      getUserInfo(<?php echo  $_SESSION['judiciary_ID']; ?>);
      getJudgements(<?php echo $current_year ?>);
    </script>
</body>
</html>