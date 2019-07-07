<style>
  .back-inv{
		font-weight:bold;
	}
</style>
<table id="str-table" class="table table-hover">
<thead class="hidden">
    <tr>
        <th>img</th>
        <th>corner</th>
        <th style="text-align: -webkit-right;">item</th>
        <th style="text-align: -webkit-left;">price</th>
        <th style="text-align: -webkit-center;">city</th>
        <th style="text-align: -webkit-left;">date</th>
        <th>pdf</th>
        <th>x</th>
    </tr>
</thead>

                    
<?php
require_once('../include_db/session.php');
require_once('../include_db/db.php');
if($_SESSION['userinfo'] != false)
$user_id = $_SESSION['userinfo']->user_id;
else $user_id = $_SESSION['cominfo']->com_id;
$statment_inbox = mysqli_query($tf_handle, "SELECT * FROM `invoice`
    WHERE `user_id` = '$user_id' AND `invoice_status` = 1 AND `isStr` = 1
    AND `inTrash` = 0 ORDER BY `date_invoice` DESC");
    if(!$statment_inbox) die('qyr');
            //$statment_inbox->execute();
            
    $total_rows = mysqli_num_rows($statment_inbox);
            
if($total_rows > 0 ){
while($row = mysqli_fetch_assoc($statment_inbox)){
  $order_id = $row["order_id"];
  $order_id_row = $order_id;
  $prod = '';
  $qry_item = mysqli_query($tf_handle,"SELECT `prod_name` FROM `tbl_order_system_item` WHERE `order_id` = '$order_id'");
  while($item = mysqli_fetch_assoc($qry_item)){
    $prod .= $item['prod_name'].' / ';
  }
  if($row["isRead"] == 1) echo '<tr class="back-inv">';
    else echo '<tr class="">';
    echo '
    <td class="col-lg-1">
            <a data-toggle="tab" href="#ord" id="'.$order_id.'"
               class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
                    <img class="img-circle img-inv" src="../img/'.$row["com_img"].'.png" alt="'.$row["com_name"].'" />
            </a>
    </td>' ?>
    <td class="col-lg-1">
      <span class="fa-m-inv"><i class="fa fa-square-o sqr" id="<?php echo $order_id; ?>"></i></span>
                                                            
    <?php
      if ($row["isStr"] == 0){
                     echo '<span class="fa-m-inv"><i class="fa fa-star-o str" id='.$order_id.'></i></span>';
            }else{
                            echo '<span class="fa-m-inv"><i style="color:#dacd00;" class="fa fa-star str" id='.$order_id.'></i></span>';
            }
            if ($row["isFav"] == 0){
                     echo '<span class="fa-m-inv"><i class="fa fa-heart-o hrt" id='.$order_id.'></i></span>';
            }else{
                            echo '<span class="fa-m-inv"><i style="color:#da0000;" class="fa fa-heart hrt" id='.$order_id.'></i></span>';
            }
    ?>

    </td>
                                                    
    <?php echo '
    <td class="col-lg-4">
        <a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
        '.$prod.'
        </a>
    </td>
    <td  class="col-lg-1" style="text-align: -webkit-left;">
      <a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
        <b>'.$row["total_amount"].'</b> رس
      </a>
    </td>
    <td class="col-lg-2" style="text-align: -webkit-center;">
      <a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
         '.$row["bra_name"].'
      </a>
    </td>
    <td  class="col-lg-2" style="text-align: -webkit-left;">
      <a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
        '.$row["date_invoice"].'
      </a>
    </td>
    <td class="text-center">
      <a style="text-decoration: none;" href="../include_html2pdf/print.php?pdf=1&id='.$order_id.'" target="_blank">
        <span style="color:blue;"><b>PDF</b></span>
      </a>
    </td>
    <td class="text-center">
      <a href="#" id="'.$order_id.'" class="inTrashStr">
        <span class="fa fa-trash" style="color:red; font-size:22px;"></span>
      </a>
    </td>
  </tr>
  ';
}
}
                            
?>
</table>
	
<script>


  var table = $('#str-table').dataTable({
					"pageLength":12
		});
		
		$('#searchBox').keyup(function() {
		   table.fnFilter(this.value);
		});
		

  var sqr_arr = [];
	$('.sqr').click(function(){
		var sqr_id = $(this).attr('id');
		function sqr_all(){
			//alert(sqr_arr.toString());
			if (sqr_arr.length > 0){
				$('#sqrAll').removeClass("fa-square-o");
				$('#sqrAll').addClass("fa-minus-square-o ");
				$('#sqrAll').css({'color':'blue'});
			}else{
				$('#sqrAll').removeClass("fa-minus-square-o");
				$('#sqrAll').addClass("fa-square-o");
				$('#sqrAll').css({'color':'black'});
			}
		}// sqr_all end
		
		function sqr_remove(){
			var a = sqr_arr.indexOf(sqr_id);
			sqr_arr.splice(a, 1);
		}
    
		if ($(this).hasClass("fa-square-o")) {
			$(this).removeClass("fa-square-o");
			$(this).addClass("fa-check-square-o");
			$(this).css({'color':'blue'});
			//$(this).closest("tr").css('background-color','#d4fff0');
			//$(this).closest("tr").addClass("back-inv");
			sqr_arr.push($(this).attr('id') );
			sqr_all();
		}else{
			$(this).removeClass("fa-check-square-o");
			$(this).addClass("fa-square-o");
			$(this).css({'color':'black'});
			//$(this).closest("tr").css('background-color','transparent');
			sqr_remove();
			sqr_all();
		}
	}); // sqr click end
  
  function on_click_str(){
    $.ajax({
         url:'inv_stars_cust.php',
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
  // start star
  $('.str').click(function(){
    var str_id = $(this).attr('id');
    var str_stat = 0 ;
    function change_str_stat(){
      $.ajax({
        url:'isStar.php',
        type:'POST',
        data:{str_id:str_id , str_stat:str_stat},
        success:function(data_str){
          if(data_str != ''){
            on_click_str();
          }
        }
      });
    }
    if ($(this).hasClass("fa-star-o")) {
      $(this).removeClass("fa-star-o");
      $(this).addClass("fa-star");
      $(this).css({'color':'#dacd00'});
      str_stat = 1;
      change_str_stat();
    }else{
      $(this).removeClass("fa-star");
      $(this).addClass("fa-star-o");
      $(this).css({'color':'black'});
      str_stat = 0 ;
      change_str_stat();
    }
  });
  // end star
  
			
      
			
			$('.hrt').click(function(){
				var fav_id = $(this).attr('id');
				var fav_stat = 0 ;
				function change_fav_stat(){
					$.ajax({
						url:'isFavor.php',
						type:'POST',
						data:{fav_id:fav_id , fav_stat:fav_stat},
						success:function(data_fav){
							if(data_fav != ''){
							}
						}
					});
				}
				if ($(this).hasClass("fa-heart-o")) {
					$(this).removeClass("fa-heart-o");
					$(this).addClass("fa-heart");
					$(this).css({'color':'#da0000'});
					fav_stat = 1;
					change_fav_stat();
				}else{
					$(this).removeClass("fa-heart");
					$(this).addClass("fa-heart-o");
					$(this).css({'color':'black'});
					fav_stat = 0;
					change_fav_stat();
				}
			});
 // end fav
 
 // This code for open invoice detail on click row
$(document).on('click','.parent',function(){
    var id_ord = $(this).attr("id");
    $.ajax({
        url:'row_ord.php',
        type:'POST',
        data:'id='+id_ord,
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
});
// End invice Detail

	// move to TRASH folder
		$(document).on('click','.inTrashStr',function(){
					var id = $(this).attr("id");
					if(confirm("هل توافق على حذف هذه الفاتورة؟")){
								//window.location.href == "main.php#del";
								$.ajax({
										url:'inTrash.php',
										type:'POST',
										data:'id='+id,
										success:function(data){
												if(data != 'ok'){
													alert('لم يتم حذف الفاتورة !! نرجوا اعادة المحاولة');
												}else{
													on_click_str();
												}
										}
								});
					}else{
						return false;
					}
		});
    // End Move to trash folder
	
</script>
