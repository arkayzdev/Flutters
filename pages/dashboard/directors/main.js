var inputTrigger = document.getElementById("search-director-input");

// Execute a function when the user presses a key on the keyboard
inputTrigger.addEventListener("keypress", function (event) {
    // If the user presses the "Enter" key on the keyboard
    if (event.key === "Enter") {
        // Cancel the default action, if needed
        event.preventDefault();
        // Trigger the button element with a click
        document.getElementById("trigger-search-directors").click();
    }
});

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
    btn.setAttribute('onclick', 'location.href = \'directors?type=delete&id=' + id + '\'');
}