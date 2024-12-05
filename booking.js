$(document).ready(function () {
    // Prices
    const prices = {
        senior: 400,
        adult: 800,
        children: 500,
    };

    // Counts
    let counts = {
        senior: 0,
        adult: 0,
        children: 0,
    };

    // Update Total
    function updateTotal() {
        const total =
            counts.senior * prices.senior +
            counts.adult * prices.adult +
            counts.children * prices.children;
        $("#totalPrice").text(total);
    }

    // Event Listeners
    // Senior
    $("#increaseSenior").on("click", function () {
        counts.senior++;
        $("#counterSenior").text(counts.senior);
        updateTotal();
    });

    $("#decreaseSenior").on("click", function () {
        if (counts.senior > 0) {
            counts.senior--;
            $("#counterSenior").text(counts.senior);
            updateTotal();
        }
    });

    // Adult
    $("#increaseAdult").on("click", function () {
        counts.adult++;
        $("#counterAdult").text(counts.adult);
        updateTotal();
    });

    $("#decreaseAdult").on("click", function () {
        if (counts.adult > 0) {
            counts.adult--;
            $("#counterAdult").text(counts.adult);
            updateTotal();
        }
    });

    // Children
    $("#increaseChildren").on("click", function () {
        counts.children++;
        $("#counterChildren").text(counts.children);
        updateTotal();
    });

    $("#decreaseChildren").on("click", function () {
        if (counts.children > 0) {
            counts.children--;
            $("#counterChildren").text(counts.children);
            updateTotal();
        }
    });

    // Initialize jQuery UI Datepicker
    $("#calendar").datepicker({
        dateFormat: "yy-mm-dd", // Format the selected date
        minDate: new Date(), // Disable past dates by setting minDate to today
    });

    // Handle the submit button click
    $("#submitButton").click(function () {
        const totalPrice = $("#totalPrice").text();
        const selectedDate = $("#calendar").val();
        const username = localStorage.getItem('username');  // Retrieve the username from localStorage

        // Check if total price is zero
        if (totalPrice == 0) {
            alert("Please add at least one ticket.");
            return; // Stop further execution if total is zero
        }

        if (!selectedDate) {
            alert("Please select a booking date.");
        } else {
            // Prepare data to send via AJAX
            const bookingData = {
                senior: counts.senior,
                adult: counts.adult,
                children: counts.children,
                totalPrice: totalPrice,
                bookingDate: selectedDate,
                username: username  // Include the username in the data
            };

            console.log(bookingData);  // Debug: Log the data to check if it's correct

            // Send data to PHP script via AJAX
            $.ajax({
                url: "insertBooking.php",
                type: "POST",
                data: bookingData,
                success: function(response) {
                    alert(response); // Show the PHP response
                    console.log(response); // Log the response

                    // Reset inputs after successful submission
                    counts = { senior: 0, adult: 0, children: 0 }; // Reset counts
                    $("#counterSenior").text(counts.senior); // Update the display for senior count
                    $("#counterAdult").text(counts.adult); // Update the display for adult count
                    $("#counterChildren").text(counts.children); // Update the display for children count
                    $("#totalPrice").text("0"); // Reset total price
                    $("#calendar").val(""); // Reset calendar input
                },
                error: function(xhr, status, error) {
                    alert("An error occurred. Please try again.");
                    console.log(error);
                }
            });
        }
    });
});
