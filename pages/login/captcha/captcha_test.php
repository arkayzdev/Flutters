<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Import Bootstrap CSS Library -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Import css -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
</head>
<body>

<h1>Puzzle Captcha</h1>
  <canvas id="canvas"></canvas>
  <button id="recharger">Recharger</button>
  <script>
  window.onload = function() {
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");
    var image = new Image();
    var taille = 100; // La taille de chaque morceau d'image

    // Chargez l'image et découpez-la en morceaux
    image.onload = function() {
      var morceaux = [];
      for (var y = 0; y < image.height; y += taille * 3) {
        for (var x = 0; x < image.width; x += taille * 3) {
          var morceau = ctx.createImageData(taille, taille);
          for (var i = 0; i < taille; i++) {
            for (var j = 0; j < taille; j++) {
              var index = (i + j * taille) * 4;
              var pixelX = x + i;
              var pixelY = y + j;
              ctx.drawImage(image, pixelX, pixelY, 1, 1, i, j, 1, 1);
              var pixel = ctx.getImageData(i, j, 1, 1);
              morceau.data[index] = pixel.data[0];
              morceau.data[index + 1] = pixel.data[1];
              morceau.data[index2] = pixel.data[2];
morceau.data[index + 3] = pixel.data[3];
}
}
morceaux.push(morceau);
}
}
// Mélangez les morceaux de l'image
for (var i = morceaux.length - 1; i > 0; i--) {
  var j = Math.floor(Math.random() * (i + 1));
  var temp = morceaux[i];
  morceaux[i] = morceaux[j];
  morceaux[j] = temp;
}

// Dessinez les morceaux de l'image mélangés sur le canvas
var index = 0;
for (var y = 0; y < canvas.height; y += taille * 3) {
  for (var x = 0; x < canvas.width; x += taille * 3) {
    ctx.putImageData(morceaux[index], x, y);
    index++;
  }
}

// Ajoutez une étape de vérification pour l'utilisateur
image.src = "Captcha-Library/test.jpg"; // Remplacez "mon_image.jpg" par le chemin de votre image

var recharger = document.getElementById("recharger");
recharger.onclick = function() {
location.reload();
};
};
};
</script>


    <!-- Import Bootstrap JS Library -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
<!-- <script src="captcha.js"></script> -->
</body>
</html>