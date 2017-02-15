
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

	if( page != 'contact' && page != 'board' && page != 'property' && page != 'project'  
		&& page != 'list_your_property' && page != 'investment_property'  
		&& page != 'investment_project'  && page != 'investment' && page != 'registeryourproperty' 
		&& page != 'member' && page != 'profile' && page != 'post_enquiry' && page != 'post_property'
		&& page != 'editorial' && page != 'article' )
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
	var center = getMapCenter();

	var mapOptions = {
		zoom: 15,
		center: new google.maps.LatLng(center[0], center[1])
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
			'address': ('undefined' != typeof prop.project) ? prop.project.address : prop.address
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
		
		if( null !== prop.sell_price )
		{
			price = prop.sell_price;
		}
		else
		{
			price = prop.rent_price;
		}
		
		if( 'undefined' != typeof prop.project )
		{
			var content = '<a href="#" class=""><div class="gmap-marker" data-marker="'+prop.seq+'">'+ (price_toshort(price) != 0 ? price_toshort(price) : 'n/a')+'</div></a>';
		}
		else
		{
			var content = '<a href="#" class=""><div class="gmap-marker2 map_project" data-marker="'+prop.seq+'">'+ prop.av_unit+'</div></a>';
		}

		if (status == google.maps.GeocoderStatus.OK) 
		{
			marker = new RichMarker({
				position: results[0].geometry.location,
				map: map,
				address: ('undefined' != typeof prop.project) ? prop.project.address : prop.address,
				animation: google.maps.Animation.DROP,
				title: prop.name,
				content: content,
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
				content: content,
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

function getMapCenter()
{
	if( 'undefined' !== typeof params.items[0] )
	{
		switch( params.items[0].requirement_id )
		{
			case 1 :	// bts Ekkamai
				return [ 13.719436, 100.585280 ];
				break;
			case 2 :	// bts Asoke
				return [ 13.736955, 100.560339 ];
				break;
			default : return [ 13.781556, 100.541233 ];
		}
	}
	else
	{
		return [ 13.781556, 100.541233 ];
	}
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

	if( $this.hasClass('map_project') )
	{
		var content =  '<div class="gmap-infobox2" style="1px solid #bbb"><div class="col-xs-3 no_padd"><img src="'+$this.data('pic')+'" class="img-responsive"></div><div class="col-xs-9">'+$this.data('name')+'</div><div class="clearfix"></div></div>';
	}
	else
	{
		var content =  '<div class="gmap-infobox" style="1px solid #bbb">' + $this.html().replace('pd-bottom', 'pd-bottom hidden') + '</div>';
	}

	var myOptions = {
		content: content
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

function chkfav()
{
	var $self = $(this);

	$.post('/member/chk', { prop : $self.data('prop'), status : ! $self.hasClass('on')}, function(msg) {
		if( msg == '1' )
		{
			$self.toggleClass('on');
		}
		else
		{
			if( confirm('Please login first') )
			{
				window.location = '/member';
			}
		}
	});
}

function chkcomp()
{
	var $self = $(this);

	$.post('/member/comp', { prop : $self.data('prop'), status : ! $self.hasClass('on')}, function(msg) {
		if( msg == '1' )
		{
			$self.toggleClass('on');
			$("#compare-panel").show();
			$("#btn-go-compare").prop("disabled", false).addClass("btn-grn");
		}
		else if( msg == '3' )
		{
			$self.toggleClass('on');
			$("#compare-panel").hide();
		}
		else
		{
			if( msg == '0' && confirm('Please login first')  )
			{
				window.location = '/member';
			}
			else
			{
				alert('max compare items is 4');
			}
		}
	});
}

function chkfav_list()
{
	var $self = $(this);

	$.post('/member/chklist', { }, function(msg) {
		if( msg.length )
		{
			var shtml = '';
			$(msg).each(function(i, ob) {
				shtml += '<div class="fv-item col-xs-12"><div class="col-xs-8 col-md-6">'+ob.project_name+'</div><div class="opt-fav col-xs-2 col-md-6" data-prop="'+ob.id+'"></div><div class="col-xs-2 col-md-3"><a href="/property/'+ob.id+'">link</a></div></div>';
			});

			$('#fv_list').html(shtml);
			
			if( typeof _fav != 'undefined' )
			{
				$('.opt-fav').each(function(i, el) {
					if( typeof $(el).data('prop') != 'undefined' && _fav.indexOf( ''+$(el).data('prop') ) != -1 )
					{
						$(el).addClass('on');
					}
				});

				$('.opt-fav').unbind().click(function () {
	
					chkfav.call(this);	
					
				});
			}

			$('#fav_list_model').modal('show');
		}
		else
		{
			if( confirm('Please login first') )
			{
				window.location = '/member';
			}
		}
	}, 'json');
}

function chkcompare_list()
{
	var $self = $(this);
	
	/*
	$.post('/member/complist', { }, function(msg) {
		if( msg.length )
		{
			var shtml = '';
			$(msg).each(function(i, ob) {
				shtml += '<div class="fv-item col-xs-12"><div class="col-xs-8 col-md-6">'+ob.project_name+'</div><div class="opt-fav col-xs-2 col-md-6" data-prop="'+ob.id+'"></div><div class="col-xs-2 col-md-3"><a href="/property/'+ob.id+'">link</a></div></div>';
			});

			$('#fv_list').html(shtml);
			
			if( typeof _fav != 'undefined' )
			{
				$('.opt-fav').each(function(i, el) {
					if( typeof $(el).data('prop') != 'undefined' && _fav.indexOf( ''+$(el).data('prop') ) != -1 )
					{
						$(el).addClass('on');
					}
				});

				$('.opt-fav').unbind().click(function () {
	
					chkfav.call(this);	
					
				});
			}

			$('#fav_list_model').modal('show');
		}
		else
		{
			if( confirm('Please login first') )
			{
				window.location = '/member';
			}
		}
	}, 'json');
	*/
}

function compare_modal()
{

}

function setComparePanel()
{
	var i, b=1, tmp = $("#tmp_compare_sm_box"), html; 

	$(".com-content").each(function(){
		$(this).html("<div class='emp-compare'>Compare</div>").removeClass("active");
	});

	/*
	for( i in compare_box )
	{
		html = tmp.html();
		html = html.replace("#name#", compare_box[i].name + " " + compare_box[i].project.name );	
		html = html.replace("#price#", $("#price_"+compare_box[i].reference_id).html().replace("<br>", ""));
		html = html.replace("#id#", "com-bx-"+i);		

		$("#com-b"+b).eq(0).html(html).addClass("active");

		b++;
	}

	$("div[name=rm-com-box]").unbind().click(function(){

		var id = $(this).attr("com-id").replace("com-bx-c", "");
		
		$("a[name=btn-compare][compare-id="+id+"]").removeClass("active");
		delete compare_box["c"+id];

		compare_items--;

		setComparePanel();

	});
	
	if( compare_items == 0 )
	{
		$("#compare-panel").hide();
	}

	if( compare_items > 1 )
	{
		$("#btn-go-compare").prop("disabled", false).addClass("btn-grn");
	}
	else
	{
		$("#btn-go-compare").prop("disabled", true).removeClass("btn-grn");
	}
	*/
}

function setCompareModel()
{
	var i,j=0, b=1, tmp = $("#tmp_compare_md_box"), html, locations, ind, ond; 

	$(".md-content").each(function(){
		$(this).html("<div class='md-emp-compare text-center'><button class='btn btn-danger'>เลือกกล่องเปรียบเทียบ</button></div>").removeClass("active");
	});
	
	/*
	for( i in compare_box )
	{
		locations = compare_box[i];

		ind = '';
		for( j in indoor )
		{
			if( typeof locations.project[j] != 'undefined' && locations.project[j] != 0 )
			{
				ind += indoor[j] + ", ";
			}
		}
		
		j = 0;
		ond = '';
		for( j in outdoor )
		{
			if( typeof locations.project[j] != 'undefined' && locations.project[j] != 0 )
			{
				ond += outdoor[j] + ", ";
			}
		}

		html = tmp.html()
			.replace("#title#", locations.property_type.name + " " + locations.requirement.name + " " + locations.project.name + " " + locations.road)
			.replace("#id#", "com-bx-"+i)
			.replace("#pic#", locations.picture.url)
			.replace("#code#", locations.reference_id)
			.replace("#bed#", locations.bedrooms || 0)
			.replace("#bath#", locations.bathrooms || 0)
			.replace("#floor#", locations.floors || 0)
			.replace("#indoor#", ind)
			.replace("#outdoor#", ond)
			.replace("#unit#", size_unit[locations.size_unit_id])
			.replace("#priceunit#", (locations.sell_price / locations.size).format(2))
			.replace("#dsppunit#", ( (locations.sell_price == 0)? "none" : "" ) )
			.replace("#size#", locations.size + " " + size_unit[locations.size_unit_id])
			.replace("#price#", $("#price_"+locations.reference_id).html())
			.replace(/#link#/g, $("#link_"+locations.reference_id).attr("href"))
			.replace("#type#", locations.property_type.name_th);		

		$("#mc-"+b).eq(0).html(html).addClass("active");

		b++;
	}

	$("div[name=rm-com-box-md]").unbind().click(function() {

		var id = $(this).attr("com-id").replace("com-bx-c", "");
		
		$("a[name=btn-compare][compare-id="+id+"]").removeClass("active");
		delete compare_box["c"+id];

		compare_items--;

		setCompareModel();
		setComparePanel();

	});

	$("div.md-emp-compare").unbind().click(function() {
		$('#model-compare').modal('hide'); 
	});
	
	if( compare_items == 0 )
	{
		$("#compare-panel").hide();
		$('#model-compare').modal('hide'); 
	}

	if( compare_items > 1 )
	{
		$("#btn-go-compare").prop("disabled", false).addClass("btn-grn");
	}
	else
	{
		$("#btn-go-compare").prop("disabled", true).removeClass("btn-grn");
	}
	*/
}

function article_getcomment(cid, climit)
{
	$.post('/editorial/getcomment', { id : cid, limit : climit }, function(msg) {
		
		article_setcomment(msg, climit);

	}, 'json');
}

function article_setcomment(comment, limit)
{
	var 
		$el_comment_box = $('.modal-article_comment'), 
		$el_comment_total = $('.modal-article_comment_total'), 
		tmpl = '<div class="cm-row"><div class="r-title">{comment_by}<small>{comment_daypass}</small></div><div class="r-detail">{comment}</div></div>',
		comment_html = '';
	
	$el_comment_box.empty();

	$(comment).each(function( i, c ) {
		
		if( i < limit )
		{
			comment_html = tmpl;
			comment_html = comment_html.replace('{comment_by}', c.comment_byname);
			comment_html = comment_html.replace('{comment_daypass}', c.diff);
			comment_html = comment_html.replace('{comment}', c.comment);

			$el_comment_box.append(comment_html);
		}

	});

	$el_comment_total.text(comment.length);
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
			return '<div class="autocomplete-suggestion" data-project_id="'+item[1]+'" data-val="'+item[0]+'" data-province="'+item[2]+'" data-zone="'+item[3]+'">'+item[0].replace(re, "<b>$1</b>")+'</div>';
		},
		onSelect: function(e, term, item) {
			$('input[name=project_id]').length && $('input[name=project_id]').val( $(item).data('project_id') );
			$('input[name=projectname]').length && $('input[name=projectname]').val( $(item).data('val') );
			$('select[name=province]').length && $('select[name=province]').val( $(item).data('province') );
			$('input[name=zone]').length && $('input[name=zone]').val( $(item).data('zone') );
		}
	});

	// to clear search value
	$('#auto-searchby').keyup(function() {
		$('input[name=project_id]').length && $('input[name=project_id]').val('');
	});
		
	if( $('#auto-search_project').length ) 
	{
		new autoComplete({
			selector: '#auto-search_project',
			minChars: 2,
			source: function(term, response) {
				$.getJSON('/list', { q: term }, function(data) { response(data); });
			},
			renderItem: function (item, search) {
				search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
				var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
				return '<div class="autocomplete-suggestion" data-project_id="'+item[1]+'" data-val="'+item[0]+'" data-province="'+item[5]+'" data-zone="'+item[4]+'">'+item[0].replace(re, "<b>$1</b>")+'</div>';
			},
			onSelect: function(e, term, item) {
				$('input[name=project_id]').length && $('input[name=project_id]').val( $(item).data('project_id') );
				$('input[name=projectname]').length && $('input[name=projectname]').val( $(item).data('val') );
				$('select[name=province_id]').length && $('select[name=province_id]').val( $(item).data('province') );
				$('select[name=zone_id]').length && $('select[name=zone_id]').val( $(item).data('zone') );
			}
		});

		// to clear search value
		$('#auto-search_project').keyup(function() {
			$('input[name=project_id]').length && $('input[name=project_id]').val('');
		});
	}

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
	
		chkfav.call(this);	
		
	});

	$('.opt-plus').click(function () {
	
		chkcomp.call(this);	
		
	});

	$('.fav_list').click(function () {
	
		chkfav_list.call(this);	
		
	});

	if( typeof _fav != 'undefined' )
	{
		$('.opt-fav').each(function(i, el) {
			if( typeof $(el).data('prop') != 'undefined' && _fav.indexOf( ''+$(el).data('prop') ) != -1 )
			{
				$(el).addClass('on');
			}
		});
	}

	if( typeof _comp != 'undefined' )
	{
		$('.opt-plus').each(function(i, el) {
			if( typeof $(el).data('prop') != 'undefined' && _comp.indexOf( ''+$(el).data('prop') ) != -1 )
			{
				$(el).addClass('on');
			}
		});
		
		setCompareModel();

		if( _comp.length > 0 )
		{
			$("#compare-panel").show();
			$("#btn-go-compare").prop("disabled", false).addClass("btn-grn");
		}
		else
		{
			$("#btn-go-compare").prop("disabled", true).removeClass("btn-grn");
		}
	}

	$('#model-compare').on('shown.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var recipient = button.data('whatever') // Extract info from data-* attributes
		
		var modal = $(this);

		setCompareModel();
	});

	$('.add_to_fav').click(function () {

		chkfav.call( $(this).find('.opt-fav')[0] );
		//$(this).find('.opt-fav').toggleClass('on');
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
		originLeft: true,
		percentPosition: true
	});
	
	if( $('#articleModel').length )
	{
		$('#articleModel').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget); // Button that triggered the modal
			var recipient = button.data('article_id'); // Extract info from data-* attributes
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this);
			
			if( typeof article[recipient] != 'undefined' )
			{
				modal.find('.modal-title').html('<img src="/public/assets/img/icon/'+article[recipient].icon+'.png" alt="">');
				modal.find('.modal-headline').text( article[recipient].description || article[recipient].name || '' );
				modal.find('.modal-datepost .bd-card-date').text( article[recipient].date_post || '' );
				modal.find('.modal-detail').html( article[recipient].content || '' );
				modal.find('.modal-article_id').val( article[recipient].id || '' );
				modal.find('.modal-picturepost').html( '<img src="/public/article_pic/'+article[recipient].image_path+'" alt="">' );
				//modal.find('.modal-body input').val(recipient);

				//modal.find('.fb-share-button').attr('data-href', 'http://agent168th.com/editorial?topic='+recipient);
				//modal.find('.fb-share-button a').attr('href', 'http://agent168th.com/editorial?topic='+recipient);
				modal.find('.twitter-share-button').attr('href', 'https://twitter.com/intent/tweet?text=http://agent168th.com/editorial?topic='+article[recipient].id);
				modal.find('.google-share-button').attr('href', 'https://plus.google.com/share?url=http://agent168th.com/editorial/article?id='+article[recipient].id);
				//modal.find('.pin-share-button').attr('href', 'https://www.pinterest.com/pin/create/button/?url=http://agent168th.com/editorial/article?id='+recipient);
				
				modal.find('.modal-more_comment').data('cid', article[recipient].id);

				article_getcomment( article[recipient].id, 2);

				$('#fb-share-button').unbind().click(function() {
					FB.ui({
                        display: 'popup',
                        method: 'share',
						//hashtag: '#agent168th',
						quote: article[recipient].name,
						picture: 'http://agent168th.com/public/article_pic/'+article[recipient].image_path,
						caption: article[recipient].description,
                        href: 'http://agent168th.com/editorial?topic=' + recipient,
                    }, function(response) {});
				});

			}
		});

		if( typeof topic != 'undefined' )
		{
			topic != '' && $('[data-article_id='+topic+']').click();
		}
	}

	if( $('.modal-more_comment').length )
	{
		$('.modal-more_comment').click(function() {

			article_getcomment( $(this).data('cid'), 100);

		});
	}

	$('.pd-top').click(function () {
		var $this = $(this);
		window.open('/property/'+$this.data('prop'), '_self');
	});

	$('.pj-top').click(function () {
		var $this = $(this);
		window.open('/project/'+$this.data('prop'), '_self');
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
	
	if( $('#form-regis').length )
	{
		$( "#form-regis" ).on( "submit", function( e ) {

			e.preventDefault();

			$.post('member/register', $( this ).serialize(), function( msg ) {
				
				if( msg.success )
				{
					window.location = '/home';
				}
				else
				{
					alert(msg.error);
				}

			}, 'json');

		});
	}

	if( $('#form-login').length )
	{
		$( "#form-login" ).on( "submit", function( e ) {

			e.preventDefault();

			$.post('member/login', $( this ).serialize(), function( msg ) {
				
				if( msg.success )
				{
					window.location = '/home';
				}
				else
				{
					alert(msg.error);
				}

			}, 'json');

		});
	}

	if( $('#form-profile').length )
	{
		$( "#form-profile" ).on( "submit", function( e ) {

			e.preventDefault();

			$.post('/member/update_profile', $( this ).serialize(), function( msg ) {
				
				if( msg.success )
				{
					window.location = '/member/profile';
				}
				else
				{
					alert(msg.error);
				}

			}, 'json');

		});
	}

	if( $('#form-article').length )
	{
		$( "#form-article" ).on( "submit", function( e ) {

			e.preventDefault();

			var $this = $(this);

			$.post('/editorial/feedback', $this.serialize(), function( msg ) {
				
				if( msg.success )
				{
					article_getcomment($this.find('.modal-article_id').eq(0).val(), 2);
					$this.find('textarea').val('');
				}
				else
				{
					alert(msg.error);
				}

			}, 'json');

		});
	}

	if( $('#form-enquiry').length )
	{
		$( "#form-enquiry" ).on( "submit", function( e ) {

			e.preventDefault();

			var $this = $(this);

			$.post('/member/post_enquiry', $this.serialize(), function( msg ) {
				
				if( msg.success )
				{
					alert('Your enquiry has been sent');
					$( "#form-enquiry" )[0].reset();
					window.location = '';
				}
				else
				{
					alert(msg.error);
				}

			}, 'json');

		});
	}

	if( $('#form-property').length )
	{
		$( "#form-property" ).on( "submit", function( e ) {

			e.preventDefault();

			var $this = $(this);

			$.post('/member/post_property', $this.serialize(), function( msg ) {
				
				if( msg.success )
				{
					alert('Your property has been sent');
					$( "#form-property" )[0].reset();
					window.location = '';
				}
				else
				{
					alert(msg.error);
				}

			}, 'json');

		});


		if( typeof e_property != 'undefined' )
		{
			var i;
			for( i in e_property )
			{
				$('#'+i).length && $('#'+i).val(e_property[i]);
			}
		}	
	}

	if( $('#form-chg_password').length )
	{
		$( "#form-chg_password" ).on( "submit", function( e ) {

			e.preventDefault();

			$.post('/member/change_password', $( this ).serialize(), function( msg ) {
				
				if( msg.success )
				{
					window.location = '/member/profile';
				}
				else
				{
					alert(msg.error);
				}

			}, 'json');

		});
	}

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
				//initMap();
			}
			else
			{
				$('#area-map').hide();
				$('#area-gall').show();
			}
		});
	}
	
	if( $('#image_file').length )
	{
		$("#image_file").fileinput({
			uploadUrl: "/file-upload-batch/2",
			showUpload: false,
			allowedFileExtensions: ["jpg", "png", "gif"],
			browseOnZoneClick : true,
			showBrowse: false,
			maxFileSize: 1000,
			fileActionSettings : { showUpload: false },
			dropZoneClickTitle : '',
			showCaption : false,
			showRemove: false,
			dropZoneTitle : '<div class="lyp-upload-pic mgt30"><i class="fa fa-picture-o" aria-hidden="true"></i></div><div class="lyp-upload-txt">Upload Photo</div><div class="lyp-upload-ext mgt5">Allow .jpg .gif .png and Max file size per image is  not 1mb</div><div class="lyp-upload-btn mgt20"><i class="fa fa-upload" aria-hidden="true"></i> Add Files</div>'
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

	if( $('#pf-picture').length )
	{
		var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
			'onclick="alert(\'Call your custom code here.\')">' +
			'<i class="glyphicon glyphicon-tag"></i>' +
			'</button>'; 

		var mPicture = profile_picture != '' ? '/public/member_pics/' + profile_picture : '/public/assets/img/default_avatar_male.jpg';

		$('#pf-picture').fileinput({
			overwriteInitial: true,
			maxFileSize: 1500,
			showClose: false,
			showCaption: false,
			browseLabel: '',
			removeLabel: '',
			browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
			removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
			removeTitle: 'Cancel or reset changes',
			elErrorContainer: '#kv-avatar-errors-1',
			msgErrorClass: 'alert alert-block alert-danger',
			defaultPreviewContent: '<img src="'+mPicture+'" alt="Your Picture" style="width:160px">',
			//layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
			allowedFileExtensions: ["jpg", "png", "gif"]
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