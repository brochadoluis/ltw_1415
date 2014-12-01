/**
 * Created by Luís on 01/12/2014.
 */

function loginSubmit() {
    var formData = {username: $('#username').val(), password: $('#password').val()};
    console.log(formData);
// AJAX Code To Submit Form.
    $.ajax({
        type: "POST",
        url: "../php/login.php",
        data: formData,// {username: $('#username').val(), password: $('#password').val()},
        dataType: 'json',
        success: function (formData) {
            alert(formData);
            alert('Inside success function!');
            alert(formData);// show response from the php script
        }
    });
}
