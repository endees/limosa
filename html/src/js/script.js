function handleScroll() {
    var topbar = document.querySelector('.topbar');
    if (window.scrollY > 1) {
      topbar.classList.add('scrolled');
    } else {
      topbar.classList.remove('scrolled');
    }
  }
  window.addEventListener('scroll', handleScroll);

