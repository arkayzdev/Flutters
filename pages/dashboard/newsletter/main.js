async function searchActors() {
  const input = document.getElementById("search-actor-input");
  const name = input.value;
  const res = await fetch("api/search-user.php?name=" + name);
  const str = await res.text();
  const div = document.getElementById("display-actor");
  div.innerHTML = str;
}

function deleteModal(id) {
  const btn = document.getElementById("delete-actor-btn");
  const alert = "Vous avez supprimé un utilisateur.";
  btn.setAttribute(
    "onclick",
    "location.href = 'newsletter?alert=" + alert + "&type=delete&id=" + id + "'"
  );
}

var loadFile = function (event) {
  var output = document.getElementById("preview-image");
  output.src = URL.createObjectURL(event.target.files[0]);
  output.onload = function () {
    URL.revokeObjectURL(output.src);
  };
};
