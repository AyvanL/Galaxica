$(document).ready(function () {
    $("#logoutButton").on("click", function () {
        // Send a request to the server to clear the database
        $.ajax({
            url: "deleteLogged.php", // Backend script to handle deletion
            type: "POST",
            success: function (response) {
                if (response.success) {
                    alert("Successfully Logout");
                    window.location.href = "index.html"; // Redirect to login page
                } else {
                    alert("Failed to clear the database: " + response.message);
                }
            },
            error: function () {
                alert("An error occurred while processing your request.");
            }
        });
    });
});
