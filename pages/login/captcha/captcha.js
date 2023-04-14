var swap = 0;
var saved_id;
var saved_img;
var file = getElementById("captcha_files").innerHTML;

// Shuffle captcha function
function shuffle_captcha() {
  file = Math.floor(Math.random() * 8) + 1;
  console.log(file);

  let tab = [1, 2, 3, 4, 5, 6, 7, 8, 9];

  // Shuffle array
  tab.sort(function () {
    return Math.random() - 0.5;
  });
  console.log(tab);

  for (let i = 1; i <= 9; i++) {
    document.getElementById(i).src =
      "https://flutters.ovh/pages/login/captcha/Captcha-Library/" +
      file +
      "/" +
      tab[i - 1] +
      ".png";
  }
}

// Captcha switch pieces
function captcha(id) {
  let element = document.getElementById(id);

  if (swap == 0) {
    saved_id = element.id;
    saved_img = element.src;

    document.getElementById(id).style = "border:3px solid green";
    swap = 1;
  } else {
    prev_element = document.getElementById(saved_id);

    prev_element.src = element.src;
    element.src = saved_img;

    swap = 0;

    for (let i = 1; i <= 9; i++) {
      document.getElementById(i).style = "border:none";
    }

    check();
  }
}

// Iteration -> Check if every pieces are at place
function check() {
  let check = 0;

  for (let i = 9, j = 1; i >= 1; i--, j++) {
    if (
      document.getElementById(j).src ==
      "https://flutters.ovh/pages/login/captcha/Captcha-Library/" +
      file +
      "/" +
      i +
      ".png"
    ) {
      check += 1;
    }
    console.log("-------------------------");
    console.log(document.getElementById(i).src);
    console.log(
      "https://flutters.ovh/pages/login/captcha/Captcha-Library/" +
      file +
      "/" +
      i +
      ".png"
    );
  }
  if (check == 9) {
    document.getElementById("1").style =
      "border-left:3px solid green; border-top:3px solid green";
    document.getElementById("2").style = "border-top:3px solid green";
    document.getElementById("3").style =
      "border-top:3px solid green; border-right:3px solid green";
    document.getElementById("4").style = "border-left:3px solid green";
    document.getElementById("5").style = "";
    document.getElementById("6").style = "border-right:3px solid green";
    document.getElementById("7").style =
      "border-left:3px solid green; border-bottom:3px solid green";
    document.getElementById("8").style = "border-bottom:3px solid green;";
    document.getElementById("9").style =
      "border-right:3px solid green; border-bottom:3px solid green";

    document.getElementById("captcha_footer").style = "display:block";

    document.getElementById("captcha_form_input").value = 1;

    const btn = document.getElementById("captcha_button");
    btn.innerHTML = "Captcha complété";
    btn.classList = "btn btn-success mt-3";

    document.getElementById("captcha_modal").id = "";

    for (let i = 1; i <= 9; i++) {
      document.getElementById(i).onclick = "";
    }
  }
}
