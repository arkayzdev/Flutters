const elH = document.querySelectorAll(".timeline li > div");

// début de l'animation
window.addEventListener("load", init);

function init() {
  setEqualHeights(elH);
}

function setEqualHeights(el) {
  let counter = 0;
  for (let i = 0; i < el.length; i++) {
    const singleHeight = el[i].offsetHeight;

    if (counter < singleHeight) {
      counter = singleHeight;
    }
  }

  for (let i = 0; i < el.length; i++) {
    el[i].style.height = `${counter}px`;
  }
}
