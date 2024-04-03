<?php
session_start();
require_once(__DIR__ . "/fonction/name.php");
require_once(__DIR__ . "/fonction/skills.php");
require_once(__DIR__ . "/fonction/work.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Jules Crevoisier</title>
</head>
<body>
    <header class="top-pages">
        <nav class="nav-bar">
            <h1 class="name-top-pages">
            Jules Crevoisier
            </h1>
            <button class="menu-hamburger">☰</button>
            <ul class="navbar-list">
                <li class="navbar-bouton"><a href="#skills">skills</a></li>
                <li class="navbar-bouton"><a href="#work">work</a></li>
                <li class="navbar-bouton"><a href="#contact">contact</a></li>
            </ul>

        </nav>
            <ul class="menu-drop hide">
                <li class="menu-drop-bouton"><a href="#skills">about</a></li>
                <li class="menu-drop-bouton"><a href="#work">work</a></li>
                <li class="menu-drop-bouton"><a href="#contact">contact</a></li>
            </ul>
    </header>
    <div class="name-pp-container">
        <?php name() ?>
        <div class="pp">
            <img src="img/ppn.png" alt="">
        </div>
    </div>
    <?php skills() ?>
    <section class="background-work-footer">
    <?php work() ?>
    <footer>
        <div id="contact" class="contact-form-container">
            <h2>Contactez-moi</h2>
            <?php if (isset($_GET['error']) && $_GET['error'] === 'captcha'): ?>
                <div class="error-message">Erreur de captcha. Veuillez réessayer.</div>
            <?php endif; ?>
            <form action="php/submit_form.php" method="post">
                <input type="text" name="name" placeholder="Nom" required>
                <input type="email" name="email" placeholder="Email" required>
                <textarea name="message" placeholder="Message" required></textarea>
                <img class="captcha-img" src="php/captcha/captcha.php" alt="Captcha">
                <input type="text" name="captcha" placeholder="Entrez le code captcha" required>
                <button type="submit">Envoyer</button>
            </form>
        </div>
        <div class="footer-links">
            <p>&copy; 2024 Jules Crevoisier. Tous droits réservés.</p>
        </div>
    </footer>
    </section>
    <script src="js/script.js"></script>
</body>
</html>
