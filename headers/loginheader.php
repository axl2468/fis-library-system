<?php
    function incorrectMessage($user) {
		echo '<script type="text/javascript">', 'alert("The username ' . $user . 'and password cannot be authenticated at the moment.");','</script>';
	}

	function generateSession($user) {
		//Generate random token and session
		session_regenerate_id();
		$_SESSION['id'] = session_id();
		$_SESSION['username'] = $user;
	}


	function PasswordValid($Password, $connection, $username) {
		

		if ($connection->connect_error) {
			die("Connection to server failed: " . $connection->connect_error) . "<br><a href='login.php' class='btn btn-primary'>Try again</div>";
		}
		else {
			$user_exist = "SELECT password FROM users WHERE username = '$username'";
			$user_check_result = $connection->query($user_exist);
			$user_check_result = $user_check_result->fetch_array();

			if(intval($user_check_result) == NULL) {
				$matches = FALSE;
			}
			else {
				$user_check_result = $user_check_result[0];
				if ($user_check_result == $Password) {
					$matches = TRUE;
				}
				else {
					$matches = FALSE;
				}
			}
	
		}
		return $matches;
		
	}
?>