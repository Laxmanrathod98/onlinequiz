<?php

    

    if(isset($_POST["total_ques"]) && isset($_POST["rollno"]) && isset($_POST["quizID"]))
    {
        if($_POST["total_ques"] != "" && $_POST["rollno"] != "" && $_POST["quizID"] != "")
        {
            require_once("scripts/connect_db.php");

         
            $marks = 0;
            $total_questions = $_POST["total_ques"];
            $roll_no = $_POST["rollno"];
            $quiz_ID = $_POST["quizID"];

            if($total_questions>0){

	         
	            for($i=1 ; $i <= $total_questions ; $i++){
	                @$fetch_ID = "rads".$i;
	                @$php_id = $_POST[$fetch_ID];

	                $check_sql = $con->query("SELECT correct FROM answers 
	                                            WHERE id='$php_id'") or die("mysql_error()");
	                $q_answer = $check_sql->fetch_assoc();
	                $marks += $q_answer["correct"];
	            }
	            $percent = ($marks/$total_questions)*100;

	         
	            $get_time_query = $con->query("SELECT now() - date_time as dtime FROM quiz_takers 
	                                            WHERE username = '$roll_no' ") or die("mysql_error()");
	            $get_time = $get_time_query->fetch_assoc();
	            $time_taken = $get_time["dtime"];

	            $check_time_query = $con->query("SELECT duration FROM quiz_takers 
	                                            WHERE username = '$roll_no' 
	                                            AND quiz_id = '$quiz_ID' ") or die("mysql_error()");
	            $check_time = $check_time_query->fetch_assoc();
	            $duration = $check_time["duration"];

	            if($duration==0){
		         
	            	$con->query("UPDATE quiz_takers 
	                	         SET marks='$marks', percentage= '$percent', duration= '$time_taken', quiz_id= '$quiz_ID'
	                    	     WHERE username = '$roll_no' ")or die("mysql_error()");
	            }else{
	            	$user_msg = 'Sorry, but re-submission of the quiz isn\'t allowed!';
	        		header('location: index.php?user_msg='.$user_msg.'');
	            }
	        }else{
	        	$user_msg = 'Hey, Weird, but it seems the quiz had no questions!';
        		header('location: index.php?user_msg='.$user_msg.'');
            	exit();
	        }
        }else{
            $user_msg = 'Hey, Something went wrong! Tell the Admin!!';
        header('location: index.php?user_msg='.$user_msg.'');
            exit();
        }
    }else{
        $user_msg = 'Hey, This is the start Page!, So enter your username here first';
        header('location: index.php?user_msg='.$user_msg.'');
            exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Result</title>

        <meta charset="utf-8">

        <link rel="stylesheet" type="text/css" href="css/master.css">
        <script type="text/javascript" src="scripts/overlay.js"></script>



                <link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" href="img/faviconit/favicon.ico">
                <link rel="shortcut icon" type="image/x-icon" href="img/faviconit/favicon.ico">




                <link rel="icon" type="image/png" sizes="195x195" href="img/faviconit/favicon-195.png">

                <link rel="apple-touch-icon" sizes="152x152" href="img/faviconit/favicon-152.png">

                <link rel="apple-touch-icon" sizes="144x144" href="img/faviconit/favicon-144.png">

                <link rel="apple-touch-icon" sizes="120x120" href="img/faviconit/favicon-120.png">

                <link rel="apple-touch-icon" sizes="114x114" href="img/faviconit/favicon-114.png">

                <link rel="icon" type="image/png" sizes="96x96" href="img/faviconit/favicon-96.png">

                <link rel="apple-touch-icon" sizes="76x76" href="img/faviconit/favicon-76.png">

                <link rel="apple-touch-icon" sizes="72x72" href="img/faviconit/favicon-72.png">

                <link rel="apple-touch-icon" href="img/faviconit/favicon-57.png">

                <meta name="msapplication-TileColor" content="#FFFFFF">
                <meta name="msapplication-TileImage" content="img/faviconit/favicon-144.png">


        <script language="javascript">
            document.addEventListener("contextmenu", function(e){
                e.preventDefault();
            }, false);
        </script>
    </head>

    <body  style="font-family: Arial;">

        <div align="center" style="background-color:#003366;color: white">
            <p style="margin: 0px; font-size: 54px">Online  Quiz System</p>
       
        </div>

        <div id="score" align="center">
          Roll_NO: <?php echo $roll_no; ?>, You scored 
            <?php echo $marks; ?>/<?php echo $total_questions; ?>
        </div>
          <h2 style="colore:blue"><a href="index.php"> Click Here to LOGOUT</a></h2> 
        <div id="video" class="white_content" onclick="javascript:close_overlay();">
            <h1 style="color: WHITE; margin-top: 185px;">Nice Try, But its time to go now!</h1>
            <br>
            <h2 style="color: WHITE;">You should have watched it before..</h2>
        </div>

        <div id="fade_overlay">
            <a href="javascript:close_overlay();" style="cursor: default;">
                <div id="fade" class="black_overlay">
                </div>
            </a>
        </div>

        <div id="footer" align="bottom">
            <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                <tbody>
                    <tr>
                        <td align="left">
                             Quiz
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html