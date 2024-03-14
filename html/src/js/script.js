function handleScroll() {
    var topbar = document.querySelector('.topbar');
    if (window.scrollY > 1) {
      topbar.classList.add('scrolled');
    } else {
      topbar.classList.remove('scrolled');
    }
  }
window.addEventListener('scroll', handleScroll);



var scrollLinks = document.querySelectorAll('a[href^="#"]');

scrollLinks.forEach(function (link) {
    link.addEventListener("click", function (event) {
        var targetId = this.getAttribute("href").substring(1);
        var targetElement = document.getElementById(targetId);
        console.log(targetId);

        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 200,
                behavior: "smooth",
            });

            event.preventDefault();
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
  const hamburger = document.querySelector('.hamburger');
  const menuList = document.querySelector('.menu__list');

  hamburger.addEventListener('click', function() {
      if (!menuList.classList.contains('openmenu')) {
          menuList.classList.add('openmenu');
      } else {
          menuList.classList.remove('openmenu');
      }
  });
});