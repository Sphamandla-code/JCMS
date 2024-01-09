$("#user_dialog_tool").on('click',function(){
    $("#user_dialog").slideToggle();
});
$(".close_user_dialog").on('click',function(){
    $("#user_dialog").slideToggle();
});

$("#send_adduser_data").on('click',function(){
    let fullname = deer.getText("#fullname");
    let username = deer.getText("#username");
    let role = deer.getText("#role");
    let gender = deer.getText("#gender");
    let email = deer.getText("#email");
    let password = deer.encpyt(deer.getText("#password"));
    let vpassword = deer.encpyt(deer.getText("#vpassword"));
    deer.date({html:".joindate",format:"long"});
    let jdate = $(".joindate").html();
    
    if(email == "" || fullname == "" || username== "" || role== "" || gender == "" || password == ""){
        alert("You have empty fields");
    }else{
        if(password == vpassword){
            signup(fullname,username,role,gender,email,password,jdate);
        }else{
            alert("Password Missmatch");
        }
    }
 });

 $(".logout_mybtn").on("click",function(){
    logout();
 });

 $(".mylogin_btn").on("click",function(){
    _login();
 })

 $("#state_cheker").change(function() {
    if(this.checked) {
        state_change("active",deer.getText("#getnewUser"));
    }else{
        state_change("inactive",deer.getText("#getnewUser"));
    }
   });

   $("#save_new_password").on('click', function(){
    let new_pass = deer.encpyt(deer.getText("#change_password"));
    let old_pass = deer.encpyt(deer.getText("#old_change_password"));
    let newrole = deer.getText("#newrole");
    let new_name = deer.getText("#new_name");
    let id = deer.getText("#getnewUser");
    updatme(id,new_name,newrole,old_pass,new_pass);
   });

$("#news_to_delete").on("click",function(){
    $(".delete_form").slideToggle();
 });
$(".cancel").on("click",function(){
    $(".delete_form").slideToggle();
});
$(".jcancel").on("click",function(){
    $(".judge_delete_form").slideToggle();
});
$(".dcancel").on("click",function(){
    $(".doc_delete_form").slideToggle();
});
$(".delete_judge").on('click',function(){
    let judge = $(this).attr('judge_id');
    $("#judge_to_delete_input").val(judge);
    $(".judge_delete_form").slideToggle();
});
$(".update_judge").on('click',function () {
    let judge = $(this).attr('judge_id');
    jUpdate(judge);
});
$(".jproceed").on('click',function(){
    let jval = $("#judge_to_delete_input").val();
    del_judge(jval);
});
$(".dproceed").on('click',function(){
    let dval = $("#doc_to_delete_input").val();
    let dname = $("#todelitem").val();
    del_doc(dval,dname);
});
$(".mymessages").on("click", function(){
    let mymessages = $(this).attr('mymessages');
    
    $("#doc_to_delete_input").val(mymessages);
    $("#note_val").html("MESSAGE");
    $("#todelitem").val("del_message");
    mymessages_(mymessages);
});
$(".del_doc").on('click', function(){
    let doc_id = $(this).attr('doc_id');
    $("#doc_to_delete_input").val(doc_id);
    $("#note_val").html("DOCUMENT LINK");
    $("#todelitem").val("del_doc");
    $(".doc_delete_form").slideToggle();
});
$(".del_user").on('click', function(){
    let doc_id = $(this).attr('user_id');
    $("#doc_to_delete_input").val(doc_id);
    $("#note_val").html("USER");
    $("#todelitem").val("del_user");
    $(".doc_delete_form").slideToggle();
});
$('.del_message').on("click", function(){
    $(".doc_delete_form").slideToggle();
});
 function _login(){
    let user = deer.getText("#username");
    let pass = deer.encpyt(deer.getText("#password"));
    
    login(user,pass);
 }

$(".seach_user_input_show").on("click", function(){
    $(".seach_user_input").slideToggle();
});

$(".remove_pp_btn").on('click' ,function(){
    let doc_id = $("#getnewUser").val();
    if(doc_id == undefined){
        doc_id = $(this).attr('user_id');
    }
    $("#doc_to_delete_input").val(doc_id);
    $("#note_val").html("Profile Picture");
    $("#todelitem").val("remove_pp");
    $(".doc_delete_form").slideToggle();
    getUserInfo(doc_id);
});
$(".upload-button").on('click', function() {
    $(".upload_pp").click();
});
$(".upload_pp").on('change', function(){
    var fd = new FormData();
    var files = $('.upload_pp')[0].files;
    var id = $("#getnewUser").val();
    
    if(files.length > 0 ){
        fd.append('file',files[0]);
        fd.append('id',id);

        $.ajax({
            url: './db/api.php?callback=response',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                alert(response);
                if(id != ""){
                    getUserInfo(id);
                } 
            },
         });
    }
});

$(".reset_password_btn").on("click",function(){
    var str = deer.randomString(8);
    var id = $("#getnewUser").val();
    resetUserPassword(id,str);
});

 function logout(){
    $.ajax({
      type: 'GET',
      url: './db/api.php?callback=response',
      data: {action:"logout"},
      dataType: 'jsonp',
      timeout: 6000,
      context:$('body'),
      success: function(data){
        
        if(data == "ok"){
            setTimeout(() => {
              window.location = "index.php";
            }, 3000);
        }else{
          alert("Something went wrong");
        }
      },
      error: function(xhr, type){
        alert('couldnot connect.');
      }
  });
}

$(document).ready(function(){
    open_page({});
    $('.sidenav').sidenav();
    $('.carousel').carousel();
    $('select').formSelect();
    $('.modal').modal();
    $('.tooltipped').tooltip();
    $('.tabs').tabs();
    $('.datepicker').datepicker();
    $('.materialboxed').materialbox();
    $(".load_new_mail").on('click',function(){
        _winbox({title:"Compose Main",color:"lightblue",win:"content"})
    });
    $("#open-user-reset-win").on('click',function(){
        _winbox({title:"User Reset",color:"red",win:"user-reset-win"})
    });
    $("#open-add-news-win").on('click',function(){
        _winbox({title:"Add News",color:"linear-gradient(90deg, #ff00f0, #0050ff)",win:"add-news-win"})
    });

    $(".pager").on('click', function(){
        let page = $(this).attr('page');
        let my_id = $(this).attr('my_id');
        open_page({page:page,my_id:my_id});
    });

    $(".mynewsid").on('click', function(){
        let news = $(this).attr('news_id');
        $("#news_to_delete_input").val(news);
        getNews(news);
    });

    setInterval(() => {
        time({html:".mytime"});
        date({html:".mydate"});
    }, 1000);
});


$(".judgement_save").on('click', function(){

    let year = deer.getText("#delieved_date").split(", ")[1];

    add_judgements({
        _Num: deer.getText("#casenumber"),
        name: deer.getText("#casename"),
        judge: deer.getText("#judgement_judge"),
        h_date: deer.getText("#head_date"),
        d_date: deer.getText("#delieved_date"),
        court: deer.getText("#court"),
        year: year
    });

});

$(".orange").on('click', function(){
    alert("me");
});

$(".year_folder").on('click', function(){
    let current_year =  $(this).attr("folder_name");
    getJudgements(current_year);
});

$(".update_add_doc").on('click',function(){
    let my_doc_id = $(this).attr("doc_id");
    deer.setText("#mydoc_jID",my_doc_id);
    $(".upload_docJudgement").click();
});

$("#syncdb").on("click", function(){

    syncnewsdata();

})

$(".upload_docJudgement").on('change', function(){

    var jd = new FormData();
    var files = $(".upload_docJudgement")[0].files;
    var id = $("#mydoc_jID").val();

    if(files.length > 0){
        jd.append('file1',files[0]);
        jd.append('id',id);

        $.ajax({
            url: './db/api.php?callback=response',
            type: 'post',
            data: jd,
            contentType: false,
            processData: false,
            success: function(response){
                alert(response[1]);
            },
         });

    }else{
        alert("no file selected");
    }

});

function time({format,html,second}){
    let d = new Date();
    let hour = d.getHours();
    let minutes = d.getMinutes();
    let seconds = d.getSeconds();

    if(hour < 10){
        hour = 0+""+hour;
    } if(minutes < 10){
        minutes = 0+""+minutes;
    } if(seconds < 10){
        seconds = 0+""+seconds;
    }
    if(format == "12hrs"){
        if(hour > 12){
            hour = hour - 12;
            if(second == true){
                $(html).html(hour+" : "+minutes+" : "+seconds+" PM");
            }else{
                $(html).html(hour+" : "+minutes+" PM");
            }
        }
        if(hour < 12){
            if(second == true){
                $(html).html(hour+" : "+minutes+" : "+seconds+" AM");
            }else{
                $(html).html(hour+" : "+minutes+" AM");
            }
        }
        if(hour == 12){
            if(second == true){
                $(html).html(hour+" : "+minutes+" : "+seconds+" PM");
            }else{
                $(html).html(hour+" : "+minutes+" PM");
            }
        }
        
    }else{
        if(second == true){
            $(html).html(hour+" : "+minutes+" : "+seconds);
        }else{
            $(html).html(hour+" : "+minutes);
        }
    }

}

function date({html,format,days}){
    let d = new Date();
    let date = d.getDate();
    let day = d.getDay();
    let month = d.getMonth();
    let year = d.getFullYear();

    var daysInWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    var daysInIndex = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var mon= ["January","February","March","April","May","June","July","August","September","October","November","December"];
    var monthIndex = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug", "Sep", "Oct", "Nov", "Dec"];



    if(days == "short"){
        day = daysInIndex[day];
    }if(days == "long"){
        day = daysInWeek[day];
    }

    if(format == "long"){
        month = mon[month];
    }if(format == "short"){
        month = monthIndex[month];
    }

    if(days == null){

        if(format == null){
            month = month+1;
            if(month < 10){
                month = "0"+month;
            }
            if(date < 10){
                date = "0"+date;
            }
            $(html).html(date+"/"+month+"/"+year);
        }else{
            $(html).html(date+" "+month+" "+year);
        }
    }else{
        if(format == null){
            month = month+1;
            if(month < 10){
                month = "0"+month;
            }
            if(date < 10){
                date = "0"+date;
            }
            $(html).html(day+" "+date+"/"+month+"/"+year);
        }else{
            $(html).html(day+" "+date+" "+month+" "+year);
        }
        
    }
}

function _winbox({title,win,color}){
    new WinBox({

        title: title,
        background:color,
        border: 4,
        x: "center",
        y: "center",
        mount: document.getElementById(win)
        .cloneNode(true)
    });
}

function all_invisible(){
    $(".page-data").css({'display':'none'});
}

function open_page({page,my_id}){
    var LS = localStorage.getItem('jud_page');
    all_invisible();
    if(page == null){
        if(LS == null || LS == ""){
            localStorage.setItem('jud_page','dashboard');
        }
        page = LS;
    }else{
        localStorage.setItem('jud_page',page);
    }

    if(my_id == null){
        my_id = '0';
    }else{
        getUserInfo(my_id);
    }

    $("#"+page).slideToggle();

}


