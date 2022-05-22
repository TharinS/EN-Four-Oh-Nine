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
    $activePage = "manage";
    include ("menu.inc");
    ?>
    <main>
        <br><br><br><br>
        <fieldset class="fieldset-border general-settings mobile-padding">
            <?php
            include ('general.php');
            include ('settings.php');
            include ('mysqlfunctions.php');

            if (!isset($_SESSION['userName']))
            {
                echo "<p class=\"font-general paragraph\">You need to be signed in inorder to view your results, please wait 5 seconds for you to be redirected to the login page.<br>Thank you for you're patience</p>";
                header("Refresh: 5; url=\"login.php\"");
            }
            else if (!(isset($_SESSION['userPrivilege']) && $_SESSION['userPrivilege'] == "ADMIN"))
            {
                echo "<p class=\"font-general paragraph\">Your account needs administrator rights inorder to use this page contact the owner if you should have access to this page, please wait 5 seconds for you to be redirected to the homepage.<br>Thank you for you're patience</p>";
                header("Refresh: 5; url=\"index.php\"");
            }
            else
            {

    // Converts a score to a percentage
                function convert_to_score($number, $maxnumber)
                {
                    $score = ceil(($number / 100) * $maxnumber);
                    return "{$score}";
                }

    // Converts a percentage back into a score
                function convert_to_percentage($number, $maxnumber)
                {
                    $percentage = ($number / $maxnumber) * 100;
                    return "{$percentage}";
                }

    // Default filters, when used in mysql it's effectively empty space
                $IDFILTER = "1";
                $USERNAMEFILTER = "1";
                $FNAMEFILTER = "1";
                $LNAMEFILTER = "1";
                $ATTEMPTFILTER = "1";
                $RESULTFILTER = "1";
                $SCOREFILTER = "1";
                $Q1FILTER = "1";
                $Q2FILTER = "1";
                $Q3FILTER = "1";
                $Q4FILTER = "1";
                $Q5FILTER = "1";

    //Checking if the submit button was clicked
                if (isset($_POST['submitButton']))
                {
        //Checking if the filter was filled and then updating corresponding variable
                    if ($_POST['idfilter'] != "")
                    {
                        $IDFILTER = "USERS.STUDENTID LIKE '{$_POST['idfilter']}%'";
                    }
        //Checking if the filter was filled and then updating corresponding variable
                    if ($_POST['usernamefilter'] != "")
                    {
                        $USERNAMEFILTER = "USERS.USERNAME LIKE '{$_POST['usernamefilter']}%'";
                    }
        //Checking if the filter was filled and then updating corresponding variable
                    if ($_POST['firstnamefilter'] != "")
                    {
                        $FNAMEFILTER = "USERS.FIRSTNAME LIKE '{$_POST['firstnamefilter']}%'";
                    }
        //Checking if the filter was filled and then updating corresponding variable
                    if ($_POST['lastnamefilter'] != "")
                    {
                        $LNAMEFILTER = "USERS.LASTNAME LIKE '{$_POST['lastnamefilter']}%'";
                    }
        //Checking if the filter was filled and then updating corresponding variable
                    if ($_POST['attemptfilter'] != "")
                    {
                        $ATTEMPTFILTER = "ATTEMPT.ATTEMPTNO = {$_POST['attemptfilter']}";
                    }
        //Checking if the filter was filled and then updating corresponding variable
                    if ($_POST['resultfilter'] != "")
                    {
                        $translated = convert_to_score($_POST['resultfilter'], 5);
            // Checking which option the user selected
                        if ($_POST['resultorderby'] == "lessorequal")
                        {
                            $RESULTFILTER = "ATTEMPT.RESULT <= '{$translated}'";
                        }
                        else if ($_POST['resultorderby'] == "equal")
                        {
                            $RESULTFILTER = "ATTEMPT.RESULT = '{$translated}'";
                        }
                        else if ($_POST['resultorderby'] == "greaterorequal")
                        {
                            $RESULTFILTER = "ATTEMPT.RESULT >= '{$translated}'";
                        }
                        else if ($_POST['resultorderby'] == "greater")
                        {
                            $RESULTFILTER = "ATTEMPT.RESULT > '{$translated}'";
                        }
                        else if ($_POST['resultorderby'] == "less")
                        {
                            $RESULTFILTER = "ATTEMPT.RESULT < '{$translated}'";
                        }
                    }
        //Checking if the filter was filled and then updating corresponding variable
                    if ($_POST['scorefilter'] != "")
                    {
            // Checking which option the user selected
                        if ($_POST['scoreorderby'] == "lessorequal")
                        {
                            $SCOREFILTER = "ATTEMPT.RESULT <= '{$_POST['scorefilter']}'";
                        }
                        else if ($_POST['scoreorderby'] == "equal")
                        {
                            $SCOREFILTER = "ATTEMPT.RESULT = '{$_POST['scorefilter']}'";
                        }
                        else if ($_POST['scoreorderby'] == "greaterorequal")
                        {
                            $SCOREFILTER = "ATTEMPT.RESULT >= '{$_POST['scorefilter']}'";
                        }
                        else if ($_POST['scoreorderby'] == "greater")
                        {
                            $SCOREFILTER = "ATTEMPT.RESULT > '{$_POST['scorefilter']}'";
                        }
                        else if ($_POST['scoreorderby'] == "less")
                        {
                            $SCOREFILTER = "ATTEMPT.RESULT < '{$_POST['scorefilter']}'";
                        }
                    }
        //Checking if the filter was filled and then updating corresponding variable
                    if ($_POST['question1filter'] != "")
                    {
                        $translated = strtolower($_POST['question1filter']);
                        $Q1FILTER = "ATTEMPT.QUESTION1 LIKE '{$translated}%'";
                    }
        //Checking if the filter was filled and then updating corresponding variable
                    if ($_POST['question2filter'] != "")
                    {
                        $translated = strtolower($_POST['question2filter']);
                        $Q2FILTER = "ATTEMPT.QUESTION2 LIKE '{$translated}%'";
                    }
        //Checking if the filter was filled and then updating corresponding variable
                    if ($_POST['question3filter'] != "")
                    {
                        $translated = strtolower($_POST['question3filter']);
                        $Q3FILTER = "ATTEMPT.QUESTION3 LIKE '{$translated}%'";
                    }
        //Checking if the filter was filled and then updating corresponding variable
                    if ($_POST['question4filter'] != "")
                    {
                        $translated = strtolower($_POST['question4filter']);
                        $Q4FILTER = "ATTEMPT.QUESTION5 LIKE '{$translated}%'";
                    }
        //Checking if the filter was filled and then updating corresponding variable
                    if ($_POST['question5filter'] != "")
                    {
                        $translated = strtolower($_POST['question5filter']);
                        $Q5FILTER = "ATTEMPT.QUESTION5 LIKE '{$translated}%'";
                    }
                }

                $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

                $tablerows = "";
                // Checking connection
                if (!$conn)
                {
                    echo "Error: Cannot connect to database<br>";
                }
                else
                {
                    // Checking if the id filter was filled or not
                    if ($IDFILTER == "1")
                    {
                        $studentIDsql = "SELECT STUDENTID FROM USERS WHERE NOT(PRIVILEGE = \"ADMIN\");";
                    }
                    else
                    {
                        $studentIDsql = "SELECT STUDENTID FROM USERS WHERE NOT(PRIVILEGE = \"ADMIN\") AND {$IDFILTER};";
                    }
                    $mysqlIDresult = mysqli_query($conn, $studentIDsql);
                    // Checking the last run query for errors
                    if ($mysqlIDresult === false)
                    {
                        echo "Error: " . $studentIDsql . "<br>" . mysqli_error($mysqlIDresult) . "<br>";
                    }
                    else
                    {
                        // Filling a table row based on if the user has previously attempted the quiz or not
                        while ($IDs = mysqli_fetch_assoc($mysqlIDresult))
                        {
                            if (!(checkifUserAttemptedQuiz($host, $user, $pwd, $sql_db, $IDs['STUDENTID']) === false))
                            {
                                if ($IDFILTER == "1")
                                {
                                    $sql = "SELECT USERS.STUDENTID, USERNAME, FIRSTNAME, LASTNAME, ATTEMPTNO, RESULT, QUESTION1, QUESTION2, QUESTION3, QUESTION4, QUESTION5, DATEANDTIME FROM ATTEMPT, USERS WHERE ATTEMPT.STUDENTID = USERS.STUDENTID AND NOT(PRIVILEGE = \"ADMIN\") AND USERS.STUDENTID = {$IDs['STUDENTID']} AND {$USERNAMEFILTER} AND {$FNAMEFILTER} AND {$LNAMEFILTER} AND {$ATTEMPTFILTER} AND {$RESULTFILTER} AND {$SCOREFILTER} AND {$Q1FILTER} AND {$Q2FILTER} AND {$Q3FILTER} AND {$Q4FILTER} AND {$Q5FILTER};";

                                }
                                else
                                {
                                    $sql = "SELECT USERS.STUDENTID, USERNAME, FIRSTNAME, LASTNAME, ATTEMPTNO, RESULT, QUESTION1, QUESTION2, QUESTION3, QUESTION4, QUESTION5, DATEANDTIME FROM ATTEMPT, USERS WHERE ATTEMPT.STUDENTID = USERS.STUDENTID AND NOT(PRIVILEGE = \"ADMIN\") AND {$IDFILTER} AND {$USERNAMEFILTER} AND {$FNAMEFILTER} AND {$LNAMEFILTER} AND {$ATTEMPTFILTER} AND {$RESULTFILTER} AND {$SCOREFILTER} AND {$Q1FILTER} AND {$Q2FILTER} AND {$Q3FILTER} AND {$Q4FILTER} AND {$Q5FILTER};";
                                }
                                $mysqlresult = mysqli_query($conn, $sql);
                                if ($mysqlresult === false)
                                {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($mysqlresult) . "<br>";
                                }
                                else
                                {
                                    while ($row = mysqli_fetch_array($mysqlresult))
                                    {
                                        $percentagefromdate = convert_to_percentage($row['RESULT'], 5);
                                        $tablerows .= "<tr>
                                        <th class=\"table-border font-general table-fx\">{$row['STUDENTID']}</th>
                                        <th class=\"table-border font-general table-fx\">{$row['USERNAME']}</th>
                                        <th class=\"table-border font-general table-fx\">{$row['FIRSTNAME']}</th>
                                        <th class=\"table-border font-general table-fx\">{$row['LASTNAME']}</th>
                                        <th class=\"table-border font-general table-fx\">{$row['ATTEMPTNO']}</th>
                                        <th class=\"table-border font-general table-fx\">{$percentagefromdate}%</th>
                                        <th class=\"table-border font-general table-fx\">{$row['RESULT']} / 5</th>
                                        <th class=\"table-border font-general table-fx\">{$row['QUESTION1']}</th>
                                        <th class=\"table-border font-general table-fx\">{$row['QUESTION2']}</th>
                                        <th class=\"table-border font-general table-fx\">{$row['QUESTION3']}</th>
                                        <th class=\"table-border font-general table-fx\">{$row['QUESTION4']}</th>
                                        <th class=\"table-border font-general table-fx\">{$row['QUESTION5']}</th>
                                        <th class=\"table-border font-general table-fx\">{$row['DATEANDTIME']}</th>
                                        </tr>";
                                    }
                                }

                            }
                            else
                            {
                                if ($ATTEMPTFILTER == "1" && $RESULTFILTER == "1" && $SCOREFILTER == "1" && $Q1FILTER == "1" && $Q2FILTER == "1" && $Q3FILTER == "1" && $Q4FILTER == "1" && $Q5FILTER == "1")
                                {
                                    if ($IDFILTER == "1")
                                    {
                                        $sql = "SELECT STUDENTID, USERNAME, FIRSTNAME, LASTNAME FROM USERS WHERE NOT(PRIVILEGE = \"ADMIN\") AND USERS.STUDENTID = {$IDs['STUDENTID']} AND {$USERNAMEFILTER} AND {$FNAMEFILTER} AND {$LNAMEFILTER};";
                                    }
                                    else
                                    {

                                        $sql = "SELECT STUDENTID, USERNAME, FIRSTNAME, LASTNAME FROM USERS WHERE NOT(PRIVILEGE = \"ADMIN\") AND {$IDFILTER} AND {$USERNAMEFILTER} AND {$FNAMEFILTER} AND {$LNAMEFILTER};";
                                    }
                                    $mysqlresult = mysqli_query($conn, $sql);
                                    if ($mysqlresult === false)
                                    {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($mysqlresult) . "<br>";
                                    }
                                    else
                                    {
                                        while ($row = mysqli_fetch_assoc($mysqlresult))
                                        {
                                            $tablerows .= "<tr>
                                            <th class=\"table-border font-general table-fx\">{$row['STUDENTID']}</th>
                                            <th class=\"table-border font-general table-fx\">{$row['USERNAME']}</th>
                                            <th class=\"table-border font-general table-fx\">{$row['FIRSTNAME']}</th>
                                            <th class=\"table-border font-general table-fx\">{$row['LASTNAME']}</th>
                                            <th colspan=\"9\" class=\"table-border font-general table-fx\">This student has not attempted the quiz</th>
                                            </tr>";
                                        }
                                    }
                                }

                            }
                        }

                    }
                }

                mysqli_close($conn);

                $table = "<form method=\"post\" action=\"manage.php\">
                <h2 class=\"font-general headings nopadding\">Student Records</h2>
                <table class=\"table-border table-mobile\">
                <tr>
                <th class=\"table-border font-general table-fx\">STUDENT ID</th>
                <th class=\"table-border font-general table-fx\">USERNAME</th>
                <th class=\"table-border font-general table-fx\">FIRST NAME</th>
                <th class=\"table-border font-general table-fx\">LAST NAME</th>
                <th class=\"table-border font-general table-fx\">ATTEMPT NO</th>
                <th class=\"table-border font-general table-fx\">RESULT</th>
                <th class=\"table-border font-general table-fx\">SCORE</th>
                <th class=\"table-border font-general table-fx\">Question 1</th>
                <th class=\"table-border font-general table-fx\">Question 2</th>
                <th class=\"table-border font-general table-fx\">Question 3</th>
                <th class=\"table-border font-general table-fx\">Question 4</th>
                <th class=\"table-border font-general table-fx\">Question 5</th>
                <th class=\"table-border font-general table-fx\">Date and Time of attempt</th>
                </tr>
                <tr>
                <th class=\"table-border font-general table-fx\">
                <input type=\"text\" id=\"idfilter\" name=\"idfilter\" >
                </th>
                <th class=\"table-border font-general table-fx\">
                <input type=\"text\" id=\"firstnamefilter\" name=\"usernamefilter\" >
                </th>
                <th class=\"table-border font-general table-fx\">
                <input type=\"text\" id=\"usernamefilter\" name=\"firstnamefilter\" >
                </th>
                <th class=\"table-border font-general table-fx\">
                <input type=\"text\" id=\"lastnamefilter\" name=\"lastnamefilter\" >
                </th>
                <th class=\"table-border font-general table-fx\">
                <input type=\"text\" id=\"attemptfilter\" name=\"attemptfilter\" >
                </th>
                <th class=\"table-border font-general table-fx\">
                <input type=\"text\" id=\"resultfilter\" name=\"resultfilter\" >
                <select name=\"resultorderby\">
                <option value=\"lessorequal\" label=\"lessorequal\">&LT;&equals;</option>
                <option value=\"equal\" label=\"equal\">&equals;&equals;</option>           
                <option value=\"greater\" label=\"greater\">&GT;</option>
                <option value=\"less\" label=\"less\">&LT;</option>
                <option value=\"greaterorequal\" label=\"greaterorequal\">&GT;&equals;</option>
                </select>
                </th>
                <th class=\"table-border font-general table-fx\">
                <input type=\"text\" id=\"scorefilter\" name=\"scorefilter\" >
                <select name=\"scoreorderby\">
                <option value=\"lessorequal\" label=\"lessorequal\">&LT;&equals;</option>
                <option value=\"equal\" label=\"equal\">&equals;&equals;</option>           
                <option value=\"greater\" label=\"greater\">&GT;</option>
                <option value=\"less\" label=\"less\">&LT;</option>
                <option value=\"greaterorequal\" label=\"greaterorequal\">&GT;&equals;</option>
                </select>
                </th>
                <th class=\"table-border font-general table-fx\">
                <input type=\"text\" id=\"question1filter\" name=\"question1filter\" >

                </th>
                <th class=\"table-border font-general table-fx\">
                <input type=\"text\" id=\"question2filter\" name=\"question2filter\" >
                </th>
                <th class=\"table-border font-general table-fx\">
                <input type=\"text\" id=\"question3filter\" name=\"question3filter\" >

                </th>
                <th class=\"table-border font-general table-fx\">
                <input type=\"text\" id=\"question4filter\" name=\"question4filter\" >

                </th>
                <th class=\"table-border font-general table-fx\">
                <input type=\"text\" id=\"question5filter\" name=\"question5filter\" >
                </th>
                <th class=\"table-border font-general table-fx\">
                <input type=\"submit\" name=\"submitButton\" value=\"Filter\" />
                </th>
                </tr>
                {$tablerows}
                </table>
                </form>";
                echo $table;
            }
            ?>
        </fieldset>
        <br><br><br><br>
    </main> 
    <?php
    include ("footer.inc")
    ?>
</body>
