
"use strict";class App{activeClassToggler(){var e=document.querySelectorAll(".-js-toggler");e&&e.forEach(e=>{e.addEventListener("click",()=>{e.classList.toggle("active")})})}pageReady(){document.body.classList.add("loaded"),document.body.classList.remove("preload")}init(){this.activeClassToggler(),this.pageReady()}}const app=new App;function handleScroll(){var e=document.querySelector(".topbar");1<window.scrollY?e.classList.add("scrolled"):e.classList.remove("scrolled")}window.addEventListener("scroll",handleScroll);var scrollLinks=document.querySelectorAll('a[href^="#"]');scrollLinks.forEach(function(e){e.addEventListener("click",function(e){var t=this.getAttribute("href").substring(1),o=document.getElementById(t);console.log(t),o&&(window.scrollTo({top:o.offsetTop-200,behavior:"smooth"}),e.preventDefault())})}),document.addEventListener("DOMContentLoaded",function(){var e=document.querySelector(".hamburger");const t=document.querySelector(".menu__list");e.addEventListener("click",function(){t.classList.contains("openmenu")?t.classList.remove("openmenu"):t.classList.add("openmenu")})});