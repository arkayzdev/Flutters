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

function startDrag(e) {
  // determine event object
  if (!e) {
    var e = window.event;
  }

  var targ = e.target ? e.target : e.srcElement;

  if (targ.className != 'dragme') { return };

  offsetX = e.clientX;
  offsetY = e.clientY;

  if (!targ.style.left) { targ.style.left = '0px' };
  if (!targ.style.top) { targ.style.top = '0px' };

  coordX = parseInt(targ.style.left);
  coordY = parseInt(targ.style.top);
  drag = true;

  document.onmousemove = dragDiv;

}
function dragDiv(e) {
  if (!drag) { return };
  if (!e) { var e = window.event };
  var targ = e.target ? e.target : e.srcElement;

  targ.style.left = coordX + e.clientX - offsetX + 'px';
  targ.style.top = coordY + e.clientY - offsetY + 'px';
  return false;
}
function stopDrag() {
  drag = false;
}
window.onload = function () {
  document.onmousedown = startDrag;
  document.onmouseup = stopDrag;
}