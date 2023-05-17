function openModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
    document.body.classList.add("modal-open");
  }
  
function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
    document.body.classList.remove("modal-open");
  }


function openModal2() {
    var modal1 = document.getElementById("myModal");
    var modal2 = document.getElementById("redirectModal");
    var radio1 = document.querySelector(".radio-option1");
    var radio2 = document.querySelector(".radio-option2");
  

    if (radio1.checked){
        closeModal();
    } else if (radio2.checked){
      modal1.style.display = "none";
      modal2.style.display = "block";
    }
  }

  function redirectHome(){
    window.location.href = "../academic.php";
  }

// Initial check when the page loads
window.addEventListener('load', function() {
    checkRadioSelection();
});

  function checkRadioSelection() {
        var radioButtons = document.getElementsByName("option");
        var button = document.getElementById("nextButton");

        for (var i = 0; i < radioButtons.length; i++) {
            radioButtons[i].addEventListener("change", function() {
                for (var j = 0; j < radioButtons.length; j++) {
                    if (radioButtons[j].checked) {
                        button.disabled = false;
                        return;
                    }
                }
                button.disabled = true;
            });
        }
    }

/*
  window.addEventListener('load', function() {
    disableButton();
});
*/

/*
  function disableButton() {
    var button = document.getElementById("nextButton");
    var countdownText = document.getElementById("countdownText");
    
    button.disabled = true;
    countdownText.style.display = "block";
    
    var count = 5;
    countdownText.textContent = "Next (" + count + ")";
    
    var countdown = setInterval(function() {
        count--;
        countdownText.textContent = "Next (" + count + ")";
        
        if (count <= 0) {
            clearInterval(countdown);
            button.disabled = false;
            countdownText.textContent = "Next";
        }
    }, 1000);
}
*/