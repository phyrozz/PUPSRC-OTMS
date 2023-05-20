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

  function validateForm() {
    var inputs = document.querySelectorAll("#studentForm input[required], #studentForm select[required]");
    var isValid = true;

    for (var i = 0; i < inputs.length; i++) {
      if (inputs[i].value.trim() === "") {
        inputs[i].classList.add("invalid-input");
        isValid = false;
      } else {
        inputs[i].classList.remove("invalid-input");
      }
    }

    if (!isValid) {
      return false;
    }
  }

  $("#studentForm").on("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting

    if (validateForm()) {
      this.submit(); // Submit the form if it is valid
    }
  });

  $("#name, #surname, #studentNumber, #amount, #course, #documentType").on("input change", function() {
    validateFields();
  });

  function validateFields() {
    var nameInput = $("#name");
    var surnameInput = $("#surname");
    var studentNumberInput = $("#studentNumber");
    var amountInput = $("#amount");
    var courseSelect = $("#course");
    var documentTypeSelect = $("#documentType");
    var nextButton = $(".next-button");

    if (
      nameInput.val().trim() === "" ||
      surnameInput.val().trim() === "" ||
      studentNumberInput.val().trim() === "" ||
      amountInput.val().trim() === "" ||
      courseSelect.val() === "" ||
      documentTypeSelect.val() === ""
    ) {
      nextButton.attr("disabled", "disabled");
    } else {
      nextButton.removeAttr("disabled");
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


