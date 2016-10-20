/**
 * Created by loner on 2016/4/30.
 */
var url = $("#url").attr("value");
$(document).keydown(function(event){
    if(event.keyCode==13){
        var searchCondition = $(".search").val();
        window.location.href = url+"/nickname/"+searchCondition;
        //alert(url+"/nickname/"+searchCondition)
    }
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
//点击添加按钮显示弹出层
$(".btn-flat").click(function(){
    $("#code").attr("value","");
    $("#demo").toggle();
})
$("#tijiao").click(function(){
    var img = $("#showImg").attr("src");
    var oldImg = "/dzq_api/Public/Admin/images/default.jpg";
    if(!$("#upImg").val() && img==oldImg){
        alert("请选择图片！");
        return;
    }
    if(!$("#inp").val()){
        alert("请添加类别名称");
        return;
    }
    $("#sub").click();
    $("#demo").toggle();
})
//弹出层关闭
$(".close_demo").click(function(){
    $("#demo").toggle();
    var img = $("#default_img").attr("value");
    $("#inp").attr("value","");
    $("#showImg").attr("src",img);
})

//编辑功能
$(".revise").click(function () {
    var name = $.trim($(this).parent().parent().find("td span").eq(0).text());
    var img = $(this).parent().parent().find("td img").eq(0).attr("src");
    if(img.length<=17){
        var img = $("#default_img").attr("value");
    }
    $("#inp").attr("value",name);
    $("#showImg").attr("src",img);
    $("#code").attr("value",$(this).attr("value"));
    $("#demo").toggle();
})
$(".current").css("background","#96BF48");