 $("#myForm").submit(function(e){
        e.preventDefault();  
        $.ajax({
            url: "./php/register.php",
            type: "POST",
            data: $(this).serialize(),  
            success: function(response){
                if(response.trim() === "success"){
                    alert("Registration Successful! Please login.");
                    window.location.href = "login.html";    
                } else {
                $("#result").html(response);
                $("#result").prop("hidden", false); 
            }

            }
        });
        console.log("Form submitted via AJAX");
    });