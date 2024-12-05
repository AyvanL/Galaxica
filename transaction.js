$(document).ready(function () {
    

    if (username) {
        $.ajax({
            url: 'transaction.php',
            type: 'POST',
            data: { username: username },
            success: function (response) {
                console.log("Response from server:", response); // Debugging step

                try {
                    const bookingData = JSON.parse(response); // Parsing response

                    // Debugging to see if data is properly parsed
                    console.log("Booking data:", bookingData);

                    if (bookingData.error) {
                        alert(bookingData.error); // Show error if any
                    } else {
                        // Populate modal
                        $('#modalUsername').text(bookingData.username);
                        $('#modalSenior').text(bookingData.senior);
                        $('#modalAdult').text(bookingData.adult);
                        $('#modalChildren').text(bookingData.children);
                        $('#modalTotalPrice').text(bookingData.totalPrice);
                        $('#modalBookingDate').text(bookingData.bookingDate);

                        // Show modal
                        $('#bookingModal').modal('show');
                    }
                } catch (error) {
                    console.error("Error parsing JSON:", error); // Log JSON errors
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", error);
            }
        });
    } else {
        alert("No username found in localStorage.");
    }
});
