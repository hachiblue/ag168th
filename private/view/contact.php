

<?php $this->import('/template/top-navbar'); ?>

<section id="contactContainer" class="a_container">

<div id="contact_map"></div>
<div class="container">
	<div class="col-md-4 ct_contain">
		<div class="contact_icon hidden-xs"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/buidling_icon.png")?>" alt=""></div>
		<div class="contact_info">
			<div class="ct-title">Our Head Office</div>
			<div class="ct-address">A6,B 25th Fl., Thanapoom Tower <br> 1550 New Petchburi Rd., <br>	Makkasan, Ratthawi, <br>	Bangkok 10400</div>
			<div class="ct-social">
				<div class="facebook_icon flol"></div><div class="ct-sweb flol">facebook.com/agent168th</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="col-md-8 ct-desc">
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos totam alias commodi accusantium deserunt corrupti eius omnis assumenda optio minima nobis maxime quidem dolore perferendis blanditiis cum natus odio ducimus ad eligendi iste porro ipsa itaque enim reprehenderit molestiae quos veritatis esse dolorum repudiandae! Voluptate autem omnis natus labore necessitatibus cum expedita perferendis inventore eum laboriosam animi ratione id porro temporibus reiciendis debitis dolorem odio ducimus quibusdam voluptatum minus cumque recusandae non iusto officia qui maiores mollitia exercitationem ipsum amet perspiciatis vel nam fuga quidem ea itaque obcaecati voluptatibus nihil sint ex. Unde non totam illum excepturi odit amet quia.</p>
	</div>

	<div class="clearfix"></div>
</div>

<div class="contact_banner">
	<div class="container">
		<div class="col-md-4 box_banner">
			<div class="phone_icon_orange"></div>
			<div class="ct-phone">087-7605555</div>
			<div class="ct-dsub">Lorem ipsum dolor sit amet, consectetur</div>
		</div>
		<div class="col-md-4 box_banner">
			<div class="fax_icon_orange"></div>
			<div class="ct-fax">02-652-7982</div>
			<div class="ct-dsub">Lorem ipsum dolor sit amet, consectetur</div>
		</div>
		<div class="col-md-4 box_banner">
			<div class="mail_icon_orange"></div>
			<div class="ct-mail">info@agent168th.com</div>
			<div class="ct-dsub mgt3">Lorem ipsum dolor sit amet, consectetur</div>
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
	  map: map
	});
  }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_mlBrkkojSUJnMjYKf00nhno1nlO9CCI&callback=initMap"></script>

</section>

<?php $this->import('/template/footer'); ?>