function deleteModal(id) {
    const btn = document.getElementById('delete-session-btn');
    btn.setAttribute('onclick', 'location.href = \'sessions?type=delete&id=' + id + '\'');
}  