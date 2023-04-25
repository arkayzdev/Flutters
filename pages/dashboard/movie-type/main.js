var inputTrigger = document.getElementById("search-type-input");

// Execute a function when the user presses a key on the keyboard
inputTrigger.addEventListener("keypress", function (event) {
    // If the user presses the "Enter" key on the keyboard
    if (event.key === "Enter") {
        // Cancel the default action, if needed
        event.preventDefault();
        // Trigger the button element with a click
        document.getElementById("trigger-search-types").click();
    }
});

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
    btn.setAttribute('onclick', 'location.href = \'movie-type?type=delete&id=' + id + '\'');
}   