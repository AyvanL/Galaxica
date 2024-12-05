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

        if (!selectedDate) {
            alert("Please select a booking date.");
        } else {
            // Prepare data to send via AJAX
            const bookingData = {
                senior: counts.senior,
                adult: counts.adult,
                children: counts.children,
                totalPrice: totalPrice,
                bookingDate: selectedDate
            };

            // Send data to PHP script via AJAX
            $.ajax({
                url: "save_booking.php", // PHP script that will handle the insertion
                type: "POST",
                data: bookingData,
                success: function(response) {
                    alert("Booking successfully saved!");
                    console.log(response); // You can log the server response
                },
                error: function(xhr, status, error) {
                    alert("An error occurred. Please try again.");
                    console.log(error);
                }
            });
        }
    });
});
