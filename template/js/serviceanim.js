function showService(id) {
    const serviceElements = document.querySelectorAll('.home__service__hidden');
    serviceElements.forEach((serviceElement, index) => {
      if (index + 1 === id) {
        // Show the selected service smoothly
        const contentHeight = serviceElement.scrollHeight;
        serviceElement.style.maxHeight = contentHeight + "px";
      } else {
        // Hide all other services smoothly
        serviceElement.style.maxHeight = "0";
      }
    });
  }
  document.addEventListener("DOMContentLoaded", function () {
  
    const serviceElements = document.querySelectorAll('.home__service__hidden');
    serviceElements.forEach((serviceElement, index) => {
      if (index === 0) {
        // Initially set the max-height of the first visible content to its scrollHeight
        serviceElement.style.maxHeight = serviceElement.scrollHeight + "px";
      } else {
        // Hide all other services smoothly
        serviceElement.style.maxHeight = "0";
      }
    });
  });