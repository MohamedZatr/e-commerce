<?php 
	session_start();
	$NoNavBar = '';
    include 'preperdata.php';
    $pageTitle = lang('LOGIN');
    include "init.php";
    if(isset($_SESSION['username']))
	{
		header("Location: dash.php");
		exit();
	}

// check If the User Coming From HTTP Post Request 
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$username = $_POST['user'];
		$password = $_POST['pass'];
		$hashedPassword = sha1($password);

		// Check the User Exist In the Data Base
		$stmt = $con->prepare("SELECT 
                                    UserID, UserName, Password, RegStatus, GroupID
                              FROM 
                                    users 
                              WHERE 
                                    UserName = ? AND Password = ? 
                            
                                    LIMIT 1 ");
		$stmt->execute(array($username,$hashedPassword));
		$result = $stmt->fetch();
        $rowCount = $stmt->rowCount();    
        echo '<pre>';
        print_r($result);
        echo '</pre>';
        $error = "";
		//If rowCount > 0 this mean data basr contain this user
		if(!empty($result)){ 
        if($result['RegStatus'] == 1){
             if($rowCount > 0){
                            if($result['GroupID'] == 1){
                            $_SESSION['username'] = $username;  // set the user name in session
                            $_SESSION['user_id']  = $result[0]; // ser the user id in session

                             header("Location: dash.php"); // redirct to hashboard Page
                            exit();  
                            }else{
                                                $_SESSION['username'] = $username;  // set the user name in session
                                                $_SESSION['user_id']  = $result[0]; // ser the user id in session

                                                header("Location: user.php"); // redirct to user Page
                                                exit();   
                            }
             }
         }else{
                $error = "Sorry ". $username ." You Can't LogIn Now You Can Login After Admin Active You";
            }
        }else{
             $error = "User Name Or Password is Not Correct";
        }
		
		
	}
	?>
<h5 class = 'text-center'>UserName:- Mohamed</h5>
<h5 class = 'text-center'>Password:- 123</h5>

					<form class = "login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
					<fieldset>
						<legend class="text-center">Admin Login</legend>						
                        <h6><?php if(!empty($error)){echo $error;}?></h6>
						<input class = "form-control" type = "text" name = "user" placeholder = "User Name" autocomplete = "off" />
						<input class = "form-control" type = "password" name="pass" placeholder = "Password" autocomplete = "new-password" />
						<input class = "btn btn-primary btn-block" type = "submit" value = "login" />
					</fieldset>
					</form>
<?php include $tpl . "footer.php"; ?>