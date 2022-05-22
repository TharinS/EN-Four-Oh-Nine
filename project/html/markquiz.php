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
    include("menu.inc");
    ?>
    <main>
        <br><br><br><br>
        <!-- Setting the field for questions about student information -->
        <?php  
        include("header.inc") 
        ?>
        <fieldset class="fieldset-border general-settings mobile-padding">
            <?php 
            include('general.php');
            include('settings.php');
            include('mysqlfunctions.php');

            if(!isset($_SESSION['userName'])) {
                echo "<p class=\"font-general paragraph\">You need to be signed in inorder to view your results, please wait 5 seconds for you to be redirected to the login page.<br>Thank you for you're patience</p>"; 
                header("Refresh: 5; url=\"login.php\"");
            } else if (isset($_SESSION['userPrivilege']) && $_SESSION['userPrivilege'] == "ADMIN") {
                echo "<p class=\"font-general paragraph\">You can view these details in the manage page, please wait 5 seconds for you to be redirected to the manage page.<br>Thank you for you're patience</p>"; 
                header("Refresh: 5; url=\"manage.php\"");
            } else {

                $question = array("", "", "", "", "");
                $attempt = 0;

                $STUDENTID = array("","");
                $QUESTION1 = array("","");
                $QUESTION2 = array("","");
                $QUESTION3 = array("","");
                $QUESTION4 = array("","");
                $QUESTION5 = array("","");
                $RESULT = array(0,0);
                $ATTEMPTNO = array(0,0);
                $DATEANDTIME = array("","");
                $FIRSTNAME = array("","");
                $LASTNAME = array("","");
                $dateandtime = date("Y-m-d H:i:s");
                $errMsg = "";
                $index = 0;

                if($_POST['creation'] != ""){
                    if((strpos(strtolower($_POST['creation']), "store animations") !== false) || (strpos(strtolower($_POST['creation']), "thorbbers") !== false)) {
                        $question[0] = "Correct";
                    } else {
                     $question[0] = "Incorrect"; 
                 }
             } else {
                $errMsg .= "Error: Question 1 not answered<br>";
            }

            if(isset($_POST['year'])) {
                if($_POST['year'] == "2004") {
                    $question[1] = "Correct";
                } else {
                 $question[1] = "Incorrect"; 
             }
         } else {
            $errMsg .= "Error: Question 2 not answered<br>";
        }

        if (isset($_POST['fdAT']) || isset($_POST['acTL']) || isset($_POST['fake_chunk']) || isset($_POST['fcTL'])) {
            if(isset($_POST['fdAT']) && isset($_POST['acTL']) && isset($_POST['fcTL'])) {
                $question[2] = "Correct";
            } else {
                $question[2] = "Incorrect";
            }
        } else {
            $errMsg .= "Error: Question 3 not answered<br>";
        }

        if ($_POST['corporation'] != "") {
            if($_POST['corporation'] == "mozilla") {
                $question[3] = "Correct";
            } else {
             $question[3] = "Incorrect"; 
         }
     } else {
        $errMsg .= "Error: Question 4 not answered<br>";
    }

    if($_POST['color_bit'] != "") {
        if(strpos($_POST['color_bit'], "24") !== false) {
            $question[4] = "Correct";
        } else {
         $question[4] = "Incorrect"; 
     }
 } else {
    $errMsg .= "Error: Question 5 not answered<br>";
}

$result = count(array_keys($question, "Correct"));

$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if(!$conn) {
    $errMsg .=  "Error: Cannot connect to database<br>";
} else {
        $sql = "SELECT ATTEMPT.STUDENTID, FIRSTNAME, LASTNAME, ATTEMPTNO, RESULT, QUESTION1, QUESTION2, QUESTION3, QUESTION4, QUESTION5, DATEANDTIME FROM ATTEMPT, USERS WHERE ATTEMPT.STUDENTID = USERS.STUDENTID AND ATTEMPT.STUDENTID = '{$_SESSION['userID']}';";
        $mysqlresult = mysqli_query($conn, $sql);
        if ($mysqlresult === FALSE) {
            $errMsg .= "Error: in " . $sql . "<br>";
        } else {
            if (mysqli_num_rows($mysqlresult) == 2) {
                $errMsg .= "You have run out of attempts<br>";
            } 

            while($row = mysqli_fetch_assoc($mysqlresult)){
                $STUDENTID[$index] = $row['STUDENTID'];
                $ATTEMPTNO[$index] = $row['ATTEMPTNO'];
                $RESULT[$index] = $row['RESULT'];
                $QUESTION1[$index] = $row['QUESTION1'];
                $QUESTION2[$index] = $row['QUESTION2'];
                $QUESTION3[$index] = $row['QUESTION3'];
                $QUESTION4[$index] = $row['QUESTION4'];
                $QUESTION5[$index] = $row['QUESTION5'];
                $DATEANDTIME[$index] = $row['DATEANDTIME'];
                $FIRSTNAME[$index] = $row['FIRSTNAME'];
                $LASTNAME[$index] = $row['LASTNAME'];
                $index = $index + 1; 
            }
            $attempt = $index + 1;
                        //User's 1st attempt so should log current answers after making a new entry for user
            if (mysqli_num_rows($mysqlresult) == 0 && $errMsg == "") {

                $insertsql = "INSERT INTO ATTEMPT(STUDENTID, ATTEMPTNO, RESULT, QUESTION1, QUESTION2, QUESTION3, QUESTION4, QUESTION5, DATEANDTIME) VALUES('{$_SESSION['userID']}',1,{$result},'{$question[0]}','{$question[1]}','{$question[2]}','{$question[3]}','{$question[4]}','{$dateandtime}');";
                $mysqlresult = mysqli_query($conn, $insertsql);
            } else if (mysqli_num_rows($mysqlresult) == 1 && $errMsg == "" && !($result === 0)) {
                $insertsql = "INSERT INTO ATTEMPT(STUDENTID, ATTEMPTNO, RESULT, QUESTION1, QUESTION2, QUESTION3, QUESTION4, QUESTION5, DATEANDTIME) VALUES('{$_SESSION['userID']}',2,{$result},'{$question[0]}','{$question[1]}','{$question[2]}','{$question[3]}','{$question[4]}','{$dateandtime}');";
                $mysqlresult = mysqli_query($conn, $insertsql);
            }
    }
}

mysqli_close($conn);



$currentattempttable = "<h2 class=\"font-general headings nopadding\">Current Attempt</h2>
<table class=\"table-border center table-mobile\">
<tr>
<th class=\"table-border font-general table-fx\">Student Name</th>
<th class=\"table-border font-general table-fx\">{$FIRSTNAME[0]} {$LASTNAME[0]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\" colspan=\"2\">Result Overview</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number</th>
<th class=\"table-border font-general table-fx\">Result</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number 1</th>
<th class=\"table-border font-general table-fx\">{$question[0]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number 2</th>
<th class=\"table-border font-general table-fx\">{$question[1]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number 3</th>
<th class=\"table-border font-general table-fx\">{$question[2]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number 4</th>
<th class=\"table-border font-general table-fx\">{$question[3]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number 5</th>
<th class=\"table-border font-general table-fx\">{$question[4]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\" colspan=\"2\">Overall Result</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Results</th>
<th class=\"table-border font-general table-fx\">{$result} out of 5</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Attempt</th>
<th class=\"table-border font-general table-fx\">{$attempt} out of 2</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Date and Time</th>
<th class=\"table-border font-general table-fx\">{$dateandtime}</th>
</tr>
</table>";

$pastattempttable = "<fieldset class=\"fieldset-border general-settings mobile-padding\">
<h2 class=\"font-general headings nopadding\">Past Attempts</h2>
<div class=\"center\">
<table class=\"table-border center sameline table-mobile\">
<tr>
<th class=\"table-border font-general table-fx\">Student Name</th>
<th class=\"table-border font-general table-fx\">{$FIRSTNAME[0]} {$LASTNAME[0]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\" colspan=\"2\">Result Overview</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number</th>
<th class=\"table-border font-general table-fx\">Result</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number 1</th>
<th class=\"table-border font-general table-fx\">{$QUESTION1[0]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number 2</th>
<th class=\"table-border font-general table-fx\">{$QUESTION2[0]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number 3</th>
<th class=\"table-border font-general table-fx\">{$QUESTION3[0]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number 4</th>
<th class=\"table-border font-general table-fx\">{$QUESTION4[0]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number 5</th>
<th class=\"table-border font-general table-fx\">{$QUESTION5[0]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\" colspan=\"2\">Overall Result</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Results</th>
<th class=\"table-border font-general table-fx\">{$RESULT[0]} out of 5</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Attempt</th>
<th class=\"table-border font-general table-fx\">1 out of 2</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Data and Time</th>
<th class=\"table-border font-general table-fx\">{$DATEANDTIME[0]}</th>
</tr>
</table>

<table class=\"table-border center sameline table-mobile\">
<tr>
<th class=\"table-border font-general table-fx\">Student Name</th>
<th class=\"table-border font-general table-fx\">{$FIRSTNAME[0]} {$LASTNAME[0]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\" colspan=\"2\">Result Overview</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number</th>
<th class=\"table-border font-general table-fx\">Result</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number 1</th>
<th class=\"table-border font-general table-fx\">{$QUESTION1[1]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number 2</th>
<th class=\"table-border font-general table-fx\">{$QUESTION2[1]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number 3</th>
<th class=\"table-border font-general table-fx\">{$QUESTION3[1]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number 4</th>
<th class=\"table-border font-general table-fx\">{$QUESTION4[1]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Question Number 5</th>
<th class=\"table-border font-general table-fx\">{$QUESTION5[1]}</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\" colspan=\"2\">Overall Result</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Results</th>
<th class=\"table-border font-general table-fx\">{$RESULT[1]} out of 5</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Attempt</th>
<th class=\"table-border font-general table-fx\">2 out of 2</th>
</tr>
<tr>
<th class=\"table-border font-general table-fx\">Date and Time</th>
<th class=\"table-border font-general table-fx\">{$DATEANDTIME[1]}</th>
</tr>
</table>
</div>
</fieldset>";

if($errMsg != "") {
    echo "<h2 class=\"font-general headings nopadding\">Current Attempt</h2><p class=\"font-general textcenter paragraph\">{$errMsg}</p>";
} else {
    echo $currentattempttable;
}
echo "<br>";
echo $pastattempttable;
}
?>
</fieldset>
<!-- Including header found throughout all site pages -->
<br>
</main> 
<?php
include("footer.inc") 
?>
</body>

</html>