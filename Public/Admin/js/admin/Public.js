/**
 * Created by loner on 2016/5/1.
 */

var ue = UE.getEditor("myEditor",{
    toolbars: [['source', '|', 'undo', 'redo', '|','bold', 'italic', 'underline', 'fontborder', 'strikethrough',
        'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'pasteplain', '|', 'forecolor',
        'backcolor', 'insertorderedlist', 'insertunorderedlist', '|', 'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
        'indent', '|', 'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|', 'justifyleft', 'justifycenter', 'justifyright',
        'justifyjustify', '|', 'touppercase', 'tolowercase', '|','link', 'unlink','|','insertimage', 'emotion', 'attachment',
        'insertcode', 'pagebreak', 'background', '|', 'spechars', 'snapscreen', '|','inserttable', 'deletetable',
        'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright',
        'mergedown', 'splittocells', 'splittorows', 'splittocols', '|', 'searchreplace']],
    autoHeightEnabled: true,
    autoFloatEnabled: true
});

var url = $("#url").attr("value");
$(document).keydown(function(event){
    if(event.keyCode==13){
        var searchCondition = $(".search").val();
        window.location.href = url+"/nickname/"+searchCondition;
        //alert(url+"/nickname/"+searchCondition)
    }
})

$("#right").mouseover(function(){
    $("#upImg").animate({
        "margin-top":"-40px",
        "opacity":"1"
    },800)
}).mouseleave(function(){
    $("#upImg").animate({
        "margin-top":"40px",
        "opacity":"0"
    },500)
})
$("#upImg").change(function(){
    var file = this.files[0];
    if(file) {
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            $("#showImg").attr("src",this.result);
        }
    }
})

if($("#error").text()){
    setTimeout(function(){
        $("#error").text("");
    },2000);
}

$(".current").css("background","#96BF48");