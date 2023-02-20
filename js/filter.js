let filterTglBtn = document.querySelector("#filterToggleBtn");
let filters = document.querySelector(".filter");
let showing = false;

let filterBtn = document.querySelector("#filterBtn");
let sortBy = document.querySelector("#sortBy");
let filterTags = document.querySelector("#filterTags");
let selectedTagsElement = document.querySelector("#selectedTags");
let selectedTag = document.querySelectorAll(".tag")
let selectedTags = [];

let tasks = document.querySelectorAll(".task");

filterTglBtn.addEventListener("click", toggleForm);

function toggleForm() {
    if (showing) {
        filters.style.display = "none";
        filterTglBtn.innerHTML = "Show Filters"
        showing = false;
    } else {
        filters.style.display = "grid";
        filterTglBtn.innerHTML = "Hide Filters";
        showing = true;
    }
}

filterTags.addEventListener("change", () => {
    tag = filterTags.value;
    if (tag) {
        if (!selectedTags.includes(tag)) {
            selectedTags.push(tag);

            let dateSpan = document.createElement('span');
            dateSpan.classList.add("tag");
            dateSpan.innerHTML = tag;
            
            selectedTagsElement.appendChild(dateSpan)
            refreshTags();
            filterTags.value = "";
        }
    }
})

filterBtn.addEventListener("click", filterBtnClicked);

function filterBtnClicked() {
    filter();
    toggleForm();
}

function filter() {
    if (selectedTags.length == 0) {
        tasks.forEach(task => {
            task.style.display = "grid";
        })
    } else {
        tasks.forEach(task => {
            task.style.display = "grid";
    
            objTags = task.children[3].innerHTML.substring(6).split(", ");
            res = objTags.find((tag) => {
                return selectedTags.includes(tag);
            })
    
            if (!res) {
                task.style.display = "none";
            }
        });
    }
}

function refreshTags() {
    selectedTag = document.querySelectorAll(".tag")
    selectedTag.forEach(tag => {
        tag.addEventListener("click", () => {
            selectedTags.pop(tag.innerHTML);
            selectedTagsElement.removeChild(tag);
            filter();
        })
    });
}