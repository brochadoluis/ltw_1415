/**
 * Created by Luís on 01/12/2014.
 */
function validateCaptcha(frm) {
    if (frm.CaptchaCode.value == "") {
        alert('Wrong code, try again.');
        frm.CaptchaCode.focus();
        return false;
    }
    return true;
}
