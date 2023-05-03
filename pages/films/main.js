// For filter
async function film_search() {
  let res = await fetch(
    "api/create_a_l_affiche.php?search=" +
      document.getElementById("film_search").value
  );
  let str = await res.text();
  let div = document.getElementById("a_l_affiche");
  div.innerHTML = str;

  res = await fetch(
    "api/create_tous_les_films.php?search=" +
      document.getElementById("film_search").value
  );
  str = await res.text();
  div = document.getElementById("tous_les_films");
  div.innerHTML = str;
}

// Calendar
async function calendar_button_trigger(val, id) {
  // Red Border
  let last_saved_element = document.getElementById(
    "calendar_selected_date"
  ).value;
  let last_element = document.getElementById(last_saved_element);
  let new_element = document.getElementById(val);

  last_element.style.borderBottom = "none";
  new_element.style.borderBottom = "2px solid red";
  document.getElementById("calendar_selected_date").value = new_element.id;

  // Actualize sessions
  let res = await fetch(
    "api/create_film_session.php?search=" + val + "&id=" + id
  );
  let str = await res.text();
  let div = document.getElementById("film_session_sub_div");
  div.innerHTML = str;
}

// Open calendar
function open_calendar() {
  let a = document.getElementById("calendar_button_input");
  a.showPicker();
  console.log(a.min);
}

// Reload calendar array
async function calendar_button_date(val, id) {
  console.log(val);
  // Actualize dates
  console.log("api/create_calendar.php?date=" + val + "&id=" + id);
  let res = await fetch("api/create_calendar.php?date=" + val + "&id=" + id);
  let str = await res.text();
  let div = document.getElementById("film_calendar_div");
  div.innerHTML = str;

  // Actualize sessions
  res = await fetch("api/create_film_session.php?search=" + val + "&id=" + id);
  str = await res.text();
  div = document.getElementById("film_session_sub_div");
  div.innerHTML = str;

  // Actualize border
  calendar_button_trigger(val, id);
}

async function calendar_reload(val, id) {
  // Actualize dates
  console.log("api/create_calendar.php?date=" + val + "&id=" + id);
  let res = await fetch("api/create_calendar.php?date=" + val + "&id=" + id);
  let str = await res.text();
  let div = document.getElementById("film_calendar_div");
  div.innerHTML = str;

  // Actualize sessions
  res = await fetch("api/create_film_session.php?id=" + id);
  str = await res.text();
  div = document.getElementById("film_session_sub_div");
  div.innerHTML = str;

  mobile_btn_reload(id);
}

async function mobile_btn_reload(id) {
  let res = await fetch("api/mobile_date_button.php?id=" + id);
  let str = await res.text();
  let div = document.getElementById("switch_btn_mobile_div");
  div.innerHTML = str;
}

// Comment

async function comment_show_more(email, id) {
  let res = await fetch(
    "api/create_commentaire.php?all=1&id=" + id + "&email=" + email
  );
  let str = await res.text();
  let div = document.getElementById("film_comment_sub_div");
  div.innerHTML = str;

  let btn = document.getElementById("film_comment_button");
  btn.innerHTML = "Voir moins";
  btn.setAttribute(
    "onClick",
    "comment_show_less('" + email + "','" + id + "')"
  );
}

async function comment_show_less(email, id) {
  let res = await fetch(
    "api/create_commentaire.php?id=" + id + "&email=" + email
  );
  let str = await res.text();
  let div = document.getElementById("film_comment_sub_div");
  div.innerHTML = str;

  let btn = document.getElementById("film_comment_button");
  btn.innerHTML = "Voir plus";
  btn.setAttribute(
    "onClick",
    " comment_show_more('" + email + "','" + id + "') "
  );
}

async function my_comment_modify(email, id) {
  console.log(email);
  let res = await fetch(
    "api/my_comment_modify.php?id=" + id + "&email=" + email
  );
  let str = await res.text();
  let div = document.getElementById("film_comment_my_content");
  div.innerHTML = str;
}

function comment_stars_value(val) {
  console.log(val);
  let stars = document.getElementsByClassName("comment_stars");
  for (let i = 0; i < val; i++) stars[i].style.color = "red";
  for (let i = val; i < 5; i++) stars[i].style.color = "lightgrey";
  document.getElementById("comment_stars_value").value = val;
}

async function my_comment_modify_send(email, id) {
  email;
  let description = document.getElementById("comment_stars_description").value;
  let stars = document.getElementById("comment_stars_value").value;

  console.log(email);
  let res = await fetch(
    "api/my_comment_send.php?id=" +
      id +
      "&email=" +
      email +
      "&stars=" +
      stars +
      "&description=" +
      description
  );
  // let str = await res.text();
  // let div = document.getElementById("film_comment_my_content");
  // div.innerHTML = str;
  comment_show_less(email, id);
}

async function my_comment_create(email, id) {
  console.log(email);
  let res = await fetch(
    "api/my_comment_create.php?id=" + id + "&email=" + email
  );
  let str = await res.text();
  let div = document.getElementById("film_comment_my_content");
  div.innerHTML = str;
}

async function my_comment_create_send(email, id) {
  email;
  let description = document.getElementById("comment_stars_description").value;
  let stars = document.getElementById("comment_stars_value").value;

  let res = await fetch(
    "api/my_comment_create_send.php?id=" +
      id +
      "&email=" +
      email +
      "&stars=" +
      stars +
      "&description=" +
      description
  );
  // let str = await res.text();
  // let div = document.getElementById("film_comment_my_content");
  // div.innerHTML = str;
  comment_show_less(email, id);
}

function remove_show_btn() {
  document.getElementById("film_comment_button").style.display = "none";
}

// Redirection
function redirect_session(id_session, id_movie) {
  window.location.href =
    "../order/session_order.php?id_session=" +
    id_session +
    "&id_movie=" +
    id_movie;
}
