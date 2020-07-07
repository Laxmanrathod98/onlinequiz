<?php 
session_start(); 

if (isset($_SESSION[‘views’]))  
{ 
    $_SESSION[‘views’] = $_SESSION[‘views’]+1; 
 }  
else
{
    $_SESSION[‘views’]=1;
}
echo "This web page view count is:”.$_SESSION[‘views’]; 
?>
