$(document).ready(function () {
    // Retrieve the username from localStorage
    const username = localStorage.getItem('username');

    if (username) {
        // Set the username in the span with class "username"
        $(".user").text(username);
    } else {
        // Handle case where username is not found (e.g., redirect to login page)
        window.location.href = "index.html"; // Or any page you want to redirect to
    }
});

$(document).ready(function () {
    $("#logoutButton").on("click", function () {
        localStorage.removeItem('username');
        window.location.href = "index.html"; // Redirect to login page or another page
    });
});