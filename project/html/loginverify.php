<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Adding the appropriate meta in the head tag -->
    <meta charset="UTF-8">
    <meta name="description" content="Quiz page - brief questions about APNG file format">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author" content="Joely Newman">
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
        <!-- Setting the field for questions about student information -->
        <?php
include ("header.inc")
?>
        <fieldset class="fieldset-border general-settings mobile-padding">
        <?php
include ('mysqlfunctions.php');
include ('settings.php');

$username = "";
$password = "";

$errMsg = "";
$mysqlErrMsg = "";

if (isset($_POST['password']))
{
    if ($_POST['password'] == "")
    {
        $errMsg .= "Password cannot be empty.<br>";
    }

    $password = $_POST['password'];
}
else
{
    $errMsg .= "Password was not entered.<br>";
}

if (isset($_POST['username']))
{
    if ($_POST['username'] == "")
    {
        $errMsg .= "Username cannot be empty.<br>";
    }
    $username = $_POST['username'];
}
else
{
    $errMsg .= "Username was not entered.<br>";
}

if ($errMsg != "")
{
    echo "<p class=\"font-general paragraph\">{$errMsg}</p>";
    echo "<button onclick=\"history.back()\" class=\"log-button\">Go Back</button>";
}
else
{
    $mysqlErrMsg = loginPass($host, $user, $pwd, $sql_db, $username, $password);
    if ($mysqlErrMsg == false)
    {
        echo "<p class=\"font-general paragraph\">Incorrect password or username or student id was entered</p>";
        echo "<button onclick=\"history.back()\" class=\"log-button\">Go Back</button>";
    }
    else
    {
        echo "<p class=\"font-general paragraph\">You've been logged in, please wait 5 seconds for you to be redirected to the homepage.<br>Thank you for you're patience</p>";
        header("Refresh: 5; url=\"index.php\"");
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
