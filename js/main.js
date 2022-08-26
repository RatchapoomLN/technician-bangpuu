let slideIndex = 0;
const slideTime = 5000;
let slideInterval = setInterval(() => changeSlide(true), slideTime);

function jumpSlide(forward) {
  clearInterval(slideInterval);
  changeSlide(forward)
  slideInterval = setInterval(() => changeSlide(true), slideTime);
}

function changeSlide(forward) {
  const slides = document.getElementsByClassName('slide');
  slides[slideIndex].classList.remove('active');
  if (forward) {
   if (slideIndex + 1 > slides.length - 1) {
    slides[0].classList.add('active');
    slideIndex = 0;
  } else {
    slides[slideIndex + 1].classList.add('active');
    slideIndex ++;
  } 
  } else {
    if (slideIndex - 1 < 0) {
    slides[slides.length - 1].classList.add('active');
    slideIndex = slides.length - 1;
  } else {
    slides[slideIndex - 1].classList.add('active');
    slideIndex --;
  }
  }
}