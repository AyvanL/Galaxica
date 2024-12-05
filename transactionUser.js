$(document).ready(function() {
    // Fetch the data from the PHP file
    fetch('transaction.php') // The PHP file that retrieves the data
      .then(response => response.json())
      .then(data => {
        // Set the values in the modal
        $('#modalUsername').text(data.username);
        $('#modalSenior').text(data.senior);
        $('#modalAdult').text(data.adult);
        $('#modalChildren').text(data.children);
        $('#modalTotalPrice').text(data.totalPrice);
        $('#modalBookingDate').text(data.bookingDate);
      })
      .catch(error => console.error('Error fetching booking data:', error));
  });
  