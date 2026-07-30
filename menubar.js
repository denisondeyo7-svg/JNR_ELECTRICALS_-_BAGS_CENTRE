
menubtn = document.getElementById('menubtn');
overlay= document.getElementById('overlay');
menubar= document.getElementById('menubar');
closemenu = document.getElementById('closemenu');
profilebtn = document.getElementById('profilebtn');
profilewindow =document.getElementById('profilewindow');
closewindow= document.getElementById('closewindow');
navbar = document .getElementById('navbar');
cartWindow = document .getElementById('cartWindow');
open_cart = document .getElementById('open_cart');
closecart = document .getElementById('closecart');


//menubar navigation

menubtn.addEventListener('click',()=>{
    menubar.classList.add('active');
    overlay.classList.add('active');
});

overlay.addEventListener('click',()=>{
    menubar.classList.remove('active');
    overlay.classList.remove('active');
});

closemenu.addEventListener('click',()=>{
    menubar.classList.remove('active');
    overlay.classList.remove('active');
});



//profile navigation

profilebtn.addEventListener('click',()=>{
    profilewindow.classList.add('active');
    cartWindow.classList.remove('active');
});
closewindow.addEventListener('click',()=>{
    profilewindow.classList.remove('active');
    
});
navbar.addEventListener('click',()=>{
    profilewindow.classList.remove('active');
    cartWindow.classList.remove('active');
});

//cart navigation
open_cart.addEventListener('click',()=>{
    cartWindow.classList.add('active');
    profilewindow.classList.remove('active');
});
closecart.addEventListener('click',()=>{
    cartWindow.classList.remove('active');
});