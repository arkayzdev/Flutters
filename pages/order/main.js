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
    console.log("ccava");
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
  let validate_pc = document.getElementById("order_validate_pc");
  let validate_mobile = document.getElementById("order_validate_mobile");
  let validate_mobile_i = document.getElementById("order_validate_mobile_i");

  if (input_quantity.value == 0) {
    quantity.style.opacity = "0.5";
    document.getElementById("select_ticket_total").style.backgroundColor =
      "lightgrey";

    validate_pc.style.backgroundColor = "lightgrey";
    validate_pc.disabled = true;

    validate_mobile_i.style.color = "lightgrey";
    validate_mobile.disabled = true;
  }
  if (input_quantity.value != 0) {
    quantity.style.opacity = "1";
    document.getElementById("select_ticket_total").style.backgroundColor =
      "rgba(227, 41, 40, 0.9)";

    validate_pc.style.backgroundColor = "rgba(227, 41, 40, 0.9)";
    validate_pc.disabled = false;

    validate_mobile_i.style.color = "rgba(227, 41, 40, 1)";
    validate_mobile.disabled = false;
  }
}

function redirect_payment(session_id) {
  let quantity = document.getElementById("select_ticket_value").value;

  console.log(quantity);
  console.log(session_id);
  console.log(email);

  window.location.href =
    "test.php?id_session=" + session_id + "&quantity=" + quantity;
}
