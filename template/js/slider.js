$(document).ready(function ($) {
  let intervalId;

  function startInterval() {
    intervalId = setInterval(moveRight, 10000);
  }

  function resetInterval() {
    clearInterval(intervalId);
    startInterval();
  }

  // Call startInterval initially to start the interval
  startInterval();

  // Function to update slide dimensions
  function updateSlideDimensions() {
    var slideCount = $("#slider ul li").length;
    var slideWidth;

    // If window width is smaller than 400px, set slide width to 350px
    if ($(window).width() < 400) {
      slideWidth = $(window).width()-20; // Fixed width for smaller screens
    } else {
      slideWidth = $("#slider ul li").outerWidth(); // Use list item width for larger screens
    }

    var slideHeight = $("#slider ul li").outerHeight(); // Get the height of the list item
    var sliderUlWidth = slideCount * slideWidth;

    // Set the width and height of the slider container and the ul
    $("#slider").css({ width: slideWidth, height: slideHeight });
    $("#slider ul").css({ width: sliderUlWidth, marginLeft: -slideWidth });
  }

  // Initial size adjustment
  updateSlideDimensions();

  // Update dimensions on window resize
  $(window).resize(function () {
    updateSlideDimensions();
  });

  $("#slider ul li:last-child").prependTo("#slider ul");

  function moveLeft() {
    $("#slider ul").animate(
      {
        left: +$("#slider ul li").outerWidth(),
      },
      200,
      function () {
        $("#slider ul li:last-child").prependTo("#slider ul");
        $("#slider ul").css("left", "");
      }
    );
    resetInterval();
  }

  function moveRight() {
    $("#slider ul").animate(
      {
        left: -$("#slider ul li").outerWidth(),
      },
      200,
      function () {
        $("#slider ul li:first-child").appendTo("#slider ul");
        $("#slider ul").css("left", "");
      }
    );
    resetInterval();
  }

  $(".slider__control_prev").click(function () {
    moveLeft();
  });

  $(".slider__control_next").click(function () {
    moveRight();
  });
});
