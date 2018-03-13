	var oldScrollPosY = 0;
  function goToScorll(id)
  {
  	
  	switch(id)
  	{
  		case 0:
	  		var curScorllPos = $("#container").scrollTop();
	  		$("#menuContainer").animate({height:"0"},50,function(){
	  			$("#container").animate({scrollTop:parseInt($("#services").offset().top) + parseInt(curScorllPos)},1000,function(){
	  			});
				});
  		break;
  		case 1:
	  		var curScorllPos = $("#container").scrollTop();
	  		$("#menuContainer").animate({height:"0"},50,function(){
	  			$("#container").animate({scrollTop:parseInt($("#aboutus").offset().top) + parseInt(curScorllPos)},1000,function(){
	  			});
				});
  		break;
  		case 2:
	   		var curScorllPos = $("#container").scrollTop();
	  		$("#menuContainer").animate({height:"0"},50,function(){
	  			$("#container").animate({scrollTop:parseInt($("#wedo").offset().top) + parseInt(curScorllPos)},1000,function(){
	  			});
				});
  		break;
  		case 3:
	   		var curScorllPos = $("#container").scrollTop();
	  		$("#menuContainer").animate({height:"0"},50,function(){
	  			$("#container").animate({scrollTop:parseInt($("#contract").offset().top) + parseInt(curScorllPos)},1000,function(){
	  			});
				});
  		break;
   		case 4:
	   		var curScorllPos = $("#container").scrollTop();
	  		$("#menuContainer").animate({height:"0"},50,function(){
	  			$("#container").animate({scrollTop:parseInt($("#ourteam").offset().top) + parseInt(curScorllPos)},1000,function(){
	  			});
				});
  		break;
  		case 5:
	   		var curScorllPos = $("#container").scrollTop();
	  		$("#menuContainer").animate({height:"0"},50,function(){
	  			$("#container").animate({scrollTop:0},1000,function(){
	  			});
				});
  		break;
  	}
  		return false;
  }
    $(function(){
	
							if(screen.availWidth>450)
							{
							//			document.getElementById("videoContainer").innerHTML=
							//				'<video id="topv" loop=""  muted="" autoplay=""><source src="./video/Blue_FullHD.webm" type="video/webm"><source src="__SRC__/./video/reu.mp4" type="video/mp4"></video>';
										document.getElementById("videoContainer").innerHTML='<video id="topv" loop="loop"  muted="" autoplay=""><source src="__SRC__/./video/MVI_7651.webm" type="video/webm"></video>';
							}
						  $("#loadingImg").animate({opacity:'1'},1500,function(){
						  $('#loadingImg').addClass('animated bounceOutLeft');
							
							$("#logoImg").animate({height:'3em'},500,function(){
						
								$("#loadingImg").remove();
							});
							$("#navbar").animate({height:'5em'},1000,function(){
									$("#menuBtn").css("display","inline");
							});
						});
						$("#menuBtn").on("click",function(){
							
						});
						$("nav li a").on("mouseover",function(){
					
						})
						$("nav li a").on("mouseout",function(){
							
						});
						$("#menuBtn").on("click",function(){
							$("#menuContainer").animate({height:"100%"},50,function(){
							});
						});
						$("#hideMenuBtn").on("click",function(){
							$("#menuContainer").animate({height:"0"},50,function(){
							});
						});
						$("#container").scroll(function() {
							
						  newScrollPosY = $("#container").scrollTop();
//						  alert(newScrollPosY);
						  if(newScrollPosY > oldScrollPosY)
						  {
						  	$("#navbar").animate({height:"0"},50,function(){
						  		//顶部Banner隐藏完成
						  		oldScrollPosY = newScrollPosY;
						  	});							  	
						  }else
						  {
						  	oldScrollPosY = newScrollPosY;
						  	$("#navbar").animate({height:"5em"},50,function(){
						  		//顶部Banner显示完成
						  		
						  	});	
						  }
						  bindEvent();
						});
		var startX = 0,
        startY = 0;
    function touchStart(evt){
        try{
            var touch = evt.touches[0], //获取第一个触点
                    x = Number(touch.pageX), //页面触点X坐标
                    y = Number(touch.pageY); //页面触点Y坐标
            //记录触点初始位置
            startX = x;
            startY = y;
        }catch(e){
            console.log(e.message)
        }
    }

    function touchMove(evt){
        try{
        	
            var touch = evt.touches[0], //获取第一个触点
                    x = Number(touch.pageX), //页面触点X坐标
                    y = Number(touch.pageY); //页面触点Y坐标
            //判断滑动方向
            
            if (y - startY>0) {
            	$("#navbar").show();
            	
//              console.log('下滑了！');
            }else{
            	 $("#navbar").hide();

            }
        }catch(e){
            console.log(e.message)
        }
    }

    function touchEnd(evt){
        try{
            var touch = evt.touches[0], //获取第一个触点
//                  x = Number(touch.pageX), //页面触点X坐标
                    y = Number(touch.pageY); //页面触点Y坐标
            //判断滑动方向
            if (y - startY>0) {
//              console.log('下滑了！');
				
            }else{
//              console.log('上滑了！');
            }
        }catch(e){
            console.log(e.message)
        }
    }

    //绑定事件
    function bindEvent(){
        document.addEventListener('touchstart',touchStart,false);
        document.addEventListener('touchmove',touchMove,false);
        document.addEventListener('touchend',touchEnd,false);
    }

});
//幻灯片
function exampleImgView()
{
	this.imgCount=0;
	this.imgShow=-1;
	this.flag=1;
	this.phoneFlag=1;
	this.phoneJudge=0;
	this.imgShowWay=function(x)
	{	
		$(".imgsDiv").children().eq(x).children().eq(1).show();
		$(".imgsDiv").children().eq(x).animate({width:'100%',height:'100%'});
	}
	this.imgHideWay=function(x)
	{	
		$(".imgsDiv").children().eq(x).animate({width:'0%',height:'0%'});
		$(".imgsDiv").children().eq(x).children().eq(1).hide();
	}
	this.rollPiece=function ()
		{
			for(var i=0;i<this.imgCount;i++)
			{
				if(i!=this.imgShow)
				{
					$('.divo').children().eq(i).css("background-color","#9dd8c5");
				}
				else
					$('.divo').children().eq(i).css("background-color","#d2dbd8");
			}
		}
	
	this.fontSize=function ()
		{
			if($(window).width()<480||window.screen.availWidth<480)  //响应式 宽度触发
				{
					
					if(window.screen.availWidth<480)
					$('.leftBotton').css("font-size","10em");
//					$(".imgsDiv").css("overflow","auto");
//					$(".exampleImg").css("overflow","auto");
					this.phoneFlag=0;
					this.phoneJudge=1;
					$(".leftBotton").hide();
					$(".rightBotton").hide();
					$(".divo").hide();
					this.flag=0;
					this.imgShow=0;
						for(var i=0;i<this.imgCount;i++)
						{
							this.imgShowWay(i);
						}

					
				}
				else
				{  
					$('.leftBotton').css("font-size","4em");
					$('.rightBotton').css("font-size","4em");
					$(".ptext").css("font-size","10");
					$(".imgsDiv").css("overflow","hidden");
					$(".exampleImg").css("overflow","hidden");
					$(".leftBotton").show();
					$(".rightBotton").show();
					$(".divo").show();
					this.flag=1;
					if(this.phoneJudge==1)
					{		
							this.imgShowWay(0);
							this.imgShow=0;
							this.rollPiece();
						for(var i=0;i<this.imgCount;i++)
						{	if(i!=this.imgShow)
							this.imgHideWay(i);
						}
						
					}
					this.phoneJudge=0;
					
					
				}
				$(".divtext").addClass("AlignCenter");
//				$('.lineCenterDiv').css("top",textHight.toString());

		}
	this.rollImg=function ()
	{	
		if(this.flag==1)
		{   
			this.imgHideWay(this.imgShow);
			this.imgShow++;
			if(this.imgShow>=this.imgCount) this.imgShow=0;
			this.imgShowWay(this.imgShow);
			this.rollPiece();

	}
		this.t=setTimeout("exampleImg.rollImg()",10000);  							//注意需要传实例进去
	

	}
	this.allEvent=function(ob)
	{
		window.onresize=function(){ //屏幕改变分辨率或宽度触发事件
			ob.fontSize();
		}
		
		$(".rightBotton").click(function(){
			if(ob.imgShow>=ob.imgCount-1) ob.imgShow=ob.imgCount-1;
			
				ob.imgHideWay(ob.imgShow);
				ob.imgShow++;
				if(ob.imgShow>ob.imgCount-1) ob.imgShow=0;
				ob.imgShowWay(ob.imgShow);
				ob.rollPiece();

			
		})
		$(".exampleDiv").mouseover(function(){
			if(ob.phoneJudge==0)
			ob.flag=0;
		})
		$(".exampleDiv").mouseout(function(){
			if(ob.phoneJudge==0)
			ob.flag=1;
		})
		$(".leftBotton").click(function(){
		if(ob.imgShow<=0) ob.imgShow=0;
	
			
			ob.imgHideWay(ob.imgShow);
			if(ob.imgShow==0) ob.imgShow=ob.imgCount;
			ob.imgShow--;
			ob.imgShowWay(ob.imgShow);
			ob.rollPiece();
			
		})
		$('.leftBotton').mouseover(function (){
			$('.leftBotton').children().eq(0).css("font-weight","bolder");
			$('.leftBotton').children().eq(0).css("opacity","0.9");
		})
		$('.rightBotton').mouseover(function (){
			$('.rightBotton').children().eq(0).css("font-weight","bolder");
			$('.rightBotton').children().eq(0).css("opacity","0.9");
		})
		$('.leftBotton').mouseout(function (){
			$('.leftBotton').children().eq(0).css("font-weight","normal");
			$('.leftBotton').children().eq(0).css("opacity","0.5");
		})
		$('.rightBotton').mouseout(function (){
			$('.rightBotton').children().eq(0).css("font-weight","normal");
			$('.rightBotton').children().eq(0).css("opacity","0.5");
		})
		
	}
	this.mainWay=function(ob)
	{
		$(document).ready(function(){
		ob.imgCount=$(".imgsDiv").children().length;
		ob.fontSize();
		ob.allEvent(ob);
		for(var i=0;i<ob.imgCount;i++)
		$(".divo").append("<div class='divoo'></div>");
		if(ob.phoneFlag==1)
		{
			for(var i=0;i<ob.imgCount;i++)
			{
			ob.imgHideWay(i);
			}
			ob.imgShowWay(0);
			ob.imgShow=0;
			ob.rollPiece();
			
		}
		setTimeout("exampleImg.rollImg()",10000); 
		})
	}

}
var exampleImg=new exampleImgView();
exampleImg.mainWay(exampleImg); //注意需要传实例进去




