var checkPass = document.querySelector('.checkPass-Js');
var checkTb = document.querySelector('.check-js');
var btn = document.querySelector('.btn-js');
checkPass.onkeyup = function(e) {
    var check = e.target.value;
    var passlen = check.length;
    if(passlen < 6) {
        checkTb.innerText = "Mật khẩu trên 6 ký tự"
        checkTb.classList.add("open-label");
        btn.disabled = true;
        btn.classList.add("close-btn");

    }else {
        setTimeout(function(){
            checkTb.classList.add("close-label");
            checkTb.classList.remove("open-label");
            btn.classList.remove("close-btn");
        }, 500)
        btn.disabled = false;
    }
}