function control_ticket(order_id) {
  let code = document.getElementById("code").value;
  document.location.href =
    "verify_control_ticket.php?order_id=" + order_id + "&code=" + code;
}
