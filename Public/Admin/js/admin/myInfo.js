/**
 * Created by loner on 2016/4/24.
 */
//图片预览
$("#upFile").change(function(){
    var file = this.files[0];
    if(file) {
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            $(".avatar").attr("src",this.result);
        }
    }
})
$("#fileBox").mouseover(function(){
    $("#upFile").animate({
        "margin-top":"-40px",
        "opacity":"1"
    },800)
}).mouseleave(function(){
    $("#upFile").animate({
        "margin-top":"40px",
        "opacity":"0"
    },500)
})

if($("#error").text()){
    setTimeout(function(){
        $("#error").text("");
    },2000);
}