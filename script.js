// Function to handle the hello button click event
function handleHelloClick() {
  alert('Hello World');
}

// Function to handle the reset button click event
function handleResetClick() {
  location.reload();
}

// Add event listeners to the buttons
document.getElementById('hello-btn').addEventListener('click', handleHelloClick);
document.getElementById('reset-btn').addEventListener('click', handleResetClick);
