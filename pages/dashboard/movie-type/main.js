async function searchTypes() {
    const input = document.getElementById('search-type-input');
    const name = input.value;
    const res = await fetch("api/search-movie-type.php?name=" + name);
    const str = await res.text();
    const div = document.getElementById('display-movie-type');
    div.innerHTML = str;
}

function deleteModal(id) {
    const btn = document.getElementById('delete-movie-type-btn');
    const alert = "Vous avez supprimé un genre."
    btn.setAttribute('onclick', 'location.href = \'movie-type?alert=' + alert + '&type=delete&id=' + id + '\'');
}   