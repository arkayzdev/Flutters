<?php 
session_start();
$ban = (isset($_SESSION['status']) && $_SESSION['status'] == 'ban') ? true : false;
if(!$ban){ 
    header('location: https://flutters.ovh');
    exit();
}
?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Banni</title>
</head>
<body style="display: flex; justify-content: center; align-items: center;">
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <h1 style="margin-bottom: 100px;">Vous avez été banni.</h1>
        <button style="margin-bottom: 100px; padding:1em; background-color: white; border: solid 1px black; border-radius: 6px"><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley" target="_blank" style="text-decoration: none; color: black">Débannir</a></button>
        <img src="troll-face.gif">
    </div>
    
</body>
</html>