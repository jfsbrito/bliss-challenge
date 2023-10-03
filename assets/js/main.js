/*Menu Mobile*/
document.addEventListener("DOMContentLoaded", function() {
    const menuButton = document.querySelector(".header__normal__navigation--btn");
    const menu = document.querySelector(".header__normal__navigation__menu");

    menuButton.addEventListener("click", function() {
        menu.classList.toggle("active");
    });
}); 