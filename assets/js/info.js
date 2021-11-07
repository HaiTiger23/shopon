
var API ="assets/js/local.json"; 
var TP = document.querySelector(".TP");
var Huyen = document.querySelector(".Huyen");
var Xa = document.querySelector(".Xa");
setTimeout(function() {
    

fetch(API)
.then( function(reponsive) {
    return reponsive.json();
    //JSON -> javascript
})
.then( function(posts) {
   var htmls = posts.map(function(post) {
       return `<option value="${post.id}">
       ${post.name}
       </option>`
   })
   if(TP.attributes.value.nodeValue != " "){
   var MaTinh= TP.attributes.value.nodeValue;
   MaTinh --;
   var html = htmls.join(' ');
   // Get Dữ liệu từ value ra
   //Tỉnh
   if(MaTinh)  TP.innerHTML = `<option value="${posts[MaTinh].id}">
   ${posts[MaTinh].name}
   </option>`;
   //Huyện
   var MaHuyen
   posts[MaTinh].districts.forEach(element => {
       if(element.id == Huyen.attributes.value.nodeValue) MaHuyen = element;
   });
   if(MaHuyen) Huyen.innerHTML = `<option value="${MaHuyen.id}">
   ${MaHuyen.name}
   </option>`;
   
  
    
   TP.addEventListener("mousedown", function() {
    TP.innerHTML = html;
   })
   //Xã
   var MaXa;
   MaHuyen.wards.forEach(element => {
    if(element.id == Xa.attributes.value.nodeValue) MaXa = element;
});
if(MaXa) Xa.innerHTML = `<option value="${MaXa.id}">
   ${MaXa.name}
   </option>`;
}
else TP.innerHTML = htmls
   TP.addEventListener("change", function() {
       var x = TP.value;
       var huyen = posts[x-1].districts;
       var htmlsH = huyen.map(function(post) {
        return `<option value="${post.id}">
        ${post.name}
        </option>`
       })
       var htmlH = htmlsH.join(' ');
       Huyen.innerHTML = htmlH;
       Xa.innerHTML = ' '
   });
   Huyen.addEventListener("change", function() {
    var x = posts[TP.value-1].districts.find(function(e) {
        return e.id === Huyen.value
    })
    var xas = x.wards;
    var htmlsx = xas.map(function(post) {
     return `<option value="${post.id}">
     ${post.prefix} ${post.name}
     </option>`
    })
    var htmlx = htmlsx.join(' ');
    Xa.innerHTML = htmlx;
});

});

},500)
