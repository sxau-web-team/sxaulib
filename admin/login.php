<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require ('../includes/login_functions.inc.php');
	require ('../mysqli_connect.php');

//对传入的email和pass变量进行stripslashes函数转义  

	$user = $_POST[ 'email' ];
	$user = stripslashes( $user );
	

	$pass = $_POST[ 'pass' ];
	$pass = stripslashes( $pass );
	

	list ($check, $data) = check_login($dbc, $user, $pass);
	
	if ($check) { // OK!
		
		// Set the SESSION:
       // session_start();
        
		setcookie('user_id',$data['user_id'],time()+3600,'/','',0,0);
        setcookie('pass',$data['pass'],time()+3600,'/','',0,0);
        setcookie('first_name',$data['first_name'],time()+3600,'/','',0,0);
		//$_SESSION['first_name']=$data['first_name'];
		//Store  the HTTP_USER_AGENT:
        //$_SESSION['agent']=md5($_SERVER['HTTP_USER_AGENT']);
		// Redirect:
		redirect_user('loggedin.php');
			
	} else { // Unsuccessful!
		// Assign $data to $errors for error reporting
		// in the login_page.inc.php file.
		$errors = $data;
	}
	mysqli_close($dbc); 
} 

// Create the page:
//include ('../includes/login_page.inc.php');
?>
