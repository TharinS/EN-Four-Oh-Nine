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
    $activePage = "edit";
    include ("menu.inc");
    ?>
    <main>
        <br><br><br><br>

        <?php
        include ('general.php');
        include ('settings.php');
        include ('mysqlfunctions.php');

        // Checking if the user is logged in and what level of privilege they have
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

            $IDFILTER = "1";
            $tablerows = "";
            $deletebuttons = "";
            $warnings = "";

            if (isset($_POST['Delete1']))
            {
                if ($_POST['row1studentID'] != "")
                {
                    $IDFILTER = "ATTEMPT.STUDENTID = '{$_POST['row1studentID']}'";
                }

                $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

                if (!$conn)
                {
                    $warnings .= "Error: Cannot connect to database<br>";
                }
                else
                {
                    if (!($IDFILTER == "1"))
                    {
                        $attempttotalsql = "SELECT * FROM ATTEMPT WHERE {$IDFILTER}";

                        $mysqlresult = mysqli_query($conn, $attempttotalsql);

                        if ($mysqlresult === false)
                        {
                            $warnings .= "Error: in " . $attempttotalsql . "<br>";
                        }
                        else
                        {
                            $deletesql = "DELETE FROM ATTEMPT WHERE ATTEMPTNO = 1 AND {$IDFILTER};";
                            $mysqlresult = mysqli_query($conn, $deletesql);
                            if ($_POST['row2studentID'] != "")
                            {
                                $updatesql = "UPDATE ATTEMPT SET ATTEMPTNO = 1 WHERE {$IDFILTER};";
                                $mysqlresult = mysqli_query($conn, $updatesql);
                            }
                        }
                    }

                }
                $_POST['IDsearch'] = $_POST['row1studentID'];
                $_POST['IDsubmit'] = "Search";
            }

            if (isset($_POST['Delete2']))
            {
                if ($_POST['row2studentID'] != "")
                {
                    $IDFILTER = "ATTEMPT.STUDENTID = {$_POST['row2studentID']}";
                }
                $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

                if (!$conn)
                {
                    $warnings .= "Error: Cannot connect to database<br>";
                }
                else
                {
                    if (!($IDFILTER == "1"))
                    {
                        $attempttotalsql = "SELECT * FROM ATTEMPT WHERE {$IDFILTER}";

                        $mysqlresult = mysqli_query($conn, $attempttotalsql);

                        if ($mysqlresult === false)
                        {
                            echo "Error: in " . $attempttotalsql . "<br>";
                        }
                        else
                        {

                            $deletesql = "DELETE FROM ATTEMPT WHERE ATTEMPTNO = 2 AND {$IDFILTER};";

                            $mysqlresult = mysqli_query($conn, $deletesql);
                        }
                    }

                }

                $_POST['IDsearch'] = $_POST['row2studentID'];
                $_POST['IDsubmit'] = "Search";
            }

            if (isset($_POST['Edit1']))
            {
                $expectresult = array();
                $newValues = "STUDENTID = {$_POST['row1studentID']}";
                if (!preg_match("/^correct$|^incorrect$/", strtolower($_POST['row1q1'])))
                {
                    $_POST['IDsearch'] = $_POST['row1studentID'];
                    $_POST['IDsubmit'] = "Search";
                    $warnings .= "when changing the result of a question 1 please stick to correct or incorrect(case insensitive)";
                }
                else
                {
                    if (strtolower($_POST['row1q1']) == "correct")
                    {
                        array_push($expectresult, "Correct");
                    }
                    else
                    {
                        array_push($expectresult, "Incorrect");
                    }
                    $question1input = ucfirst(strtolower($_POST['row1q1']));
                    $newValues .= ", QUESTION1 = '{$question1input}'";
                }

                if (!preg_match("/^correct$|^incorrect$/", strtolower($_POST['row1q2'])))
                {
                    $_POST['IDsearch'] = $_POST['row1studentID'];
                    $_POST['IDsubmit'] = "Search";
                    $warnings .= "when changing the result of a question 2 please stick to correct or incorrect(case insensitive)";
                }
                else
                {
                    if (strtolower($_POST['row1q2']) == "correct")
                    {
                        array_push($expectresult, "Correct");
                    }
                    else
                    {
                        array_push($expectresult, "Incorrect");
                    }
                    $question2input = ucfirst(strtolower($_POST['row1q2']));
                    $newValues .= ", QUESTION2 = '{$question2input}'";
                }

                if (!preg_match("/^correct$|^incorrect$/", strtolower($_POST['row1q3'])))
                {
                    $_POST['IDsearch'] = $_POST['row1studentID'];
                    $_POST['IDsubmit'] = "Search";
                    $warnings .= "when changing the result of a question 3 please stick to correct or incorrect(case insensitive)";
                }
                else
                {
                    if (strtolower($_POST['row1q3']) == "correct")
                    {
                        array_push($expectresult, "Correct");
                    }
                    else
                    {
                        array_push($expectresult, "Incorrect");
                    }
                    $question3input = ucfirst(strtolower($_POST['row1q3']));
                    $newValues .= ", QUESTION3 = '{$question3input}'";
                }

                if (!preg_match("/^correct$|^incorrect$/", strtolower($_POST['row1q4'])))
                {
                    $_POST['IDsearch'] = $_POST['row1studentID'];
                    $_POST['IDsubmit'] = "Search";
                    $warnings .= "when changing the result of a question 4 please stick to correct or incorrect(case insensitive)";
                }
                else
                {
                    if (strtolower($_POST['row1q4']) == "correct")
                    {
                        array_push($expectresult, "Correct");
                    }
                    else
                    {
                        array_push($expectresult, "Incorrect");
                    }
                    $question4input = ucfirst(strtolower($_POST['row1q4']));
                    $newValues .= ", QUESTION4 = '{$question4input}'";
                }

                if (!preg_match("/^correct$|^incorrect$/", strtolower($_POST['row1q5'])))
                {
                    $_POST['IDsearch'] = $_POST['row1studentID'];
                    $_POST['IDsubmit'] = "Search";
                    $warnings .= "when changing the result of a question 5 please stick to correct or incorrect(case insensitive)";
                }
                else
                {
                    if (strtolower($_POST['row1q5']) == "correct")
                    {
                        array_push($expectresult, "Correct");
                    }
                    else
                    {
                        array_push($expectresult, "Incorrect");
                    }
                    $question5input = ucfirst(strtolower($_POST['row1q5']));
                    $newValues .= ", QUESTION5 = '{$question5input}'";
                }

                if ((int)$_POST['row1result'] > 5)
                {
                    $_POST['IDsearch'] = $_POST['row1studentID'];
                    $_POST['IDsubmit'] = "Search";
                    $warnings .= "the score/result can have a maximum value of 5";
                }
                else
                {
                    if (!(count(array_keys($expectresult, "Correct")) === (int)$_POST['row1result']))
                    {
                        $_POST['IDsearch'] = $_POST['row1studentID'];
                        $_POST['IDsubmit'] = "Search";
                        $warnings .= "the score/result does not add up to the number of correct answers";
                    }
                    else
                    {
                        $newValues .= ", RESULT = {$_POST['row1result']}";
                    }
                }

                $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

                if (!$conn)
                {
                    $warnings .= "Error: Cannot connect to database<br>";
                }
                else
                {
                    $updatesql = "UPDATE ATTEMPT SET {$newValues} WHERE ATTEMPTNO = 1 AND STUDENTID = {$_POST['row1studentID']};";

                    $mysqlresult = mysqli_query($conn, $updatesql);
                    if ($mysqlresult === false)
                    {
                        $warnings .= $updatesql . "<br>";
                    }
                }
                $_POST['IDsearch'] = $_POST['row1studentID'];
                $_POST['IDsubmit'] = "Search";
            }

            if (isset($_POST['Edit2']))
            {
                $expectresult = array();
                $newValues = "STUDENTID = {$_POST['row2studentID']}";
                if (!preg_match("/^correct$|^incorrect$/", strtolower($_POST['row2q1'])))
                {
                    $_POST['IDsearch'] = $_POST['row1studentID'];
                    $_POST['IDsubmit'] = "Search";
                    $warnings .= "when changing the result of a question 1 please stick to correct or incorrect(case insensitive)";
                }
                else
                {
                    if (strtolower($_POST['row2q1']) == "correct")
                    {
                        array_push($expectresult, "Correct");
                    }
                    else
                    {
                        array_push($expectresult, "Incorrect");
                    }
                    $question1input = ucfirst(strtolower($_POST['row2q1']));
                    $newValues .= ", QUESTION1 = '{$question1input}'";
                }

                if (!preg_match("/^correct$|^incorrect$/", strtolower($_POST['row2q2'])))
                {
                    $_POST['IDsearch'] = $_POST['row1studentID'];
                    $_POST['IDsubmit'] = "Search";
                    $warnings .= "when changing the result of a question 2 please stick to correct or incorrect(case insensitive)";
                }
                else
                {
                    if (strtolower($_POST['row2q2']) == "correct")
                    {
                        array_push($expectresult, "Correct");
                    }
                    else
                    {
                        array_push($expectresult, "Incorrect");
                    }
                    $question2input = ucfirst(strtolower($_POST['row2q2']));
                    $newValues .= ", QUESTION2 = '{$question2input}'";
                }

                if (!preg_match("/^correct$|^incorrect$/", strtolower($_POST['row2q3'])))
                {
                    $_POST['IDsearch'] = $_POST['row1studentID'];
                    $_POST['IDsubmit'] = "Search";
                    $warnings .= "when changing the result of a question 3 please stick to correct or incorrect(case insensitive)";
                }
                else
                {
                    if (strtolower($_POST['row2q3']) == "correct")
                    {
                        array_push($expectresult, "Correct");
                    }
                    else
                    {
                        array_push($expectresult, "Incorrect");
                    }
                    $question3input = ucfirst(strtolower($_POST['row2q3']));
                    $newValues .= ", QUESTION3 = '{$question3input}'";
                }

                if (!preg_match("/^correct$|^incorrect$/", strtolower($_POST['row2q4'])))
                {
                    $_POST['IDsearch'] = $_POST['row1studentID'];
                    $_POST['IDsubmit'] = "Search";
                    $warnings .= "when changing the result of a question 4 please stick to correct or incorrect(case insensitive)";
                }
                else
                {
                    if (strtolower($_POST['row2q4']) == "correct")
                    {
                        array_push($expectresult, "Correct");
                    }
                    else
                    {
                        array_push($expectresult, "Incorrect");
                    }
                    $question4input = ucfirst(strtolower($_POST['row2q4']));
                    $newValues .= ", QUESTION4 = '{$question4input}'";
                }

                if (!preg_match("/^correct$|^incorrect$/", strtolower($_POST['row2q5'])))
                {
                    $_POST['IDsearch'] = $_POST['row1studentID'];
                    $_POST['IDsubmit'] = "Search";
                    $warnings .= "when changing the result of a question 5 please stick to correct or incorrect(case insensitive)";
                }
                else
                {
                    if (strtolower($_POST['row2q5']) == "correct")
                    {
                        array_push($expectresult, "Correct");
                    }
                    else
                    {
                        array_push($expectresult, "Incorrect");
                    }
                    $question5input = ucfirst(strtolower($_POST['row2q5']));
                    $newValues .= ", QUESTION5 = '{$question5input}'";
                }

                if ((int)$_POST['row2result'] > 5)
                {
                    $_POST['IDsearch'] = $_POST['row1studentID'];
                    $_POST['IDsubmit'] = "Search";
                    $warnings .= "the score/result can have a maximum value of 5";
                }
                else
                {
                    if (!(count(array_keys($expectresult, "Correct")) === (int)$_POST['row2result']))
                    {
                        $_POST['IDsearch'] = $_POST['row2studentID'];
                        $_POST['IDsubmit'] = "Search";
                        $warnings .= "the score/result does not add up to the number of correct answers";
                    }
                    else
                    {
                        $newValues .= ", RESULT = {$_POST['row2result']}";
                    }
                }

                $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

                if (!$conn)
                {
                    $warnings .= "Error: Cannot connect to database<br>";
                }
                else
                {
                    $updatesql = "UPDATE ATTEMPT SET {$newValues} WHERE ATTEMPTNO = 2 AND STUDENTID = {$_POST['row2studentID']};";

                    $mysqlresult = mysqli_query($conn, $updatesql);
                    if ($mysqlresult === false)
                    {
                        $warnings .= $updatesql . "<br>";
                    }
                }
                $_POST['IDsearch'] = $_POST['row2studentID'];
                $_POST['IDsubmit'] = "Search";
            }

            if (isset($_POST['IDsubmit']))
            {
                if ($_POST['IDsearch'] != "")
                {
                    $IDFILTER = "USERS.STUDENTID LIKE '{$_POST['IDsearch']}'";
                }

                $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

                $tablerows = "";

                if (!$conn)
                {
                    $warnings .= "Error: Cannot connect to database<br>";
                }
                else
                {
                    if (!($IDFILTER == "1"))
                    {
                        $studentIDsql = "SELECT STUDENTID FROM USERS WHERE NOT(PRIVILEGE = \"ADMIN\") AND {$IDFILTER};";

                        $mysqlIDresult = mysqli_query($conn, $studentIDsql);
                        if ($mysqlIDresult === false)
                        {
                            $warnings .= "Error: in " . $studentIDsql . "<br>";
                        }
                        else
                        {
                            if(mysqli_num_rows($mysqlIDresult) == 0) {
                                $warnings .= "StudentID not found<br>";
                            } else {
                                while ($IDs = mysqli_fetch_assoc($mysqlIDresult))
                                {
                                    if (!(checkifUserAttemptedQuiz($host, $user, $pwd, $sql_db, $IDs['STUDENTID']) === false))
                                    {
                                        $sql = "SELECT USERS.STUDENTID, USERNAME, FIRSTNAME, LASTNAME, ATTEMPTNO, RESULT, QUESTION1, QUESTION2, QUESTION3, QUESTION4, QUESTION5, DATEANDTIME FROM ATTEMPT, USERS WHERE ATTEMPT.STUDENTID = USERS.STUDENTID AND NOT(PRIVILEGE = \"ADMIN\") AND {$IDFILTER};";

                                        $mysqlresult = mysqli_query($conn, $sql);
                                        if ($mysqlresult === false)
                                        {
                                            $warnings .= "Error: in " . $sql . "<br>";
                                        }
                                        else
                                        {
                                            while ($row = mysqli_fetch_array($mysqlresult))
                                            {
                                                $tablerows .= "<tr>
                                                <th class=\"table-border font-general table-fx\">
                                                <input type=\"text\" id=\"row{$row['ATTEMPTNO']}studentID\" name=\"row{$row['ATTEMPTNO']}studentID\" value=\"{$row['STUDENTID']}\" readonly >
                                                </th>
                                                <th class=\"table-border font-general table-fx\">
                                                <input type=\"text\" id=\"row{$row['ATTEMPTNO']}username\" name=\"row{$row['ATTEMPTNO']}username\" value=\"{$row['USERNAME']}\" readonly >
                                                </th>
                                                <th class=\"table-border font-general table-fx\">
                                                <input type=\"text\" id=\"row{$row['ATTEMPTNO']}fname\" name=\"row{$row['ATTEMPTNO']}fname\" value=\"{$row['FIRSTNAME']}\" readonly >
                                                </th>
                                                <th class=\"table-border font-general table-fx\">
                                                <input type=\"text\" id=\"row{$row['ATTEMPTNO']}lname\" name=\"row{$row['ATTEMPTNO']}lname\" value=\"{$row['LASTNAME']}\" readonly >
                                                </th>
                                                <th class=\"table-border font-general table-fx\">
                                                <input type=\"text\" id=\"row{$row['ATTEMPTNO']}atmptno\" name=\"row{$row['ATTEMPTNO']}atmptno\" value=\"{$row['ATTEMPTNO']}\" readonly >
                                                </th>
                                                <th class=\"table-border font-general table-fx\">
                                                <input type=\"text\" id=\"row{$row['ATTEMPTNO']}result\" name=\"row{$row['ATTEMPTNO']}result\" value=\"{$row['RESULT']}\" >
                                                </th>
                                                <th class=\"table-border font-general table-fx\">
                                                <input type=\"text\" id=\"row{$row['ATTEMPTNO']}q1\" name=\"row{$row['ATTEMPTNO']}q1\" value=\"{$row['QUESTION1']}\" >
                                                </th>
                                                <th class=\"table-border font-general table-fx\">
                                                <input type=\"text\" id=\"row{$row['ATTEMPTNO']}q2\" name=\"row{$row['ATTEMPTNO']}q2\" value=\"{$row['QUESTION2']}\" >
                                                </th>
                                                <th class=\"table-border font-general table-fx\">
                                                <input type=\"text\" id=\"row{$row['ATTEMPTNO']}q3\" name=\"row{$row['ATTEMPTNO']}q3\" value=\"{$row['QUESTION3']}\" >
                                                </th>
                                                <th class=\"table-border font-general table-fx\">
                                                <input type=\"text\" id=\"row{$row['ATTEMPTNO']}q4\" name=\"row{$row['ATTEMPTNO']}q4\" value=\"{$row['QUESTION4']}\" >
                                                </th>
                                                <th class=\"table-border font-general table-fx\">
                                                <input type=\"text\" id=\"row{$row['ATTEMPTNO']}q5\" name=\"row{$row['ATTEMPTNO']}q5\" value=\"{$row['QUESTION5']}\" >
                                                </th>
                                                <th class=\"table-border font-general table-fx\">
                                                <input type=\"text\" id=\"row{$row['ATTEMPTNO']}datetime\" name=\"row{$row['ATTEMPTNO']}datetime\" value=\"{$row['DATEANDTIME']}\" readonly >
                                                </th>
                                                <th class=\"table-border font-general table-fx\">
                                                <input type=\"submit\" class=\"sameline\" name=\"Edit{$row['ATTEMPTNO']}\" value=\"Save\" />
                                                </th>
                                                </tr>";

                                                $deletebuttons .= "<input type=\"submit\" class=\"sameline\" name=\"Delete{$row['ATTEMPTNO']}\" value=\"Delete Attempt {$row['ATTEMPTNO']}\" />";
                                            }
                                        }

                                    }
                                    else
                                    {
                                        $sql = "SELECT STUDENTID, USERNAME, FIRSTNAME, LASTNAME FROM USERS WHERE NOT(PRIVILEGE = \"ADMIN\") AND {$IDFILTER};";
                                        $mysqlresult = mysqli_query($conn, $sql);
                                        if ($mysqlresult === false)
                                        {
                                            echo "Error: in " . $sql . "<br>";
                                        }
                                        else
                                        {
                                            while ($row = mysqli_fetch_assoc($mysqlresult))
                                            {
                                                $tablerows .= "<tr><th class=\"table-border font-general table-fx\">{$row['STUDENTID']}</th>
                                                <th class=\"table-border font-general table-fx\">{$row['USERNAME']}</th>
                                                <th class=\"table-border font-general table-fx\">{$row['FIRSTNAME']}</th>
                                                <th class=\"table-border font-general table-fx\">{$row['LASTNAME']}</th>
                                                <th colspan=\"8\" class=\"table-border font-general table-fx\">This student has not attempted the quiz</th>
                                                </tr>";
                                            }
                                        }

                                    }
                                }
                            }
                            
                        }

                    }
                }

                mysqli_close($conn);
            }

            $table = "<form method=\"post\" action=\"editdetails.php\">
            <h2 class=\"font-general headings nopadding\">Student Records</h2>
            <p class=\"font-general paragraph\">
            <label for=\"IDsearch\">Enter a studentID to search - </label>
            <input type=\"text\" class=\"fill-in-blank\" id=\"IDsearch\" name=\"IDsearch\" >
            </p>
            <div class=\"form-button\">
            <input type=\"submit\" class=\"sameline\" name=\"IDsubmit\" value=\"Search\" />
            </div>

            <table class=\"table-border table-mobile\">
            <tr>
            <th class=\"table-border font-general table-fx\">STUDENT ID</th>
            <th class=\"table-border font-general table-fx\">USERNAME</th>
            <th class=\"table-border font-general table-fx\">FIRST NAME</th>
            <th class=\"table-border font-general table-fx\">LAST NAME</th>
            <th class=\"table-border font-general table-fx\">ATTEMPT NO</th>
            <th class=\"table-border font-general table-fx\">RESULT</th>
            <th class=\"table-border font-general table-fx\">Question 1</th>
            <th class=\"table-border font-general table-fx\">Question 2</th>
            <th class=\"table-border font-general table-fx\">Question 3</th>
            <th class=\"table-border font-general table-fx\">Question 4</th>
            <th class=\"table-border font-general table-fx\">Question 5</th>
            <th class=\"table-border font-general table-fx\">Date and Time of attempt</th>
            </tr>
            {$tablerows}
            </table>
            <div class=\"form-button\">
            {$deletebuttons}
            </div><br>
            {$warnings}
            </form>";
            echo $table;
        }
        ?>
        <br><br><br><br>
    </main> 
    <?php
    $stayAtBottom = true;
    include ("footer.inc")
    ?>
</body>
