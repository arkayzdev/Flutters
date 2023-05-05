var inputTrigger = document.getElementById("search-user-input");

// Execute a function when the user presses a key on the keyboard
inputTrigger.addEventListener("keypress", function (event) {
    // If the user presses the "Enter" key on the keyboard
    if (event.key === "Enter") {
        // Cancel the default action, if needed
        event.preventDefault();
        // Trigger the button element with a click
        document.getElementById("trigger-search-users").click();
    }
});

async function searchUsers() {
    const input = document.getElementById('search-user-input');
    const name = input.value;
    const res = await fetch("api/search-user.php?name=" + name);
    const str = await res.text();
    const div = document.getElementById('display-user');
    div.innerHTML = str;
}


function deleteModal(id) {
    const btn = document.getElementById('delete-user-btn');
    btn.setAttribute('onclick', 'location.href = \'users?type=delete&id=' + id + '\'');
}

function banModal(id) {
    const btn = document.getElementById('ban-user-btn');
    btn.setAttribute('onclick', 'location.href = \'api/ban?id=' + id + '\'');
}

function unbanModal(id) {
    const btn = document.getElementById('unban-user-btn');
    btn.setAttribute('onclick', 'location.href = \'api/unban?id=' + id + '\'');
}

