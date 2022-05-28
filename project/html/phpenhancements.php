<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Topic/about page - brief description and history about the APNG file format">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author" content="Tharin Sandipa">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../Images/APNGLogoNoBackground.png">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="import" href="'https://fonts.googleapis.com/css?family=Rubik:700&display=swap'">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'>
    <title>Animated Portable Network Graphics</title>
</head>

<body>
    <?php
        $activePage = "php";   
        include("menu.inc");
    ?>
    <!-- Breaks nav bar if not used -->
    <br><br><br><br>
    <main>
        <?php include("header.inc") ?>
        <section>
            <fieldset class="fieldset-settings general-settings">
                <h2 class="font-general headings">Enhancement 1 - User Accounts</h2>
                <p class="font-general paragraph">a new visitor can create and login to a student account after entering the required details and administrators are allowed to make new admin accounts. The user is able to login and out whenever they want and can see a different menu depending on which page they are currently in and also what level of privilege thier account has. The implementation of this feature was made possible thanks to seperating the users data and student's quiz attempts into seperate tables linked together with a foriegn key relationship.</p>
                <ol>
                    <li class="font-general">Greeting message that contains the username and id of the logged in account.</li>
                    <li class="font-general">Pages behave differently depending on whether the user is logged in or not and what level of privilege the user's account has for example students cannot view the manage page and the admins cannot view the quiz page.
                    </li>
                </ol>
                <br><br>
                <a href="login.php" class="go-button">Go to Example</a>
            </fieldset>
        </section>
        <section>
            <fieldset class="fieldset-settings general-settings">
                <h2 class="font-general headings">Enhancement 2 - Interactive Table for Admins</h2>
                <p class="font-general paragraph">Administrator can filter and even sort the data that is displayed on the table almost like they were writing an actual query
                </p>
                <ul>
                    <li class="font-general">Admin can filter students who all aced the tests or only those who have failed</li>
                </ul>
                <p class="font-general paragraph">Sources - <a class="link" href="https://www.w3schools.com/css/css3_animations.asp">w3schools - Animations</a></p>
                <br><br>
                <a href="manage.php" class="go-button">Go to Example</a>
            </fieldset>

        </section>
        <br><br><br><br>
    </main>
        <?php include("footer.inc") ?>
</body>

</html>