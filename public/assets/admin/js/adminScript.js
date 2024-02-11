// const $button  = document.querySelector('#sidebar-toggle');
// const $wrapper = document.querySelector('#wrapper');
// $button.addEventListener('click', (e) => {
//     e.preventDefault();
//     $wrapper.classList.toggle('toggled');
// });
//


let list = document.querySelectorAll(".navigation li");

function activeLink() {
    list.forEach((item) => {
        item.classList.remove("hovered");
    });
    this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
};
