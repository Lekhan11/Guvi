$(document).ready(function() {
$("#loginForm").submit(function(event) {
    event.preventDefault(); // Prevent the default form submission
    
    $.ajax({
        url: "./php/login.php",
        type: "POST",
        data: $(this).serialize(), // Serialize form data
        success: function(response) {
            data = JSON.parse(response);
            if (data.status === "success") {
                session = localStorage.setItem("loginSession", JSON.stringify({ token: data.token, loggedIn: true,username: data.username }));
                window.location.href = "profile.html";  // 🔥 redirect
            } else {
                    $("#loginResult").html("Incorrect Username or Password"); 
                }
        }
    });
})
});