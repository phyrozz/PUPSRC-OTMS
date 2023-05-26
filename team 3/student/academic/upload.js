// Get the div and hidden file input element
const uploadDiv = document.getElementById('uploadDiv');
const fileInput = document.getElementById('hiddenFileInput');

// Add click event listener to the div
uploadDiv.addEventListener('click', function() {
  // Programmatically trigger a click on the hidden file input
  fileInput.click();
});

// Add change event listener to the file input
fileInput.addEventListener('change', function() {
  // Display the selected file name in the div
  uploadDiv.textContent = fileInput.files[0].name;
});