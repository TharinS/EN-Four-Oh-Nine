<?php 
	include_once('general.php');
	$mysqlErrMsg = "";

    function checkifUserExist($host, $user, $pwd, $sql_db, $username) {
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

        if(!$conn) {
        	return "Error: Cannot connect to database<br>";
        } else {
        	$table = "USERS";
        	if(isItStudentID($username)){
        		$sqlquery = "Select * from {$table} where STUDENTID = '{$username}'";
        	} else {
        		$sqlquery = "Select * from {$table} where USERNAME = '{$username}'";
        	}
            $result = mysqli_query($conn, $sqlquery);
        	if (mysqli_num_rows($result) == 0) {
  				return FALSE;
			}
        	return TRUE;
        }
        mysqli_close($conn);
    }

    function checkifUserAttemptedQuiz($host, $user, $pwd, $sql_db, $userid) {
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

        if(!$conn) {
            return "Error: Cannot connect to database<br>";
        } else {
            $checkstatement = "Select USERS.STUDENTID from USERS, ATTEMPT WHERE USERS.STUDENTID = ATTEMPT.STUDENTID  AND ATTEMPT.STUDENTID = '{$userid}'";
            $check = mysqli_query($conn, $checkstatement);
            if (mysqli_num_rows($check) === 0) {
                return FALSE;
            }
            return TRUE;
        }
        mysqli_close($conn);
    }

    function createUser($host, $user, $pwd, $sql_db, $username, $password, $studentID, $firstname, $lastname, $privilege){
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

        if(!$conn) {
        	return "Error: Cannot connect to database<br>";
        } else {
        	if(!checkifUserExist($host, $user, $pwd, $sql_db, $username)){
        		$table = "USERS";
        		$sql = "INSERT INTO {$table}(STUDENTID, PWD, USERNAME, FIRSTNAME, LASTNAME, PRIVILEGE) VALUES ('{$studentID}','{$password}','{$username}','{$firstname}','{$lastname}','{$privilege}')";
                $result = mysqli_query($conn, $sql);
        		if ($result === FALSE) {
  					echo "Error: " . $sql . "<br>" . mysqli_error($result) . "<br>";
				}
        		return "";
        	} else {
        		return "Error: User already exists<br>";
        	}
        }
        mysqli_close($conn);
    }

    function loginPass($host, $user, $pwd, $sql_db, $username, $password) {
    	$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

        if(!$conn) {
        	echo "Error: Cannot connect to database<br>";
        } else {
        	$table = "USERS";
        	if(isItStudentID($username) == true){
        		$sqlquery = "Select STUDENTID, FIRSTNAME, LASTNAME, PWD, USERNAME, PRIVILEGE from {$table} where STUDENTID = '{$username}'";
        	} else {
        		$sqlquery = "Select STUDENTID, FIRSTNAME, LASTNAME, PWD, USERNAME, PRIVILEGE from {$table} where USERNAME = '{$username}'";
        	}
            $result = mysqli_query($conn, $sqlquery);
            if ($result === FALSE) {
                echo "Error: " . $sqlquery . "<br>" . mysqli_error($result) . "<br>";
            }
        	if (mysqli_num_rows($result) == 1) {
                $rowData = $conn->query($sqlquery)->fetch_assoc();
                if(isItStudentID($username) == true){
                    if($username != $rowData['STUDENTID']){
                        return false;
                    }
                } else {
                    if($username != $rowData['USERNAME']){
                        return false;
                    }
                }
                if($password != $rowData['PWD']){
                    return false;
                } else {
                    $_SESSION['userName'] = $rowData['USERNAME'];
                    $_SESSION['userID'] = $rowData['STUDENTID'];
                    $_SESSION['userPrivilege'] = $rowData['PRIVILEGE'];
                }
  				return true;
			}
        	return false;
        }
        mysqli_close($conn);
    }
?>