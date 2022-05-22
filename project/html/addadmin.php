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
    $activePage = "login";
    include ("menu.inc");

// Checks if the user has logged in if not redirect to the login page
    if (!isset($_SESSION['userName']))
    {
        echo "<p class=\"font-general paragraph\">You need to be signed into an appropriate account to use this page, please wait 5 seconds for you to be redirected to the login page.<br>Thank you for you're patience</p>";
        header("Refresh: 5; url=\"login.php\"");
    }

// Check if user has proper privileges to view this page
    if (!(isset($_SESSION['userPrivilege']) && $_SESSION['userPrivilege'] == "ADMIN"))
    {
        echo "<p class=\"font-general paragraph\">Your account needs administrator rights inorder to use this page contact the owner if you should have access to this page, please wait 5 seconds for you to be redirected to the homepage.<br>Thank you for you're patience</p>";
        header("Refresh: 5; url=\"index.php\"");
    }
    ?>
    <main>
        <br><br><br><br>
        <!-- Including header found throughout all site pages -->
        <?php include ("header.inc") ?>
        <!-- Getting text from the user for a new admin account -->
        <fieldset class="fieldset-border general-settings mobile-padding">
            <form method="post" action="createaccount.php">
                <section>
                    <h2 class="font-general headings">Enter details of new administrator : </h2>
                    <p class="font-general paragraph">
                        <label for="sid">Admin ID: </label>
                        <input type="text" name="sid" id="sid" />
                    </p>
                    <p class="font-general paragraph">
                        <label for="username">Username: </label>
                        <input type="text" name="username" id="username" />
                    </p>
                    <p class="font-general paragraph">
                        <label for="firstname">First Name: </label>
                        <input type="text" name="firstname" id="firstname" />
                    </p>
                    <p class="font-general paragraph">
                        <label for="lastname">Last Name: </label>
                        <input type="text" name="lastname" id="lastname" />
                    </p>
                    <p class="font-general paragraph">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" />
                    </p>
                </section>
                <br>
                <!-- Including buttons to submit and reset the values in the form -->
                <div class="form-button">
                    <input type="submit" name="adminPrivilege" value="Create Account" />
                    <input type="reset" value="Reset" />
                </div>
            </form>
        </fieldset>

        <br><br>
    </main> 
    <?php
    // Including generic footer in the bottom of the page
    include ("footer.inc")
    ?>
</body>

</html>
