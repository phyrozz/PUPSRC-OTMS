function openModal() {
  var modal = document.getElementById("myModal");
  modal.style.display = "block";
  document.body.classList.add("modal-open");
}

function open_payModal() {
  var modal = document.getElementById("payModal");
  modal.style.display = "block";
  document.body.classList.add("modal-open");
}

function yesModal() {
  var modal = document.getElementById("redirectModal");
  modal.style.display = "none";
  window.location.href = "../academic.php";
  document.body.classList.remove("modal-open");
}

function closeModal() {
  var modal = document.getElementById("redirectModal");
  modal.style.display = "none";
  document.body.classList.remove("modal-open");
}

function close_payModal() {
  var modal = document.getElementById("payModal");
  modal.style.display = "none";
  document.body.classList.remove("modal-open");
}

function questionModal() {
  var modal1 = document.getElementById("myModal");
  var modal2 = document.getElementById("redirectModal");
  var radio1 = document.querySelector(".radio-option1");
  var radio2 = document.querySelector(".radio-option2");

  if (radio1.checked) {
    modal1.style.display = "none";
    document.body.classList.remove("modal-open");
  } else if (radio2.checked) {
    modal1.style.display = "none";
    modal2.style.display = "block";
  }
}

function openModal2() {
  var modal1 = document.getElementById("myModal");
  var modal2 = document.getElementById("redirectModal");
  var modal3 = document.getElementById("payModal");
  var radio1 = document.querySelector(".radio-option1");
  var radio2 = document.querySelector(".radio-option2");

  if (radio1.checked) {
    modal1.style.display = "none";
    modal3.style.display = "block";
  } else if (radio2.checked) {
    modal1.style.display = "none";
    modal2.style.display = "block";
  }
}

function checkRadioSelection() {
  var radioButtons = document.getElementsByName("option");
  var nextButtonModal = document.getElementById("nextButtonModal");
  var nextButtonRedirect = document.getElementById("nextButtonRedirect");

  function updateNextButton() {
      var isChecked = false;

      for (var i = 0; i < radioButtons.length; i++) {
          if (radioButtons[i].checked) {
              isChecked = true;
              break;
          }
      }

      nextButtonModal.disabled = !isChecked;
      nextButtonRedirect.disabled = !isChecked;

      if (isChecked) {
          nextButtonModal.classList.remove("disabled-button");
          nextButtonRedirect.classList.remove("disabled-button");
      } else {
          nextButtonModal.classList.add("disabled-button");
          nextButtonRedirect.classList.add("disabled-button");
      }
  }

  for (var i = 0; i < radioButtons.length; i++) {
      radioButtons[i].addEventListener("change", updateNextButton);
  }

  // Initial check when the page loads
  updateNextButton();
}

// Initial check when the page loads
window.addEventListener("load", function() {
  checkRadioSelection();
});

    function open_successModal() {
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    }