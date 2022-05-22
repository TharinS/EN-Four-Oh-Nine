
<?php
    session_start();
    $indexButton = "<li class=\"navbar-item\"><a class=\"button\" href=\"index.php\"><span class=\"desktop-text\">Index</span><span class=\"mobile-text\">I</span></a></li>";
    $topicButton = "<li class=\"navbar-item\"><a class=\"button\" href=\"topic.php\"><span class=\"desktop-text \">Topic</span><span class=\"mobile-text \">T</span></a></li>";
    $quizButton = "<li class=\"navbar-item\"><a class=\"button\" href=\"quiz.php\"><span class=\"desktop-text\">Quiz</span><span class=\"mobile-text\">Q</span></a></li>";
    $enhancementButton = "<li class=\"navbar-item\"><a class=\"button\" href=\"enhancements.php\"><span class=\"desktop-text\">Enhancement</span><span class=\"mobile-text\">E</span></a></li>";
    $enhancementPHPButton = "<li class=\"navbar-item\"><a class=\"button\" href=\"phpenhancements.php\"><span class=\"desktop-text\">PHP Enhancement</span><span class=\"mobile-text\">PE</span></a></li>";

    if(isset($_SESSION['userName'])) {
       $loginButton = "<li class=\"navbar-item\"><a class=\"button\" href=\"signout.php\"><span class=\"desktop-text\">Logout/Signout</span><span class=\"mobile-text\">SO</span></a></li>";
    } else {
        $loginButton = "<li class=\"navbar-item\"><a class=\"button\" href=\"login.php\"><span class=\"desktop-text\">Login\Signup</span><span class=\"mobile-text\">LI</span></a></li>";
    }

    if (isset($_SESSION['userPrivilege']) && $_SESSION['userPrivilege'] == "ADMIN") {
        $manageButton = "<li class=\"navbar-item\"><a class=\"button\" href=\"manage.php\"><span class=\"desktop-text\">View Records</span><span class=\"mobile-text\">M</span></a></li>";
        $addAdminButton = "<li class=\"navbar-item\"><a class=\"button\" href=\"addadmin.php\"><span class=\"desktop-text\">Add Admin</span><span class=\"mobile-text\">AA</span></a></li>";
        $editButton = "<li class=\"navbar-item\"><a class=\"button\" href=\"editdetails.php\"><span class=\"desktop-text\">Edit Records</span><span class=\"mobile-text\">AA</span></a></li>";
    }

    if(isset($activePage)){
        switch ($activePage) {
        case "index": 
            $indexButton = "<li class=\"navbar-item\"><a class=\"button active\" href=\"index.php\"><span class=\"desktop-text black-font\">Index</span><span class=\"mobile-text black-font\">I</span></a></li>";
            break;
        case "topic":
            $topicButton = "<li class=\"navbar-item\"><a class=\"button active\" href=\"topic.php\"><span class=\"desktop-text black-font\">Topic</span><span class=\"mobile-text black-font\">T</span></a></li>";
            break;
        case "quiz":
            $quizButton = "<li class=\"navbar-item\"><a class=\"button active\" href=\"quiz.php\"><span class=\"desktop-text black-font\">Quiz</span><span class=\"mobile-text black-font\">Q</span></a></li>";
            break;
        case "php":
            $enhancementPHPButton = "<li class=\"navbar-item\"><a class=\"button active\" href=\"phpenhancements.php\"><span class=\"desktop-text black-font\">PHP Enhancement</span><span class=\"mobile-text black-font\">PE</span></a></li>";
            break;
        case "enhancements":
            $enhancementButton = "<li class=\"navbar-item\"><a class=\"button active\" href=\"enhancements.php\"><span class=\"desktop-text black-font\">Enhancement</span><span class=\"mobile-text black-font\">E</span></a></li>";
            break;
        case "login":
            if(isset($_SESSION['userName'])) {
                $loginButton = "<li class=\"navbar-item\"><a class=\"button active\" href=\"signout.php\"><span class=\"desktop-text black-font\">Logout/Signout</span><span class=\"mobile-text black-font\">SO</span></a></li>";
            } else {
                $loginButton = "<li class=\"navbar-item\"><a class=\"button active\" href=\"login.php\"><span class=\"desktop-text black-font\">Login\Signup</span><span class=\"mobile-text black-font\">LI</span></a></li>";
            }
            break;
        case "manage":
            $manageButton = "<li class=\"navbar-item\"><a class=\"button active\" href=\"manage.php\"><span class=\"desktop-text black-font\">View Records</span><span class=\"mobile-text black-font\">M</span></a></li>";
            break;
        case "addadmin":
            $addAdminButton = "<li class=\"navbar-item\"><a class=\"button active\" href=\"addadmin.php\"><span class=\"desktop-text black-font\">Add Admin</span><span class=\"mobile-text black-font\">AA</span></a></li>";
            break;
        case "edit":
            $editButton = "<li class=\"navbar-item\"><a class=\"button active\" href=\"editdetails.php\"><span class=\"desktop-text black-font\">Edit Records</span><span class=\"mobile-text black-font\">AA</span></a></li>";
            break;
        }
    }
    
    if(isset($manageButton)) {
        echo "<nav class=\"banner-background navbar\">
                <ul class=\"navbar-container\">
                    {$indexButton}
                    {$topicButton}
                    {$quizButton}
                    {$enhancementButton}
                    {$enhancementPHPButton}
                    {$manageButton}
                    {$editButton}
                    {$addAdminButton}
                    {$loginButton}
                </ul>
        </nav>";
    } else {
        echo "<nav class=\"banner-background navbar\">
                <ul class=\"navbar-container\">
                    {$indexButton}
                    {$topicButton}
                    {$quizButton}
                    {$enhancementButton}
                    {$enhancementPHPButton}
                    {$loginButton}
                </ul>
        </nav>";

    }

    ?>