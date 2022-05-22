<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Index/Home Page - Page that users intially land on">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author" content="Tharin Sandipa, Joely Newman, Mohammad Hassanuzzaman">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../Images/APNGLogoNoBackground.png">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="import" href="'https://fonts.googleapis.com/css?family=Rubik:700&display=swap'">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'>
    <title>Animated Portable Network Graphics</title>
</head>

<body>
    <?php
            $activePage = "index";   
            include("menu.inc") 
        ?>
    <main>
        <!-- <nav class="banner-background navbar">
            <ul class="navbar-container">
                <li class="navbar-item"><a class="button active" href="index.php"><span class="desktop-text black-font">Index</span><span class="mobile-text black-font">I</span></a></li>
                <li class="navbar-item"><a class="button" href="topic.php"><span class="desktop-text">Topic</span><span class="mobile-text">T</span></a></li>
                <li class="navbar-item"><a class="button" href="quiz.php"><span class="desktop-text">Quiz</span><span class="mobile-text">Q</span></a></li>
                <li class="navbar-item"><a class="button" href="enhancements.php"><span class="desktop-text">Enhancement</span><span class="mobile-text">E</span></a></li>
            </ul>
        </nav> -->
        
        <br><br><br><br>
        <?php include("header.inc") ?>
        <div class="special-letter-container-top mobile-shift">
            <span class="Letter1">A</span>
            <span class="Letter2">N</span>
            <span class="Letter3">I</span>
            <span class="Letter4">M</span>
            <span class="Letter5">A</span>
            <span class="Letter6">T</span>
            <span class="Letter7">E</span>
            <span class="Letter8">D</span>
            <span class="Letter9">P</span>
            <span class="Letter10">O</span>
            <span class="Letter11">R</span>
            <span class="Letter12">T</span>
            <span class="Letter13">A</span>
            <span class="Letter14">B</span>
            <span class="Letter15">L</span>
            <span class="Letter16">E</span>
        </div>
        <div class="mobile-padding mobile-shift">
            <img class="logo" src="../Images/APNGLogoNoBackground.png" alt="Website Logo">
        </div>
        <br><br><br>
        <div class="mobile-shift">
            <fieldset class="fieldset-settings">
                <a class="youtube-button" href="https://youtu.be/jNQcJMdh-mM">
                    <div class="youtube-triangle">
                        <div class="youtube-triangle"></div>
                    </div>
                </a>
            </fieldset>
        </div>
        <div class="special-letter-container-bottom mobile-shift">
            <span class="Letter17">N</span>
            <span class="Letter18">E</span>
            <span class="Letter19">T</span>
            <span class="Letter20">W</span>
            <span class="Letter21">O</span>
            <span class="Letter22">R</span>
            <span class="Letter23">K</span>
            <span class="Letter24">G</span>
            <span class="Letter25">R</span>
            <span class="Letter26">A</span>
            <span class="Letter27">P</span>
            <span class="Letter28">H</span>
            <span class="Letter29">I</span>
            <span class="Letter30">C</span>
            <span class="Letter31">S</span>
        </div>
        
    </main>
    <?php 
            $stayAtBottom = true;
            include("footer.inc") 
        ?>
</body>

</html>