$(document).ready(function() {
        $("form").submit(function(event) {
            var formData = {
                iduser: $("#iduser").val(),
                password: $("#password").val(),
                confirm_password: $("#confirm_password").val(),
                old_password: $("#old_password").val()
            };

            $.ajax({
                type: "POST",
                url: "update.php",
                data: formData,
                dataType: "json",
                encode: true,
                success: function(data) {
                    alert(data);
                },

                error: function(data) {
                    alert("error ocuured , profile page not working !");
                },
            });
            event.preventDefault();


        });
    });