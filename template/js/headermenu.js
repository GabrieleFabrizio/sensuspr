document.addEventListener("DOMContentLoaded", function () {
  const burger = document.querySelector(".header__burger");
  const mobileMenu = document.querySelector(".header__nav__cont");

  burger.addEventListener("click", function () {
    burger.classList.toggle("active");
    if (mobileMenu) {
      mobileMenu.classList.toggle("active");
    }
  });
});

