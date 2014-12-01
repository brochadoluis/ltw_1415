/**
 * Created by Luís on 01/12/2014.
 */
function ValidateForm(frm) {
    if (frm.FirstName.value == "") {
        alert('First Name is required.');
        frm.FirstName.focus();
        return false;
    }
    if (frm.LastName.value == "") {
        alert('Last Name is required.');
        frm.LastName.focus();
        return false;
    }
    if (frm.FromEmailAddress.value == "") {
        alert('Email address is required.');
        frm.FromEmailAddress.focus();
        return false;
    }
    if (frm.FromEmailAddress.value.indexOf("@") < 1 || frm.FromEmailAddress.value.indexOf(".") < 1) {
        alert('Please enter a valid email address.');
        frm.FromEmailAddress.focus();
        return false;
    }
    if (frm.Username.value == "") {
        alert('Username is required.');
        frm.Username.focus();
        return false;
    }
    if (frm.Password.value == "") {
        alert('Password is required.');
        frm.Password.focus();
        return false;
    }
    if (frm.CaptchaCode.value == "") {
        alert('Enter web form code.');
        frm.CaptchaCode.focus();
        return false;
    }
    return true;
}
