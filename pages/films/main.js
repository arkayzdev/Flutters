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

async function calendar_button_trigger(val) {
  let last_saved_element = document.getElementById(
    "calendar_selected_date"
  ).value;
  let last_element = document.getElementById(last_saved_element);
  let new_element = document.getElementById(val);

  last_element.style.borderBottom = "none";
  new_element.style.borderBottom = "1px solid red";

  console.log(document.getElementById("calendar_selected_date").value);
  document.getElementById("calendar_selected_date").id = new_element;
}
