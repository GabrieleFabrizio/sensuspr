
const clCarSliderTrack = document.querySelector('.client-carusel__wrap');
const clCarSlides = Array.from(document.querySelectorAll('.client-carusel__slide'));
const clCarSlideWidth = clCarSlides[0].offsetWidth;
let clCarPosition = 0;
let clCarIsHovered = false;
let clCarAnimationFrame;

// Clone slides initially to create a seamless loop effect
clCarSlides.forEach(clCarSlide => clCarSliderTrack.appendChild(clCarSlide.cloneNode(true)));

// Function to animate the slider automatically
function clCarSlide() {
  if (!clCarIsHovered) {
    clCarPosition -= 1; // Move left by 1px
    clCarSliderTrack.style.transform = `translateX(${clCarPosition}px)`;

    // Check if the first slide has completely exited the view
    if (Math.abs(clCarPosition) >= clCarSlideWidth) {
      // Reset position and rearrange slides
      clCarPosition += clCarSlideWidth; // Offset position back
      const clCarFirstSlide = clCarSliderTrack.firstElementChild;
      clCarSliderTrack.appendChild(clCarFirstSlide); // Move the first slide to the end
      clCarSliderTrack.style.transform = `translateX(${clCarPosition}px)`;
    }
  }

  clCarAnimationFrame = requestAnimationFrame(clCarSlide);
}

clCarSlide(); // Start the sliding animation

// Event listeners for pausing on hover over a slide with a link
clCarSlides.forEach(clCarSlide => {
  const clCarLink = clCarSlide.querySelector('a');
  if (clCarLink) {
    clCarSlide.addEventListener('mouseenter', () => {
      clCarIsHovered = true; // Stop the automatic sliding
    });
    clCarSlide.addEventListener('mouseleave', () => {
      clCarIsHovered = false; // Resume the automatic sliding
    });
  }
});

