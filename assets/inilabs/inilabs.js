var url      = window.location.href;
var res = url.split('/');
var url_true = "";
for (var i = 2; i <= 4; i++) {

    if(res[i] == 'add' || res[i] == 'edit' || res[i] == 'view' || res[i] == 'sent' || res[i] == 'trash' || res[i] == 'fav_message') { url_true += '/index'; } else { url_true += '/'+res[i]; }
}
url = res[0]+'/'+url_true;

if($("a[href$='"+url+"']").parent().parent().attr('class') == 'treeview-menu') {
    $("a[href$='"+url+"']").parent().parent().css('display', 'block');
    $("a[href$='"+url+"']").parent().parent().parent().addClass('active');
    $("a[href$='"+url+"']").parent().addClass('active');
} else {
    $("a[href$='"+url+"']").parent().addClass('active');
}