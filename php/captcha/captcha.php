<?php
session_start();

// Définissez la liste des caractères possibles
$possible_characters = '23456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

// Créez un code captcha aléatoire de 5 caractères
$code = substr(str_shuffle($possible_characters), 0, 5);

// Enregistrez le code captcha dans la session
$_SESSION['captcha_code'] = $code;

// Créez l'image
$image_width = 600;
$image_height = 80;
$image = imagecreate($image_width, $image_height);

// Définissez les couleurs
$background_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
$line_color = imagecolorallocate($image, 128, 128, 128);

// Remplissez l'image avec la couleur de fond
imagefilledrectangle($image, 0, 0, $image_width, $image_height, $background_color);

// Ajoutez des lignes aléatoires
for ($i = 0; $i < 10; $i++) {
    imageline($image, rand(0, $image_width), rand(0, $image_height), rand(0, $image_width), rand(0, $image_height), $line_color);
}

// Ajoutez le texte du captcha avec une police aléatoire
$font_size = 20;
$font_angle = rand(-15, 15);
$font_file = '/mnt/portfolio/portfoliofin/php/fonts/times_new_yorker.ttf'; // Remplacez par le chemin d'accès à un fichier de police TTF

do {
    $text_box = imagettfbbox($font_size, $font_angle, $font_file, $code);
    $text_width = $text_box[4] - $text_box[0];
    $font_size = min($font_size + 5, 60); // Augmentez la taille de la police jusqu'à un maximum de 60
} while ($text_width > $image_width - 20); // Vérifiez si la largeur du texte est inférieure à la largeur de l'image moins 20 pixels de marge

$x = ($image_width - $text_width) / 2;
$y = ($image_height + $text_box[1]) / 2;
imagettftext($image, $font_size, $font_angle, $x, $y, $text_color, $font_file, $code);

// Envoyez les en-têtes appropriés et affichez l'image
header('Content-Type: image/png');
imagepng($image);

// Libérez la mémoire
imagedestroy($image);
?>
