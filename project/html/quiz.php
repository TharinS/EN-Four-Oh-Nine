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
$activePage = "quiz";
include ("menu.inc")
?>
    <br><br><br><br>
    <main>
        <br><br>
        <!-- Including header found throughout all site pages -->
        <?php include ("header.inc") ?>
        <!-- Setting the field for questions about student information -->
        <?php
if (!isset($_SESSION['userName']))
{
    echo "<p class=\"font-general paragraph\">You need to create an account and be signed in inorder to attempt this quiz, please wait 5 seconds for you to be redirected to the login page.<br>Thank you for you're patience</p>";
    header("Refresh: 5; url=\"login.php\"");
}
else if (isset($_SESSION['userPrivilege']) && $_SESSION['userPrivilege'] == "ADMIN")
{
    echo "<p class=\"font-general paragraph\">Administrators cannot attempt this quiz, please wait 5 seconds for you to be redirected to the homepage.<br>Thank you for you're patience</p>";
    header("Refresh: 5; url=\"index.php\"");
}
else
{
    echo "<fieldset class=\"fieldset-border general-settings mobile-padding\">
            <form method=\"post\" action=\"markquiz.php\">
                <section>
                    <h2 class=\"font-general headings\">A Quiz on the History of Animated Portable Network Graphics</h2>
                </section>
                <section>
                    <fieldset class=\"fieldset-border\">
                        <legend class=\"font-general\">
                            <h3>Five questions about Animated Portable Network Graphics</h3>
                        </legend>
                        <p class=\"font-general paragraph\">
                            <label for=\"creation\">Why were Animated Portable Network Graphics initially created?</label>
                        </p>
                        <p class=\"font-general paragraph\">
                            <textarea class=\"text-area\" id=\"creation\" name=\"creation\" rows=\"4\" cols=\"40\" placeholder=\"Write your answer here...\"></textarea>
                        </p>
                        <p class=\"font-general paragraph\">When were Animated Portable Network Graphics created?</p>
                        <p class=\"font-general paragraph\">
                            <label for=\"1997\">1997</label>
                            <input type=\"radio\" id=\"1997\" name=\"year\" value=\"1997\" />
                            <label for=\"2001\">2001</label>
                            <input type=\"radio\" id=\"2001\" name=\"year\" value=\"2001\" />
                            <label for=\"2004\">2004</label>
                            <input type=\"radio\" id=\"2004\" name=\"year\" value=\"2004\"  />
                            <label for=\"2007\">2007</label>
                            <input type=\"radio\" id=\"2007\" name=\"year\" value=\"2007\" />
                        </p>
                        <p class=\"font-general paragraph\">What type of chunks are Animated Portable Network Graphics separated into? (Select 3)</p>
                        <p class=\"font-general paragraph\">
                            <input type=\"checkbox\" id=\"fdAT\" name=\"fdAT\" value=\"fdAT\" />
                            <label for=\"fdAT\">Frame Data Chunk</label> <br>
                            <input type=\"checkbox\" id=\"acTL\" name=\"acTL\" value=\"acTL\" />
                            <label for=\"acTL\">Animation Control Chunk</label><br>
                            <input type=\"checkbox\" id=\"fake_chunk\" name=\"fake_chunk\" value=\"fake_chunk\" />
                            <label for=\"fake_chunk\">Frame Inspector Chunk</label><br>
                            <input type=\"checkbox\" id=\"fcTL\" name=\"fcTL\" value=\"fcTL\" />
                            <label for=\"fcTL\">Frame Control Chunk</label><br>
                        </p>
                        <p class=\"font-general paragraph\">
                            <label for=\"corporation\">Which corporation were the creators of Animated Portable Network Graphics from?</label>
                        </p>
                        <!-- Including a dropdown input question. With appropriate options -->
                        <p class=\"font-general paragraph\">
                            <select name=\"corporation\" id=\"corporation\">
                        <option value=\"\">Please Select</option>
                        <option value=\"microsoft\">Microsoft</option>           
                        <option value=\"google\">Google</option>
                        <option value=\"mozilla\">Mozilla</option>
                        <option value=\"apple\">Apple</option>
                    </select>
                        </p>
                        <!-- Including a text input question that only accepts digits as possible answers. With appropriate label's and inputs -->
                        <p class=\"font-general paragraph\">
                            <label for=\"color_bit\">The APNG file format supports</label>
                            <input type=\"text\" class=\"fill-in-blank\" id=\"color_bit\" name=\"color_bit\" > bit color as well as 8 bit transparency.
                        </p>
                    </fieldset>
                </section>
                <br>
                <!-- Including buttons to submit and reset the values in the form -->
                <div class=\"form-button\">
                    <input type=\"submit\" value=\"Submit\" />
                    <input type=\"reset\" value=\"Reset Form\" />
                </div>
            </form>
        </fieldset>";
}
?>
        <br><br>
        <!-- Including header found throughout all site pages -->
    </main>
        <?php
include ("footer.inc")
?>
</body>

</html>
