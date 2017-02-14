
<?php extract($params); ?>

<!doctype html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="Keywords" content="">
<meta name="Description" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="apple-touch-icon" sizes="180x180" href="<?php echo \Main\Helper\URL::absolute("/public/assets/apple-touch-icon.png")?>">
<link rel="icon" type="image/png" href="<?php echo \Main\Helper\URL::absolute("/public/assets/favicon-32x32.png")?>" sizes="32x32">
<link rel="icon" type="image/png" href="<?php echo \Main\Helper\URL::absolute("/public/assets/favicon-16x16.png")?>" sizes="16x16">
<link rel="manifest" href="<?php echo \Main\Helper\URL::absolute("/public/assets/manifest.json")?>">
<link rel="mask-icon" href="<?php echo \Main\Helper\URL::absolute("/public/assets/safari-pinned-tab.svg")?>" color="#5bbad5">
<meta name="theme-color" content="#ffffff">


<title>AGENT168</title>

<?php $this->import('/template/style'); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
 
  ga('create', 'UA-89796658-1', 'auto');
  ga('send', 'pageview');
</script>

</head>
<body>

<?php $this->import('/'.$page); ?>


<?php $this->import('/template/script'); ?>

<!-- Modal -->
<div class="modal fade" id="fav_list_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Favorite list</h4>
      </div>
      <div class="modal-body">
		<div id="fv_list">
			
		</div>

		<div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>


<div class="navbar-fixed-bottom" id="compare-panel" style="display:none;">

	<div class="btn-wrap">
		<div class="row">
			<button id="btn-go-compare" class="btn" data-toggle="modal" data-target=".model-compare" disabled>เปรียบเทียบเลย</button>
		</div>
	</div>


	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3 com-bx">
					<div id="com-b1" class="com-content b1"></div>
				</div>
				<div class="col-md-3 com-bx">
					<div id="com-b2" class="com-content b2"></div>
				</div>
				<div class="col-md-3 com-bx">
					<div id="com-b3" class="com-content b3"></div>
				</div>
				<div class="col-md-3 com-bx">
					<div id="com-b4" class="com-content b4"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="tmp_compare_sm_box" style="display:none;">
	<div name="rm-com-box" com-id="#id#" class="remove">
		<i class="glyphicon glyphicon-minus" aria-hidden="true"></i>
	</div>
	<div class="compare_sm_content">
		<div class="row">
			<div class="col-xs-12 item-com">
				<div class="item-com-name clearfix">
					#name#
				</div>
				<div class="item-com-price  text-red">
					#price#				
                </div>
			</div>
		</div>
	</div>
</div>

<div id="tmp_compare_md_box" style="display:none;">
	<div name="rm-com-box-md" com-id="#id#" class="remove">
		<i class="glyphicon glyphicon-minus" aria-hidden="true"></i>
	</div>
	<div class="item-list">
		<ul class="item-list-box">
			<li class="item-list-type-room">
				<div class="img-item">

					<a href="#link#">
						<img src="#pic#" alt="condo" width="100%" height="246" style="margin-left:0px;">
					</a>

				</div>

				<div class="item-name clearfix">
					<a href="#link#">#title#</a>
				</div>
				<div class="item-code clearfix">
					<span class="pull-left">รหัส</span>
					<span class="pull-right">#code#</span>
				</div>
				<div class="item-type clearfix">
					<span class="pull-left">ประเภทอสังหาฯ</span>
					<span class="pull-right"><a href="" class="item-type-name">#type#</a></span>
				</div>
				<div class="item-room clearfix">
					<span class="pull-left">ห้องนอน</span>
					<span class="pull-right"><a href="" class="item-type-name">#bed#</a></span>
				</div>
				<div class="item-room clearfix">
					<span class="pull-left">ห้องน้ำ</span>
					<span class="pull-right"><a href="" class="item-type-name">#bath#</a></span>
				</div>
				<div class="item-room clearfix">
					<span class="pull-left">ชั้น</span>
					<span class="pull-right"><a href="" class="item-type-name">#floor#</a></span>
				</div>
				<div class="item-room clearfix">
					<span class="pull-left">ขนาด</span>
					<span class="pull-right"><a href="" class="item-type-name">#size#</a></span>
				</div>
				<div class="item-room clearfix" style="display:#dsppunit#;>
					<span class="pull-left">ราคา ต่อ #unit#</span>
					<span class="pull-right"><a class="item-type-name">#priceunit#</a></span>
				</div>
				<div class="item-room clearfix">
					<div class="col-sm-12" style="padding:0;">Indoor amenities</div>
					<div class="pull-left"><a class="item-type-name">#indoor#</a></div>
				</div>
				<div class="item-room clearfix">
					<div class="col-sm-12" style="padding:0;">Outdoor amenities</div>
					<div class="pull-left"><a class="item-type-name">#outdoor#</a></div>
				</div>
			   <div class="item-price text-red">
					<a id="link_#code#" href="#link#">
						<button type="button" class="btn btn-primary pull-right">Detail</button>
					</a>
					<span id="price_#code#">#price#<br> </span>
				</div>
			</li>
		</ul>
	</div>
</div>

<div id="model-compare" class="modal fade model-compare" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" style="width: 88%;">
		<div class="modal-content" style="background: #eee;">
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> <h4 class="modal-title" id="myLargeModalLabel">Property Comparer</h4> 
			</div>
			
			<div class="modal-body" style="padding-top:0px;">
				<div class="row">        
					<div class="col-md-3 md-content" id="mc-1">
						
						
					</div>
					<div class="col-md-3 md-content" id="mc-2">
						
						
					</div>
					<div class="col-md-3 md-content" id="mc-3">
						
						
					</div>
					<div class="col-md-3 md-content" id="mc-4">
						
						
					</div>
				</div>
			</div>
        </div>	
	</div>
</div>

<div id="fb-root"></div>


<script
    type="text/javascript"
    async defer
    src="//assets.pinterest.com/js/pinit.js"
></script>

<script>

window.fbAsyncInit = function() {
	FB.init({
		appId      : '201917783227826',
		xfbml      : true,
		version    : 'v2.8'
	});

	FB.AppEvents.logPageView();
};

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=201917783227826";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>

</body>
</html>
