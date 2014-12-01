/**
 * Created by Luís on 01/12/2014.
 */

function ReloadCaptchaImage(captchaImageId) {
    var obj = document.getElementById(captchaImageId);
    var src = obj.src;
    var date = new Date();
    var pos = src.indexOf('&rad=');
    if (pos >= 0) {
        src = src.substr(0, pos);
    }
    obj.src = src + '&rad=' + date.getTime();
    return false;
}
