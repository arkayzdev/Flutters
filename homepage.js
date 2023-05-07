document.querySelectorAll(".accordion__question").forEach((item) => {
  item.addEventListener("click", (event) => {
    console.log("click!");
    let accCollapse = item.nextElementSibling;

    if (!item.classList.contains("collapsing")) {
      // Ouvrir l'accordéon
      if (!item.classList.contains("open")) {
        console.log("toggle accordion button");

        accCollapse.style.display = "block";
        let accHeight = accCollapse.clientHeight;
        console.log(accHeight);

        setTimeout(() => {
          accCollapse.style.height = accHeight + "px";
          accCollapse.style.display = "";
        }, 1);

        accCollapse.classList = "accordion__collapse collapsing";

        setTimeout(() => {
          console.log("open accordion content");
          accCollapse.classList = "accordion__collapse collapse open";
        }, 300);
      }
      // Fermer l'accordéon
      else {
        accCollapse.classList = "accordion__collapse collapsing";

        setTimeout(() => {
          accCollapse.style.height = "0px";
        }, 1);

        setTimeout(() => {
          console.log("close accordion content");
          accCollapse.classList = "accordion__collapse collapse";
          accCollapse.style.height = "";
        }, 300);
      }

      item.classList.toggle("open");
    }
  });
});

let PASSCODE = ['e', 's', 'g', 'i'],
  current = 0,
  confetti = document.getElementById('mystere-confetti');

function keyListener(e) {
  let code = e.keyCode || e.which,
    str = String.fromCharCode(code);

  if (str === PASSCODE[current]) {
    current++;
    if (current >= PASSCODE.length) {
      confetti.style.display = "flex";
      setTimeout(function () {
        window.open("https://www.esgi.fr/");
        confetti.style.display = "none";
      }, 2000);
    }
  } else {
    current = 0;
  }

}

document.addEventListener("keypress", keyListener);