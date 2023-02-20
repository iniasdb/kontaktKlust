let filterBtn = document.querySelector("#filterToggleBtn");
let filters = document.querySelector(".filter");
let showing = false;

filterBtn.addEventListener("click", (e) => {
    console.log("ja");
    if (showing) {
        filters.style.display = "none";
        filterBtn.innerHTML = "Show Filters"
        showing = false;
    } else {
        filters.style.display = "grid";
        filterBtn.innerHTML = "Hide Filters";
        showing = true;
    }
})