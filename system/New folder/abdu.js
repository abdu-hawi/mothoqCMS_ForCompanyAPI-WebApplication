$('#com_invo').click(function(){
    var click_btn = $(this).attr('href');
    $('#show_system_content').load(click_btn);
    return false;
});