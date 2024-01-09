function signup(fullname,username,role,gender,email,password,jdate){
    $.ajax({
        type: 'GET',
        url: './db/api.php?callback=response',
        data: {action:"signup",
               fullname:fullname,
               role:role,
               username:username,
               gender:gender,
               email:email,
               jdate:jdate,
               password:password},
        dataType: 'jsonp',
        timeout: 6000,
        context:$('body'),
        success: function(data){
          
          if(data == "username exist"){
              alert("Username taken");
          }else if(data == "added_user"){
            alert("User Added");
          }else if(data == "failed_user"){
            alert("Error adding user. Please retry");
          }
        },
        error: function(xhr, type){
          alert('couldnot connect.');
        }
 });
}

function login(username,password) { 
    $.ajax({
        type: 'GET',
        url: './db/api.php?callback=response',
        data: {action:"login",
               username:username,
               password:password},
        dataType: 'jsonp',
        timeout: 6000,
        context:$('body'),
        success: function(data){
          
          if(data == "ok"){
              window.location = "index.php";
          }else if(data == "failed"){
            alert("User Details Are incorrect");
          }else if(data == "inactive"){
            alert("This account is Deactiveted. Please contact admin for more information")
          }
        },
        error: function(xhr, type){
          alert('couldnot connect.');
        }
 });
}

function getNews(id){
  $.ajax({
      type: 'GET',
      url: './db/api.php?callback=response',
      data: {action:"getnews",
            id:id,},
      dataType: 'jsonp',
      timeout: 6000,
      context:$('body'),
      success: function(data){
        
        if(data == "failed"){
          alert("Error getting news");
        }else{
          $(".text_news").html(data);
        }
      },
      error: function(xhr, type){
        alert('couldnot connect.');
      }
  });
}

function del_judge(param) {
  $.ajax({
    type: 'GET',
    url: './db/api.php?callback=response',
    data: {action:"del_judge",
          id:param,},
    dataType: 'jsonp',
    timeout: 6000,
    context:$('body'),
    success: function(data){
      
      if(data == "failed"){
        alert("Error deleting Judge");
      }else if(data == 'ok'){
        alert("data deleted");
        window.location = 'index.php';
      }
    },
    error: function(xhr, type){
      alert('couldnot connect.');
    }
});
}

function jUpdate(param) {
  $.ajax({
    type: 'GET',
    url: './db/api.php?callback=response',
    data: {action:"jupdate",
          id:param,},
    dataType: 'jsonp',
    timeout: 6000,
    context:$('body'),
    success: function(data){
      
      if(data == "failed"){
        alert("Error getting Judge");
      }else {
        $("#jname").val(data[0]["Name"]);
        $("#position").val(data[0]["position"]);
        $("#jcourt").val(data[0]["court"]);
      }
    },
    error: function(xhr, type){
      alert('couldnot connect.');
    }
});
}

function save_doc(){
  let doc = deer.getText("#dname");
  let link = deer.getText("#dlink");

    $.ajax({
      type: 'GET',
      url: './db/api.php?callback=response',
      data: {action:"add_doc",
            doc:doc,
            link,link,
            date_:deer.getdate({format:"short",days:"short"})},
      dataType: 'jsonp',
      timeout: 6000,
      context:$('body'),
      success: function(data){
        if(data == "ok"){
          alert("Document Added");
        }else {
          alert("Error adding Document");
        }
      },
      error: function(xhr, type){
        alert('couldnot connect.');
      }
  });

}

function del_doc(param,param2) {
  $.ajax({
      type: 'GET',
      url: './db/api.php?callback=response',
      data: {action:param2,
            id:param,},
      dataType: 'jsonp',
      timeout: 6000,
      context:$('body'),
      success: function(data){
        alert(data);
        $(".doc_delete_form").slideToggle();
      },
      error: function(xhr, type){
        alert('couldnot connect.');
      }
  });
}

function mymessages_(param) {
  $.ajax({
      type: 'GET',
      url: './db/api.php?callback=response',
      data: {action:"mymessage",
            id:param,},
      dataType: 'jsonp',
      timeout: 6000,
      context:$('body'),
      success: function(data){
        $(".messages_show").html(data);
      },
      error: function(xhr, type){
        alert('couldnot connect.');
      }
  });
}

function getUserInfo(param) { 

  $.ajax({
    type: 'GET',
    url: './db/api.php?callback=response',
    data: {action:"getUserInfo",
          id:param,},
    dataType: 'jsonp',
    timeout: 6000,
    context:$('body'),
    success: function(data){
     if(data == "failed"){
      alert("Failed to get user data");
     }else{
      deer.setHTML({find:".getfullname",text:data[0]['Fullname']});
      deer.setHTML({find:".getusername",text:data[0]['username']});
      deer.setHTML({find:".getrole",text:data[0]['role']});
      deer.setHTML({find:".getcdate",text:data[0]['join_date']});
      deer.setHTML({find:".getcby",text:data[0]['create_by']});
      deer.setHTML({find:".getImage",text:`<img src="${data[0]['img']}" class="responsive-img materialboxed" alt="user-img">`});
      deer.setText("#new_name",data[0]['Fullname']);
      deer.setText("#newrole",data[0]['role']);
      deer.setText("#getnewUser",data[0]['user_id']);
      if(data[0]['state'] == "active"){
        $("#state_cheker").attr('checked', true);
      }else{
        $("#state_cheker").attr('checked', false);
      }
     }
    },
    error: function(xhr, type){
      alert('couldnot connect.');
    }
});

}

function state_change(state,id){
  
    $.ajax({
        type: 'GET',
        url: './db/api.php?callback=response',
        data: {action:"state_change",
              id:id,
              state:state,},
        dataType: 'jsonp',
        timeout: 6000,
        context:$('body'),
        success: function(data){
         alert(data);
        },
        error: function(xhr, type){
          alert('couldnot connect.');
        }
    });
  
}

function updatme(id,new_name,newrole,old_pass,new_pass) { 
  $.ajax({
      type: 'GET',
      url: './db/api.php?callback=response',
      data: {action:"updatme",
            id:id,
            new_name:new_name,
            newrole:newrole,
            old_pass,old_pass,
          new_pass,new_pass},
      dataType: 'jsonp',
      timeout: 6000,
      context:$('body'),
      success: function(data){
      alert(data);
      },
      error: function(xhr, type){
        alert('couldnot connect.');
      }
  });
 }

function searchUser(myval){
    $.ajax({
      type: 'GET',
      url: './db/api.php?callback=response',
      data: {action:"search",
            val:myval,
            },
      dataType: 'jsonp',
      timeout: 6000,
      context:$('body'),
      success: function(data){
      $(".user_search_list").html(data);
      },
      error: function(xhr, type){
        alert('couldnot connect.');
      }
  });
}
function resetUserPassword(id,v){
  let str = deer.encpyt(v);
  $.ajax({
    type: 'GET',
    url: './db/api.php?callback=response',
    data: {action:"resetPassword",
          id:id,
          val:str,
          },
    dataType: 'jsonp',
    timeout: 6000,
    context:$('body'),
    success: function(data){
     if(data == "ok"){
      alert(`New Password = ${v}`);
     }else{
      alert("Failed To Reset Password");
     }
    },
    error: function(xhr, type){
      alert('couldnot connect.');
    }
});
}

function add_judgements({_Num,name,judge,h_date,d_date,court,year}){
  $.ajax({
    type: 'GET',
    url: './db/api.php?callback=response',
    data: {action:"_add_judgements",
          _Num:_Num,
          name:name,
          judge:judge,
          h_date:h_date,
          d_date:d_date,
          court:court,
          year:year
          },
    dataType: 'jsonp',
    timeout: 6000,
    context:$('body'),
    success: function(data){
      alert(data);
    },
    error: function(xhr, type){
      alert('couldnot connect.');
    }
});
}

function getJudgements(year){

  $.ajax({
    type: 'GET',
    url: './db/api.php?callback=response',
    data: {action:"_get_judgements",
          year:year,
          },
    dataType: 'jsonp',
    timeout: 6000,
    context:$('body'),
    success: function(data){
      $(".row_judgement_list").html(data);
    },
    error: function(xhr, type){
      alert('couldnot connect.');
    }
});

}

function syncnewsdata(){
  $.ajax({
    type: 'GET',
    url: './db/api.php?callback=response',
    data: {action:"syncdata_news"},
    dataType: 'jsonp',
    timeout: 6000,
    context:$('body'),
    success: function(data){
      sendnewsToLite(data);
      //alert(data);
    },
    error: function(xhr, type){
      alert('couldnot connect.');
    }
});
}

function sendnewsToLite(str){
  $.ajax({
    type: 'GET',
    url: 'http://192.168.1.187:8080/boot/test.php?callback=response',
    data: {action:"syncdata_news",
          val:str,
    },
    dataType: 'jsonp',
    timeout: 6000,
    context:$('body'),
    success: function(data){
      alert(data);
    },
    error: function(xhr, type){
      alert('couldnot connect.');
    }
});
}