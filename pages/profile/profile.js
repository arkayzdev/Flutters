function change_avatar() {
  document.getElementById("avatar_submit_btn").submit();
}

function delete_avatar() {
  location.href = "avatar_delete.php";
}

function download_order_pdf(order_id) {
  location.href = "../order/order_pdf/generate_pdf.php?order_id=" + order_id;
}
function download_event_pdf(order_id) {
  location.href = "../events/events_pdf/generate_pdf.php?order_id=" + order_id;
}

function download_user_pdf() {
  location.href = "user_pdf/generate_user_pdf.php";
}
