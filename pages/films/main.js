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
