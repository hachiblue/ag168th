<?php $this->import("/layout/headProperty"); ?>

<!-- Important stylesheet -->
<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("");?>/public/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("");?>/public/css/owl.theme.css">

<!-- Include js plugin -->
<script src="<?php echo \Main\Helper\URL::absolute("");?>/public/js/custom.js"></script>
<script src="<?php echo \Main\Helper\URL::absolute("");?>/public/js/owl.carousel.min.js"></script>

<!-- script slide -->
<script>
$(document).ready(function() {

  $("#owl-demo").owlCarousel({

      navigation : false, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
	  autoPlay : 3000,

      // "singleItem:true" is a shortcut for:
      // items : 1,
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false

  });
});
</script>

<style>
	.property{
		padding:40px 0;
    background: #eeeeee;
	}
  .property > .container {
    background: white;
    -moz-box-shadow: 0 0 5px #888;
    -webkit-box-shadow: 0 0 5px#888;
    box-shadow: 0 0 5px #888;
	}
	.property-slide .item img{
		width:100%;
	}
	.property-slide .owl-theme .owl-controls {
    margin-top: -30px;
	}
	.remarkimg{
		margin:10px 0;
	}
	.property-slide h3{
	    color: #555555;
	}
	.property-slide h3 span{
		margin-right:15px;
	}
	.overview h3,
	.property-box h3{
		color: #555555;
		border-bottom: 2px solid #DDDDDD;
		padding-bottom:10px;
	}
	.property_options .bottom-border {
    	border-bottom: 1px solid #DDDDDD;
    	padding: 5px 5px;
		margin-bottom:5px;
	}
	.property_options .bottom-border span{
    	float: right;
	}
	.property_options .bottom-border p{
		margin-bottom:5px;
	}
	.property_options .bottom-border span.label{
		padding:5px 15px;
	}
	.bottom-border strong{
		margin: 0 10px 10px 0;
	}
	.red{color:red;}
	.property_options .bottom-border p a{ text-decoration:none;}
	.amenities {
		margin-bottom:20px;
		float:left;
		width:100%;
	}
	.amenities ul{
		list-style:none;
		display: block;
		padding:0;
	}
	.amenities ul li{
		margin-right:15px;
		float:left;
		width:180px;
		text-align:left;
	}
	.amenities ul li span{
		margin-right:5px;
	}
	.box-right {
		background-color: gainsboro;
		color: #000;
		padding: 20px;
		font-size: 16px;
		margin: 10px 0 40px 0;
		border: 1px solid whitesmoke;
	}
	p.head-form {
		text-align: center;
		font-size: 17px;
		margin: 0 0 10px 0;
	}
	.cf:before, .cf:after {
		content: " ";
		display: table;
	}
	.item-form p {
		margin: 10px 0;
		font-size: 13px;
	}
	.item-form>p:after {
		content: '*';
		font-size: 10px;
		color: red;
		top: -5px;
		left: 2px;
		position: relative;
	}
	.item-form>div>input[type=radio] {
		margin-right: 12px;
		padding-top: 3px;
	}
	.item-form>div {
		width: 100%;
		height: 30px;
		font-size: 13px;
	}
	.item-form div input[type=text] {
		width: 100%;
		height: 28px;
		font-size: 18px;
		color: #000;
		padding: 0 0 0 10px;
		border: 1px solid whitesmoke;
	}
	.btn-search {
		width: 190px;
		height: 30px;
		display: block;
		margin: 20px auto 0 auto;
		color: #fff;
		background-color: #1957a4;
		border: 1px solid #1957a4;
		text-align: center;
		line-height: 30px;
		text-decoration: none;
	}
</style>

<div class="corner-ribbon top-right sticky orange">system maintenance</div>

<div class="hidden">
  <?php print_r($params["item"]);?>
</div>
	<div class="property">
		<div class="container">
        	<div class="col-md-9">
        		<div class="property-slide">
                	<h3><span class="glyphicon glyphicon-home"></span>
                    <?php echo $params["item"]['property_type']['name'];?>
                    <?php echo $params["item"]['requirement']['name'];?>
                    <?php echo $params["item"]['project']['name'];?>
                    <?php echo $params["item"]['road'];?>
                    Bangkok
                  </h3>
          			<div id="owl-demo" class="owl-carousel owl-theme">
                  <?php
                  $imgs = count($params["item"]["images"]) > 0? $params["item"]["images"]: $params["item"]['project']["images"];
                  if(count($imgs) == 0)
                    $imgs = [$params["item"]["picture"]];
                  ?>
                  <?php foreach($imgs as $img) {?>
                  <div class="item"><img src="<?php echo $img["url"];?>" alt=""></div>
                  <?php }?>
                	</div>
					<p class="remarkimg">
                    * ภาพที่แสดงอาจไม่เหมือนสภาพจริง และห้อง/ บ้านที่จำหน่าย ไม่รวมการตกแต่งใดๆ ทั้งสิ้น ทั้งนี้เป็นไปตามเงื่อนไขบริษัทฯ</p>
				</div><!--content-->
           </div>

           <div class="col-md-3">
           		<div class="overview">
                	<h3>Overview</h3>
                    <div class="property_options">
                    	<div class="bottom-border"><p><strong>ชื่อโครงการ</strong>
                        <?php echo $params["item"]['property_type']['name'];?>
                        <?php echo $params["item"]['requirement']['name'];?>
                        <?php echo $params["item"]['project']['name'];?>
                        <?php echo $params["item"]['road'];?>
                        Bangkok</p>
                      </div>
                      <div class="bottom-border"><p><strong>Purpose :</strong><span class="label btn-danger"><?php echo $params["item"]["requirement"]["name"];?></span></p></div>
                      <div class="bottom-border"><p><strong>ประเภทอสังหาฯ :</strong><span><a href=""><?php echo $params["item"]["property_type"]["name_th"];?></a></span></p></div>
                      <div class="bottom-border"><p><strong>รหัสอสังหาฯ : </strong><span> <?php echo $params["item"]["reference_id"];?></span></p></div>
		                   <div class="bottom-border"><p><strong>ราคาขาย : </strong><span class="red"><?php echo number_format($params["item"]["sell_price"]);?> บาท </span></p></div>
 		                   <div class="bottom-border"><p><strong>ราคาเช่า : </strong><span class="red"><?php echo number_format($params["item"]["rent_price"]);?> บาท </span></p></div>
                      <div class="bottom-border"><p><strong>ทำเล :</strong><a><?php echo @$params["item"]["zone"]["name"];?></a></p></div>
                    	<div class="bottom-border"><p><strong>ขนาด :</strong><span> <?php echo $params["item"]["size"];?> ตร.ว.</span></p></div>
                    	<div class="bottom-border"><p><strong>Bathrooms:</strong><span> <?php echo $params["item"]["bathrooms"];?> </span></p></div>
                   		<div class="bottom-border"><p><strong>Bedrooms:</strong><span> <?php echo $params["item"]["bedrooms"];?> </span></p></div>
                    	<div class="bottom-border"><p><strong>Floor:</strong><span> <?php echo $params["item"]["floors"];?> </span></p></div>
                  	</div>
            	</div>
           </div>


     		<div class="col-md-9">
        		<div class="property-box">
                	<!-- <div class="descrip">
           				     <h3>Description</h3>
                    	<p>......................</p>
                  </div> -->

                    <div class="amenities">
                    	<h3>Indoor amenities</h3>
                        <ul>
                      		<?php if(@$params['item']['project']['has_onsen']){?><li><span class="glyphicon glyphicon-ok"></span>Onsen</li><?php }?>
                      		<?php if(@$params['item']['project']['has_bowling']){?><li><span class="glyphicon glyphicon-ok"></span>Bowling</li><?php }?>
                      		<?php if(@$params['item']['project']['has_pool_room']){?><li><span class="glyphicon glyphicon-ok"></span>Pool Room</li><?php }?>
                      		<?php if(@$params['item']['project']['has_game_room']){?><li><span class="glyphicon glyphicon-ok"></span>Game Room</li><?php }?>
                      		<?php if(@$params['item']['project']['has_meeting_room']){?><li><span class="glyphicon glyphicon-ok"></span>Meeting Room</li><?php }?>
                      		<?php if(@$params['item']['project']['has_private_butler']){?><li><span class="glyphicon glyphicon-ok"></span>Private Butler</li><?php }?>
                      		<?php if(@$params['item']['project']['has_minimart_supermarket']){?><li><span class="glyphicon glyphicon-ok"></span>Minimart Supermarket</li><?php }?>
                      		<?php if(@$params['item']['project']['has_restaurant']){?><li><span class="glyphicon glyphicon-ok"></span>Restaurant</li><?php }?>
                      		<?php if(@$params['item']['project']['has_laundry_service']){?><li><span class="glyphicon glyphicon-ok"></span>Laundry Servic</li><?php }?>
                      		<?php if(@$params['item']['project']['has_bathtub_inside_unit']){?><li><span class="glyphicon glyphicon-ok"></span>Bathtub Inside Unit</li><?php }?>
                        </ul>
                    </div>
                    <div class="amenities">
                    	<h3>Outdoor amenities</h3>
                        <ul>
                      		<?php if(@$params['item']['project']['has_swimming_pool']){?><li><span class="glyphicon glyphicon-ok"></span>Swimming Pool</li><?php }?>
                      		<?php if(@$params['item']['project']['has_gym']){?><li><span class="glyphicon glyphicon-ok"></span>Gym</li><?php }?>
                      		<?php if(@$params['item']['project']['has_garden']){?><li><span class="glyphicon glyphicon-ok"></span>Garden</li><?php }?>
                      		<?php if(@$params['item']['project']['has_futsal']){?><li><span class="glyphicon glyphicon-ok"></span>Futsal</li><?php }?>
                      		<?php if(@$params['item']['project']['has_badminton']){?><li><span class="glyphicon glyphicon-ok"></span>Badminton</li><?php }?>
                      		<?php if(@$params['item']['project']['has_basketball']){?><li><span class="glyphicon glyphicon-ok"></span>Basketball</li><?php }?>
                      		<?php if(@$params['item']['project']['has_tennis']){?><li><span class="glyphicon glyphicon-ok"></span>Tennis</li><?php }?>
                      		<?php if(@$params['item']['project']['has_playground']){?><li><span class="glyphicon glyphicon-ok"></span>Playground</li><?php }?>
                      		<?php if(@$params['item']['project']['has_shuttle_bus']){?><li><span class="glyphicon glyphicon-ok"></span>Shuttle Bus</li><?php }?>
                      		<?php if(@$params['item']['project']['has_private_parking']){?><li><span class="glyphicon glyphicon-ok"></span>Private Parking</li><?php }?>
                        </ul>
                    </div>
        		</div>
     		</div>
            <div class="col-md-3">
            	<div class="box-right">
    			<form id="frmQuickSendEnquiry">
                    <p class="head-form">กรอกข้อมูลเพื่อเยี่ยมชมยูนิตนี้</p>
                    <div class="item-form cf">
                    <p>ฉันต้องการ</p>
                        <div>
                        <input type="radio" name="requirement" value="Buy" checked=""><span>ซื้อ</span>
                        <input type="radio" name="requirement" value="Rent"><span>เช่า</span>
                        <input type="radio" name="requirement" value="Buy/Rent"><span>ซื้อ / เช่า</span>
                        </div>
                    </div>
                    <div class="item-form cf">
                        <p>ชื่อ</p>
                        <div><input name="first_name" type="text"></div>
                    </div>
                    <div class="item-form cf">
                        <p>นามสกุล</p>
                        <div><input name="last_name" type="text"></div>
                    </div>
                    <div class="item-form cf">
                        <p>มือถือ</p>
                        <div><input name="phone" type="text" class="number-only"></div>
                    </div>
                    <div class="item-form cf">
                        <p>อีเมล</p>
                        <div><input name="email" type="text"></div>
                    </div>
                    <div class="box-btn-toggle">
                        <button type="submit" style="display:none;" class="btn-search transit btnSubmit">Send</button>
                        <button class="btn-search transit btnSubmit">SEND</button>
                    </div>
                    <input type="hidden" name="reference_id" value="<?php echo $params['item']['reference_id'];?>">
                    <input type="hidden" name="id" value="<?php echo $params['item']['id'];?>">
     			</form>
          <div id="message-success"
          style="display:none; text-align:center; line-height:30px;">Success send form</div>
    	</div>
            </div>
     	</div>
     </div>


        <!-- Project Details -->
		<!--<div class="box-text-main">
			<p class="title-text">ข้อมูลอสังหาฯ</p>
			<div class="text cf">
        <p><span>ประเภทอสังหาฯ</span> :
          <a href="" target="_blank">
            <?php echo $params['item']['property_type']['name_th'];?>
          </a>
        </p>
        <?php if($params['item']['property_type_id']==1){?>
        <p><span>ชื่อโครงการ</span> : <?php echo $params['item']['project']['name'];?></p>
        <?php }?>
				<p><span>รหัสอสังหาฯ</span> : <?php echo $params['item']['reference_id'];?></p>
				<p><span>ขนาด</span> : <?php echo $params['item']['size'];?> ตร.ว.</p>
				<p><span>ห้องนอน</span> : <?php echo $params['item']['bedrooms'];?></p>
				<p><span>ห้องน้ำ</span> : <?php echo $params['item']['bathrooms'];?></p>
			</div>
			<p class="bor"><span>ทำเล</span> : <a href="" target="_blank"><?php echo $params['item']['zone']['name'];?></a></p>
			<p class="title-text">สิ่งอำนวยความสะดวก</p>
			<div class="text2 cf">
    		<?php if(@$params['item']['project']['has_swimming_pool']){?><p>Swimming Pool</p><?php }?>
    		<?php if(@$params['item']['project']['has_onsen']){?><p>Onsen</p><?php }?>
    		<?php if(@$params['item']['project']['has_gym']){?><p>Gym</p><?php }?>
    		<?php if(@$params['item']['project']['has_garden']){?><p>Garden</p><?php }?>
    		<?php if(@$params['item']['project']['has_futsal']){?><p>Futsal</p><?php }?>
    		<?php if(@$params['item']['project']['has_badminton']){?><p>Badminton</p><?php }?>
    		<?php if(@$params['item']['project']['has_basketball']){?><p>Basketball</p><?php }?>
    		<?php if(@$params['item']['project']['has_tennis']){?><p>Tennis</p><?php }?>
    		<?php if(@$params['item']['project']['has_bowling']){?><p>Bowling</p><?php }?>
    		<?php if(@$params['item']['project']['has_pool_room']){?><p>Pool Room</p><?php }?>
    		<?php if(@$params['item']['project']['has_game_room']){?><p>Game Room</p><?php }?>
    		<?php if(@$params['item']['project']['has_playground']){?><p>Playground</p><?php }?>
    		<?php if(@$params['item']['project']['has_meeting_room']){?><p>Meeting Room</p><?php }?>
    		<?php if(@$params['item']['project']['has_private_butler']){?><p>Private Butler</p><?php }?>
    		<?php if(@$params['item']['project']['has_shuttle_bus']){?><p>Shuttle Bus</p><?php }?>
    		<?php if(@$params['item']['project']['has_minimart_supermarket']){?><p>Minimart Supermarket</p><?php }?>
    		<?php if(@$params['item']['project']['has_restaurant']){?><p>Restaurant</p><?php }?>
    		<?php if(@$params['item']['project']['has_laundry_service']){?><p>Laundry Servic</p><?php }?>
    		<?php if(@$params['item']['project']['has_private_parking']){?><p>Private Parking</p><?php }?>
    		<?php if(@$params['item']['project']['has_bathtub_inside_unit']){?><p>Bathtub Inside Unit</p><?php }?>
     	</div>-->

<script>
  $(function(){
    var form = $('#frmQuickSendEnquiry');
    var messageSuccess = $('#message-success');
    form.submit(function(e){
      e.preventDefault();

      var data = form.serialize();
      form.find(':input').prop("disabled", true);

      $.ajax("", {
        type: "post",
        dataType: "json",
        data: data,
        success: function(data){
          messageSuccess.show();
          form.hide();
        },
        error: function(){
          form.find(':input').prop("disabled", false);
        }
      });
    });
  });
</script>
<script type="text/javascript">
$(document).ready(function(){
    $("#slideshow_thumbs .thumbs").each(function(e) {
        if (e >= 4)
            $(this).hide();
    });

    $("#thumbs_block .next").click(function(){
        if ($("#slideshow_thumbs .thumbs:visible:last").next().length != 0)
            $("#slideshow_thumbs .thumbs:visible:last").nextAll(":lt(4)").show().prevAll(":lt(4)").hide();
        else {
            $("#slideshow_thumbs .thumbs:visible").hide();
            $("#slideshow_thumbs .thumbs:lt(4)").show();
        }
        return false;
    });

    $("#thumbs_block .prev").click(function(){
        if ($("#slideshow_thumbs .thumbs:visible:first").prev().length != 0)
            $("#slideshow_thumbs .thumbs:visible:first").prevAll(":lt(4)").show().first().nextAll(":lt(4)").hide();
        else {
            $("#slideshow_thumbs .thumbs:visible").hide();
            var mod = $("#slideshow_thumbs").length%4;
            if(mod==0) mod = 4;
            mod++;
            $("#slideshow_thumbs .thumbs:gt(-"+mod+")").show();
        }
        return false;
    });
});
</script>
<?php $this->import("/layout/footer"); ?>
