<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
	<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+("devicePixelRatio" in window ? ","+devicePixelRatio : ",1")+'; path=/';</script>
	<meta charset="utf-8" />

	<!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Hibou</title>

	<!-- Included CSS Files -->
	<link rel="stylesheet" href="stylesheets/screen.css" />

	<!--script src="javascripts/vendor/custom.modernizr.js" type="text/javascript"></script-->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script src="./js/modernizr.js"></script>
	<script src="./js/quo.debug.js"></script>
	<script src="js/imgLiquid-min.js"></script>

</head>
<body>

	<header>	
		<div class="hello">
			<h1>Hibou</h1>
		</div>
		<nav>
			<ul>
				<li><span>First</span>
					<ul>
						<li>Sub Menu #1</li>
						<li>Sub Menu #2</li>
						<li>Sub Menu #3</li>
						<li>Sub Menu #4</li>
					</ul>
				</li>
				<li><span>Second</span>
					<ul>
						<li>Ich bin eins</li>
						<li>und ich zwei</li>
						<li>ich drei</li>
						<li>und ich sowas von #4</li>
					</ul>
				</li>
				<li><span>Third</span>
				<ul>
						<li>SUBSUBSUB</li>
						<li>UbsUbsUbs</li>
						<li>ubSubSubu</li>
						<li>buSbuSbuS</li>
					</ul>
				</li>
				<li><span>Fourth</span><ul>
						<li>Sub Menu4 #1</li>
						<li>Sub Menu4 #2</li>
						<li>Sub Menu4 #3</li>
						<li>Sub Menu4 #4</li>
					</ul>
				</li>
			</ul>
		</nav>
	</header>
	<div class="arrow-up" id="cssArrowUp"></div>

	<article>
		<h2></h2>
		<div class="liquidImg imgLiquid">
			<img src="img/nick-gentry-floppy-disk-art-5.png" alt="" />
		</div>
	</article>
	<article>
		<h2></h2>
		<div class="liquidImg imgLiquid">
			<img src="img/lemon.jpg" alt="" />
		</div>
	</article>
	<article>
		<h2></h2>
		<div class="liquidImg imgLiquid">
			<img src="img/gifrocket.jpg" alt="" />
		</div>
	</article>
	<article>
		<h2></h2>
		<div class="liquidImg imgLiquid">
			<img src="img/gifrocket.jpg" alt="" />
		</div>
	</article>
	<article>
		<h2></h2>
		<div class="liquidImg imgLiquid">
			<img src="img/nick-gentry-floppy-disk-art-5.png" alt="" />
		</div>
	</article>
	<article>
		<h2></h2>
		<div class="liquidImg imgLiquid">
			<img src="img/lemon.jpg" alt="" />
		</div>
	</article>
	
	
	<footer>
		<div class="search">
			<div class="icon-search"></div>
		</div>
		<div class="copy"><span>&copy; <a target="_blank" href="https://github.com/alpipego/hibou">hibou</a> <a target="_blank" href="http://alpipego.com/">alpipego</a></span></div>
	</footer>

	<div class="hibou-container" id="hibouContainer"></div>


	<script src="./js/throttle-debounce.js"></script>
	<script>
		hBlack 		= '#222';
		hRed 		= '#D84442';
		hOrange 	= '#D4AA58';
		hYellow 	= '#DEDB62';
		hLightblue 	= '#54C0D6';
		hBlue 		= '#45449E';
		hGreen 		= '#7cc7a7'

		function specs() {
			//defining global vars
			horiz = window.innerWidth;
			vert  = window.innerHeight;

			if( horiz/vert >= 1 ) {
				orient = 'landscape';
			} else if( vert/horiz > 1 ) {
				orient = 'portrait';
			}

			articles = $('article').length;

			//different columns depending on screen size
			if(horiz < 321) {
				window.cols = 2;
				boxes = (articles*4)+16; 
				rows = boxes/cols;
			} else if(horiz < 641) {
				window.cols = 4;
				boxes = (articles*4)+16; 
				rows = boxes/cols;	
			} else if(horiz >= 641) {
				window.cols = 8;
				boxes = (articles*4)+16;
				if(boxes%8 != 0) {
					boxes = boxes+4;
				} 
				rows = boxes/cols;
				if(articles%2 == 0) {
					if(rows%2 != 0) {
						boxes = boxes+8;
					}
				}
				rows = boxes/cols;
			}			
			console.log('Articles: '+articles+' Boxes: '+boxes+' Rows: '+rows);
			//margins and width of columns
			aFifth 		= Math.floor(horiz*0.04); 
			horizM 		= horiz-aFifth*2;
			colWidth 	= Math.floor(horizM/cols);
			rest 		= horiz-(colWidth*cols+2*aFifth);
		}
		specs();
		//this creates (or recalculates) the rows and columns
		function calculateColumns(){
			$('.hibou-container').css('margin', aFifth);

			for(var i = 0; i < rows; ++i) {
			    $('#hibouContainer').append($('<div class="hibou-row"></div>'));
			}
			
			$('.hibou-row').each(function(){
				for(var i = 0; i < cols; ++i) {
					$(this).append('<div class="hibou"></div>');
				}
			});

			$('.hibou').css({'height': colWidth, 'width': colWidth });
			
		};

		// adds the logo
		function addTheLogo() {
			if(cols === 4) {
				var logo2r1c = cols*2;
				var logo2r2c = cols*2+1;
			} else {
				var logo2r1c = cols;
				var logo2r2c = cols+1;
			}
			var topLeft = '.hibou:eq(0),.hibou:eq(1),.hibou:eq('+logo2r1c+'),.hibou:eq('+logo2r2c+')';
			$(topLeft).css('background-color', hGreen);
			$('.hello').css({'height': colWidth*2, 'width': colWidth*2, 'left': aFifth});

			var h1 = $('.hello h1').outerWidth(true); 
			var hello = $('.hello').innerWidth();
			$('.hello h1').css('font-size', hello/50 + 'em');
			
			var h1w = $('.hello h1').outerWidth(true);
			var h1h = $('.hello h1').outerHeight(true);
			var helloh = $('.hello').innerHeight();

			$('.hello h1').css({
				'left':(hello-h1w)/2,
				'top':(helloh-h1h)/2
			});
		};

		//adds the footer
		function addTheFooter() {
			var footerlrlc = boxes-1;
			var footerlr2lc = boxes-2;
			var bottomRight = '.hibou:eq('+footerlr2lc+'),.hibou:eq('+footerlrlc+')';
			$('footer').css({'right': aFifth+rest, 'bottom': 0});
			if(cols === 2){
				var footerlr3lc = boxes-3;
				var footerlr4lc = boxes-4;
				$('footer').css({'height': colWidth*2, 'width': colWidth*2});
			} else if( cols === 4 ) {
				if(articles%2 != 0 && rows%2 != 0) {
					var footerlr3lc = boxes-5;
					var footerlr4lc = boxes-6;
					$('footer').css({'width':colWidth*2, 'height':colWidth*2});
				} else {
					var footerlr3lc = boxes-3;
					var footerlr4lc = boxes-4;
					$('footer').css({'width':colWidth*4, 'height':colWidth});
				}
			} else if(cols === 8) {
				if(articles%4 == 0) {
					var footerlr3lc = boxes-9;
					var footerlr4lc = boxes-10;
					$('footer').css({'width':colWidth*2, 'height':colWidth*2});
				} else {
					var footerlr3lc = boxes-3;
					var footerlr4lc = boxes-4;
					$('footer').css({'width':colWidth*4, 'height':colWidth});
				}
			}
			var bottomRight = '.hibou:eq('+footerlrlc+'),.hibou:eq('+footerlr2lc+'),.hibou:eq('+footerlr3lc+'),.hibou:eq('+footerlr4lc+')';
			$(bottomRight).css('background-color', hBlack);
			
			var footerText = $('footer .copy').text();
			var footerHtml = $('footer .copy').html();

			var footerArray = footerText.split(' ');
			for( i=0; i<footerArray.length; i++) {
				console.log(footerArray[i]);
				var length = footerArray[i].length;
			}
			console.log(footerArray);

			$('footer .copy').css({'position':'absolute', 'height': colWidth, 'width': colWidth, 'right':0, 'bottom':0, 'display':'inline-block','text-align':'center'});
			$('footer .search').css({'position':'relative', 'height': colWidth, 'width': colWidth*2, 'left': 0, 'top': 0, 'display':'inline-block'});	
		}

		//adding the navigation
		function addTheNavigation() {
			//redundancy for the sake of readability
			//case1 === 4
			var nav1r3c = 2;
			var nav1r4c = 3;
			var nav2r3c = cols*2+2;
			var nav2r4c = cols*2+3;
			//case2 > 4
			var nav1r3c = 2;
			var nav1r4c = 3;
			var nav1r5c = 4;
			var nav1r6c = 5;
			//case3 < 4
			var nav3r1c = nav1r5c;
			var nav3r2c = nav1r6c;
			var nav4r1c = 10;
			var nav4r2c = 11;

			if(cols === 4) {
				var nav = '.hibou:eq(' + nav1r3c + '),.hibou:eq(' + nav1r4c + '),.hibou:eq(' + nav2r3c + '),.hibou:eq(' + nav2r4c + ')';
				$('nav>ul>li:first-child').css({'left': colWidth*2+aFifth, 'top': 0});
				$('nav>ul>li:nth-child(2)').css({'left': colWidth*3+aFifth, 'top': 0});
				$('nav>ul>li:nth-child(3)').css({'left': colWidth*2+aFifth, 'top': colWidth*1});
				$('nav>ul>li:nth-child(4)').css({'left': colWidth*3+aFifth, 'top': colWidth*1});
			} else if(cols > 4) {	
				var nav = '.hibou:eq(' + nav1r3c + '),.hibou:eq(' + nav1r4c + '),.hibou:eq(' + nav1r5c + '),.hibou:eq(' + nav1r6c + ')';
				$('nav>ul>li:first-child').css({'left': colWidth*2+aFifth, 'top': 0});
				$('nav>ul>li:nth-child(2)').css({'left': colWidth*3+aFifth, 'top': 0});
				$('nav>ul>li:nth-child(3)').css({'left': colWidth*4+aFifth, 'top': 0});
				$('nav>ul>li:nth-child(4)').css({'left': colWidth*5+aFifth, 'top': 0});
			} else if(cols < 4) {
				var nav = '.hibou:eq(' + nav3r1c + '),.hibou:eq(' + nav3r2c + '),.hibou:eq(' + nav4r1c + '),.hibou:eq(' + nav4r2c + ')';
				$('nav>ul>li:first-child').css({'left': aFifth, 'top': colWidth*2});
				$('nav>ul>li:nth-child(2)').css({'left': colWidth+aFifth, 'top': colWidth*2});
				$('nav>ul>li:nth-child(3)').css({'left': aFifth, 'top': colWidth*3});
				$('nav>ul>li:nth-child(4)').css({'left': colWidth+aFifth, 'top': colWidth*3});
			}
			$('nav ul li').css({'height': colWidth, 'width': colWidth});

			var li = $('nav>ul>li').innerWidth();
			var fz = [];
			$('nav>ul>li span').each(function(){
				var span = $(this).outerWidth(true); 
				fz.push(span);
			});
			fz = fz.sort();
			fzLen = fz.length - 1;
			fz = fz[fzLen];
			$('nav>ul>li>span').css('font-size', li/(fz*1.5) + 'em');	

			var li1spanW = $('nav>ul>li:first-child span').outerWidth(true);
			var li2spanW = $('nav>ul>li:nth-child(2) span').outerWidth(true);
			var li3spanW = $('nav>ul>li:nth-child(3) span').outerWidth(true);
			var li4spanW = $('nav>ul>li:nth-child(4) span').outerWidth(true);
			var lispanH = $('nav>ul>li:first-child span').outerHeight(true);

			$('nav>ul>li span').css({'top':(colWidth-lispanH)/2,'position':'relative'});
			$('nav>ul>li:first-child span').css('left', (colWidth-li1spanW)/2);
			$('nav>ul>li:nth-child(2) span').css('left', (colWidth-li2spanW)/2);
			$('nav>ul>li:nth-child(3) span').css('left', (colWidth-li3spanW)/2);
			$('nav>ul>li:nth-child(4) span').css('left', (colWidth-li4spanW)/2);

			$(nav).css('background-color', hRed);
		}

		function addTheSubNav() {
			if(cols === 2) {
				var subnav4r1c = cols+4;
				var subnav4r2c = cols+5;
				var subnav5r1c = cols+6;
				var subnav5r2c = cols+7;

				subnav = '.hibou:eq(' + subnav4r1c + '),.hibou:eq(' + subnav4r2c + '),.hibou:eq(' + subnav5r1c + '),.hibou:eq(' + subnav5r2c + ')';
				$(subnav).hide();
			} else if(cols === 4) {
				var subnav2r1c = cols;
				var subnav2r2c = cols+1;
				var subnav2r3c = cols+2;
				var subnav2r4c = cols+3;

				subnav = '.hibou:eq(' + subnav2r1c + '),.hibou:eq(' + subnav2r2c + '),.hibou:eq(' + subnav2r3c + '),.hibou:eq(' + subnav2r4c + ')';
				$(subnav).hide();
			} else if(cols === 8) {
				subnav = '';
			} 
			$(subnav).css('display', 'none');
		}
		function enterTheNavigation() {
			if (cols === 8) {
				$(subnav).fadeIn('fast');
				for(var i = 1; i < 5; ++i) {
					$('nav>ul>li:nth-child('+liIndex+')>ul>li:nth-child('+i+')').css({'top': colWidth, 'left': colWidth*(i-liIndex)});
				}
				$('#cssArrowUp').css({'display':'block','top':colWidth-10,'left':(colWidth*2)+(colWidth*(liIndex-1))+(colWidth/2)+aFifth-10});
				$('nav>ul>li:nth-child('+liIndex+')>ul').css('display', 'block');
			}
		}
		function exitTheNavigation() {
			$('#cssArrowUp').css('display','none');
			$(subnav).fadeOut(0);
			$('nav>ul>li:nth-child('+liIndex+')>ul').css('display', 'none');
		};
		function useTheNavigation() {
			$('nav>ul>li').on('mouseover', function(){
				liIndex = $('nav>ul>li').index(this)+1;
				enterTheNavigation();
			});
			$('nav>ul>li').on('mouseleave', function(){
				exitTheNavigation();
			});
		}

		//resize Images
		function resizeImg() {
			setTimeout(function(){
				$('.liquidImg').imgLiquid({
					fill: true,
			        horizontalAlign: "center",
			        verticalAlign: "top"
			    });
			}, 300);
		}

		function addImageSize() {
			//zero counter --> odd is actually even
			$('article:odd .liquidImg').css({'width':(colWidth*2), 'height':colWidth});
			$('article:even .liquidImg').css({'width':(colWidth*2), 'height':colWidth});
		}

		function isEven(value) {
			return (value%2 == 0);
		}

		function positionArticle() {
			if(cols === 2) {
				var offset = 2;
				for(nth = 1; nth <= articles; nth++) {
					offset++;
					$('article:nth-of-type('+nth+')').css({'left': aFifth, 'top': colWidth*(nth+offset)});					
				}
			} else if(cols === 4) {
				for(nth = 1; nth <= articles; nth++) {
					if(isEven(nth)){ 
						var colOff = 2;
					} else { 
						var colOff = 0;
						var rowOff = nth+1;
					};
					$('article:nth-of-type('+nth+')').css({'left': aFifth+(colWidth*(colOff)), 'top': colWidth*rowOff});
				}
			} else if(cols === 8) {
				offsetCounter = 0;
				for(nth = 2; nth <= articles; nth++) {
					if((nth+2)%4 == 0){
						offsetCounter = offsetCounter+2;
						var topOffset = offsetCounter;
						var leftOffset = nth+nth;
					}
					$('article:nth-of-type('+nth+')').css({'left': aFifth+(colWidth*((nth-leftOffset)+nth)), 'top': colWidth*topOffset});
				}
				$('article:first-of-type').css({'left': aFifth+colWidth*6, 'top': 0});
			}
		}

		//find the "end" of a resize event
		$(window).resize(function() {
		    if(this.resizeTO) clearTimeout(this.resizeTO);
		    this.resizeTO = setTimeout(function() {
		        $(this).trigger('resizeEnd');
		    }, 500);
		});

		//actual execution
		$(document).ready(function(){
			// specs();
			calculateColumns();
			addTheLogo();
			$('.hibou-row').css('min-width', horiz);
			addTheFooter();
			addTheNavigation();
			addTheSubNav();
			useTheNavigation();
			addImageSize();
			resizeImg();
			positionArticle();

			$(window).resize(function(){
				$('body').fadeOut('fast');
				$('nav>ul>li>span').css('font-size', '1em');
				$('.hibou-row').not($('.row-0')).each(function(){
					$(this).remove();
				});
			});
			
			$(window).bind('resizeEnd', function() {
				specs();
				calculateColumns();
				$('body').fadeIn('fast');
				$('.hibou-row').css('min-width', horiz);
				addTheLogo();
				addTheFooter();
				addTheNavigation();
				addTheSubNav();
				useTheNavigation();
				addImageSize();
				resizeImg();
				positionArticle();
			});

			//PLAYGROUND
			
			
		}); //document.ready	
	</script>
</body>
</html>