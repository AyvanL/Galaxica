$(document).ready(function () {
    // Fetch the username and populate the span
    $.ajax({
        url: "getUser.php", // Path to the PHP script
        type: "GET", // HTTP method
        success: function (response) {
            $(".user").text(response); // Update the span with the retrieved username
        },
        error: function () {
            console.log("An error occurred while fetching the username.");
        }
    });
});