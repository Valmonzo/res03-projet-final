window.addEventListener('DOMContentLoaded', function() {
    let selects = document.getElementsByClassName("top32");
    for (let i = 0; i < selects.length; i++) {
        selects[i].addEventListener('change', function(e) {
            console.log(e.target.value);
        });
    }
});
