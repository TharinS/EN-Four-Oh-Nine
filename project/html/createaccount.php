<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Adding the appropriate meta in the head tag -->
    <meta charset="UTF-8">
    <meta name="description" content="Quiz page - brief questions about APNG file format">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author" content="Tharin Sandipa">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Linking to necessary included images and css styles -->
    <link rel="icon" type="image/x-icon" href="../Images/APNGLogoNoBackground.png">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="import" href="'https://fonts.googleapis.com/css?family=Rubik:700&display=swap'">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'>
    <title>Animated Portable Network Graphics</title>
</head>

<body>
    <!-- Adding the menu for navigation between html pages -->
    <?php
    include ("menu.inc")
    ?>
    <main>
        <br><br><br><br>
        <?php
        include ("header.inc")
        ?>
        <fieldset class="fieldset-border general-settings mobile-padding">
            <?php
            include ('mysqlfunctions.php');
            include ('settings.php');

            $username = ""; 
            $password = ""; 
            $studentID = "";
            $firstname = "";
            $lastname = "";
            $privilege = "";

            $errMsg = "";
            $mysqlErrMsg = "";

            // Checking if the userid was entered
            if (isset($_POST['sid']))
            {
                // Checking if the userid is empty
                if ($_POST['sid'] == "")
                {
                    $errMsg .= "Student ID cannot be empty<br>";
                }
                // Checking if the userid is either 7 or 10 numerical digits 
                else if (!preg_match("/^[\d]{7}$|^[\d]{10}$/", $_POST['sid']))
                {
                    $errMsg .= "Student ID can only have numbers that are 7 or 10 digits long<br>";
                }
                $studentID = $_POST['sid'];
            }
            else
            {
                $errMsg .= "Student ID was not set.<br>";
            }

            // Checking if the password was entered
            if (isset($_POST['password']))
            {
                // Checking if the password is empty
                if ($_POST['password'] == "")
                {
                    $errMsg .= "Password cannot be empty.<br>";
                }

                $password = $_POST['password'];
            }
            else
            {
                $errMsg .= "Password was not set.<br>";
            }

            // Checking if the username was entered
            if (isset($_POST['username']))
            {
                // Checking if the username is empty or if it does not match the regular expression
                if ($_POST['username'] == "")
                {
                    $errMsg .= "Username cannot be empty.<br>";
                }
                else if (!preg_match("/^(?![0-9._])(?!.*[0-9._]$)(?!.*\d_)(?!.*_\d)[a-zA-Z0-9_-]+$/", $_POST['username']))
                {
                    $errMsg .= "Username contains speacial characters only underscores and hypens are allowed.<br>";
                }
                $username = $_POST['username'];
            }
            else
            {
                $errMsg .= "Username was not set.<br>";
            }

            // Checking if the first name was entered 
            if (isset($_POST['firstname']))
            {
                // Checking if the first is empty or does not match the regular expression
                if ($_POST['firstname'] == "")
                {
                    $errMsg .= "First name cannot be empty.<br>";
                }
                else if (!preg_match("/^[a-zA-Z-\s]{0,30}$/", $_POST['firstname']))
                {
                    $errMsg .= "First name can only contain letters, hypens and spaces.<br>";
                }
                $firstname = $_POST['firstname'];
            }
            else
            {
                $errMsg .= "First name was not set.<br>";
            }

            // Checking if the last name was entered
            if (isset($_POST['lastname']))
            {   
                // Checking if the last name was entered or dose not match the regular expression
                if ($_POST['lastname'] == "")
                {
                    $errMsg .= "Last name cannot be empty.<br>";
                }
                else if (!preg_match("/^[a-zA-Z-\s]{0,30}$/", $_POST['lastname']))
                {
                    $errMsg .= "Last name can only contain letters, hypens and spaces.<br>";
                }
                $lastname = $_POST['lastname'];
            }
            else
            {
                $errMsg .= "Last name was not set.<br>";
            }

            // Checking admin privileges of the logged in user
            if (isset($_POST['adminPrivilege']))
            {
                $privilege = "ADMIN";
            }
            else
            {
                $privilege = "STUDENT";
            }

            // Displaying the error messages if there are any
            if ($errMsg != "")
            {
                echo "<p class=\"font-general paragraph\">{$errMsg}</p>";
                echo "<button onclick=\"history.back()\" class=\"log-button\">Go Back</button>";
            }
            else
            {
                // Running the create user query and checking if it failed, if it passed then displaying user details for the new user to take note of
                $mysqlErrMsg = createUser($host, $user, $pwd, $sql_db, $username, $password, $studentID, $firstname, $lastname, $privilege);
                if ($mysqlErrMsg != "")
                {
                    echo "<p class=\"font-general paragraph\">{$mysqlErrMsg}</p>";
                    echo "<button onclick=\"history.back()\" class=\"log-button\">Go Back</button>";
                }
                else
                {
                    echo "<p class=\"font-general paragraph\">Congratulations Account for : <br><br> Username - {$username} <br> Name - {$firstname} {$lastname} <br> ID - {$studentID} <br><br> was created you may now login to your new account.</p>";

                }
            }
            ?>
        </fieldset>
        <!-- Including header found throughout all site pages -->
    </main> 
    <?php
    $stayAtBottom = true;
    include ("footer.inc")
    ?>
</body>

</html>
