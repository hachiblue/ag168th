

<?php 
extract($params);
$this->import('/template/top-navbar'); 
?>

<section id="contactContainer" class="a_container">

<div id="contact_map"></div>
<div class="container">
	<div class="col-md-4 ct_contain">
		<div class="contact_icon hidden-xs"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/buidling_icon.png")?>" alt=""></div>
		<div class="contact_info">
			<div class="ct-title">Our Head Office</div>
			<div class="ct-address">A6,B 25th Fl., Thanapoom Tower <br> 1550 New Petchburi Rd., <br>	Makkasan, Ratthawi, <br>	Bangkok 10400</div>
			<div class="ct-social">
				<div class="facebook_icon flol"></div><div class="ct-sweb flol"><a href="http://www.facebook.com/agent168th/" target="_blank">facebook.com/agent168th</a></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="col-md-8 ct-desc">

		<div class="cont-headline">COMPANY PROFILE</div>	

		<p>&nbsp;&nbsp;&nbsp;Agent168 founded in 2015. We are Bangkok base Real Estate agency. Providing services ex: buy, sell, rent including investment plan. With 10 year experiences in this industry, we thrive as we also gain more in market share.</p>
		
		<div class="cont-headline mgt10">PREMIUM EXPERIENCE</div>	
		<p>&nbsp;&nbsp;&nbsp;We know, buy a house, is a big decision. Our well trained Property Consultant are ready to provide you with their experience. You are our premium client from the moment that our Property Consultant take your case. You will meet the new premium experience in your life.</p>
		
		<div class="cont-headline mgt10">WHY CHOOSE US?</div>	
		<p>&nbsp;&nbsp;&nbsp;With over 40,000 units in our stock. We have various units for you to choose. From low rise in the hearth of the center to a room with a breathtaking river view. Combine with our exceptional Property Consultant who will assist you from the beginning until you get the right one. We’re ready if you’re ready! Contact us now : 087-760- 5555</p>

	</div>

	<div class="clearfix"></div>
</div>

<div class="contact_banner">
	<div class="container">
		<div class="col-md-4 box_banner">
			<div class="phone_icon_orange"></div>
			<div class="ct-phone">087-7605555</div>
			<!-- <div class="ct-dsub">Lorem ipsum dolor sit amet, consectetur</div> -->
		</div>
		<div class="col-md-4 box_banner">
			<div class="fax_icon_orange"></div>
			<div class="ct-fax">02-652-7982</div>
			<!-- <div class="ct-dsub">Lorem ipsum dolor sit amet, consectetur</div> -->
		</div>
		<div class="col-md-4 box_banner">
			<div class="mail_icon_orange"></div>
			<div class="ct-mail">info@agent168th.com</div>
			<!-- <div class="ct-dsub mgt3">Lorem ipsum dolor sit amet, consectetur</div> -->
		</div>

		<div class="clearfix"></div>
	</div>
</div>

<script>
  function initMap() {
	var uluru = {lat: 13.749500, lng: 100.557849};
	var map = new google.maps.Map(document.getElementById('contact_map'), {
	  zoom: 16,
	  center: uluru
	});
	var marker = new google.maps.Marker({
	  position: uluru,
	  animation: google.maps.Animation.DROP,
	  map: map
	});
  }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_mlBrkkojSUJnMjYKf00nhno1nlO9CCI&callback=initMap"></script>

</section>

<?php $this->import('/template/footer'); ?>