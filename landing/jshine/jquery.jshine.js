/*!
 * jShine - Shine effect with jQuery
 *   http://soofit.blogspot.com/
 *
 * Copyright (c) 2011 Michał Wereda (http://soofit.blogspot.com/)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Built on top of the jQuery library
 *   http://jquery.com
 *
 */
(function( $ ){

  $.fn.jshine = function(options) {
	//spr czy this jest tablicą
	var settings = {
	'overElement'		:'myimg',
	'frequency'         : 4000, //間隔
	'duration'			: 500, //スピード
	'easing'			: 'linear',
	'effImgSrc'			: 'aa4.png',
	'times'				:0,
	'immediately'		:true
	};	
	// If options exist, lets merge them with our default settings
	if ( options ) { 
		$.extend( settings, options );
	}
	this.data('jshine',settings);
	var oImage = new Image();
	function run(myimg,myjquery){
    	myjquery.data('jshine.effImgWidth',myimg.width);// width of loaded image
		myjquery.data('jshine.overElementWidth',$('#'+settings.overElement).outerWidth());
		myjquery.data('jshine.overElementHeight',$('#'+settings.overElement).outerHeight());
		myjquery.each(function(i) {
			$(this).attr('style',$(this).attr('style')+';position:absolute;filter:alpha(opacity=60);-moz-opacity:0.6;opacity:0.6;width:'+$(this).data('jshine.overElementWidth')+'px; height:'+$(this).data('jshine.overElementHeight')+'px;background:transparent url('+$(this).data('jshine').effImgSrc+') -'+$(this).data('jshine.effImgWidth')+'px top no-repeat; z-index:7; top:1px; ');
	   });//each
		function animate_wrap(el){
			el.each(function(i) {
				el.animate(
					{'background-position':[parseInt((el.width()))+'px top', el.data('jshine').easing ]}, 
					settings.duration, 
					function() 
					{
						el.css({'background-position':'-'+el.data('jshine.effImgWidth')+'px top'});
					}
				);//animate
			});//each
		}//animate_wrap
		if(settings.immediately==true){
			animate_wrap(myjquery);
			if(settings.times==1){return;}
			if(settings.times > 1){ settings.limit--;}
		}
		myjquery.everyTime(myjquery.data('jshine').frequency,'timer3yv'+myjquery.data('jshine').overElement, function(i) {
			animate_wrap($(this));
		},settings.times);//everyT
	}//run

	$(oImage).data('mysrc',this);
	$(oImage).load(function () {run(this,$(this).data('mysrc'));})
	oImage.src = this.data('jshine').effImgSrc;

  };//shine
})( jQuery );

