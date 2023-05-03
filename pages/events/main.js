// For filter
async function event_search() {
  let res = await fetch(
    "api/create_event_a_venir.php?search=" +
      document.getElementById("event_search").value
  );
  let str = await res.text();
  let div = document.getElementById("a_l_affiche");
  div.innerHTML = str;

  res = await fetch(
    "api/create_event_passe.php?search=" +
      document.getElementById("event_search").value
  );
  str = await res.text();
  div = document.getElementById("tous_les_events");
  div.innerHTML = str;
}

// Ticket
function select_ticket(val, price) {
  let quantity = document.getElementById("select_ticket_quantity");
  let total = document.getElementById("select_ticket_total");
  let input_quantity = document.getElementById("select_ticket_value");

  // Add and Less
  if (val == "plus") {
    input_quantity.value = Number(input_quantity.value) + 1;
    quantity.innerHTML = input_quantity.value + " Billet(s)";
    total.innerHTML =
      "Prix Total : " +
      (Number(input_quantity.value) * Number(price)).toFixed(2) +
      "€ TTC";
  } else if (val == "minus") {
    input_quantity.value = Number(input_quantity.value) - 1;
    quantity.innerHTML = input_quantity.value + " Billet(s)";
    total.innerHTML =
      "Prix Total : " +
      (Number(input_quantity.value) * Number(price)).toFixed(2) +
      "€ TTC";
  }

  // Enable, Disable Buttons
  if (Number(input_quantity.value) == 0) {
    document.getElementById("select_ticket_minus").style.color = "lightgrey";
    document.getElementById("select_ticket_minus").disabled = true;
  }
  if (Number(input_quantity.value) == 8) {
    document.getElementById("select_ticket_plus").style.color = "lightgrey";
    document.getElementById("select_ticket_plus").disabled = true;
  }
  if (Number(input_quantity.value) != 8 && Number(input_quantity.value) != 0) {
    document.getElementById("select_ticket_plus").style.color = "#e32828";
    document.getElementById("select_ticket_plus").disabled = false;

    document.getElementById("select_ticket_minus").style.color = "#e32828";
    document.getElementById("select_ticket_minus").disabled = false;
  }

  // If quantity = 0*
  let validate = document.getElementById("select_ticket_total");

  if (input_quantity.value == 0) {
    quantity.style.opacity = "0.5";
    document.getElementById("select_ticket_total").style.backgroundColor =
      "lightgrey";

    validate.style.backgroundColor = "lightgrey";
    validate.disabled = true;
  }
  if (input_quantity.value != 0) {
    quantity.style.opacity = "1";
    document.getElementById("select_ticket_total").style.backgroundColor =
      "rgba(227, 41, 40, 0.9)";

    validate.style.backgroundColor = "rgba(227, 41, 40, 0.9)";
    validate.disabled = false;
  }
}

// Redirect Payment
function redirect_payment(session_id) {
  let quantity = document.getElementById("select_ticket_value").value;

  window.location.href =
    "/pages/events/stripe_send?id_event=" +
    session_id +
    "&quantity=" +
    quantity;
}

function download_ticket(order_id) {
  window.location.href = "events_pdf/generate_pdf.php?order_id=" + order_id;
}
