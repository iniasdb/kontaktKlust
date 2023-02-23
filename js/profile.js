let editButton = document.querySelector("#editBtn");
let editForm = document.querySelector("#editForm");
let showing = false;

editButton.addEventListener("click", (e) => {
    if (showing) {
        editForm.style.display = "none";
        editButton.innerHTML = "Edit Profile"
        showing = false;
    } else {
        editForm.style.display = "block";
        editButton.innerHTML = "Close Form"
        showing = true;
    }
})