
var fileAvt = document.getElementById("file-upload")
var preview = document.querySelector(".preview");
var labelAvt = document.querySelector(".custom-file-upload");
var iconLabel = labelAvt.querySelector("i")
fileAvt.addEventListener("change", function() {
    const curFiles = fileAvt.files;
    if(curFiles.length != 0) {
    var src = URL.createObjectURL(curFiles[0])
    console.log(src);
    preview.style.backgroundImage = "url('"+src+"')"
    labelAvt.htmlFor  = "SaveAvt"
    iconLabel.classList.remove("fa-edit");
    iconLabel.classList.add("fa-save");
    }
});


