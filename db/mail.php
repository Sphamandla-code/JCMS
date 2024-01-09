<?php

function multi_attach_mail($to, $subject, $message, $senderEmail, $senderName, $files = array()){ 
    // Sender info  
    $from = $senderName." <".$senderEmail.">";  
    $headers = "From: $from"; 
 
    // Boundary  
    $semi_rand = md5(time());  
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
 
    // Headers for attachment  
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";  
 
    // Multipart boundary  
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
    "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";  
 
    // Preparing attachment 
    if(!empty($files)){ 
        for($i=0;$i<count($files);$i++){ 
            if(is_file($files[$i])){ 
                $file_name = basename($files[$i]); 
                $file_size = filesize($files[$i]); 
                 
                $message .= "--{$mime_boundary}\n"; 
                $fp =    @fopen($files[$i], "rb"); 
                $data =  @fread($fp, $file_size); 
                @fclose($fp); 
                $data = chunk_split(base64_encode($data)); 
                $message .= "Content-Type: application/octet-stream; name=\"".$file_name."\"\n" .  
                "Content-Description: ".$file_name."\n" . 
                "Content-Disposition: attachment;\n" . " filename=\"".$file_name."\"; size=".$file_size.";\n" .  
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
            } 
        } 
    } 
     
    $message .= "--{$mime_boundary}--"; 
    $returnpath = "-f" . $senderEmail; 
     
    // Send email 
    $mail = mail($to, $subject, $message, $headers, $returnpath);  
     
    // Return true if email sent, otherwise return false 
    if($mail){ 
        return true; 
    }else{ 
        return false; 
    } 
}

function rrmdir($dir)
{
 if (is_dir($dir))
 {
  $objects = scandir($dir);

  foreach ($objects as $object)
  {
   if ($object != '.' && $object != '..')
   {
    if (filetype($dir.'/'.$object) == 'dir') {rrmdir($dir.'/'.$object);}
    else {unlink($dir.'/'.$object);}
   }
  }

  reset($objects);
  rmdir($dir);
 }
}

if(isset($_POST['send_mail'])){

    $mydir = "./webfiles/mail_files";
           
    rrmdir($mydir);

    if (!file_exists('./webfiles/mail_files/')) {
        mkdir('./webfiles/mail_files/');
    }

    $targetDir = "./webfiles/mail_files/";
    $allowTypes = array('jpg','png','jpeg','gif','pdf','doc','docx');

    $statesMsg = "";
    $fileNames = array_filter($_FILES['files']['name']);

    if(!empty($fileNames)){
        foreach($_FILES['files']['name'] as $key=>$val){ 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION)); 

            if(in_array($fileType, $allowTypes)){ 
                
                move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath);
            }else{ 
                $statesMsg .= $_FILES['files']['name'][$key].' err |'; 
            } 
        }
    }

    echo $statesMsg;

    $files = array();


    if (is_dir($targetDir)){
        if ($dh = opendir($targetDir)){
          while (($file2 = readdir($dh)) !== false){
            $files[] = $targetDir.$file2;
          }
          closedir($dh);
        }else{
            echo "failed to open file directory";
        }
      }else{
          echo "Nothing available to Send";
      }

    $to = 'info@judiciary.org.sz'; 
    $sql = "SELECT email FROM Subscriber";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $to .= ", ".$row['email'];
    }
    } else {
    echo "0 results";
    }

    $from = 'info@judiciary.org.sz'; 
    $fromName = 'Judiciary Eswatini'; 
    
    $subject = $_POST['subject'];
    $htmlContent = '<span>'.$_POST['message'].'</span>
        <p>Kind Regards:</p>
        <br>
        <p>The Judiciary of Eswatini</p>
        ';

    $sendEmail = multi_attach_mail($to, $subject, $htmlContent, $from, $fromName, $files); 

    // Email sending status 
    if($sendEmail){ 
        echo 'The email is sent successfully.'; 
    }else{ 
        echo 'Email sending failed!'; 
    }
        
}

?>