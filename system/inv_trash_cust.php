<style>
  .back-inv{
		font-weight:bold;
	}
</style>
<table id="data-table" class="table table-hover">
       
     <thead class="hidden">
            <tr>
                <th style="text-align: -webkit-center;">img</th>
                <th style="text-align: -webkit-right;">corner</th>
                <th style="text-align: -webkit-right;">item</th>
                <th style="text-align: -webkit-left;">price</th>
                <th style="text-align: -webkit-center;">city</th>
                <th style="text-align: -webkit-left;">date</th>
            </tr>
        </thead>
        <?php
          require_once('../include_db/session.php');
          require_once('../include_db/db.php');
          if($_SESSION['userinfo'] != false)
            $user_id = $_SESSION['userinfo']->user_id;
          else $user_id = $_SESSION['cominfo']->com_id;
            $stmt_trash = mysqli_query($tf_handle, "SELECT * FROM `invoice`
                WHERE `user_id` = '$user_id' AND `inTrash` = 1 ORDER BY `date_invoice` DESC");
                if(!$stmt_trash) die('qyr');
                        //$statment_inbox->execute();
                        
                $total_rows = mysqli_num_rows($stmt_trash);
                        
            if($total_rows > 0 ){
            while($row = mysqli_fetch_assoc($stmt_trash)){
              $order_id = $row["order_id"];
              $order_id_row = $order_id;
              $prod = '';
              $qry_item = mysqli_query($tf_handle,"SELECT `prod_name` FROM `tbl_order_system_item` WHERE `order_id` = '$order_id'");
              while($item = mysqli_fetch_assoc($qry_item)){
                $prod .= $item['prod_name'].' / ';
              }
        
        if($row["isRead"] == 1) echo '<tr class="back-inv">';
          else echo '<tr class="">';
            
        ?>
                <td class="col-lg-1">
                   <?php
                   echo '
                     <a data-toggle="tab" href="#ord" id="'.$order_id.'"
                        class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
                             <img class="img-circle img-inv" src="../img/'.$row["com_img"].'.png" alt="'.$row["com_name"].'" />
                     </a>
                     ';
                   ?>
                <td class="col-lg-2">
                   <span class="fa-m-inv">
                        <i class="fa fa-square-o sqr" id="<?php echo $order_id; ?>"  style="font-size:18px;"></i>
                   </span>
                   <span class="fa-m-inv">
                        <a href="#" id="<?php echo $order_id; ?>" class="delete" style="text-decoration:none;">
                            <span class="fa fa-trash" style="color:red; font-size:22px;"></span>
                        </a>
                   </span>
                   <span class="fa-m-inv">
                      <a href="#" id="<?php echo $order_id; ?>" class="outTrash" style="text-decoration:none;" >
                        <i class="fa fa-repeat" style="color:blue; font-size:18px;"></i>
                      </a>
                   </span>
                </td>
                
                <?php
                echo '
                <td class="col-lg-4">
                    <a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width:
                        100%; text-decoration:none; color:#000;">'.$prod.'
                    </a>
                </td>
		<td  class="col-lg-1" style="text-align: -webkit-left;">
                    <a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width:
                        100%; text-decoration:none; color:#000;"> <b>'.$row["total_amount"].'</b> رس
                    </a>
                </td>
		<td class="col-lg-2" style="text-align: -webkit-center;">
                    <a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width:
                        100%; text-decoration:none; color:#000;"> '.$row["bra_name"].'
                    </a>
                </td>
		<td  class="col-lg-2" style="text-align: -webkit-left;">
                     <a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width:
                        100%; text-decoration:none; color:#000;">'.$row["date_invoice"].'
                     </a>
                </td>
        </tr>
		';
        
            }
            }
            ?>      	  
           
</table>
	
<script>
var table = $('#data-table').dataTable({
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

// DELETE invoice forever
  $(document).on('click','.delete',function(){
    var id = $(this).attr("id");
    if(confirm("سيتم حذف الفاتورة بشكل نهائي ولن يتم أسترجاعها بعد ذلك, هل تؤكد الحذف؟")){
      //window.location.href == "main.php#del";
      $.ajax({
          url:'delete.php',
          type:'POST',
          data:'id='+id,
          success:function(data){
            if(data != 'ok'){
              alert('لم يتم حذف الفاتورة !! نرجوا اعادة المحاولة');
            }else{
              on_click_trash();
            }
          }
      });
    }else{
      return false;
    }
  });
  
  // move From TRASH folder
		$(document).on('click','.outTrash',function(){
					var id = $(this).attr("id");
					if(confirm("هل تريد إعادة هذه الفاتورة لصندوق الوراد")){
								//window.location.href == "main.php#del";
								$.ajax({
										url:'outTrash.php',
										type:'POST',
										data:'id='+id,
										success:function(data){
												if(data != 'ok'){
													alert('لم يتم حذف الفاتورة !! نرجوا اعادة المحاولة');
												}else{
													on_click_trash();
												}
										}
								});
					}else{
						return false;
					}
		});
    // End Move From trash folder

 
	
</script>
