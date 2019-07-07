<?php
require_once('../include_db/session.php');
if($_SESSION['userinfo'] == false && $_SESSION['cominfo'] == false) header('location:../login.php');
if($_SESSION['userinfo'] != false)
$user_id = $_SESSION['userinfo']->user_id;
else $user_id = $_SESSION['cominfo']->com_id;
?>

<script src="js/new_cus_inv.js"></script>
<style>

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
<div> <br/>
  
  <form method="post" id="invoice_form" class="abform">
            <div class="table">
                <table class="table table-bordered">
                  
                    <tr>
                        <td colspan="2">
                        <div id="show" align="center"></div>
                        <br/>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" 
                                        name="shop_name"
                                        id="shop_name"
                                        class="form-control input-sm"
                                        placeholder="إسم المتجر"/>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" 
                                        name="shop_desc"
                                        id="shop_desc"
                                        class="form-control input-sm"
                                        placeholder="ملاحظات"/>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" 
                                        name="user_id"
                                        class="form-control input-sm" value="<?php echo $user_id; ?>"
                                        placeholder="ملاحظات"/>
                                </div>
                                <div class="col-md-4">
                                  <b>التاريخ</br></b>
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
                                <th class="col-lg-7 col-md-6 col-sm-6 col-xs-4">إسم المنتج</th>
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
<script>
	$(".nav-in li.active").removeClass("active");
	$('#shop_name').keyup(function(){
		var shop_len = $.trim($('#shop_name').val()).length ;
		if( shop_len > 0){
			$('#shop_name').css({'background':'#deffdf','border':'1px solid #00b304'});
		}
	});
  
  $('#create_invoice').click(function(){
        
		$('#show').html('');
		
		if($('#shop_name').val().length == ''){
			$('#show').html('<h4>الرجاء ملء الصفوف أولا</h4>');
			$('#shop_name').css({'background':'#ffdede', 'border':'1px solid #d30000' });
			return false;
		}else{
			
		}
		var da_form = $('#invoice_form').serialize();
    //console.log(da_form);
		$.ajax({
			url:"assist/op_new_cust_invoice.php", 
			type: 'POST' , 
			data: da_form,
			success: function(data){
				if(data == 'okInsert'){
					
					var n = $('#show').html('<div class="alert alert-info"><b>تمت إضافة الفاتورة بنجاح</b></div>');
					//setInterval(n,30000);window.close();
					setTimeout( function(){window.location.reload();}, 3000);
					
				}else{
					$('#show').html('<div class="alert alert-danger"><b> لم يتم إدخال الفاتورة <br/> نرجو تحديث الصفحة وإعادة المحاولة</b></div>');
				}
				}
		});
		/*
		var da_form = $('#invoice_form').serialize();
		$.post('op_new_cust_invoice.php',da_form,function(data){
			
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
			*/
		
	}); /// End create invoice btn
	
      
</script>
