<?php
/*
 *SELECT * FROM `tbl_order_system` INNER JOIN `tbl_order_system_item` ON `tbl_order_system`.`order_id` = `tbl_order_system_item`.`order_id` WHERE `tbl_order_system`.`user_id` = 7 AND `tbl_order_system`.`invoice_status` = 1;
 */
require_once('../include_db/session.php');
include '../include_db/db.php';
if($_SESSION['userinfo'] != false)
$user_id = $_SESSION['userinfo']->user_id;
else $user_id = $_SESSION['cominfo']->com_id;
//INNER JOIN `tbl_order_system_item` ON `tbl_order_system`.`order_id` = `tbl_order_system_item`.`order_id`

$statment_inbox = mysqli_query($tf_handle, "SELECT * FROM `invoice`
WHERE `user_id` = '$user_id' AND `invoice_status` = 1 ORDER BY `date_invoice` DESC");
if(!$statment_inbox) die('qyr');
	//$statment_inbox->execute();
	
	$total_rows = mysqli_num_rows($statment_inbox);

?>
<style>
	.com_row .sign:after{
		content:"+";
		display:inline-block;
		color:blue;
		font-size: 200%;
		text-decoration:none;
	}
	.com_row.expand .sign:after{
		content:"-";
		color:red;
		font-size: 200%;
		text-decoration:none;
	}
	.row_bra{
		margin-right: 1em;
		margin-bottom: 0.3em;
		padding: 1px 6px;
	}
	.back-inv{
		font-weight:bold;
	}
</style>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home" style="padding-left: 8.3em;padding-right: 0.39em;">الفواتير</a></li>
    <li><a data-toggle="tab" href="#menu1" style="padding-left: 3.831em;
    padding-right: 0.00086em;">الشركات والمؤسسات</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">

<table id="data-table" class="table table-hover">
            <thead>
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
          $statment_inbox = mysqli_query($tf_handle, "SELECT * FROM `invoice`
					WHERE `user_id` = '$user_id' AND `invoice_status` = 1 AND `inTrash` = 0 ORDER BY `order_id` DESC");
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
              }//style="font-weight:bold"
							if($row["isRead"] == 1) echo '<tr class="back-inv">';
							else echo '<tr class="">';
              echo '
                
                <td class="col-lg-1">
									<a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
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
                  <a href="#" id="'.$order_id.'" class="inTrashInbox">
                    <span class="fa fa-trash" style="color:red; font-size:22px;"></span>
                  </a>
                </td>
              </tr>
              ';
            }
          }
					
          ?>
        </table>
</div> <!-- end id home -->


    <div id="menu1" class="tab-pane fade">
			<br/>
		<table class="table table-hover" id="example">
      	<thead class="hidden">
            <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th>Platform(s)</th>
                <th>Platform(s)</th>
            </tr>
        </thead>
				
				
				<?php
				
				///////////////////////
				//$statment_inbox = mysqli_query($tf_handle, "SELECT * FROM `inv_by_com`
				//HAVING `user_id` = '$user_id' AND `invoice_status` = 1 ORDER BY `date_invoice` DESC");
				$statment_inbox = mysqli_query($tf_handle,"SELECT * FROM `inv_by_com` WHERE user_id = '$user_id' AND `invoice_status` = 1  GROUP BY `com_name` ORDER BY `date_invoice` DESC");
				if(!$statment_inbox) die('qyr');
					//$statment_inbox->execute();
					
				$total_rows = mysqli_num_rows($statment_inbox);
				if($total_rows > 0 ){
					$cnt = 0;
            while($row = mysqli_fetch_assoc($statment_inbox)){
							$cnt = $cnt + 1;
							
							echo '
								<tr>
										<td class="col-lg-2"><img class="img-circle img-inv" src="../img/'.$row["com_img"].'.png" alt="'.$row["com_name"].'" width="50" height="50"></td>
										<td class="col-lg-2">'.$row["com_name"].'</td>
										
										<td class="col-lg-7">'.$row["com_desc"].'</td>
										<td class="col-lg-1">
											<a href="#" id="" class="com_row" data-toggle="collapse" data-target="#demo_row'.$cnt.'">
												<span class="sign"></span>
											</a>
										</td>
								</tr>
								';
								
								//`inv_by_bra`
								$id = $row["com_id"];
								$stmt_inbox = mysqli_query($tf_handle, "SELECT * FROM `inv_by_bra`
								HAVING `com_id` = '$id' AND `user_id` = '$user_id' ");
								if(!$stmt_inbox) die('qyr');
									//$statment_inbox->execute();
									
								$total_bra = mysqli_num_rows($stmt_inbox);
								if($total_bra > 0 ){
									echo '<tr id="demo_row'.$cnt.'" class="collapse"><td colspan="4">';
										while($row_bra = mysqli_fetch_assoc($stmt_inbox)){
											
											echo '<button class="btn btn-primary row_bra">
															<a data-toggle="tab" href="#bra_sel" style="text-decoration:none;color:#fff;">'.$row_bra["bra_name"].'</a>
														</button>';
											
										}
										echo '</td></tr>';
								}
								
							
				///////////////////////////////////
						}
				}
				?>
				
      </table>
    </div>
	</div>
	
<script>

	var table = $('#data-table').DataTable({
					"pageLength":12
		});
	/*
	setInterval(function(){
    on_click_inbox();
	}, 180000);
	*/	
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
			//$(this).parent().parent().parent().addClass("back-inv");
			sqr_arr.push($(this).attr('id') );
			sqr_all();
		}else{
			$(this).removeClass("fa-check-square-o");
			$(this).addClass("fa-square-o");
			$(this).css({'color':'black'});
			sqr_remove();
			sqr_all();
		}
	}); // sqr click end
	
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
                //on_click_fav();
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

function on_click_inbox(){
     $.ajax({
     url:'inv_inbox_cust.php',
     type:'POST',
     success:function(data){
         if(data != ''){
             //$(".nav-in li.active").removeClass("active");
             //$('#inbox_href').html(data);
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

	// move to TRASH folder
		$(document).on('click','.inTrashInbox',function(){
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
													on_click_inbox();
												}
										}
								});
					}else{
						return false;
					}
		});
    // End Move to trash folder
	
	
</script>
