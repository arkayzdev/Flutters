var inputTrigger = document.getElementById("search-actor-input");

// Execute a function when the user presses a key on the keyboard
inputTrigger.addEventListener("keypress", function (event) {
    // If the user presses the "Enter" key on the keyboard
    if (event.key === "Enter") {
        // Cancel the default action, if needed
        event.preventDefault();
        // Trigger the button element with a click
        document.getElementById("trigger-search-actors").click();
    }
});

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
