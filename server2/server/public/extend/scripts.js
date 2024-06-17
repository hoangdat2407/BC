document.getElementById('showHintBtn').onclick = function() {
    document.getElementById('myModal').style.display = 'block';
}

document.getElementById('closeBtn').onclick = function() {
    document.getElementById('myModal').style.display = 'none';
}

window.onclick = function(event) {
    if (event.target == document.getElementById('myModal')) {
        document.getElementById('myModal').style.display = 'none';
    }
}
