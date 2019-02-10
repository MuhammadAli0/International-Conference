$(document).ready(function () {

    $(document).on('submit', '#Register', function () {

        // get form data
        ValidateForm();
        var _form = $(this);
        var data = JSON.stringify(_form.serializeObject());

        // submit form data to api

        var xhr = new XMLHttpRequest();
        xhr.withCredentials = true;

        xhr.addEventListener("readystatechange", function () {
            console.log(data);
            if (this.readyState === 4) {
                try {
                    result = $.parseJSON(this.responseText)

                    if (result['status'] === 200) {
                        $('#1234').html("<div class='alert alert-success'>تم التسجيل بنجاح.</div>");
                    } else{
                        dlpError = result['error'];
                        $('#1234').html("<div class='alert alert-danger'> لقد تم التسجيل مسبقآ بأستخدام."+ dlpError +"</div>");
                    }
                }
                catch (err) {
                    $('#1234').html("<div class='alert alert-danger'> من فضلك حاول فى وقت لاحق."+ err +"</div>");
                }


            }




        });

        xhr.open("POST", window.location + 'register.php');
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

    function ValidateForm(){
        var type = document.getElementById("type").value;
        if(type === 'ذهبى'){
            document.getElementById("cost").value = 1500;
        } else if (type === 'شركه'){
            document.getElementById("cost").value = 1200;
        } else if (type === 'فضي'){
            document.getElementById("cost").value = 1000;
        } else if (type === 'برونزي'){
            document.getElementById("cost").value = 800;
        } else if (type === 'عادى'){
            document.getElementById("cost").value = 500;
        } else{
            document.getElementById("cost").value = "Unkown";
        } 
    }


});
