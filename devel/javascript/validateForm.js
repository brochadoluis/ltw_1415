/**
 * Created by Luís on 01/12/2014.
 */
function validateForm(frm) {
    if (frm.name.value == "") {
        alert('Name is required.');
        frm.name.focus();
        return false;
    }
    if (frm.email.value == "") {
        alert('Email address is required.');
        frm.email.focus();
        return false;
    }
    if (frm.email.value.indexOf("@") < 1 || frm.email.value.indexOf(".") < 1) {
        alert('Please enter a valid email address.');
        frm.email.focus();
        return false;
    }
    if (frm.username.value == "") {
        alert('Username is required.');
        frm.username.focus();
        return false;
    }
    if (frm.password.value == "") {
        alert('Password is required.');
        frm.password.focus();
        return false;
    }
    if (frm.CaptchaCode.value == "") {
        alert('Enter web form code.');
        frm.CaptchaCode.focus();
        return false;
    }
    return true;
}
