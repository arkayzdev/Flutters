// Preview Image
var loadFile = function (event) {
    var output = document.getElementById('preview-image')
    output.src = URL.createObjectURL(event.target.files[0])
    output.onload = function () {
        URL.revokeObjectURL(output.src)
    }
}

async function searchMovies() {
    const input = document.getElementById('search-movie-input');
    const name = input.value;
    const res = await fetch("api/search-movie.php?name=" + name);
    const str = await res.text();
    const div = document.getElementById('display-movie');
    div.innerHTML = str;
}


function deleteModal(id) {
    const btn = document.getElementById('delete-event-btn');
    const alert = "Vous avez supprimé un événement."
    btn.setAttribute('onclick', 'location.href = \'events?alert=' + alert + '&type=delete&id=' + id + '\'');
}   