const icon =document.querySelector('.icon');
const navbar = document.querySelector('ul');
icon.addEventListener('click',()=>{
    navbar.classList.toggle('slide');
});