$(document).ready(function () {

    $(document).on('submit', '#Register', function () {

        // get form data
        var _form = $(this);
        var data = JSON.stringify(_form.serializeObject());

        // submit form data to api


        var xhr = new XMLHttpRequest();
        xhr.withCredentials = true;

        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === 4) {
                try {
                    result = $.parseJSON(this.responseText)

                    if (result['status'] === 200) {
                        setCookie("jwt", result['jwt'], 1);
                        showHomePage();
                        $('#1234').html("<div class='alert alert-success'>Successful login.</div>");

                    } else if (result['status'] === 122) {
                        $('#1234').html("<div class='alert alert-danger'>Plice Validate your Account.</div>");
                    } else {

                        $('#1234').html("<div class='alert alert-danger'>Plice check your username or password.</div>");
                    }
                }
                catch (err) {
                    $('#1234').html("<div class='alert alert-danger'>Unable to login, plice contact the admin.</div>");
                }


            }




        });

        xhr.open("POST", "https://idea-maker.herokuapp.com/api/index.php/login");
        xhr.setRequestHeader("content-type", "application/json");

        xhr.setRequestHeader("cache-control", "no-cache");

        xhr.send(data);


        return false;
    });


    // function to make form values to json format
    $.fn.serializeObject = function () {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };


});
