async function searchDirectors() {
    const input = document.getElementById('search-director-input');
    const name = input.value;
    const res = await fetch("api/search-director.php?name=" + name);
    const str = await res.text();
    const div = document.getElementById('display-director');
    div.innerHTML = str;
}

function deleteModal(id) {
    const btn = document.getElementById('delete-director-btn');
    const alert = "Vous avez supprimé un réalisateur."
    btn.setAttribute('onclick', 'location.href = \'directors?alert=' + alert + '&type=delete&id=' + id + '\'');
}