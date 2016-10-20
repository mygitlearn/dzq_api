/**
 * Created by loner on 2016/4/22.
 */
var url = $("#url").attr("value");

$(document).keydown(function(event){
    if(event.keyCode==13){
        var searchCondition = $(".search").val();

        window.location.href = url+"/nickname/"+searchCondition;
    }
})
$(".current").css("background","#96BF48");