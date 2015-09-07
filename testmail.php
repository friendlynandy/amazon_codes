<?php
$mailto="raghunadh2006ster@outlook.com";
 $subject="mail test";
 $content="test";
 $result=mail($mailto, $subject, $content);
 if($result){
    echo "mail success";
 }else  {
    error_log($mailto, 0);  
    echo "mail fail";
 }
?>
