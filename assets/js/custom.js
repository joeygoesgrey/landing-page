jQuery(document).ready(function ($) {
  var openModalButton = $("#openModalButton");
  var openModalButton2 = $("#openModalButton2");
  var openModalButton3 = $("#openModalButton3");
  var openModalButton4 = $("#openModalButton4");
  var closeModalButton = $("#closeModalButton");
  var modal = $("#modal");

  function toggleAnimationClass() {
    if (modal.hasClass("show")) {
      openModalButton.removeClass("animate__rubberBand").hide();
      openModalButton2.removeClass("animate__rubberBand").hide();
      openModalButton3.removeClass("animate__rubberBand").hide();
      openModalButton4.removeClass("animate__rubberBand").hide();
    } else {
      openModalButton.addClass("animate__rubberBand").show();
      openModalButton2.addClass("animate__rubberBand").show();
      openModalButton3.addClass("animate__rubberBand").show();
      openModalButton4.addClass("animate__rubberBand").show();
    }
  }

  openModalButton.on("click", function () {
    modal.removeClass("hidden").addClass("show");
    toggleAnimationClass();
  });

  openModalButton2.on("click", function () {
    modal.removeClass("hidden").addClass("show");
    toggleAnimationClass();
  });

  openModalButton3.on("click", function () {
    modal.removeClass("hidden").addClass("show");
    toggleAnimationClass();
  });

  openModalButton4.on("click", function () {
    modal.removeClass("hidden").addClass("show");
    toggleAnimationClass();
  });

  closeModalButton.on("click", function () {
    modal.removeClass("show").addClass("hidden");
    toggleAnimationClass();
  });

  $(window).on("click", function (event) {
    if ($(event.target).is(modal)) {
      modal.removeClass("show").addClass("hidden");
      toggleAnimationClass();
    }
  });

  var countryCode; // To store the fetched country code

  // Fetch the country code from the API
  $.get("https://ipinfo.io", function (response) {
    countryCode = "+" + response.country; // Store country code
  }, "jsonp").fail(function () {
    countryCode = "+234"; // Default country code if API fails
  });

  // Handle form submission
  $("#modalForm").on("submit", function (event) {
    event.preventDefault();
    var phoneNumber = $("#phone").val().replace(/\s+/g, ''); // Remove any spaces

    // Check if the phone number already includes a valid country code
    if (/^\+\d{1,3}/.test(phoneNumber)) {
      // Special handling for Nigerian numbers
      if (phoneNumber.startsWith("+2340")) {
        phoneNumber = "+234" + phoneNumber.slice(5); // Remove the leading zero after country code
      }
    } else {
      // Assume local number without country code, remove first digit and prepend country code
      phoneNumber = countryCode + phoneNumber.slice(1);
    }

    var formData = $(this).serializeArray();
    formData.push({name: "phone", value: phoneNumber}); // Update phone data with properly formatted number

    // Perform the AJAX request
    $.ajax({
      type: "POST",
      url: ajax_object.ajax_url,
      data: $.param(formData),
      success: function (response) {
        if (response.success) {
          window.location.href = response.data.redirect_url;
        } else {
          $("#validationMessage").text("Oops! " + response.data).removeClass("hidden");
        }
      },
      error: function (response) {
        $("#validationMessage").text("Oops! " + response.statusText).removeClass("hidden");
      },
    });
  });

  // Function to get the next day's midnight time
  function getNextMidnight() {
    var now = new Date();
    var tomorrow = new Date();
    tomorrow.setDate(now.getDate() + 1);
    tomorrow.setHours(0, 0, 0, 0); // Set to 00:00:00
    return tomorrow.getTime();
  }

  var countDownDate = getNextMidnight();

  // Update the count down every 1 second
  var x = setInterval(function () {
    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for hours, minutes and seconds
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the elements with id="hours", id="minutes", and id="seconds"
    $("#hours").text(hours);
    $("#minutes").text(minutes);
    $("#seconds").text(seconds);

    // If the count down is over, write some text and reset for the next day
    if (distance < 0) {
      clearInterval(x);
      $("#hours").text("0");
      $("#minutes").text("0");
      $("#seconds").text("0");
      // Reset the countdown for the next day
      countDownDate = getNextMidnight();
      x = setInterval(arguments.callee, 1000);
    }
  }, 1000);

});
