$(document).ready(function() {
    sessionData=localStorage.getItem("loginSession")
    if(sessionData){
        window.location.href = "profile.html";  
    }

    
$("#loginForm").submit(function(event) {
    event.preventDefault(); 
    $.ajax({
        url: "./php/login.php",
        type: "POST",
        data: $(this).serialize(), 
        success: function(response) {
            data = JSON.parse(response);
            if (data.status === "success") {
                alert("Login Successful");
                session = localStorage.setItem("loginSession", JSON.stringify({ token: data.token, loggedIn: true,username: data.username }));
                window.location.href = "profile.html"; 
            } else {
                    $("#loginResult").html("Incorrect Username or Password");
                    $("#loginResult").prop("hidden", false);
        }
    }
    });
})
});