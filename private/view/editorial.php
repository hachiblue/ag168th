<?php 
extract($params);
$this->import('/template/top-navbar'); 
?>

<section id="boardContainer" class="a_container">

	<div id="searchArea" class="collapse search_bar pds ">
	
		<div class="col-md-12 no_padd">
			<form class="search_prod_form form-inline" action="" method="get">

				<div class="form-group col-xs-12 col-sm-12 col-md-10 padd_form">
					<div class="inp_contain shc">
						<span class="icon"></span>
						<input type="search" name="searchBy" id="searchBy" value="<?=(isset($_GET["searchBy"]))?$_GET["searchBy"]:'';?>" class="form-control search-prod search-board opabx" autocomplete="off" placeholder="What you are looking for">
					</div>	
				</div>
					
				<?php
				$topic = array('1'=>'Editorial', '2'=>'Investment', '3'=>'Topic');
				?>
				<div class="form-group col-xs-6 col-sm-6 col-md-1 padd_form">
					<div class="inp_contain">
						<div class="btn-group search-prod">
							<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
								<span data-bind="label" id="searchLabel" class="dsp_drop_txt"><?=(isset($_GET["topic_id"]) && !empty($_GET["topic_id"]))? $topic[$_GET["topic_id"]]: 'All Posts';?></span>  
								<span class="caret"></span>
							</button>
							<input type="hidden" id="topic_id" name="topic_id" value="<?=(isset($_GET["topic_id"]))?$_GET["topic_id"]:1;?>" class="btn_value">
							<ul class="dropdown-menu" role="menu">
								<li><a name="sel_editorial" value="1">Editorial</a></li>
								<li><a name="sel_investment" value="2">Investment</a></li>
								<li><a name="sel_topic" value="3">Topic</a></li>
							</ul>
						</div>

						<!-- <div class="btn-group search-prod">
							<?php
							$req = array( '1' => 'For Buy', '2' => 'For Rent' );
							?>
							<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
								<span data-bind="label" id="searchLabel" class="dsp_drop_txt"><?=(isset($_GET["requirement_id"]) && !empty($_GET["requirement_id"]))? $req[$_GET["requirement_id"]]: 'Sell/Rent';?></span>  
								<span class="caret"></span>
							</button>
							<input type="hidden" id="requirement_id" name="requirement_id" value="<?=(isset($_GET["requirement_id"]))?$_GET["requirement_id"]:1;?>" class="btn_value">
							<ul class="dropdown-menu" role="menu">
								<li><a value="1">For Buy</a></li>
								<li><a value="2">For Rent</a></li>
							</ul>
						</div> -->


					</div>
				</div>
			
				<div class="col-xs-12 col-sm-12 col-md-1 no_padd">
					<div class="inp_contain">
						<button type="submit" class="btn btn-grn">Search</button>
					</div>
				</div>

			</form>
		</div>
		
		<div class="clearfix"></div>
	</div>

	<div id="postArea">
		<div class="grid">
			<div class="gutter-sizer"></div>
			<div class="grid-sizer"></div>
			<?php
			foreach( $article as $i => $topic )
			{
				?>
				<div class="bd-card grid-item" data-toggle="modal" data-target="#articleModel" data-article_id="<?=$topic['id'];?>">
					<div class="bd-card-img"><img src="<?php echo \Main\Helper\URL::absolute("/public/article_pic/".$topic['image_path'])?>" alt=""></div>
					<div class="editorial_icon"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/".$topic['icon'].".png")?>" alt=""></div>
					<div class="bd-card-title"><?=(empty($topic['description']))? $topic['name'] : $topic['description'];?></div>
					<div class="bd-card-date"><?=$topic['date_post'];?></div>
				</div>
				<?php
			}
			?>

		</div>

		<div class="clearfix"></div>

	</div>

</section>


<!-- Modal -->
<div class="modal fade" id="articleModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title pull-left" id="myModalLabel"><img src="img/icon/post_editorial_icon.png" alt=""></h4>
      </div>
      <div class="modal-body">


		<div class="modal-headline mgt10"></div>
		<div class="modal-datepost"><div class="bd-card-date modal-datepost"></div></div>
		<div class="modal-picturepost mgt15">
			<img src="http://agent168th.com/public/prop_pic/GyUnsDpu5vHl2ZwKb03qtNxc8PVIh9W4.jpg" alt="">
		</div>	
		<div class="modal-detail mgt15"></div>

		<div class="modal-comment-container">
			<div class="cm-total col-xs-12"><span class="modal-article_comment_total">0</span> Comments</div>
			<div class="cm-box col-xs-12 mgt30 modal-article_comment">

			</div>

			
			<div class="cm-more col-xs-6">
				<a href="#" class="modal-more_comment">Show More</a><i class="fa fa-sort-desc" aria-hidden="true"></i>
			</div>
			
			<div class="modal-socialbar pull-right">

				<!-- <div class="fb-share-button" data-href="http://agent168th.com/editorial?topic=0" data-layout="button" data-size="small" data-mobile-iframe="true"></div> -->
				
				<a id="fb-share-button" style="color:#a3a9ae;">
				<i class="fa fa-facebook" aria-hidden="true"></i></a>

				<a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=Hello%20world" style="color:#a3a9ae;">
				<i class="fa fa-twitter" aria-hidden="true"></i></a>

				<a class="google-share-button" href="https://plus.google.com/share?url={URL}" onclick="javascript:window.open(this.href, '',  'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" style="color:#a3a9ae;"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
				

				<a class="pin-share-button" data-pin-do="buttonPin" href="https://www.pinterest.com/pin/create/button/" data-pin-custom="true" style="color:#a3a9ae;"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>

				<!-- <i class="fa fa-facebook" aria-hidden="true"></i> -->
				<!-- <i class="fa fa-twitter" aria-hidden="true"></i> -->
				
				
			</div>


		</div>

		<div class="modal-feedback-container">
			<?php
			if( isset($_SESSION['member']) && !empty($_SESSION['member']) )
			{
			?>	
			<form id="form-article" class="col-xs-12">
				<div class="fb-headline col-md-12 no_padd">Leave Feedback</div>	
				<div class="form-group col-xs-12 col-md-6  no_padd_l pdr10 ">
					<input type="text" class="form-control" id="fb-name" name="name" value="<?=$_SESSION['member']['name'];?>" placeholder="Your Name" required>
					<input type="hidden" name="article_id" class="modal-article_id" value="">
				</div>
				<div class="form-group col-xs-12 col-md-6 no_padd">
					<input type="email" class="form-control" id="fb-email" name="email" value="<?=$_SESSION['member']['email'];?>" placeholder="Your Email" required>
				</div>

				<div class="clearfix"></div>

				<div class="form-group col-md-12 no_padd">
					<textarea class="form-control" id="fb-text" name="comment" rows="4" placeholder="Write your Text ..." required></textarea>
				</div>
				<button type="submit" class="btn btn-searchred btn-fbpost pull-right">Send</button>
				<button type="button" class="btn btn-default btn-fbpost pull-right mgr15" data-dismiss="modal">Close</button>

				<div class="clearfix"></div>
			</form>	
			<?php
			}
			else
			{
				?>
				<button type="button" class="btn btn-default btn-fbpost pull-right mgr15" data-dismiss="modal">Close</button>
				<?php
			}
			?>
			<div class="clearfix"></div>
		</div>
		

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
<!--
	
var article = <?=json_encode($article);?>;
var topic = '<?=( isset($_GET["topic"]) )? $_GET["topic"] : '';?>';

//-->
</script>

<?php $this->import('/template/footer'); ?>