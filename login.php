<?php

    session_start();

    $wrong = "";
    if(isset($_POST['user_msg']) && $_POST['user_msg']!=""){
        $wrong = $_POST['user_msg'];
    }

    if(isset($_GET['user_msg']) && $_GET['user_msg']!=""){
        $wrong = $_GET['user_msg'];
    }

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Admin-Login</title>

		<meta charset="utf-8">
  		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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


          <link rel="stylesheet" href="css/login.css">

        <script language="javascript">
			document.addEventListener("contextmenu", function(e){
			    e.preventDefault();
			}, false);
		</script>

		<style type="text/css">

		body{
			position: absolute;
			top: 50%;
			left: 50%;
			margin-left: -250px;
			margin-top: -130px;
		}

		</style>

	</head>
	<body>
		<form action="login_check.php" class="login" method="POST">
          		<p>
			         <label for="login">&nbsp&nbsp&nbsp</label>
			     <h1> <input type="text" name="login" placeholder="Username" id="login" autofocus>
			    </p>

			    <p>
			      <label for="password">&nbsp&nbsp&nbsp</label>
			      <input type="password" name="password" placeholder="Password" id="password">
			    </p><center><a href="Forget_Password.php" style="color:grey">Forget Password!!!</a></center><br><br>

			    <p class="login-submit">
			      <button type="submit" class="login-button">Login</button>
			    </p>
			    <p class="message">
			    	<?php echo $wrong; ?>
			    </p>
		</form>
	</body>
</html>