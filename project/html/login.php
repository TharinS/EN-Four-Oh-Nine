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
    <?php
$isLoggedIn = false;

?>
    <!-- Adding the menu for navigation between html pages -->
        <?php
$activePage = "login";
include ("menu.inc")
?>
    <main>
    <br><br><br><br>
        <!-- Including header found throughout all site pages -->
        <?php include ("header.inc") ?>
        <!-- Setting the field for questions about student information -->
        <fieldset class="fieldset-border general-settings mobile-padding">
            <form method="post" action="loginverify.php">
                <section>
                    <h2 class="font-general headings">Login</h2>
                        <p class="font-general paragraph">
                            <label for="username">Username or Student ID: </label>
                            <input type="text" name="username" id="username" />
                        </p>
                        <p class="font-general paragraph">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" />
                        </p>
                </section>
                <br>
                <!-- Including buttons to submit and reset the values in the form -->
                <div class="form-button">
                    <input class="center sameline" type="submit" value="Login" />
                    <a href="signup.php" class="log-button center sameline">Create an account</a>
                </div>
            </form>
        </fieldset>
        <p class="font-general paragraph"></p>
        <br><br>
        <!-- Including header found throughout all site pages -->
    </main> 
    <?php
$stayAtBottom = true;
include ("footer.inc");
?>
</body>

</html>
