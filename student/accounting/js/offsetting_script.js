$(document).ready(function(){
    $('.dropdown-submenu a.dropdown-toggle').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
    })
})//max value
//decimal input
$(document).on('keydown', 'input[pattern]', function(e){
    var input = $(this);
    var oldVal = input.val();
    var regex = new RegExp(input.attr('pattern'), 'g');
  
    setTimeout(function(){
      var newVal = input.val();
      if(!regex.test(newVal)){
        input.val(oldVal); 
      }
    }, 1);
  });
//allowed input
function restrictName(event) {
  const keyCode = event.keyCode || event.which;
  const inputValue = String.fromCharCode(keyCode);
  const allowedChars = /^[A-Za-zñÑ \b\t]+$/;

if (!allowedChars.test(inputValue)) {
  event.preventDefault();
  document.getElementById("error-message").textContent = "Only letters A-Z are allowed";
} else {
  document.getElementById("error-message").textContent = "";
}
}
//Validate
function validateForm(event) {
// Prevent form submission
event.preventDefault();

// Reset previous invalid state
var form = document.getElementById("studentForm");
var inputs = form.getElementsByClassName("form-control");
for (var i = 0; i < inputs.length; i++) {
    inputs[i].classList.remove("is-invalid");
}

// Perform custom validation
var isValid = true;

// Validate first name
var firstNameInput = document.getElementById("firstName");
if (firstNameInput.value.trim() === "") {
    firstNameInput.classList.add("is-invalid");
    isValid = false;
}

// Validate last name
var lastNameInput = document.getElementById("lastName");
if (lastNameInput.value.trim() === "") {
    lastNameInput.classList.add("is-invalid");
    isValid = false;
}

// Validate student number
var studentNumberInput = document.getElementById("student-number");
if (studentNumberInput.value.trim() === "") {
    studentNumberInput.classList.add("is-invalid");
    isValid = false;
}
 // Validate birth date
 var birthDateInput = document.getElementById("birthdate");
 if (birthDateInput.value.trim() === "") {
     birthDateInput.classList.add("is-invalid");
     isValid = false;
 }

 if (isValid) {
     // If the form is valid, submit it
     form.submit(); 
 }
}
// Get the current date
var currentDate = new Date().toISOString().split('T')[0];

// Set the max attribute of the input element to the current date
document.getElementById("birthdate").setAttribute("max", currentDate);

function closeAlert() {
document.getElementById('custom-alert').style.display = 'none';
}