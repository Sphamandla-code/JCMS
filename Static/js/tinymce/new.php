<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #title{
            width: 80%;
            height: 30px;
            padding: 10px 20px;
            border-radius: 50px;
        }
        .mybtn_{
            width: 100px;
            height: 50px;
            border-radius: 50px;
            background-color: rgb(49, 49, 228);
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <center><input type="text" id="title" placeholder="Title"></center>
    <br><br><textarea id="mytextarea">Hello, World!</textarea>
    <br><br>
    <button class="mybtn_">Save</button>

    <div class="joindate" style="display: none;"></div>
    <div class="jointime" style="display: none;"></div>
    <script src="tinymce.min.js"></script>
    <script src="../jquery-3.2.1.min.js"></script>
    <script src="../deer.js"></script>
    <script>

        $(".mybtn_").on("click",function(){
            deer.date({html:".joindate",format:"short"});
            deer.time({html:".jointime"});

            let jtime = $(".jointime").html();
            let jdate = $(".joindate").html();
            let title = $("#title").val();
            let news = tinymce.get('mytextarea').getContent();
            
            $.ajax({
                    type: 'GET',
                    url: '../../../db/api.php?callback=response',
                    data: {action:"addnews",
                        title:title,
                        news:news,
                        adate:jdate,
                        atime:jtime,
                        },
                    dataType: 'jsonp',
                    timeout: 6000,
                    context:$('body'),
                    success: function(data){
                    
                    if(data == "ok"){
                        alert("News Added");
                    }else if(data == "failed"){
                        alert("Error adding news. Please retry");
                    }
                    },
                    error: function(xhr, type){
                    alert('couldnot connect.');
                    }
            });

        });

        tinymce.init({
  
          selector: '#mytextarea',
  
          plugins: [
  
            'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
  
            'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
  
            'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
  
          ],
  
          toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
  
            'alignleft aligncenter alignright alignjustify | ' +
  
            'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
  
        });
  
      </script>
</body>
</html>