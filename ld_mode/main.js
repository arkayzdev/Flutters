//class="ld_item"

// LD MODE COOKIES PAS TOUCHER
// if (!isset($_COOKIE['ld_mode'])) {
//     setcookie("ld_mode", 3, time()+3600);
// }
// include ($_SERVER['DOCUMENT_ROOT'].'/ld_mode/ld_mode.php');

// LD MODE JS
// <script src="https://flutters.ovh/ld_mode/main.js"></script>

if (check_cookie_name() == 1) {
  console.log(check_cookie_name());
  load_night();
} else if (check_cookie_name() == 0) {
  console.log(check_cookie_name());
  load_sun();
}

async function ld_switch() {
  // Change actual page button
  let actual_status = document.getElementById("ld_button");

  if (actual_status.value == 0) {
    actual_status.style.backgroundColor = "rgb(45, 45, 45)";
    actual_status.value = "1";
    document.cookie = "ld_mode=1";
    load_night();
  } else if (actual_status.value == 1) {
    actual_status.style.backgroundColor = "rgb(227,41,40)";
    actual_status.value = "0";
    document.cookie = "ld_mode=0";
    load_sun();
  }

  // Change session ld_mode & change button icon
  let res = await fetch(
    "/ld_mode/modify_session_value.php?ld_mode=" + actual_status.value
  );
  let text = await res.text();
  let div = document.getElementById("ld_button");
  div.innerHTML = text;
}

function load_sun() {
  console.log("LOAD_SUN");
  let ld_item = document.getElementsByClassName("ld_item");
  let ld_itema = document.getElementsByClassName("ld_itema");
  let ld_calendar_btn = document.getElementsByClassName("ld_itemz");
  for (let i = 0; i < ld_item.length; i++) {
    ld_item[i].style.backgroundColor = "rgba(255, 255, 255, 1)";
    ld_item[i].style.transition = "0.3s";
  }
  for (let i = 0; i < ld_itema.length; i++) {
    ld_itema[i].style.color = "black";
    ld_itema[i].style.transition = "0.3s";
  }
  for (let i = 0; i < ld_calendar_btn.length; i++) {
    ld_calendar_btn[i].style.boxShadow = "rgba(0, 0, 0, 0.1) 0px 5px 15px";
    ld_calendar_btn[i].style.transition = "0.3s";
  }
}

function load_night() {
  console.log("LOAD_NIGHT");
  let ld_item = document.getElementsByClassName("ld_item");
  let ld_itema = document.getElementsByClassName("ld_itema");
  let ld_calendar_btn = document.getElementsByClassName("ld_itemz");
  for (let i = 0; i < ld_item.length; i++) {
    ld_item[i].style.backgroundColor = "rgba(71,71,71,1)";
    ld_item[i].style.transition = "0.3s";
  }
  for (let i = 0; i < ld_itema.length; i++) {
    ld_itema[i].style.color = "white";
    ld_itema[i].style.transition = "0.3s";
  }
  for (let i = 0; i < ld_calendar_btn.length; i++) {
    ld_calendar_btn[i].style.boxShadow =
      "rgba(120, 120, 120, 0.45) 0px 5px 15px";
    ld_calendar_btn[i].style.transition = "0.3s";
  }
}

function check_cookie_name() {
  var match = document.cookie.match(
    new RegExp("(^| )" + "ld_mode" + "=([^;]+)")
  );

  return match[2];
}
