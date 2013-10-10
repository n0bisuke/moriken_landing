<?php
	//画像きりかえ
	if(isset($_GET["type"]) && $_GET["type"]=="sakumon"){ //sakumon.jpフレーム
		$url = "../image/sakumon";
		$mes = "Moriken Web Quiz";
	}elseif(isset($_GET["type"]) && $_GET["type"]=="fb"){ //facebookアプリフレーム
		$url = "../image/fb";
		$mes = "Facebook App";
	}elseif(isset($_GET["type"]) && $_GET["type"]=="iphone"){ //iphoneアプリフレーム
		$url = "../image/iphone";
		$mes = "iPhone App";
	}elseif(isset($_GET["type"]) && $_GET["type"]=="android"){ //anbroidアプリフレーム
		$url = "../image/and";
		$mes = "Android App";
	}elseif(isset($_GET["type"]) && $_GET["type"]=="ganriser"){ //ガンライザー検定フレーム
		$url = "../image/gan";
		$mes = "Ganrise Kentei";
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css"></link>
	<script src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
	<script src="js/cufon-yui.js"></script>
	<script src="fonts/aura_400.font.js"></script>
	<!--[if lt IE 7]>
	<script defer type="text/javascript" src="js/pngfix.js"></script>
	<![endif]--> 
</head>
<body>
	<div id="container">
	   	<div class="mainframe">
	    	<div id="largephoto">
			  	<div id="loader"></div>
			    <div id="largecaption">
					<div class="captionShine"></div>
					<div class="captionContent"></div>
				</div>
				<div id="largetrans"></div>
			</div>
	   	</div>
	   	<div class="thumbnails">
			<?php //スマホ版にスタイル変更
				if($_GET["type"]=="iphone" ||
					$_GET["type"]=="android" ||
					$_GET["type"]=="ganriser") :?>
	   			<style>
	   				#largephoto{
	   					width: 210px;
	   					margin-left: 50px;
	   				}
	   				#largetrans {
	   					width: 210px;
	   				}
	   				#largecaption{
	   					height: 50px;
	   					width: 210px;
	   					margin-top: 250px;
	   				}
	   				#largecaption .captionShine {
	   					width: 210px;
	   				}
	   				#container .thumbnails{
						position: absolute;
						left: 270px;
						width: 100px;
					}
	   			</style>
	   		<?php endif; ?>

			<?php for ($i=1; $i < 5; $i++): ?> 
		   		<!-- start entry-->
				<div class="thumbnailimage">
				    <div class="thumb_container"> 
				        <div class="large_thumb">
				    		<img src="../image/and_icon.png" width="50px" height="50px"
				    			class="large_thumb_image" alt="thumb" /> 
				            <img src=<?php echo $url.$i.".png"; ?>
				            	class="large_image" rel=<?php echo '"'.$mes.'"'; ?> />
				            <div class="large_thumb_border"></div>
				            <div class="large_thumb_shine"></div>
				        </div>
					</div>
			   	</div>
			   	<!--end entry-->
			<?php endfor;?>
	   	</div>
	</div>

<script>
  $(document).ready(function()
  {
   
	 /*Your ShineTime Welcome Image*/
	 var default_image = <?php echo "'".$url."1.png'"; ?>;
	 var default_caption = <?php echo "'".$mes."'"; ?>;
	 
	 /*Load The Default Image*/
	 loadPhoto(default_image, default_caption);
	 
	 
	 function loadPhoto($url, $caption)
	 {
	 
	 
	    /*Image pre-loader*/
	    showPreloader();
	    var img = new Image();
	    jQuery(img).load( function() 
		{
			jQuery(img).hide();
			hidePreloader();
		
        }).attr({ "src": $url });
	
	    $('#largephoto').css('background-image','url("' + $url + '")');
		$('#largephoto').data('caption', $caption);
	 }

	 
	 /* When a thumbnail is clicked*/
	 $('.thumb_container').click(function()
	 {
	     
		  var handler = $(this).find('.large_image');
		  var newsrc  = handler.attr('src');
		  var newcaption  = handler.attr('rel');
		  loadPhoto(newsrc, newcaption);
	 
	 });
	 
	 /*When the main photo is hovered over*/
	 $('#largephoto').hover(function()
	 {
	    
		var currentCaption  = ($(this).data('caption'));
		var largeCaption = $(this).find('#largecaption');
		
		largeCaption.stop();
		largeCaption.css('opacity','0.9');
		largeCaption.find('.captionContent').html(currentCaption);
		largeCaption.fadeIn()
	
	
		
		 largeCaption.find('.captionShine').stop();
         largeCaption.find('.captionShine').css("background-position","-550px 0"); 
         largeCaption.find('.captionShine').animate({backgroundPosition: '550px 0'},700);
		 
		 Cufon.replace('.captionContent');
		

	 },
	 
	 function()
	 {
	    var largeCaption = $(this).find('#largecaption');
		largeCaption.find('.captionContent').html('');
		largeCaption.fadeOut();
	 
	 });
	
	 
	 
     /* When a thumbnail is hovered over*/
	 $('.thumb_container').hover(function()
	 {  
         $(this).find(".large_thumb").stop().animate({marginLeft:-7, marginTop:-7},200);
		 $(this).find(".large_thumb_shine").stop();
         $(this).find(".large_thumb_shine").css("background-position","-99px 0"); 
         $(this).find(".large_thumb_shine").animate({backgroundPosition: '99px 0'},700);
			 
	 }, function()
	 {
	    $(this).find(".large_thumb").stop().animate({marginLeft:0, marginTop:0},200);
	 });
	 
	 function showPreloader()
	 {
	   $('#loader').css('background-image','url("images/interface/loader.gif")');
	 }
	 
	 function hidePreloader()
	 {
	   $('#loader').css('background-image','url("")');
	 }
   
  });
</script>
</body>
</html>