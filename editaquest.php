<?php


 
	if(isset($_POST['desc'])){
		if(!isset($_POST['iscorrect']) || $_POST['iscorrect'] == ""){
			echo "Sorry, important data to submit your question is missing. Please press back in your browser and try again and make sure you select a correct answer for the question.";
			exit();
		}

		if(!isset($_POST['type']) || $_POST['type'] == ""){
			echo "Sorry, there was an error parsing the form. Please press back in your browser and try again";
			exit();
		}

	 
		require_once("scripts/connect_db.php");

	 
		$question = $_POST['desc'];
		$program = $_POST['code_desc'];
		$programType = $_POST['prog-lang'];
		$answer1 = $_POST['answer1'];
		$answer2 = $_POST['answer2'];
		$answer3 = $_POST['answer3'];
		$answer4 = $_POST['answer4'];
		$type = $_POST['type'];
		$quizID = $_POST['quizID'];
		$q_id = $_POST['questionID'];

	 
		$quizID = preg_replace('/[^0-9]/', "", $quizID);
		$q_id = preg_replace('/[^0-9]/', "", $q_id);

	 
		$type = preg_replace('/[^a-z]/', "", $type);

	 
		$isCorrect = preg_replace('/[^0-9a-z]/', "", $_POST['iscorrect']);

	 
		$question = htmlspecialchars($question);
		$question = $con->escape_string($question);

		$program = htmlspecialchars($program);
		$program = $con->escape_string($program);

		$answer1 = htmlspecialchars($answer1);
		$answer1 = $con->escape_string($answer1);

		$answer2 = htmlspecialchars($answer2);
		$answer2 = $con->escape_string($answer2);

		$answer3 = htmlspecialchars($answer3);
		$answer3 = $con->escape_string($answer3);

		$answer4 = htmlspecialchars($answer4);
		$answer4 = $con->escape_string($answer4);



	 
		if($type == 'tf'){
		 
			if((!$question) || (!$answer1) || (!$answer2) || (!$isCorrect) || (!$q_id) || (!$quizID)){
				if($answer1=='0' || $answer2=='0')
				{
					
				}else{
					echo "Sorry, All fields must be filled in to add a new question to the quiz. Please press back in your browser and try again.";
					exit();
				}
			}
		}

	 
		if($type == 'mc'){
		 
			if((!$question) || (!$answer1) || (!$answer2) || (!$answer3) || (!$answer4) || (!$isCorrect) || (!$q_id) || (!$quizID)){
				if($question=='0' || $answer1=='0' || $answer2=='0' || $answer3=='0' || $answer4=='0')
				{
					
				}else{
					echo "Sorry, All fields must be filled in to add a new question to the quiz. Please press back in your browser and try again.";
					exit();
				}
			}
		}
		
	 
		$con->query(" UPDATE questions 
				SET quiz_id='$quizID', question='$question', code='$program', code_type='$programType', type='$type' 
				WHERE question_id='$q_id' ")or die("mysql_error()");

	 
		$con->query("DELETE FROM answers WHERE question_id='$q_id'")or die("mysql_error()");
		
 	 

	 
		if($type == 'tf'){
		 
			if($isCorrect == "answer1"){
				$sql2 = $con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer1', '1')")or die("mysql_error()");
				$con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer2', '0')")or die("mysql_error()");
				$msg = 'Thanks, question no.'.$q_id.' has been edited';
		  		header('location: admin.php?msg='.$msg.'');
				exit();
			}
		 
			if($isCorrect == "answer2"){
				$sql2 = $con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer2', '1')")or die("mysql_error()");
				$con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer1', '0')")or die("mysql_error()");
				$msg = 'Thanks, question no.'.$q_id.' has been edited';
				header('location: admin.php?msg='.$msg.'');
				exit();
			}	
		}

	 
		if($type == 'mc'){
		 
			if($isCorrect == "answer1"){
				$sql2 = $con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer1', '1')")or die("mysql_error()");
				$con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer2', '0')")or die("mysql_error()");
				$con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer3', '0')")or die("mysql_error()");
				$con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer4', '0')")or die("mysql_error()");
				$msg = 'Thanks, question no.'.$q_id.' has been edited';
			  	header('location: admin.php?msg='.$msg.'');
				exit();
			}
		 
			if($isCorrect == "answer2"){
				$sql2 = $con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer2', '1')")or die("mysql_error()");
				$con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer1', '0')")or die("mysql_error()");
				$con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer3', '0')")or die("mysql_error()");
				$con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer4', '0')")or die("mysql_error()");
				$msg = 'Thanks, question no.'.$q_id.' has been edited';
		  		header('location: admin.php?msg='.$msg.'');
				exit();
			}
		 
			if($isCorrect == "answer3"){
				$sql2 = $con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer3', '1')")or die("mysql_error()");
				$con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer1', '0')")or die("mysql_error()");
				$con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer2', '0')")or die("mysql_error()");
				$con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer4', '0')")or die("mysql_error()");
				$msg = 'Thanks, question no.'.$q_id.' has been edited';
		  		header('location: admin.php?msg='.$msg.'');
				exit();
			}
		 
			if($isCorrect == "answer4"){
				$sql2 = $con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer4', '1')")or die("mysql_error()");
				$con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer1', '0')")or die("mysql_error()");
				$con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer2', '0')")or die("mysql_error()");
				$con->query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$q_id', '$answer3', '0')")or die("mysql_error()");
				$msg = 'Thanks, question no.'.$q_id.' has been edited';
			  	header('location: admin.php?msg='.$msg.'');
				exit();
			}
		}
	}else{
        $user_msg = 'Sorry, but Something went wrong';
        header('location: admin.php?msg='.$user_msg.'');
    }
?>