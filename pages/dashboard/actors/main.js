async function searchActors() {
    const input = document.getElementById('search-actor-input');
    const name = input.value;
    const res = await fetch("api/search-actor.php?name=" + name);
    const str = await res.text();
    const div = document.getElementById('display-actor');
    div.innerHTML = str;
}

function deleteModal(id) {
    const btn = document.getElementById('delete-actor-btn');
    const alert = "Vous avez supprimé un acteur."
    btn.setAttribute('onclick', 'location.href = \'actors?alert=' + alert + '&type=delete&id=' + id + '\'');
}   
