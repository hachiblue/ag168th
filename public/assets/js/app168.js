
if (typeof jQuery === 'undefined') 
{
	throw new Error('app168\'s JavaScript requires jQuery. jQuery must be included before app168\'s JavaScript.')
}

"use strict";

+ function() {

	var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function(obj) {
			return typeof obj;
		} : function(obj) {
			return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
		};

	var _createClass = function() {
		function defineProperties(target, props) {
			for (var i = 0; i < props.length; i++) {
				var descriptor = props[i];
				descriptor.enumerable = descriptor.enumerable || false;
				descriptor.configurable = true;
				if ("value" in descriptor) descriptor.writable = true;
				Object.defineProperty(target, descriptor.key, descriptor);
			}
		}
		return function(Constructor, protoProps, staticProps) {
			if (protoProps) defineProperties(Constructor.prototype, protoProps);
			if (staticProps) defineProperties(Constructor, staticProps);
			return Constructor;
		};
	}();

	function _possibleConstructorReturn(self, call) {
		if (!self) {
			throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
		}
		return call && (typeof call === "object" || typeof call === "function") ? call : self;
	}

	function _inherits(subClass, superClass) {
		if (typeof superClass !== "function" && superClass !== null) {
			throw new TypeError("Super expression must either be null or a function, not " + typeof superClass);
		}
		subClass.prototype = Object.create(superClass && superClass.prototype, {
			constructor: {
				value: subClass,
				enumerable: false,
				writable: true,
				configurable: true
			}
		});
		if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
	}

	function _classCallCheck(instance, Constructor) {
		if (!(instance instanceof Constructor)) {
			throw new TypeError("Cannot call a class as a function");
		}
	}


	/**
     * Start 168 Component
     */

	var gMap = function($) {


	}(jQuery);


}();

// Wrap everything in an IIFE
 + (function($, viewport) {
	
	function setViewport() 
	{
		// Executes only in XS breakpoint
		if( viewport.is('xs') ) {
			// ...
		}

		// Executes in SM, MD and LG breakpoints
		if( viewport.is('>=sm') ) {
			// ...
		}

		// Executes in XS and SM breakpoints
		if( viewport.is('<md') ) {
			l.removeClass("fixed");
		}

		// Executes in MD and LG breakpoints
		if( viewport.is('>md') ) {

			if( page == 'home' ) x() && g(l) ? m() : !x() && v() && S();
		}
	}

    // Execute only after document has fully loaded
    $(document).ready(function() {
        setViewport();
    });

    // Execute code each time window size changes
    $(window).resize(
        viewport.changed(function() {
			setViewport();
        })
    ); 

})(jQuery, ResponsiveBootstrapToolkit);

/**
 * Number.prototype.format(n, x)
 * 
 * @param integer n: length of decimal
 * @param integer x: length of sections
 */
Number.prototype.format = function(n, x) {
	var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
	return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

$(document).click(function (e) {
	e.stopPropagation();
	var container = $(".dropdown");
	if ( container.has(e.target).length === 0 ) 
	{
		$('[data-toggle="dropdown"]').parent().removeClass('open');
	}

	var $searchContainer = $("#searchArea");
	if(  $searchContainer.hasClass('in') && $searchContainer.has(e.target).length === 0 )
	{
		$searchContainer.collapse('hide');
	}
});


var r = {}
  , o = $(window)
  , a = $("#content")
  , l = $("#heroContainer")
  , u = $(".pg-footer")
  , c = $("#dotwhack")
  , h = "670";

var g = function t(e) {
	var n = $(e)
	  , i = u.offset().top - o.scrollTop()
	  , r = n.offset().top + n.height() - o.scrollTop();
	return i < r
}
  , v = function t() {
	var e = u.offset().top - o.scrollTop();
	return e > o.height()
}
  , m = function t() {
	x() && (l.removeClass("fixed"),
	l.css({
		top: u.offset().top - l.height()
	}),
	l.data("grabbed", !0),
	c.length && c.hide("fast"))
}
  , w = function t() {
	return n.setHeader("Sign up to get alerts when new homes hit the market.").login()
}
  , y = function t() {
	c.removeClass("hideVisually")
}
  , b = function t() {
	c.addClass("hideVisually")
}
  , k = function t() {
	i.isUserLoggedIn || (window.innerHeight < h ? b() : y())
}
  , x = function t() {
	return "undefined" == typeof l.data("grabbed") || l.data("grabbed") === !1
}
  , S = function t() {
	x() || (l.addClass("fixed"),
	l.css({
		top: 0
	}),
	l.data("grabbed", !1),
	c.length && c.show("fast"))
};

var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
	|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;

if(  isMobile ) l.removeClass("fixed");
u.removeClass("fixed"),
$(window).scroll(_.throttle(function() {

	if( page != 'contact' && page != 'board' && page != 'property' && page != 'project'  && page != 'list_your_property' && page != 'investment_property'  && page != 'investment_project'  && page != 'investment' )
	{
		if( ! isMobile ) x() && g(l) ? m() : !x() && v() && S();
	}

}, 25));

/**
 * FUNC
 */

function pricerange_todsp()
{
	var 
		txt_dsp = '',
		$target = $('#price-range-dsp'),
		$min = $('#price-min'), 
		$max = $('#price-max'),
		vmin = $('#price-min').val() || 'n/a', vmax = $('#price-max').val() || 'n/a';
	
	txt_dsp = price_toshort(vmin) + ' - ' + price_toshort(vmax);
	$target.text(txt_dsp);
}

function price_toshort( price )
{
	price = parseFloat((''+price).replace('/,/g', '')) || 0;
	
	if( price > 9999 && price < 1000000 )
	{
		price = ( price / 10000 ).toFixed(2) + 'k';
	}
	else if( price > 999999 )
	{
		price = ( price / 1000000 ).toFixed(2) + 'm';
	}
	else if( price <= 99999 )
	{
		price = price.format(2);
	}

	return (''+price).replace('.00', '');
}


var map, geocoder, marker;
var markers = []; // Create a marker array to hold your markers
function initialize() 
{
	var mapOptions = {
		zoom: 12,
		center: new google.maps.LatLng(13.781556, 100.541233)
	};
	
	map = new google.maps.Map(document.getElementById('map'), mapOptions);
	
	geocoder = new google.maps.Geocoder();

	setMarkers(params.items);
	
	// Bind event listener on button to reload markers
	//document.getElementById('reloadMarkers').addEventListener('click', reloadMarkers);
}

function setMarkers(locations) 
{
	var i, prop, myLatLng;

	for (i = 0; i < locations.length; i++) 
	{
		prop = locations[i];
		prop.seq = i;

		geocoder.geocode({
			'address': prop.project.address
		}, 
		geoCallback(prop) );
	}

	/*
	$('.mapMarker').hover(
		// when mouse in
		function() {
			var $this = $(this);

			when_hover($('[data-seq='+$this.data('mseq')+']'));
		}
		,
		// when mouse out
		when_offhover
	);*/
}

function geoCallback(prop)
{
	var price = 0;
	var geoCB = function(results, status) {
		
		if( null !== prop.sell_price && prop.requirement_id == 1 )
		{
			price = prop.sell_price;
		}
		else
		{
			price = prop.rent_price;
		}

		if (status == google.maps.GeocoderStatus.OK) 
		{
			marker = new RichMarker({
				position: results[0].geometry.location,
				map: map,
				address: prop.project.address,
				animation: google.maps.Animation.DROP,
				title: prop.name,
				content: '<a href="#" class=""><div class="gmap-marker" data-marker="'+prop.seq+'">'+ (price_toshort(price) != 0 ? price_toshort(price) : 'n/a')+'</div></a>',
				zIndex: 1,
				shadow: 'none'
			});

			// Push marker to markers array
			markers.push(marker);					
		}
		else 
		{ 
			myLatLng = new google.maps.LatLng(prop.project.location_lat, prop.project.location_lng);
			marker = new RichMarker({
				position: myLatLng,
				map: map,
				animation: google.maps.Animation.DROP,
				title: prop.name,
				content: '<a href="#" class=""><div class="gmap-marker" data-marker="'+prop.seq+'">'+ price_toshort(price) || 'n/a'+'</div></a>',
				zIndex: 1,
				shadow: 'none'
			});

			// Push marker to markers array
			markers.push(marker);	
		}
		
		marker.addListener('mouseover', function() {
          when_hover(prop.seq);
        });

		marker.addListener('mouseout', function() {
          when_offhover(prop.seq);
        });
		
		/*
		$('.gmap-marker').unbind().hover(
			// when mouse in
			when_hover
		,
			// when mouse out
			when_offhover
		);*/
	};

	return geoCB;
}

var infowindow = null;
function when_hover(e)
{
	if( e.type != 'mouseenter' )
	{
		var $this = $('.cardContainer[data-seq='+e+']');
	}
	else
	{
		var $this = $(this);
	}

	if (infowindow) 
	{
		infowindow.close();
	}

	if( $this.data('marker') != undefined )
	{
		//$this = $('.cardContainer[data-seq='+$this.data('marker')+']');
	}

	var myOptions = {
		content: '<div class="gmap-infobox" style="1px solid #bbb">' + $this.html().replace('pd-bottom', 'pd-bottom hidden') + '</div>'
		,maxWidth: 0
		,pixelOffset: new google.maps.Size(-140, 0)
		,zIndex: null
		,boxStyle: { 
			width: "100%"
		}
		,closeBoxURL : ''
		,closeBoxMargin: "10px 2px 2px 2px"
		,isHidden: false
		,infoBoxClearance: new google.maps.Size(1, 1)
		,enableEventPropagation: false
	};

	infowindow = new InfoBox(myOptions);
	
	var seq = $this.data('seq');

	if( undefined !== markers[ +seq ] )
	{
		infowindow.open(map, markers[ +seq ]);
	}
}

function when_offhover()
{
	if (infowindow) 
	{
		infowindow.close();
	}
}	


$(document).on("ready", function () {
	
	new autoComplete({
		selector: '#auto-searchby',
		minChars: 2,
		source: function(term, response) {
			$.getJSON('/list', { q: term }, function(data) { response(data); });
		},
		renderItem: function (item, search) {
			search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
			var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
			return '<div class="autocomplete-suggestion" data-project_id="'+item[1]+'" data-val="'+item[0]+'">'+item[0].replace(re, "<b>$1</b>")+'</div>';
		},
		onSelect: function(e, term, item) {
			$('input[name=project_id]').val( $(item).data('project_id') );
		}
	});

	// to clear search value
	$('#auto-searchby').keyup(function() {
		$('input[name=project_id]').val('');
	});

	$('.cardContainer').hover(
		// when mouse in
		when_hover
		,
		// when mouse out
		when_offhover
	);


	$(".dropdown-menu").on('click', 'li a', function () {
		var 
			$this = $(this),
			$parent = $this.parents('.btn-group');

		$parent.find('.dsp_drop_txt').text( $this.text() );
		$parent.find('input[type=hidden]').val( $this.attr('value') );
	});

	$('[data-toggle="offcanvas"]').click(function () {
		$('.row-offcanvas').toggleClass('active');

		$('.a_container').click(function () {
			$('.row-offcanvas').removeClass('active');
			$('#homepageContainer').off();
		});
	});

	$('.property_list').hover(
		function() {
			$(this).addClass('pd-active');
		},
		function() {
			$(this).removeClass('pd-active');
		}
	);

	$('.project_list').hover(
		function() {
			$(this).addClass('pj-active');
		},
		function() {
			$(this).removeClass('pj-active');
		}
	);

	$('.opt-fav').click(function () {
		$(this).toggleClass('on');
	});

	$('.add_to_fav').click(function () {
		$(this).find('.opt-fav').toggleClass('on');
	});

	$('.dropdown.keep-open').on( {
		"shown.bs.dropdown": function() { this.closable = true; },
		"click":             function(e) {  
			if( $(e.target).hasClass('dropdown-toggle') )
			{
				this.closable = true;  
			}
			else
			{
				this.closable = false;  
			}
		},
		"hide.bs.dropdown":  function() {  return this.closable; }
	});

	$('.grid').masonry({
		itemSelector: '.grid-item',
		columnWidth: '.bd-card',
		//gutter: '.gutter-sizer',
		originLeft: false,
		percentPosition: true
	});

	$('.pd-top').click(function () {
		var $this = $(this);
		window.open('property/'+$this.data('prop'), '_self');
	});

	$('.pj-top').click(function () {
		var $this = $(this);
		window.open('project/'+$this.data('prop'), '_self');
	});
	
	$('#list-price-min li').click(function () {
		var 
			$this = $(this),
			$target = $('#price-min');

		$target.val( $this.data('price') );
		pricerange_todsp();
	});

	$('#list-price-max li').click(function () {
		var 
			$this = $(this),
			$target = $('#price-max');

		$target.val( $this.data('price') );
		pricerange_todsp();
	});

	$('[data-href]').click(function () {
		var $this = $(this);
		window.open($this.data('href'), '_self');
	});
	
	if( $('div[name=tab-project]').length )
	{
		$('div[name=tab-project]').click(function () {
			var 
				$this = $(this),
				target = $this.data('tab');
			
			$('div[name=tab-project]').removeClass('active');
			$this.addClass('active');
			$('.gall, .map').hide();
			if( target == 'map' )
			{
				$('#area-gall').hide();
				$('#area-map').show();
				initMap();
			}
			else
			{
				$('#area-map').hide();
				$('#area-gall').show();
			}
		});
	}

	if( $('#map').length && ! isMobile )
	{
		initialize();
	}
		
	if( $('.swiper-prop-container').length )
	{
		var swiper = new Swiper('.swiper-prop-container', {
			pagination: '.swiper-pagination',
			slidesPerView: 1,
			paginationClickable: true,
			spaceBetween: 0,
			freeMode: false,
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',
		});
	}

	if( isMobile ) 
	{
		var swiper = new Swiper('.swiper-container', {
			pagination: '.swiper-pagination',
			slidesPerView: 2,
			paginationClickable: true,
			spaceBetween: 0,
			freeMode: true
		});

		var swiper = new Swiper('.swiper-investment-container', {
			slidesPerView: 'auto',
			paginationClickable: true,
			spaceBetween: 10,
			freeMode: false
		});
	}

});