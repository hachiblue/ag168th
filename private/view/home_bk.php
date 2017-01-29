<?php
use Main\Helper;

$this->import('/layout/header');
$db = \Main\DB\Medoo\MedooFactory::getInstance();
$news = $db->get("article", "*", ["topic_id"=> 1, "ORDER"=> "created_at DESC"]);
$tip = $db->get("article", "*", ["topic_id"=> 2, "ORDER"=> "created_at DESC"]);
$review = $db->get("article", "*", ["topic_id"=> 3, "ORDER"=> "created_at DESC"]);

$zones = $db->select("zone", "*");
$zonegroups = $db->select("zone_group", "*");
foreach($zonegroups as &$zonegroup) {
  $zonegroup["zones"] = array_filter($zones, function($zone) use($zonegroup) {
    return $zonegroup["id"] == $zone["zone_group_id"];
  });
}

$projects = $db->select("project", ["id", "name"], ["ORDER"=> "name ASC"]);

$btss = $db->select("bts", "*");
$mrts = $db->select("mrt", "*");
$requirement = $db->select("requirement", "*");
$property_types = $db->select("property_type", "*");

?>
<style>
.slide .carousel-indicators
{
  height: 17px;
}

html, body {
  height: 100%;
  width: 100%;
}
</style>
<div class="slide">
    <div class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php foreach($params['slide_1'] as $key=> $val) {?>
            <div class="item <?php if($key==0) echo "active";?>"><img width="100%" height="710" src="<?php echo \Main\Helper\URL::absolute("/public/slide_1/").$val;?>" /></div>
            <?php }?>
            <div class="item"><a href="http://sevenseas.agent168th.com/"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/slide/slide03.png")?>" /></a></div>
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<div class="container" style="position: relative;">
    <div class="findprops">
        <img style="opacity: 0.8;" src="<?php echo \Main\Helper\URL::absolute("/public/images/maps.jpg")?>" />
        <div class="searchbox">
            <div class="row">
                <div class="col-lg-9">
                    <p>Find your place</p>
                    <div class="pic" style="margin-left: 290px;">
                        <img src="<?php echo \Main\Helper\URL::absolute("/public/images/linetable.jpg")?>" /> <span class="glyphicon glyphicon-search"></span> <img src="<?php echo \Main\Helper\URL::absolute("/public/images/linetable.jpg")?>" />
                    </div>
                    <form class="searchopt" action="list">
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Location:</label><br/>
                                <select class="form-control" name="zone_id">
                                    <option value="">Any Location</option>
                                    <?php foreach($zonegroups as $zonegroup) {?>
                                      <optgroup label="<?php echo $zonegroup["name"];?>">
                                      <?php foreach($zonegroup["zones"] as $zone) {?>
                                        <option value="<?php echo $zone["id"];?>" <?php if(@$_GET['zone_id']==$zone["id"]) echo "selected";?>><?php echo $zone["name"];?></option>
                                      <?php }?>
                                      </optgroup>
                                    <?php }?>
                                </select>
                                <label>Near MRT:</label><br/>
                                <select class="form-control" name="mrt_id">
                                    <option value="">Any Feature</option>
                                    <?php foreach($mrts as $mrt) {?>
                                      <option value="<?php echo $mrt["id"];?>" <?php if(@$_GET['mrt_id']==$mrt["id"]) echo "selected";?>><?php echo $mrt["name"];?></option>
                                    <?php }?>
                                </select>

								<label>Requirement:</label><br/>
                                <select class="form-control" name="requirement_id">
                                    <option value="">Any Feature</option>
                                    <?php foreach($requirement as $req) {?>
                                      <option value="<?php echo $req["id"];?>" <?php if(@$_GET['requirement_id']==$req["id"]) echo "selected";?>><?php echo $req["name"];?></option>
                                    <?php }?>
                                </select>

                            </div>

                            <div class="col-lg-4">
                                <label>Property Type:</label><br/>
                                <select class="form-control" name="property_type_id">
                                    <option value="">Any Type</option>
                                    <?php foreach($property_types as $property_type) {?>
                                      <option value="<?php echo $property_type["id"];?>" <?php if(@$_GET['property_type_id']==$property_type["id"]) echo "selected";?>><?php echo $property_type["name"];?></option>
                                    <?php }?>
                                </select>

                                <label>Near BTS:</label><br/>
                                <select class="form-control" name="bts_id">
                                    <option value="">Any Feature</option>
                                    <?php foreach($btss as $bts) {?>
                                      <option value="<?php echo $bts["id"];?>" <?php if(@$_GET['bts_id']==$bts["id"]) echo "selected";?>><?php echo $bts["name"];?></option>
                                    <?php }?>
                                </select>
								
								<label>&nbsp;</label><br/>
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Bathrooms:</label><br/>
                                        <select class="form-control" name="bathrooms">
                                            <option value="">Any</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4+">4+</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Bedrooms:</label><br/>
                                        <select class="form-control" name="bedrooms">
                                            <option value="">Any</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4+">4+</option>
                                        </select>
                                    </div>
                                </div>
                                  <label>Project:</label><br/>
                                  <select class="form-control" name="project_id" id="project_id">
                                      <option value="">Any</option>
                                      <?php foreach($projects as $project){?>
                                      <option value="<?php echo $project["id"];?>" <?php if(@$_GET['project_id']==$project["id"]) echo "selected";?>><?php echo $project["name"];?></option>
                                      <?php }?>
                                  </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="underslide">
    <div class="container">
        <p>Bangkok Condo, Apartments & Houses for Sale & Rent</p>
    </div>
</div>

<div class="highlightslide">
    <div class="container">
        <div class="row">
            <div class="col-xs-2"></div>
            <div class="col-xs-3"><p>Highlight Properties</p></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-2"></div>
                <?php foreach($params['highlight'] as $item){?>
                <div class="col-sm-3 highlight">
                    <a class="images-home" href="<?php echo \Main\Helper\URL::absolute('/property/'.$item['id']);?>">
                      <img src="<?php echo $item['picture']['url'];?>" width="262" height="196" />
                    </a>
                    <a class="name" href="<?php echo \Main\Helper\URL::absolute('/property/'.$item['id']);?>"><?php echo $item['project']['name'];?></a>
                    <!-- <p class="add">Annapolls</p> -->
                    <div class="hr"></div>
                    <p class="sale"><a href="<?php echo \Main\Helper\URL::absolute('/property/'.$item['id']);?>"><?php echo $item['requirement']['name'];?></a>
                      <span class="price">
                      <?php echo number_format($item['requirement_id']==1? $item['sell_price']: $item['rent_price'], 0)." บาท";?>
                      </span>
                    </p>
                    <div class="detail" style="font-size: 11px;">
                        <span class="ft"><?php echo $item['size']." ".$item['size_unit']['name'];?></span>
                        <span class="bed"><?php echo $item['bedrooms'];?> Beds</span>
                        <span class="bath"><?php echo $item['bathrooms'];?> Baths</span>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
        <!-- <div class="highlight">
            <a class="images-home" href=""><img src="<?php echo \Main\Helper\URL::absolute("/public/images/house.jpg")?>"  /></a>
            <a class="name" href="">678 Bay Hills Lane</a>
            <p class="add">Annapolls</p>
            <div class="hr"></div>
            <p class="sale"><a href="">For Sale</a><span class="price">$240,000</span></p>
            <div class="detail">
                <span class="ft">1025 sq ft</span>
                <span class="bed">4 Beds</span>
                <span class="bath">2 Baths</span>
            </div>
        </div>
        <div class="highlight">
            <a class="images-home" href=""><img src="<?php echo \Main\Helper\URL::absolute("/public/images/house.jpg")?>"  /></a>
            <a class="name" href="">678 Bay Hills Lane</a>
            <p class="add">Annapolls</p>
            <div class="hr"></div>
            <p class="sale"><a href="">For Sale</a><span class="price">$240,000</span></p>
            <div class="detail">
                <span class="ft">1025 sq ft</span>
                <span class="bed">4 Beds</span>
                <span class="bath">2 Baths</span>
            </div>
        </div>
        <div class="highlight">
            <a class="images-home" href=""><img src="<?php echo \Main\Helper\URL::absolute("/public/images/house.jpg")?>"  /></a>
            <a class="name" href="">678 Bay Hills Lane</a>
            <p class="add">Annapolls</p>
            <div class="hr"></div>
            <p class="sale"><a href="">For Sale</a><span class="price">$240,000</span></p>
            <div class="detail">
                <span class="ft">1025 sq ft</span>
                <span class="bed">4 Beds</span>
                <span class="bath">2 Baths</span>
            </div>
        </div> -->
    </div>
</div>

<div class="highlightslide">
    <div class="container">
        <div class="row">
            <div class="col-xs-2"></div>
            <div class="col-xs-3"><p>Best Buy</p></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-3 pull-right see-more"><a href="<?php echo \Main\Helper\URL::absolute('/list?feature_unit_id=1');?>">ดูเพิ่มเติม</a></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-2"></div>
            <?php foreach($params['bestbuy'] as $item){?>
                <div class="col-sm-3 highlight">
        			<div class="ribbon-wrapper"><div class="ribbon r-green">Best Buy</div></div>
                    <a class="images-home" href="<?php echo \Main\Helper\URL::absolute('/property/'.$item['id']);?>">
                      <img src="<?php echo $item['picture']['url'];?>" width="262" height="196" />
                    </a>
                    <a class="name" href="<?php echo \Main\Helper\URL::absolute('/property/'.$item['id']);?>"><?php echo $item['project']['name'];?></a>
                    <!-- <p class="add">Annapolls</p> -->
                    <div class="hr"></div>
                    <p class="sale"><a href="<?php echo \Main\Helper\URL::absolute('/property/'.$item['id']);?>"><?php echo $item['requirement']['name'];?></a>
                      <span class="price">
                      <?php echo number_format($item['requirement_id']==1? $item['sell_price']: $item['rent_price'], 0)." บาท";?>
                      </span>
                    </p>
                    <div class="detail" style="font-size: 11px;">
                        <span class="ft"><?php echo $item['size']." ".$item['size_unit']['name'];?></span>
                        <span class="bed"><?php echo $item['bedrooms'];?> Beds</span>
                        <span class="bath"><?php echo $item['bathrooms'];?> Baths</span>
                    </div>
                </div>
            <?php }?>
            </div>
        </div>
    </div>
</div>

<div class="highlightslide">
    <div class="container">
        
        <div class="row">
            <div class="col-xs-2"></div>
            <div class="col-xs-3"><p>Hot Price</p></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-3 pull-right see-more"><a href="<?php echo \Main\Helper\URL::absolute('/list?feature_unit_id=2');?>">ดูเพิ่มเติม</a></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-2"></div>
                <?php foreach($params['hotrental'] as $item){?>
                <div class="col-sm-3 highlight">
        			<div class="ribbon-wrapper"><div class="ribbon r-orange">Hot Price</div></div>
                    <a class="images-home" href="<?php echo \Main\Helper\URL::absolute('/property/'.$item['id']);?>">
                      <img src="<?php echo $item['picture']['url'];?>" width="262" height="196" />
                    </a>
                    <a class="name" href="<?php echo \Main\Helper\URL::absolute('/property/'.$item['id']);?>"><?php echo $item['project']['name'];?></a>
                    <!-- <p class="add">Annapolls</p> -->
                    <div class="hr"></div>
                    <p class="sale"><a href="<?php echo \Main\Helper\URL::absolute('/property/'.$item['id']);?>"><?php echo $item['requirement']['name'];?></a>
                      <span class="price">
                      <?php echo number_format($item['requirement_id']==1? $item['sell_price']: $item['rent_price'], 0)." บาท";?>
                      </span>
                    </p>
                    <div class="detail" style="font-size: 11px;">
                        <span class="ft"><?php echo $item['size']." ".$item['size_unit']['name'];?></span>
                        <span class="bed"><?php echo $item['bedrooms'];?> Beds</span>
                        <span class="bath"><?php echo $item['bathrooms'];?> Baths</span>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<div class="highlightslide">
    <div class="container">
        
        <div class="row">
            <div class="col-xs-2"></div>
            <div class="col-xs-3"><p>Discount</p></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-3 pull-right see-more"><a href="<?php echo \Main\Helper\URL::absolute('/list?feature_unit_id=3');?>">ดูเพิ่มเติม</a></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-2"></div>
                <?php foreach($params['withtenant'] as $item){?>
                <div class="col-sm-3 highlight">

        			<div class="ribbon-wrapper"><div class="ribbon r-red">Discount</div></div>

                    <a class="images-home" href="<?php echo \Main\Helper\URL::absolute('/property/'.$item['id']);?>">
                      <img src="<?php echo $item['picture']['url'];?>" width="262" height="196" />
                    </a>
                    <a class="name" href="<?php echo \Main\Helper\URL::absolute('/property/'.$item['id']);?>"><?php echo $item['project']['name'];?></a>
                    <!-- <p class="add">Annapolls</p> -->
                    <div class="hr"></div>
                    <p class="sale"><a href="<?php echo \Main\Helper\URL::absolute('/property/'.$item['id']);?>"><?php echo $item['requirement']['name'];?></a>
                      <span class="price">
                      <?php echo number_format($item['requirement_id']==1? $item['sell_price']: $item['rent_price'], 0)." บาท";?>
                      </span>
                    </p>
                    <div class="detail" style="font-size: 11px;">
                        <span class="ft"><?php echo $item['size']." ".$item['size_unit']['name'];?></span>
                        <span class="bed"><?php echo $item['bedrooms'];?> Beds</span>
                        <span class="bath"><?php echo $item['bathrooms'];?> Baths</span>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<div class="highlightslide">
    <div class="container">
        <div class="row">
            <div class="col-xs-2"></div>
            <div class="col-xs-3"><p>New</p></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-3 pull-right see-more"><a href="<?php echo \Main\Helper\URL::absolute('/list?feature_unit_id=4');?>">ดูเพิ่มเติม</a></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-2"></div>
                <?php foreach($params['newcoming'] as $item){?>
                <div class="col-sm-3 highlight">
        			<div class="ribbon-wrapper"><div class="ribbon r-blue">New</div></div>
                    <a class="images-home" href="<?php echo \Main\Helper\URL::absolute('/property/'.$item['id']);?>">
                      <img src="<?php echo $item['picture']['url'];?>" width="262" height="196" />
                    </a>
                    <a class="name" href="<?php echo \Main\Helper\URL::absolute('/property/'.$item['id']);?>"><?php echo $item['project']['name'];?></a>
                    <!-- <p class="add">Annapolls</p> -->
                    <div class="hr"></div>
                    <p class="sale"><a href="<?php echo \Main\Helper\URL::absolute('/property/'.$item['id']);?>"><?php echo $item['requirement']['name'];?></a>
                      <span class="price">
                      <?php echo number_format($item['requirement_id']==1? $item['sell_price']: $item['rent_price'], 0)." บาท";?>
                      </span>
                    </p>
                    <div class="detail" style="font-size: 11px;">
                        <span class="ft"><?php echo $item['size']." ".$item['size_unit']['name'];?></span>
                        <span class="bed"><?php echo $item['bedrooms'];?> Beds</span>
                        <span class="bath"><?php echo $item['bathrooms'];?> Baths</span>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>

    </div>
</div>


<div class="newsletter skrollable skrollable-between">
    <div class="container" id="subscribe">
        <div class="row">
            <div style="display: inline-block;" id="letter">
                Newsletter Sign up
            </div>
            <div style="margin-top: 10px; margin-left: 20px; display: inline-block; width: 262px;">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Your Email address" style="font-size: 22px;"/>
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">OK</button>
                    </span>
                </div>
            </div>
        </div>
        <p id="comment">Stay updated with all our latest news enter your e-mail address here</p>
    </div>
</div>
<div class="newsandtips">
    <div class="newsandtipsheader">
        <div class="container"><p>NEWS & TIPS</p></div>
    </div>
    <div class="container">
        <div class="newsandtipsarrow">
            <img style="margin-left: 50%;" src="<?php echo \Main\Helper\URL::absolute("/public/images/newstipsarrow.png")?>"  />
        </div>
    </div>
    <div class="newsandtipscontent start">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <?php if($news){?>
                        <div class="col-lg-3" id="box1" style="border: solid 2px;">
                            <div class="row">
                                <div class="col-lg-12" id="banner"><p>NEWS:Propety News</p></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" id="contentpic">
                                    <img src="<?php echo \Main\Helper\URL::absolute("/public/article_pic/".$news["image_path"]);?>"  style="margin: 0 auto; max-width: 100%;" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" id="contentdes">
                                    <p id="headline"><?php echo $news["name"];?></p>
                                    <p><?php echo $news["description"];?></p>

                                    <a class="btn btn-primary" href="<?php echo \Main\Helper\URL::absolute("/campaign/".$news["id"])?>">View All</a>
                                </div>
                            </div>
                        </div>
                        <?php }else{?><div class="col-lg-3" id="box1"></div><?php }?>
                        <?php if($tip){?>
                        <div class="col-lg-3" id="box2" style="margin: 0 50px 0 50px; border: solid 2px;">
                            <div class="row">
                                <div class="col-lg-12" id="banner"><p>Tips:Propety Tips</p></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" id="contentpic">
                                    <img src="<?php echo \Main\Helper\URL::absolute("/public/article_pic/".$tip["image_path"]);?>"  style="max-width: 100%;"  />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" id="contentdes">
                                    <p id="headline"><?php echo $tip["name"];?></p>
                                    <p><?php echo $tip["description"];?></p>
                                    <a class="btn btn-primary" href="<?php echo \Main\Helper\URL::absolute("/campaign/".$tip["id"])?>">View All</a>
                                </div>
                            </div>
                        </div>
                        <?php }else{?><div class="col-lg-3" id="box2"></div><?php }?>
                        <?php if($review){?>
                        <div class="col-lg-3" id="box3" style="border: solid 2px;">
                            <div class="row">
                                <div class="col-lg-12" id="banner"><p>Project Review</p></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" id="contentpic">
                                    <img src="<?php echo \Main\Helper\URL::absolute("/public/article_pic/".$review["image_path"]);?>" style="max-width: 100%;" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" id="contentdes">
                                    <p id="headline"><?php echo $review["name"];?></p>
                                    <p><?php echo $review["description"];?></p>
                                    <a class="btn btn-primary" href="<?php echo \Main\Helper\URL::absolute("/campaign/".$review["id"]);?>">View All</a>
                                </div>
                            </div>
                        </div>
                        <?php }else{?><div class="col-lg-3" id="box3"></div><?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="split">
    <hr/>
</div>
<div class="feedback start">
    <div class="container">
        <div class="row" style="margin-left: 100px;">
            <div class="col-lg-4" id="recommend" style="margin-right: 70px;">
                <p id="subject">TESTIMONIAL</p>
                <p style="font-style: italic;">"I found my current apartment on Agent168 with extraordinary
                    help from them and totally satisfied with the choice I made.
                    All I had to do was to tell what I was looking for and
                    I got back property suggestions nearly exact to my imagination.
                    Among those, I finally chose mine now then completed procedure
                    at ease. Highly recommend Agent168  for your home search."</p>
                <div class="row">
                    <div class="col-lg-2"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/Mugshot.png")?>" /></div>
                    <div class="col-lg-4" style="margin-left: 20px;">
                        <p style="font-weight: bold;">Niran Yodying</p>
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" id="company">
                <img src="<?php echo \Main\Helper\URL::absolute("/public/images/showcase.png")?>" />
                <div class="row">
                    <div class="col-lg-8">
                        <p id="aboutbrand" style="font-family: 'cocogoose', 'Arial', sans-serif; font-size: 1.5em;">AGENT168 Co.,Ltd.</p>
                        <p id="aboutbrand" style="margin-top: -15px;">PROFESSIONAL PROPERTY AGENT</p><br/>
                        <div class="row">
                            <div class="col-lg-12">
                                <p>Agent168 is a well established full-service property brokerage agency
                                    providing services ranging from buying, renting and selling consultations.
                                    With over 10 years of experience in the business and a crew of properties
                                    but also professional real estate related advice. By letting us take care of
                                    your every real estate need, you are sure to find the result to be no less
                                    than spectacular.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
      var ua = navigator.userAgent;

      if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Mobile|mobile/i.test(ua)){}
      else if (/Chrome/i.test(ua))
      {
        var $el = $('.newsletter');
        var wH = $(window).height();
        var top = $el.offset().top - wH;
        var bottom = top + wH + ($el.height()*2);

        var topAttr = 'data-'+parseInt(top);
        var bottomAttr = 'data-'+parseInt(bottom);
        $el.attr(topAttr, "background-position:0% 30%;");
        $el.attr(bottomAttr, "background-position:0% 100%;");

        // setTimeout(function(){
        //     skrollr.init({
        //         smoothScrolling: false,
        //         mobileDeceleration: 0.004
        //     });
        // },1000);
      }
    });
</script>
<script>
    $(function(){
        $(document).ready(function() {
            var ua = navigator.userAgent;

            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Mobile|mobile/i.test(ua)){}
            else if (/Chrome/i.test(ua))
            {
                // var $html = $("html");
                // $html.niceScroll({
                //     spacebarenabled: false
                // });
                //
                // $html.css("overflow", "auto");
                // $(".nicescroll-rails").hide();
            }
        });

        var $window = $(window);
        $window.scroll(function(){
            $('.animation-once').each(function(index, el){
                var $el = $(el);
                var hT = $el.offset().top,
                    hH = $el.outerHeight(),
                    wH = $window.height(),
                    wS = $window.scrollTop();
                var pos = (hT+parseInt(hH/3)-wH);
                if (wS > pos){
                    $el.removeClass('animation-once');
                }
                // console.log(wS , (hT+hH-wH));
            });
        });
    });
</script>
<!--<script>-->
<!--    $(function(){-->
<!--        setTimeout(function(){-->
<!--            $('.newsletter').scrollTop(0);-->
<!--        }, 1000);-->
<!--    });-->
<!--</script>-->
<script>
    function isElementInViewport(elem) {
        var $elem = $(elem);

        // Get the scroll position of the page.
        var scrollElem = ((navigator.userAgent.toLowerCase().indexOf('webkit') != -1) ? 'body' : 'html');
        var viewportTop = $(scrollElem).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        // Get the position of the element on the page.
        var elemTop = Math.round( $elem.offset().top );
        var elemBottom = elemTop + $elem.height();

        //console.log(elemTop, viewportTop);

        return ((elemTop < viewportBottom) && (elemBottom > viewportTop));
    }
    $(function(){
        $(window).scroll(function(){
            var el = $('#box1');
            if(isElementInViewport(el)){
                $('.newsandtipscontent').removeClass('start');
            }
        });
    });

</script>

<script>
    $(function(){

		$("#project_id").chosen({disable_search_threshold: 10});

        $(window).scroll(function(){
            var el = $('#recommend');
            if(isElementInViewport(el)){
                $('.feedback').removeClass('start');
            }
        });
    });
</script>
<?php
$this->import('/layout/footer');
?>
