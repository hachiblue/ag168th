<?php
$this->import('/layout/headProperty');
?>

<style>

body {
	background: #EEEEEE;
}

.item-property{
	padding:40px 0 0 0;
}

.item-list-type-room {
	position: relative;
  /* margin: 0 20px 20px 0; */
  /* border: 1px solid #1957a4; */
  /* width: 350px; */
  float: left;
  padding: 10px;
  background: white;

	color: #1957a4;
	-moz-box-shadow: 0 0 5px #888;
	-webkit-box-shadow: 0 0 5px#888;
	box-shadow: 0 0 5px #888;

  display: block;
  position: relative;
}

.img-item a img{
	width:100%;
	/*height:100%;*/
}

.item-name{
	padding: 10px 0 6px 0;
	font-size: 14px;
	color: #1957a4;
	display: inline-block;
	border-bottom: 1px solid #dddddd;
	font-weight: bold;
}

.item-code, .item-type, .item-room {
  border-bottom: 1px solid #dddddd;
	color: #555555;
  padding-top: 8px;
}

.button-detail{
	margin:15px 0;
}

.item-list ul{
	padding:0;
}

.text-red{
	color:red;
	margin:10px 0;
}

a.item-type-name:hover,
.item-name a:hover{
	text-decoration:none;
}

.item-price button{
	padding: 7px 30px;
}

.item-price span{
	float: left;
	margin-top: 0px;
	font-size: 12px;
	color: #555555;
	font-weight: bold;
}

.hr{
	margin:10px 0;
}

.item-list-type-room{
	color: #1957a4;
}

.page-next{
	text-align:center;
}


</style>

<div class="bgList">
    <div class="container">
    	<div class="item-property">
        <!-- <div class="labelText divTop">
          <a href="<?php echo \Main\Helper\URL::absolute("/condo")?>">List</a>
          &nbsp;&nbsp;/&nbsp;&nbsp;
          <a href="<?php echo \Main\Helper\URL::absolute("/map")?>">Map</a>
          &nbsp;&nbsp;/&nbsp;&nbsp;
          <a href="<?php echo \Main\Helper\URL::absolute("/gallery")?>">Gallery</a>
          &nbsp;&nbsp;/&nbsp;&nbsp;
          <a href="<?php echo \Main\Helper\URL::absolute("/table")?>">Table</a>
        </div> -->
        <!-- <div class="labelText"><hr></div> -->
        <?php foreach($params['items'] as $key=> $item){?>
				<?php if($key%4 == 0){?><div class="row"><?php }?>
        <div class="col-md-3">
					<div class="hidden">
						<?php //print_r($item); ?>
					</div>
        	<div class="item-list">
            	<ul class="item-list-box">
                	<li class="item-list-type-room">
                        <div class="img-item">
													<a href="<?php echo \Main\Helper\Url::absolute("/property/{$item["id"]}");?>">
														<img src="<?php echo $item["picture"]["url"];?>" alt="condo" width="100%" height="246">
													</a>
												</div>
                        <div class="item-name clearfix">
													<a href="<?php echo \Main\Helper\Url::absolute("/property/{$item["id"]}");?>">
														<?php echo $item['property_type']['name'];?>
		                        <?php echo $item['requirement']['name'];?>
		                        <?php echo $item['project']['name'];?>
		                        <?php echo $item['road'];?>
														Bangkok
													</a>
												</div>
                        <div class="item-code clearfix">
													<span class="pull-left">รหัส</span>
													<span class="pull-right"><?php echo $item["reference_id"];?></span>
												</div>
                        <div class="item-type clearfix">
													<span class="pull-left">ประเภทอสังหาฯ</span>
													<span class="pull-right"><a href="" class="item-type-name"><?php echo $item["property_type"]["name_th"];?></a></span>
												</div>
                        <div class="item-room clearfix">
													<span class="pull-left">ห้องนอน</span>
													<span class="pull-right"><a href="" class="item-type-name"><?php echo $item["bedrooms"];?></a></span>
                        </div>
                        <div class="item-room clearfix">
													<span class="pull-left">ห้องน้ำ</span>
													<span class="pull-right"><a href="" class="item-type-name"><?php echo $item["bathrooms"];?></a></span>
                        </div>
                       <div class="item-price text-red">
												 <a href="<?php echo \Main\Helper\Url::absolute("/property/{$item["id"]}");?>">
                        	<button type="button" class="btn btn-primary pull-right">Detail</button>
												</a>
                            <span>
															<?php echo empty($item["sell_price"])?"": "ขาย : ".number_format($item["sell_price"])." บาท";?><br>
															<?php echo empty($item["rent_price"])?"": "เช่า : ".number_format($item["rent_price"])." บาท";?>
														</span>
                        </div>
                	</li>
                </ul>

            </div>
         </div>
			 	<?php if($key%4 == 3 || ($key+1) == count($params['items'])){?></div><?php }?>
        <?php }?>
				<?php
				// paging
				$i = 1;
				if($params["paging"]["pageLimit"] > 9) {
					$i = $_GET["page"] - 4;
					$i = $i>0? $i: 1;
					$i = $i<$params["paging"]["pageLimit"]-7? $i: $params["paging"]["pageLimit"]-7;
				}
				$stop = $i+8;
				?>
        <div class="page-next">
            <nav>
              <ul class="pagination">
                <li>
                  <a href="<?php echo \Main\Helper\Url::absolute("/list?".http_build_query(array_merge($_GET, ["page"=> 1])))?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
								<?php for(; $i < $stop; $i++){?>
                <li <?php if($params["paging"]["page"]==$i){?>class="active"<?php }?>>
									<a href="<?php echo \Main\Helper\Url::absolute("/list?".http_build_query(array_merge($_GET, ["page"=> $i])))?>"><?php echo $i;?></a></li>
								<?php }?>
                <li>
                  <a href="<?php echo \Main\Helper\Url::absolute("/list?".http_build_query(array_merge($_GET, ["page"=> $params["paging"]["pageLimit"]])))?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
        </div>
		</div>
    </div><br><br>
</div>
<?php
$this->import('/layout/footer');
?>
