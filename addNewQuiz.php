<?php

	include('scripts/connect_db.php');

        if(isset($_POST['quizName']) && $_POST['quizName'] != ""
        && isset($_POST['quizTime']) && $_POST['quizTime'] != ""
        && isset($_POST['numQues']) && $_POST['numQues'] != ""){

            $qName=$con->escape_string($_POST['quizName']);
            $qTime=$con->escape_string($_POST['quizTime']);
            $nQues=$con->escape_string($_POST['numQues']);

            $qTime = preg_replace('/[^0-9]/', "", $qTime);
            $nQues = preg_replace('/[^0-9]/', "", $nQues);

            $fetch=$con->query("SELECT id FROM quizes 
                                WHERE quiz_name='$qName'")or die("mysql_error()");
            $count=$fetch->num_rows;
            if($count!="")
            {
            	$user_msg = 'Sorry, but \ '.$qName.' \ already exists!';
                header('location: admin.php?msg='.$user_msg.'');
            }else{
                $con->query("INSERT INTO quizes (quiz_name, display_questions, time_allotted) 
                	VALUES ('$qName','$nQues','$qTime')")or die("mysql_error()");
                
                $lastId = $con->insert_id();
                $con->query("UPDATE quizes SET quiz_id='$lastId' 
                                WHERE id='$lastId' LIMIT 1")or die("mysql_error()");

            	$user_msg = 'Quiz, \ '.$qName.' \ has been created!';
                header('location: admin.php?msg='.$user_msg.'');
            }
        }else{
            $user_msg = 'Sorry, but Something went wrong';
            header('location: admin.php?msg='.$user_msg.'');
        }
?>