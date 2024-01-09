<!DOCTYPE html>
<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Static/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="Static/css/style.css">
    <title>Login</title>
</head>
<body class="blue">
    <br><br>
    <center>
        <div class="row container myItems login_card ">
            <div class="col s12 m6 white login_form">
               <b>Judiciary Login</b>
               <br>
               <div class="input-field">
                   <input type="text" name="username" id="username">
                   <label for="username">Username</label>
               </div>
               <div class="s12"></div>
               <div class="input-field">
                   <input type="password" name="password" id="password">
                   <label for="password">Password</label>
               </div>
               <div class="input-field">
                   <button class="btn blue mylogin_btn">Login</button>
               </div>
            </div>
            <div class="col s12 m6 imgback hide-on-med-and-down">
               <div class="imgbackcover">
                    <img src="Static/imgs/logo.png" width="100px" alt="" class="circle responsive-img">
                    <br>
                    <h5 class="white-text">Judiciary of Eswatini</h5>
                    <p class="white-text">Welcome To Judiciary of Eswatini Web Panel <br>
                    <br>
                    <a href="http://judiciary.org.sz/" class="white-text"><u>Websites' Home Page</u></a>
                    </p>
               </div>
            </div>
        </div>
        
        <p class="white-text">Judiciary of Eswatini &copy; 2022</p>
    </center>

    <script src="Static/js/jquery-3.2.1.min.js"></script>
    <script src="Static/materialize/js/materialize.min.js"></script>
   <script src="Static/js/deer.js"></script>
   <script src="Static/js/api.js"></script>
   <script src="Static/js/main.js"></script>
   <script>
            document.onkeypress = keyPress;
            function keyPress(e){
            var x = e || window.event;
            var key = (x.keyCode || x.which);
            if(key == 13 || key == 3){
                _login();
            }
            }
    </script>
</body>
</html>