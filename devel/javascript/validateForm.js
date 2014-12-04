/**
 * Created by Luís on 01/12/2014.
 */
function validateCaptcha(frm) {
	if (frm.FromEmailAddress.value == "") {
        alert('Email address is required.');
        frm.FromEmailAddress.focus();
        return false;
    }
    if (frm.FromEmailAddress.value.indexOf("@") < 1 || frm.FromEmailAddress.value.indexOf(".") < 1) {
        alert('Please enter a valid email address.');
        frm.FromEmailAddress.focus();
        
    if (frm.CaptchaCode.value == "") {
        alert('Wrong code, try again.');
        frm.CaptchaCode.focus();
        return false;
    }
    return true;
}
