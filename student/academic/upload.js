// Add click event listener to the uploadDiv element
document.getElementById('uploadDiv').addEventListener('click', function() {
  // Trigger a click on the hiddenFileInput element
  document.getElementById('hiddenFileInput').click();
});

// Add change event listener to the hiddenFileInput element
document.getElementById('hiddenFileInput').addEventListener('change', function() {
  // Retrieve the selected file from the fileInput element
  const fileInput = this;
  const selectedFile = fileInput.files[0];

  // Perform further actions with the selected file, such as uploading it to a server or displaying its details
});
