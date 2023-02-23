let filterTags = document.querySelector("#filterTags");
let selectedTagsElement = document.querySelector("#selectedTags");
let selectedTag = document.querySelectorAll(".tag");
let tagInput = document.querySelector("#tagInput");
let selectedTags = [];

filterTags.addEventListener("change", () => {
    tag = filterTags.value;
    if (tag) {
        if (!selectedTags.includes(tag)) {
            selectedTags.push(tag);
            updateInputField();
            
            let tagSpan = document.createElement('span');
            tagSpan.classList.add("tag");
            let selectedText = filterTags.options[filterTags.selectedIndex].text;
            tagSpan.innerHTML = selectedText;
            
            selectedTagsElement.appendChild(tagSpan)
            refreshTags();
            filterTags.value = "";
        }
    }
})

function updateInputField() {
    let tagString = selectedTags.toString();
    tagInput.value = tagString;
}

function refreshTags() {
    selectedTag = document.querySelectorAll(".tag")
    selectedTag.forEach(tag => {
        tag.addEventListener("click", () => {
            selectedTags.pop(tag.innerHTML);
            updateInputField();
            selectedTagsElement.removeChild(tag);
        })
    });
}