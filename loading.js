// Show loading modal when the page is loading

// $(document).ready(function() {
//     // // Show loading modal when the page is loading
//     // $('#loadingModal').modal('show');
  
//     // Hide loading modal after a short delay
//     setTimeout(function() {
//       $('#loadingModal').modal('hide');
//     }, 1000);
//     window.addEventListener("load", function() {
//         setTimeout(function() {
//             $('#loadingModal').modal('hide');
//         }, 1000);
//     });
// });

document.onreadystatechange = function() {
    if (document.readyState !== "complete") {
      document.querySelector("body").style.visibility = "hidden";
      document.querySelector("#loader").style.visibility = "visible";
    } else {
      // Add fade-out animation class
      document.querySelector("#loader").classList.add("fade-out");
  
      // Set a timeout to hide the loading screen after the animation finishes
      setTimeout(function() {
        document.querySelector("#loader").style.display = "none";
        document.querySelector("body").style.visibility = "visible";
        document.querySelector("body").classList.add("fade-in");
      }, 300); // Adjust the timeout duration (in milliseconds) as needed
    }
  };