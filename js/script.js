// let menu = document.querySelector ('#menu-btn');
// let navbar = document.querySelector ('.header .navbar');

// menu.onclick = () =>{
//     menu.classList.toggle('fa-times');
//     menavbarnu.classList.toggle('active');


// }


// const menuBtn = document.getElementById('menu-btn');
// const navbar = document.querySelector('.navbar');

// menuBtn.addEventListener('click', () => {
//     navbar.classList.toggle('active');
//     menuBtn.classList.toggle('fa-times'); // Change the icon to a "close" icon
// });

// window.onscroll = () =>{

//     menuBtn.classList.remove('fa-times');
//     navbar.classlist.remove('active');
// }







const navbar = document.querySelector('.navbar');
const menuBtn = document.getElementById('menu-btn');

menuBtn.addEventListener('click', () => {
    navbar.classList.toggle('active');
    menuBtn.classList.toggle('fa-times'); // Change the icon to a "close" icon
});

window.onscroll = () => {
    navbar.classList.remove('active');
    menuBtn.classList.remove('fa-times');

};


// reviews

let slide = document.querySelectorAll('.reviews .slide-container .slide');
let index = 0;

function next()
{
    slide[index].classList.remove('active');
    index = (index + 1) % slide.length; 
    slide[index].classList.add('active');
}

function prev()
{
    slide[index].classList.remove('active'); // Corrected classList
    index = (index - 1 + slide.length) % slide.length; // Corrected variable name
    slide[index].classList.add('active'); 
}




// newsletter
// const openBtn = document.querySelector('#open-modal');
// const dialog = document.querySelector('#dialog');
// const closeBtn = dialog.querySelector('#close');

// openBtn.addEventListener('click', () => dialog.showModal());
// closeBtn.addEventListener('click', () => dialog.close());


const form = document.querySelector('#newsletter-form');
const dialog = document.querySelector('#dialog');
const closeBtn = dialog.querySelector('#close');

form.addEventListener('submit', (e) => {
    e.preventDefault(); // Prevent the form from reloading the page
    dialog.showModal();  // Show the modal when form is submitted
});

closeBtn.addEventListener('click', () => dialog.close());
