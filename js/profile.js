$(document).ready(function() {

    loggedIn = localStorage.getItem('loginSession')
    if (!loggedIn) {
        window.location.href = "login.html";
    }

    $("#logoutBtn").click(function(){
        $.ajax({
            url: 'php/sessionchk.php',
            type: 'POST',
            data: 'token=' + JSON.parse(localStorage.getItem('loginSession')).token
        });
        localStorage.removeItem("loginSession");
        window.location.href = "login.html";
    });


    $.ajax({
        url: 'php/profile.php',
        type: 'POST',
        data: 'username=' + JSON.parse(localStorage.getItem('loginSession')).username
    }).done(function(data) {
        if(data.error){
            alert(data.error);
            return;
        }
        $('#name').html(data.name);
        $('#email').html(data.email);
        $('#phone').html(data.phone);
        $('#dob').html(data.dob);
        $('#gender').html(data.gender);
        $('#age').html(data.age);
        
        $("#editUsername").val(data.username);
        $('#editName').val(data.name);
        $('#editEmail').val(data.email);
        $('#editAge').val(data.age);
        $('#editPhone').val(data.phone);
        $('#editDob').val(data.dob);
        $("#editAge").val(data.age);
        $('#editGender').val(data.gender);
    });

    $("#editProfileForm").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'php/editprofile.php',
            type: 'POST',
            data: $(this).serialize()
        }).done(function(response){
            $("#editModal").modal('hide');
            window.location.reload();
           
            
        });
    });
    
});