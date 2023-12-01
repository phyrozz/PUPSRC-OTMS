$(document).ready(function() {
  $('.dropdown-submenu a.dropdown-toggle').on("click", function(e) {
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });

  function restrictInput(input) {
    const maxLength = 12;
    const allowedChars = /^[A-Za-z0-9-]+$/;

    if (!allowedChars.test(input.value)) {
      input.value = input.value.slice(0, maxLength);
      document.getElementById("error-message").textContent = "Only letters, numbers, and '-' are allowed";
    } else {
      document.getElementById("error-message").textContent = "";
    }
  }

  function restrictName(event) {
    const keyCode = event.keyCode || event.which;
    const inputValue = String.fromCharCode(keyCode);
    const allowedChars = /^[A-Za-z\s\b]+$/; // Include '\s' to allow space

    if (!allowedChars.test(inputValue)) {
      event.preventDefault();
      document.getElementById("error-message").textContent = "Only letters A-Z and space are allowed";
    } else {
      document.getElementById("error-message").textContent = "";
    }
  }






});




/*POPUP WHEN SUBMIT BUTTON IN PAGE2 PAYMENTS IS CLICKED */
function showPopup() {
  const popup = document.getElementById('popup');
  popup.style.display = 'block';
  setTimeout(hidePopup, 2000); // Adjust the duration in milliseconds (e.g., 2000 = 2 seconds)
}

function hidePopup() {
  const popup = document.getElementById('popup');
  popup.style.display = 'none';
}

const uploadButton = document.getElementById('receiptImage');
const submitButton = document.querySelector('.submit-button');

submitButton.addEventListener('click', function(event) {
  if (!uploadButton.value) {
    event.preventDefault(); // Prevent form submission if no image is uploaded
  } else {
    showPopup(); // Show the popup notification
  }
});


