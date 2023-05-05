async function searchSessions() {
    const input = document.getElementById('search-session-input');
    const name = input.value;
    const res = await fetch("api/search-session.php?name=" + name);
    const str = await res.text();
    const div = document.getElementById('display-session');
    div.innerHTML = str;
}

function deleteModal(id) {
    const btn = document.getElementById('delete-session-btn');
    btn.setAttribute('onclick', 'location.href = \'sessions?type=delete&id=' + id + '\'');
}  