$(document).ready(function () {
    $("#loginform").on("submit", function (e) {
        e.preventDefault(); // Prevent form submission

        // Collect form data
        const username = $("#username").val().trim();
        const password = $("#password").val().trim();

        // Check if the username is 'admin' and password is '1234'
        if (username == "admin" && password == 1234) {
            // Redirect to userAdmin.php directly without checking the database
            window.location.href = "userAdmin.php";
        } else {
            // If not 'admin' and '1234', proceed with AJAX request to check login credentials
            $.ajax({
                url: "login.php", // The PHP script to process the login
                type: "POST",
                data: { username: username, password: password },
                success: function (response) {
                    if (response === "success") {
                        // Redirect to logged.html if login is successful
                        window.location.href = "logged.html";
                    } else {
                        // Show error message if login fails
                        alert("Incorrect username or password");
                    }
                },
                error: function () {
                    alert("An error occurred. Please try again.");
                }
            });
        }
    });
});
