

$(document).ready(function () {
    $("#loginform").on("submit", function (e) {
        e.preventDefault(); // Prevent form submission

        // Collect form data
        const username = $("#username").val();
        const password = $("#password").val();

        // AJAX request to the PHP script
        $.ajax({
            url: "login.php", // The PHP script to process the login
            type: "POST",
            data: { username: username, password: password },
            success: function (response) {
                if (response === "success") {
                    // Store the username in localStorage
                    localStorage.setItem('username', username);
            
                    // Update the span with the class "username"
                    $(".user").text(username);
            
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
    });
});










