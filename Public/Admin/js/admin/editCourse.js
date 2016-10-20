/**
 * Created by loner on 2016/4/26.
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

//加内容改变事件监听
ue.addListener('contentChange',function(e){
    $(".btn").attr("disabled",false);
});

//设置输入框高度
var height = document.documentElement.clientHeight;
height = (height-200)+"px";
$("#editUe").css("height",height);