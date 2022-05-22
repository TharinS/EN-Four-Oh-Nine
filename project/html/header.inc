<?php
    if(isset($_SESSION['userName'])) {
        echo "<header><h1 class=\"header-title  text-gradient\">Welcome {$_SESSION['userName']} ({$_SESSION['userID']})</h1></header>";
    } else {
        echo "<header><h1 class=\"header-title  text-gradient\">En Four Oh Nein</h1></header>";
    }
?>      
