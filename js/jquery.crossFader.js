/*
 *	jQuery crossFader 0.4 - jQuery plugin
 *	Plugin developed by: Takayoshi Shiraishi
 *	http://lab.komadoya.com/
 *
 *	2013/09/24 - ver 0.4 (Add manual-start mode)
 *	2012/07/04 - ver 0.3 (Add non-clickStep mode)
 *	2011/03/17 - ver 0.2 (Add non-loop mode)
 *	2011/02/14 - ver 0.1
 *	 
 *	Based from Simple jQuery Slideshow Script (http://jonraasch.com/blog/a-simple-jquery-slideshow)
 *	Released by Jon Raasch (jonraasch.com) under FreeBSD license: free to use or modify, not responsible for anything, etc.)
 * 
 *	Released under the MIT license:
 *	http://www.opensource.org/licenses/mit-license.php
/* -------------------------------------------------------------------- */

(function($){

	$.fn.crossFader = function(options){

		var options = $.extend({
			timer: 6000,
			speed: 1500,
			changeSpd: 800,
			clickStep: true,
			autoStart: true,
			random: false,
			loop: true,
			// グローバルな .active（Bootstrap ナビ等）と衝突しないよう専用クラス
			activeClass: 'cf-slide-active',
			lastActiveClass: 'cf-slide-last'
		}, options);
		
		return this.each(function(){
		
			// prepare elements
			var $unit = $(this);
			var $slide = $('img', $unit);
			var timerID;
			var links = $unit.children('a').length;
			var clicked = false;
			var $startUnit = $('.startBtn', $unit);
			var $startBtn = $('a', $startUnit);
			var slides = $slide.length;
			var switches = 1;

			// init
			function init(){
				slideSet();
				if(options.autoStart){
					fadeStart();
				} else {
					autoJudge();
				}
				
				//judge for autoStart
				function autoJudge(){
					$startBtn.click(function(){
						options.autoStart = true;
						$startUnit.fadeOut();
						fadeStart();
					});
				}

			//fadeStart
			function fadeStart(){
					if (slides >= 2) {
						timerID = setInterval(function(){
							slideSwitch(options.speed);
						}, options.timer);
					}
					$slide.bind('click', slideClick);
				}
			}

			// set first image
			function slideSet(){
				$slide.removeClass(options.activeClass);
				if (!slides) {
					return;
				}
				// set first image in random order, if random is true
				var $start = (options.random) ? Math.floor(Math.random() * $slide.length) : 0;
				$($slide[$start]).addClass(options.activeClass);
			}
			
			// slideSwitch
			function slideSwitch(sp){
				if (slides < 2) {
					return;
				}
				
				//prevent from continuous click
				$slide.unbind('click');
				
				var $active = $unit.find('img.' + options.activeClass);
				
				//for loop
				if(options.loop || switches < slides || clicked) {
					if ($active.length == 0) {
						$active = $slide.last();
					}
					switches++;
					clicked = false;
				} else {
					clearInterval(timerID);
					$slide.bind('click', slideClick);
					return;
				}
				
				// $slide 順で次へ（先頭・末尾の img が :first-child でない DOM でも確実に動く）
				var $next;
				if (links) {
					$next = ($active.parent("a").next().length) ? $active.parent("a").next().find('img') : $slide.first();
				} else {
					var cur = $slide.index($active);
					if (cur < 0) {
						cur = 0;
					}
					$next = $slide.eq((cur + 1) % slides);
				}
				
				//set z-index lower than visible slide
				$active.addClass(options.lastActiveClass);
			
				//transition
				$next
					.css({opacity: 0.0})
					.addClass(options.activeClass)
					.animate({opacity: 1.0}, sp, function(){
						$active.removeClass(options.activeClass + ' ' + options.lastActiveClass);
						$slide.bind('click', slideClick);
					});
			}
			
			// slideClick Action
			function slideClick(){
				if(options.clickStep){
					clearInterval(timerID);
					clicked = true;
					slideSwitch(options.changeSpd);
					timerID = setInterval(function(){
						slideSwitch(options.speed);
					}, options.timer);
				}
			}
			
			// execute
			init();

		});
	};
})(jQuery);

