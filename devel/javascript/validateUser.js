/**
 * Created by Luís on 01/12/2014.
 */

function loginSubmit() {
// AJAX Code To Submit Form.
    $.ajax({
        type: "POST",
        url: "../php/login.php",
        data: {username: $('#username').val(), password: $('#password').val()},
        dataType: 'json',
        success: function (data) {
            alert('Inside success function!');
            alert(data);// show response from the php script
            console.log(data);
        }
    });
}
