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
            $activePage = "enhancements";   
            include("menu.inc") 
        ?>
    <!-- Breaks nav bar if not used -->
    <br><br><br><br>
    <main>
        <?php include("header.inc") ?>
        <section>
            <fieldset class="fieldset-settings general-settings">
                <h2 class="font-general headings">Enhancement 1 - Responsive Design</h2>
                <p class="font-general paragraph">what is responsive design, it is a way of designing a website such that it would respond to changes in devices be it screen width, orientation etc. In the base website that is to implemented without any media queries to change from desktop
                    to mobile, the menu bar would not work quite as well as the text would make the buttons too large for the width found in mobile devices and text that is unreadable in mobile as it would be too small.</p>
                <ol>
                    <li class="font-general">Graphics Interchange Format (GIF) is one of the earliest file formats. Although it lacks alpha transparency, it supports 8-bit colour and is one of the most popular animated picture file formats.</li>
                    <li class="font-general">WebP was first developed in 2010 by Google. WebP has similar features to APNG including 24-bit colour and 8-bit transparency, as well as lossy and lossless compression, which allows for minimal file sizes whilst also maintaining excellent
                        quality.
                    </li>
                </ol>
                <p class="font-general paragraph">Sources - <a class="link" href="https://www.w3schools.com/css/css_rwd_mediaqueries.asp">w3schools - Responsive Web Design</a></p>
                <br><br>
                <a href="index.php" class="go-button">Go to Example</a>
            </fieldset>
        </section>
        <section>
            <fieldset class="fieldset-settings general-settings">
                <h2 class="font-general headings">Enhancement 2 - Animations</h2>
                <p class="font-general paragraph">Animations add a pop to a website as such we have implemented a variety of different animations in the website such
                </p>
                <ul>
                    <li class="font-general">as using transitions to make the sections appear when the page is loaded.</li>
                    <li class="font-general">By making use of a png with a transparent logo in the topic page we were able to try and recreate a light flickering effect.</li>
                    <li class="font-general">In the index page the youtube button made using css shapes was animated to have a plusing effect to simulate a heart beat.</li>
                </ul>
                <p class="font-general paragraph">Sources - <a class="link" href="https://www.w3schools.com/css/css3_animations.asp">w3schools - Animations</a></p>
                <br><br>
                <a href="index.php" class="go-button">Go to Example</a>
            </fieldset>

        </section>
        <br><br><br><br>
    </main>
        <?php include("footer.inc") ?>
</body>

</html>