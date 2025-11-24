 $("#myForm").submit(function(e){
        e.preventDefault(); // Page reload prevent

        $.ajax({
            url: "./php/register.php",
            type: "POST",
            data: $(this).serialize(), // Form data send
            success: function(response){
                if(response.trim() === "success"){
                    window.location.href = "login.html"; // Redirect to login page
                } else {
                $("#result").html(response); // Response display
            }

            }
        });
        console.log("Form submitted via AJAX");
    });