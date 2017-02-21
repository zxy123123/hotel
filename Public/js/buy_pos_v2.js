	 var varPostage = 0 ;	//邮费
	 var g_maxNumber = 99 ; //最大购买数量
 
     //得到对象

      function getObj(id) {
        return $("#" + id);
      }


      var total = 1; //总数

      function chkAddAmount(id, type) {
        //得到数量文本框
        var varObj = getObj(createCountId(id));
        var varObjValue = varObj.val();
		if(type==0){
			//为空，用于计算用户输入数量，不改变文本框值，重新计算商品总金额
		}else if (type == 1) {
          varObjValue++;
        }
        else {
          varObjValue--;
        }
		
        //判断数量是否大于最大购买数量
        if (varObjValue > g_maxNumber) {
			alert('一次性购买不能超过'+g_maxNumber+'个');
			varObj.val(g_maxNumber);
			changeSumPrice();
			changeSubtotal(id,g_maxNumber);
			return;
		}
        //判断数量是否小于1
        if (varObjValue <= 1) {
          //当前文本框数量为1
          varObj.val(1);
          //设置当前文本框的
          getObj(createSubtotalId(id)).text(getObj(createFirstId(id)).text());
          //改变余额
          changeSumPrice();
          return;
        }
        varObj.val(varObjValue);
        changeSubtotal(id, varObjValue);
      }

      //改变小计

      function changeSubtotal(id, amount) {
        //得到单价
        var varFirstPrice = getObj(createFirstId(id)).text();
        //单价乘以数量
        var varSubtotal = floatCounstrue(varFirstPrice * amount);
        //赋值
        getObj(createSubtotalId(id)).text(varSubtotal);
        //余额赋值
        changeSumPrice();
      }

      //改变余额

      function changeSumPrice() {
        var index = 1;
        var varSumPrice = 0;
        for (index; index <= total; index++) {
          varSumPrice += parseFloat(getObj(createSubtotalId(index)).text());
		  //alert(parseFloat(getObj(createSubtotalId(index)).text()));
        }
        varSumPrice = floatCounstrue(varSumPrice);
        getObj("span_sumPirce").text(varSumPrice);
        getObj("b_sumPirce").text(varSumPrice);
      }

      //浮点型分析

      function floatCounstrue(val) {
		  
        val = val.toString();
        var index = val.indexOf(".");
        if (index > 0) {			
          return val.substring(0, index + 3);
        }
        else {
          return val + ".00";
        }
      }


      //创建单价Id

      function createFirstId(id) {
        return "span_first_price_" + id;
      }

      //创建数量 I

      function createCountId(id) {
        return "input_count_" + id;
      }


      //创建小计Id

      function createSubtotalId(id) {
        return "span_subtotal_price_" + id;
      }
	  
	  function fnChangePictrue(number,flag){
		  switch(number){
			  case 1:
			  
			  break;
			  case 2:
			  	var varImagePath1 = baseLocation+"web/images/message_btn.png";
				var varImagePath2 = baseLocation+"web/images/message_btn1.png";
				if(flag){
					alert(varImagePath1);
				  	getObj("next2 > img").attr("src",varImagePath2);
				}else{
					alert(varImagePath2);
					getObj("next2 > img").attr("src",varImagePath1);
				}
				
			  break;
			  
		  }
	  }

