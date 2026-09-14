  const fadeobserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.transform = 'translateX(0) scale(1)'; // Reset the transform on the target element
        entry.target.style.opacity = 1;
      }
    });
  });

  // Select all elements with fade classes inside .fadecontainer
  document.querySelectorAll(".fadecontainer .fade-in-left, .fadecontainer .fade-in-right, .fadecontainer .fade-in-top, .fadecontainer .fade-in-bottom , .fadecontainer .fade-in-scalesm").forEach(element => {
    fadeobserver.observe(element);
  });