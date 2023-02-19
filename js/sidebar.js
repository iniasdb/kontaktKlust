let sidebarBtn = document.querySelector("#menu-btn");
let sidebar = document.querySelector("nav");
let main = document.querySelector("main");
let activeLink = document.querySelector("#active");
let open = false;

sidebarBtn.addEventListener("click", (e) => {
    if (open) {
        sidebar.style.width = "0px";
        open = false;
    } else {
        sidebar.style.width = "70%";
        open = true;
    }
})

main.addEventListener("click", (e) => {
    if (open) {
        sidebar.style.width = "0px";
        open = false;
    } 
})

activeLink.addEventListener("click", (e) => {
    sidebar.style.width = "0px";
    open = false;
})

