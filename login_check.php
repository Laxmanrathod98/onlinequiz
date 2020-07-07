<?php 


    include('scripts/connect_db.php');

    if(isset($_POST['login']) && $_POST['login'] != "" &&
       isset($_POST['password']) && $_POST['password'] != "" ){

        session_start();
        {
            $user=$con->escape_string($_POST['login']);
            $pass=$con->escape_string($_POST['password']);
            $fetch=$con->query("SELECT id FROM admins 
                                WHERE username='$user' and password='$pass'")or die("mysql_error()");
            $count=$fetch->num_rows;
            if($count!="")
            {
            
                $_SESSION['login_username']=$user;

                $con->query("UPDATE admins 
                             SET last_login=now()
                             WHERE username = '$user' ")or die("mysql_error()");

                header("Location:admin.php");
            }
            else
            {
                $user_msg = 'Wrong Username or Password!';
                header('location: login.php?user_msg='.$user_msg.'');
            }

        }
    } else{
        $user_msg = 'Sorry, but Something went wrong';
        header('location: admin.php?msg='.$user_msg.'');
    }
?>

