async function searchLogs() {
    const input = document.getElementById('search-logs-input');
    const date = input.value;
    console.log(date);
    const res = await fetch("api/search-logs.php?date=" + date);
    const str = await res.text();
    const div = document.getElementById('display-logs');
    div.innerHTML = str;
}