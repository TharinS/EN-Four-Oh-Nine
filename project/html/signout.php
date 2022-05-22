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
            include("menu.inc") 
        ?>
    <main>
    <br><br><br><br>
        <!-- Including header found throughout all site pages -->
        <?php include("header.inc") ?>
        <!-- Setting the field for questions about student information -->
        <fieldset class="fieldset-border general-settings mobile-padding">
            <h2 class="font-general headings">Thank you, come again</h2>
            <p class="font-general paragraph">You have been signed out, Log back in to whenever you need</p>
            <?php 
                unset($_SESSION['userName']);
                unset($_SESSION['userID']);
                unset($_SESSION['userPrivilege']);

                header("Refresh: 5; url=\"index.php\"");
            ?>
            <p class="font-general paragraph">You may click the button below to go the homepage or wait for 5 seconds and you will be automatically redirected to the homepage.<br>Thank you for you're patience.</p>
            <a href="index.php" class="log-button">Back to homepage</a>
        </fieldset>
        <br><br>
        <!-- Including header found throughout all site pages -->
    </main> 
    <?php
        $stayAtBottom = true;
        include("footer.inc");
    ?>
</body>

</html>