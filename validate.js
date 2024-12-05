// Add an event listener to the confirm button
document.getElementById('confirmBookingButton').addEventListener('click', function() {
    // Get the values entered by the user
    const cardNumber = document.getElementById('cardNumber').value;
    const pinInput = document.getElementById('pinInput').value;

    // Send data to PHP to validate the card number and PIN
    $.ajax({
      url: 'validateCard.php',
      type: 'POST',
      data: {
        cardNum: cardNumber,
        cardPin: pinInput
      },
      success: function(response) {
        const data = JSON.parse(response);
        if (data.valid) {
          alert('Card validated successfully! Booking confirmed.');
          window.location.href = "logged.html"; 
            
          // Optionally, redirect to another page or update the UI
          // window.location.href = "confirmationPage.html";  // Example redirect

        } else {
          alert('Invalid card number or PIN. Please try again.');
        }
      },
      error: function() {
        alert('An error occurred while processing your request.');
      }
    });
});
