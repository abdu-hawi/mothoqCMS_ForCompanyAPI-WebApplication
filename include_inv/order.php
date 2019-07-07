<?php
require_once('../include_db/session.php');
if($_SESSION['brainfo'] == false) header('location:../login.php');
$com_id =  $_SESSION['brainfo']->com_id ;
require_once('../include_db/db.php');
$img_com = mysqli_query($tf_handle, "SELECT * FROM `company` WHERE `com_id`= '$com_id'");
$rows = $img_com->fetch_object();
$rows->password = 0 ;
$_SESSION['cominfo'] = $rows ;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>فاتورة جديدة</title>
<link rel="stylesheet" type="text/css" href="../include/css/bootstrap.min.css">
<script src="../include/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/my_code.js" ></script>
</head>

<style>
body{
  direction: rtl;
}
.center-block {
  float: right;
}
@media (min-width: 992px){
  .col-md-8 {
    width: 66.66666667%;
    float: right;
  }
}
th {
    text-align: right;
}

.input-sm, .form-group-sm .form-control {
    height: 30px;
    padding: 5px 10px;
    font-size: 18px;
    line-height: 1.5;
    border-radius: 3px;
}
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    cursor: not-allowed;
    background-color: #f5f5f5;
    opacity: 1;
}
</style>

<body>
<div class="container"> <br/>
  
  <form method="post" id="invoice_form" class="abform">
            <div class="table">
                <table class="table table-bordered">
                  <tr>
                    <td colspan="2">
                        <a href="../include_db/logout.php" style="color: #fff;text-decoration:none;" class="btn btn-danger">تسجيل الخروج</a>
                    </td>
                    
                  </tr>
                    <tr>
                      
                        <td colspan="2" align="center">
                            <h2 style="margin-top:5.5px">
                                <img src="../img/<?php echo $rows->com_img;?>.png" width="300" />
                            </h2>
                            <h2 style="margin-top:30.5px">
                                <?php
                                    if ($_SESSION['brainfo']->bra_stat == 8)
                                      echo " إسم الفرع / ".$_SESSION['brainfo']->bra_name ;
                                    else
                                      echo " إسم الموزع / ".$_SESSION['brainfo']->bra_name ; 
                                ?>
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <div id="show" align="center"></div>
                        <div class="col-lg-4 center-block">
                          <input type="hidden" value="<?php echo $rows->com_id; ?>" id="com_id" name="com_id" />
                          <input type="hidden" value="<?php echo $_SESSION['brainfo']->bra_id; ?>" id="bra_id" name="bra_id" />
                          <input type="hidden" value="<?php echo $rows->com_name; ?>" id="com_name" name="com_name" />
                          <input type="hidden" value="<?php echo $_SESSION['brainfo']->bra_name; ?>" id="bra_name" name="bra_name" />
                          <input type="hidden" value="<?php echo $_SESSION['brainfo']->bra_stat; ?>" id="bra_stat" name="bra_stat" />
                            	<input type="text" 
                                    name="customer_no"
                                    id="customer_no"
                                    class="form-control input-sm"
                                    placeholder="إدخل رقم العميل"/>
                            </div>
                        
                            <br/><br/>
                            <div class="row">
                                <div class="col-md-8" id="user_name_test">
                                    <b>إسم الشركة / العميل</br></b>
                                    <input type="text" 
                                        name="order_recive_name"
                                        id="order_recive_name"
                                        class="form-control input-sm"
                                        placeholder="إسم الشركة / العميل"
                                        readonly />
                                </div>
                                <div class="col-md-4">
                                  <b>إسم الشركة / العميل</br></b>
                                    <input type="text" 
                                        name="order_date"
                                        id="order_date"
                                        class="form-control input-sm"
                                        value="<?php
                                          //date_default_timezone_set('Asia/Riyadh');
                                          echo date("Y-m-d   H:i:s");
                                        ?>"
                                        readonly />
                                </div>
                            </div>
                        <table id="invoice-item-table" class="table table-bordered" style="margin-top:5px;">
                            <tr>
                                <th>تسلسل</th>
                                <th class="col-lg-7">إسم المنتج</th>
                                <th class="col-lg-1 text-center">الكمية</th>
                                <th class="col-lg-2 text-center">السعر</th>
                                <th class="col-lg-2 text-center">الاجمالي</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td id="sr_no">1</td>
                                <td><input type="text" name="item_name[]"
                                    id="item_name1" class="form-control input-sm item_name" />
                                </td>
                                <td><input type="text" name="order_item_quantity[]"
                                    id="order_item_quantity1" data-srno="1" 
                                    class="form-control input-sm text-center order_item_quantity" />
                                </td>
                                <td><input type="text" name="order_item_price[]"
                                    id="order_item_price1" data-srno="1"
                                    class="form-control input-sm text-center number-only order_item_price" />
                                </td>
                                <td><input type="text" name="order_item_final_amount[]"
                                    id="order_item_final_amount1" data-srno="1" 
                                    class="form-control input-sm text-center order_item_final_amount" readonly />
                                </td>
                            </tr>
                        </table>
                        <div align="center">
                            <button type="button" name="add_row" id="add_row"
                                class="btn btn-success btn-xs">
                                +
                            </button>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" class="col-lg-10"><b>الإجمالي الصافي</b></td>
                        <td align="right" class="col-lg-2" style="background:#f5f5f5;">
                        	<input readonly class="form-control text-center input-sm" name="final_total_amt" id="final_total_amt" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" align="center">
                            <input type="hidden" name="total_item" id="total_item" value="1" />
                            <input type="button" id="create_invoice" name="create_invoice"
                                class="btn btn-info create_invoice" value="Create Invoice"/>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
</div>
</body>
</html>
<script>
  
  
  $(document).on('blur','#customer_no',function(){
    var id_n = $(this).val();
    var bra_stat = $('#bra_stat').val();
    if (bra_stat == 8){
      $.ajax({
          url:'ajax_load_cust_name.php',
          type:'POST',
          data:'id='+id_n,
          success: function(data){
            if(data != ''){
              $('#user_name_test').html(data);
            }else{
              $('#show').html('<div class="alert alert-danger"><b>رقم العميل غير صحيح, نرجو إعادة إدخال رقم العميل </b></div>');
            }
          },
          complate:function(){
            $('#show').remove();
          }
      });
    }else{
      $.ajax({
          url:'ajax_load_com_name.php',
          type:'POST',
          data:'id='+id_n,
          success: function(data){
            if(data != ''){
              $('#user_name_test').html(data);
              
            }else{
              $('#show').html('<div class="alert alert-danger"><b>رقم العميل غير صحيح, نرجو إعادة إدخال رقم العميل </b></div>');
            }
          },
          complate:function(){
            $('#show').remove();
          }
      });
    }
    
  });
	
	// create invoice and send to db
	// $('#show').html('<h4>الرجاء ملء الحقول المطلوبة</h4>');
  
  $('#create_invoice').click(function(){
        
       /* 
		var rx_name = $.trim($('#order_recive_name').val()).length;
		var cust_number = $.trim($('#customer_no').val()).length;
		var order_date = $.trim($('#order_date').val()).length;
		var item_name ;
		var item_price;
		var item_qty;
		
        
		
		for(var no=1;no<=count ; no++){
			item_name = $('#item_name'+no);
			item_price = $('#order_item_price'+no);
			item_qty = $('#order_item_quantity'+no);
		}
		
		if( ( rx_name && cust_number && order_date && ($('.item_name').val().length) 
				&& ($('.order_item_price').val().length) && ($('.order_item_quantity').val().length) ) == 0){
			//alert('ss');
			$('#show').html('<h4>الرجاء ملء الحقول المطلوبة</h4>');
			
			$('#customer_no').css({'background':'#ffdede', 'border':'1px solid #d30000' });
				s_l('#customer_no' ,1);
			item_name.css({'background':'#ffdede', 'border':'1px solid #d30000' });
				s_l(item_name,1);
			item_price.css({'background':'#ffdede', 'border':'1px solid #d30000' });
				s_l(item_price,1);
			item_qty.css({'background':'#ffdede', 'border':'1px solid #d30000' });
				s_l(item_qty,1);
				return false;
		}else if(cust_number == 0){
				$('#show').html('<h4>الرجاء ملء الحقول المطلوبة</h4>');
				$('#customer_no').css({'background':'#ffdede', 'border':'1px solid #d30000' });
				s_l('#customer_no' ,1);
				return false;
		}else if (rx_name == 0){
				$('#show').html('<h4>الرجاء التأكد من رقم العميل</h4>');
				$('#order_recive_name').css({'background':'#ffdede', 'border':'1px solid #d30000' });
				s_l('#order_recive_name' , 5);
				return false;
		}else if($.trim(item_name.val()).length == 0){
				$('#show').html('<h4>الرجاء ملء الحقول المطلوبة</h4>');
				item_name.css({'background':'#ffdede', 'border':'1px solid #d30000' });
				s_l(item_name,3);
				return false;
		}else if($.trim(item_qty.val()).length == 0){
				$('#show').html('<h4>الرجاء ملء الحقول المطلوبة</h4>');
				item_qty.css({'background':'#ffdede', 'border':'1px solid #d30000' });
				s_l(item_qty,1);
				return false;
		}else if($.trim(item_price.val()).length == 0){
				$('#show').html('<h4>الرجاء ملء الحقول المطلوبة</h4>');
				item_price.css({'background':'#ffdede', 'border':'1px solid #d30000' });
				s_l(item_price,1);
				return false;
		}else{
      */
			$('#show').html('');
			
			var da_form = $('#invoice_form').serialize();
			$.post('op_pro_invoice.php',da_form,function(data){
				
				//$('#invoice_form').submit();
				
				//okInsert value is coming from post.add.php if is true insert to db
				if(data == 'okInsert'){
					$('#show').html('<div class="alert alert-info"><b>تمت إضافة الفاتورة بنجاح</b></div>');
          
					// this for hide image wating load
					//$('#waitingL').hide(1000);
				}else{
					$('#show').html('<div class="alert alert-danger"><b> لم يتم إدخال الفاتورة <br/> نرجو تحديث الصفحة وإعادة المحاولة</b></div>');
				}
			});
		//
			
		
	}); /// End create invoice btn
	
      
</script>
