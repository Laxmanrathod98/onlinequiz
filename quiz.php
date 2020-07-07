<?php
	require_once("scripts/connect_db.php");

	$selecting_quiz = $con->query("SELECT quiz_id, display_questions, time_allotted, quiz_name
									FROM quizes WHERE set_default=1");
	$selecting_quiz_row = $selecting_quiz->fetch_assoc();



 
	if(isset($_POST['rollno']) && $_POST['rollno'] != "")
	{
		
	 
		$roll_no = $_POST['rollno'];
		$roll_no = htmlspecialchars($roll_no);
		$roll_no = $con->escape_string($roll_no);

		$total_questions = preg_replace('/[^0-9]/', "", $selecting_quiz_row['display_questions']);

	 
		$total_time = (preg_replace('/[^0-9]/', "", $selecting_quiz_row['time_allotted']))*60;

		$final_quiz_ID = preg_replace('/[^0-9]/', "", $selecting_quiz_row['quiz_id']);

		$quzz_name = $selecting_quiz_row['quiz_name'];

	 
		$userCheck = $con->query(" SELECT id FROM quiz_takers 
										WHERE username = '$roll_no' 
										AND quiz_id='$final_quiz_ID' ")or die("mysql_error()");
	 
		if(!($userCheck->num_rows < 1)){
			$user_msg = 'Sorry, but '.$roll_no.', has already attempted the quiz, '.$quzz_name.'!';
			header('location: index.php?user_msg='.$user_msg.'');
			exit();
		}else{
	 
		$con->query("INSERT INTO quiz_takers (username, percentage, date_time, quiz_id, duration) 
					 VALUES ('$roll_no', '0', now(), '$final_quiz_ID', '0')")or die("mysql_error()");
		}
	}else{
		$user_msg = 'Hey, This is the start Page, So enter your username here first';
		header('location: index.php?user_msg='.$user_msg.'');
			exit();
	}


 
	$m_output='';
 
 
	$m_questions_from_DB = $con->query("SELECT * FROM questions WHERE quiz_id='$final_quiz_ID'
								ORDER BY rand() LIMIT $total_questions");

		while ($m_questions_from_DB->num_rows<1) {
			$user_msg = 'Hey, weird, but it seems there are no questions in this quiz!';
			header('location: index.php?user_msg='.$user_msg.'');
			exit();
		}

	 
		$m_display_ID = 1;

	 
		while($m_row = $m_questions_from_DB->fetch_assoc()){
		 
			$m_answers='';
				
		 
			$m_id = $m_row['id'];
			$m_thisQuestion = $m_row['question'];
			$m_type = $m_row['type'];
			$m_question_id = $m_row['question_id'];
			$m_code = $m_row['code'];
			$m_code_type = $m_row['code_type'];

		 
			$m_q = '<tr>
						<td width="40px" rowspan="1" align="center">
							<strong>'.$m_display_ID.'.</strong>
						</td>
						<td>
							<pre class="question_style"><strong><div style="width: 730px; word-wrap: break-word;">'.$m_thisQuestion.'</div></strong></pre>
						</td>
					</tr>';
		 
			if($m_code != "" && $m_code_type != ""){
				$m_q .='<tr>
						<td></td>
						<td id="hi123">
							<pre class="brush: '.$m_code_type.';">'.$m_code.'</pre>
						</td>
					</tr>
					';
			}

		 
			$m_options_from_DB = $con->query("SELECT * FROM answers 
									WHERE question_id='$m_question_id' ORDER BY rand()");

				$m_answers .=  '<tr>
									<td></td>
									<td>
								';
				 
					while($m_row2 =$m_options_from_DB->fetch_assoc()){
					 
						$m_answer = $m_row2['answer'];
						$m_answer_ID = $m_row2['id'];

						
						$m_answers .= ' <label style="cursor:pointer;">
									   		<input type="radio" name="rads'.$m_display_ID.'" value="'.$m_answer_ID.'">'.$m_answer.'</label>
										<br /><br />
									  ';
					}

					$m_answers .=  '</td>
								</tr>
								<tr height="20px">
								</tr>
								   ';



			 
				$m_output .= ''.$m_q.$m_answers;

				$m_display_ID++;

		}

		$m_display_ID--;

	 
		$m_output .= '  <tr>
							<td colspan="2" align="center">
								<span id="m_btnSpan">
									<a href="javascript:{}" onclick="quiz_submit()" class="myButton">Submit</a>
								</span>
							</td>
						</tr>';

	 
		$m_output .= '<input type="hidden" name="rollno" value="'.$roll_no.'">
					  <input type="hidden" name="total_ques" value="'.$m_display_ID.'">
					  <input type="hidden" name="total_time" value="'.$total_time.'">
					  <input type="hidden" name="quizID" value="'.$final_quiz_ID.'">
					  ';
?>


<!DOCTYPE html>
<html>

	<head>
		<title>Quiz</title>

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



        <link rel="stylesheet" type="text/css" href="sh/styles/shCore.css">
		<link rel="stylesheet" type="text/css" href="sh/styles/shThemeDefault.css">
		<script type="text/javascript" src="sh/scripts/shCore.js"></script>
	 <!-- INCLUDING ALL SCRIPTS FOR BRUSHES -->
		<script type="text/javascript" src="sh/scripts/shBrushAppleScript.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushAS3.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushBash.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushColdFusion.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushCpp.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushCSharp.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushCss.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushDelphi.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushDiff.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushErlang.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushGroovy.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushJava.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushJavaFX.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushJScript.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushPerl.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushPhp.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushPlain.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushPowerShell.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushPython.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushRuby.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushSass.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushScala.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushSql.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushVb.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushXml.js"></script>
		<script type="text/javascript">
		    SyntaxHighlighter.all()
		</script>

        <script type="text/javascript">
	     
			function quiz_submit(){
				window.onbeforeunload = null;
	            document.getElementById('quiz_form').submit(); 
	        }

	     
			function timer(secs){
				var ele = document.getElementById("countdown");
				ele.innerHTML = "Your Time Starts Now";			
				var mins_rem = parseInt(secs/60);
				var secs_rem = secs%60;
				
				if(mins_rem<10 && secs_rem>=10)
					ele.innerHTML = "Time Remaining: "+"0"+mins_rem+":"+secs_rem;
				else if(secs_rem<10 && mins_rem>=10)
					ele.innerHTML = "Time Remaining: "+mins_rem+":0"+secs_rem;
				else if(secs_rem<10 && mins_rem<10)
					ele.innerHTML = "Time Remaining: "+"0"+mins_rem+":0"+secs_rem;
				else
					ele.innerHTML = "Time Remaining: "+mins_rem+":"+secs_rem;

				if(mins_rem=="00" && secs_rem < 1){
					quiz_submit(); 
				}
				secs--;
			 
			 
				var time_again = setTimeout('timer('+secs+')',1000);
			}

		 
			function closeEditorWarning(){
    				return "really wanna quit!? You can't take the test again you know!";
			}
			window.onbeforeunload = closeEditorWarning;
        </script>

        <script language="javascript">
			document.addEventListener("contextmenu", function(e){
			    e.preventDefault();
			}, false);
		</script>
		<style type="text/css">
			
			.syntaxhighlighter .toolbar
			{
				background: white !important;
				display: none !important;
			}
		</style>
		
	</head>

	<body style="font-family: Arial;">

		<div align="center" style="background-color:#003366;color: white">
            <p style="margin: 0px; font-size: 54px">Online Quiz System</p>

        </div>

        <br><strong><?php echo $quzz_name; ?></strong>

        <div id="countdown">
        	<script type="text/javascript">
        		timer(<?php echo $total_time; ?>);
        	</script>
        </div>


		<div id="main_body" align="center" style="margin-bottom: 100px;">
			<form id="quiz_form" name="quiz_form_name" action="result.php" method="POST">
			<br /><BR /><BR />
				<table width="780px" align="center">
					<?php echo $m_output ?>
				</table>
			</form>
		</div>


		<div id="video" class="white_content">
            <a name="Planet_Earth">
                <video id="video_player" controls preload="meta" height="480">
                    <source src="videos/video.mp4" type='video/mp4' />
                    <source src="videos/video.webmhd.webm" type='video/webm' />
                    Your browser doesn't seem to support the video tag.
                </video>
                
            </a>
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
                        <td align="left" id="copyright">
                             Quiz
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
	</body>
</html