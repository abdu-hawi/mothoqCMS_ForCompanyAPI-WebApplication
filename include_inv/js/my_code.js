$(document).ready(function() {
	// for date
	
     var final_total_amt = $('#final_total_amt').text();
     var count = 1;
     $(document).on('click','#add_row',function(){
		 
		 if( ($('#item_name'+count).val().length) == '' ){
			 $('#show').html('<h4>الرجاء ملء الصفوف أولا</h4>');
			 $('#item_name'+count).css({'background':'#ffdede', 'border':'1px solid #d30000' });
			 s_l($('#item_name'+count),1);
			 return false;
		 }else if(  ($('#order_item_quantity'+count).val())  == 0 ){
			 $('#show').html('<h4>الرجاء ملء الصفوف أولا</h4>');
			 $('#order_item_quantity'+count).css({'background':'#ffdede', 'border':'1px solid #d30000' });
			 s_l($('#order_item_quantity'+count),1);
			 return false;
		 }else if(  ($('#order_item_price'+count).val())  == 0 ){
			 $('#show').html('<h4>الرجاء ملء الصفوف أولا</h4>');
			 $('#order_item_price'+count).css({'background':'#ffdede', 'border':'1px solid #d30000' });
			 s_l($('#order_item_price'+count),1);
			 return false;
		 }
		 
		 count = count + 1;
		 $('#total_item').val(count);
		 var html_code = '';
		 html_code += '<tr id="row_id_'+count+'">';
		 html_code += '<td><span id="sr_no">'+count+'</span></td>';
		 html_code += '<td><input type="text" name="item_name[]" id="item_name'+count+'" class="form-control input-sm item_name" /></td>';
		 html_code += '<td><input type="text" name="order_item_quantity[]" id="order_item_quantity'+count+'" data-srno="'+count+'" class="form-control text-center input-sm order_item_quantity" /></td>';
		 html_code += '<td><input type="text" name="order_item_price[]" id="order_item_price'+count+'" data-srno="'+count+'" class="form-control text-center input-sm number-only order_item_price" /></td>';
		 html_code += '<td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount'+count+'" data-srno="'+count+'" class="form-control text-center input-sm number-only order_item_final_amount" readonly /></td>';
					   
		 html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="remove_row text-center btn btn-danger btn-xs">X</button> </td> </tr>';
		 $('#invoice-item-table').append(html_code);
     });
     $(document).on('click','.remove_row' ,function(){
          var row_id = $(this).attr("id");
          var total_item_amount = $('#order_item_final_amount'+row_id).val();
          var final_amount = $('#final_total_amt').text();
          var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
          $('#final_total_amt').text(result_amount);
          $('#row_id_'+row_id).remove();
          count --;
          $('#total_item').val(count);
    });
	
	// when write in text area or input
	function s_l (id,nn){
		$(id).keyup(function(){
			var sizeval = $.trim($(this).val()).length;
			if(sizeval < nn ){ // سيتغير اللون الى الاخضر مجرد ما يتعدى 10 احرف ولكن سيقوم شرط اخر الخاص ب30 حرف بالتغير الى احمر
				$(id).css({'background':'#ffdede', 'border':'1px solid #d30000' });
			}else{
				$(id).css({'background':'#deffdf','border':'1px solid #00b304'});
			}
		});
	}
	
	s_l('#customer_no' ,1);
	
    
    
  
	// this function to calculate auto and declare when bulr in price * qty input
	function cal_total_amount(count){
		//final_total_amt // this is for total amount
		//order_item_final_amount // this is for (item total= price*qty)
		var total_amount = 0;
		
		for(i=0;i<=count;i++){
			var qty = 0;
			var price = 0;
			var final_amt = 0;
			qty = $('#order_item_quantity'+i).val();
			if(qty>0){
				var price = $('#order_item_price'+i).val();
				final_amt = price * qty ;
				total_amount = parseFloat(final_amt) + parseFloat(total_amount) ;
				$('#order_item_final_amount'+i).val(final_amt);
				
				// here calculate total amount
			}
		}
		$('#final_total_amt').val(total_amount).css({'color':'#F00','font-style':'italic','font-family':
						'Arial Black, Gadget, sans-serif' , 'font-size':'16px'});
	}
	
	$(document).on('blur','.order_item_price',function(){
          cal_total_amount(count);
    });
	
	$(document).on('blur','.order_item_quantity',function(){
          cal_total_amount(count);
    });
	
	$('#bra').css({'color':'#0C0'});
				
});