/**
 * Created by Luís on 01/12/2014.
 */
function validateCaptcha(frm) {
    var x = document.getElementById("");
    if (frm.CaptchaCode.value == "" || frm.CaptchaCode.value !=) {
        alert('Wrong code, try again.');
        frm.CaptchaCode.focus();
        return false;
    }
    return true;
}
