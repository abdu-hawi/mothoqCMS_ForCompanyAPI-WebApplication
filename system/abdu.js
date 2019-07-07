$(document).ready(function (){
 
  window.onload = on_click_inbox();
 
 
 $('#btn-coll').click(function(){
					if($('#asideNav').hasClass("col-lg-10-inv")){
									$('#asideNav').removeClass("col-lg-10-inv");
								$('#asid-down').removeClass("col-lg-10-invoi");
									$('#asid-down').addClass("col-lg-10-inv");
					}else{
								$('#asid-down').removeClass("col-lg-10-inv");
								$('#asideNav').addClass("col-lg-10-inv asi-nav");
								$('#asid-down').addClass("col-lg-10-invoi");
					}
			  
			});
		
		$('.collba').click(function(){
							$('#asid-down').addClass("col-lg-10-invoi");
			});
		
		$('.coll').click(function(){
							$('#asid-down').removeClass("col-lg-10-invoi");
			});
  
  
 function on_click_inbox(){
     $.ajax({
     url:'inv_inbox_cust.php',
     type:'POST',
     success:function(data){
         if(data != ''){
             $('.tab-content').children().remove();
             $('.tab-content').append( "<div id='aja_content'></div>" );
             $('#aja_content').html(data);
         }else{
             $('.tab-content').load('href');
         }
       }
     });
     return false;
 }

 $(document).on('click','#inbox',function(){
     on_click_inbox();
  });
 
 function on_click_manual(){
     $.ajax({
     url:'inv_manual_cust.php',
     type:'POST',
     success:function(data){
         if(data != ''){
             $(".nav-in li.active").removeClass("active");
             $('.tab-content').children().remove();
             $('.tab-content').append( "<div id='aja_content'></div>" );
             $('#aja_content').html(data);
         }else{
             $('.tab-content').load('href');
         }
       }
     });
     return false;
 }

 $(document).on('click','#manual',function(){
     on_click_manual();
  });
 
$(document).on('click','#refresh',function(){
     window.location.reload();
  });
 function on_click_fav(){
     //var id_ord = $(this).attr("id");
   $.ajax({
       url:'inv_fav_cust.php',
       type:'POST',
       success:function(data){
           if(data != ''){
               //$(".nav-in li.active").removeClass("active");
               $('.tab-content').children().remove();
               $('.tab-content').append( "<div id='aja_content'></div>" );
               $('#aja_content').html(data);
           }else{
               $('.tab-content').load('href');
           }
       }
   });
   return false;
 }
 
$(document).on('click','#fav',function(){
    on_click_fav();
});

function on_click_str(){
  $.ajax({
       url:'inv_stars_cust.php',
       type:'POST',
       success:function(data){
           if(data != ''){
               //$(".nav-in li.active").removeClass("active");
               //$('.tab-content').hide().html(data).fadeIn();
               $('.tab-content').children().remove();
               $('.tab-content').append( "<div id='aja_content'></div>" );
               $('#aja_content').html(data);
           }else{
               $('.tab-content').load('href');
           }
       }
   });
   return false;
}

 $(document).on('click','#str',function(){
     on_click_str();
 });
 
 // start in trash
 
 function on_click_trash(){
  $.ajax({
       url:'inv_trash_cust.php',
       type:'POST',
       success:function(data){
           if(data != ''){
               $('.tab-content').children().remove();
               $('.tab-content').append( "<div id='aja_content'></div>" );
               $('#aja_content').html(data);
           }else{
               $('.tab-content').load('href');
           }
       }
   });
   return false;
}

 $(document).on('click','#tra',function(){
     on_click_trash();
 });
 
 // end in trSH 
   
// this code used for show branch of company in tab company & establshment when click +
$('.com_row').click(function(){
    $(this).toggleClass('expand').nextUntil('tr.com_row').slideToggle(100);
 });


 /*
// move to TRASH folder
$(document).on('click','.inTrash',function(){
	var id = $(this).attr("id");
	if(confirm("هل توافق على حذف هذه الفاتورة؟")){
		$.ajax({
			url:'inTrash.php',
			type:'POST',
			data:'id='+id,
			success:function(data){
				if(data != 'ok'){
					alert('لم يتم حذف الفاتورة !! نرجوا اعادة المحاولة');
				}else{
					on_click_inbox();
				}
			}
		});
	}else{
		return false;
	}
});
// End Move to trash folder

// not know for what
$('#com_invo').click(function(){
    var click_btn = $(this).attr('href');
    $('#show_system_content').load(click_btn);
    return false;
});
*/
});