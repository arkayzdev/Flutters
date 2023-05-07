async function sub_newsletter() {
  let email = document.getElementById("sub_newsletter_input");
  let res = await fetch(
    "/pages/footer/sub_newsletter.php?email=" + email.value
  );
  console.log("HEYHEY");
  let text = await res.text();
  let div = document.getElementById("sub_newsletter_div");
  div.innerHTML = text;
}
