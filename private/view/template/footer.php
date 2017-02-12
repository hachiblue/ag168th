
<?php extract($params); ?>

	<div class="col-xs-6 col-sm-3 mgt65 sidebar-offcanvas hidden-md hidden-lg" id="sidebar">
	  <div class="list-group side-list-group fixright">
		<a href="/home" class="list-group-item side-list-group-item <?=(isset($act1)) ? $act1 : '';?>">Home</a>
		<a href="/list?requirement_id=1" class="list-group-item side-list-group-item <?=(isset($act2)) ? $act2 : '';?>">Buy</a>
		<a href="/list?requirement_id=2" class="list-group-item side-list-group-item <?=(isset($act3)) ? $act3 : '';?>">Rent</a>
		<a href="/list_project" class="list-group-item side-list-group-item <?=(isset($act4)) ? $act4 : '';?>">Project Search</a>
		<a href="/regisprops" class="list-group-item side-list-group-item <?=(isset($act5)) ? $act5 : '';?>">List Your Property</a>
		<a href="/editorial" class="list-group-item side-list-group-item <?=(isset($act6)) ? $act6 : '';?>">Editorial</a>
		<a href="/contact" class="list-group-item side-list-group-item <?=(isset($act7)) ? $act7 : '';?>">Contact</a>

		<?php
		if( isset($_SESSION['member']) && !empty($_SESSION['member']) )
		{
			$txtWelcome = !empty($_SESSION['member']['name'])? $_SESSION['member']['name'] : $_SESSION['member']['email'];
		?>
			<a href="#" class="list-group-item side-list-group-item dropdown-toggle mem-barwelcome" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome, <?=$txtWelcome;?> <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="/member/profile">Profile</a></li>
				<li><a href="/member/enquiry">Enquiry</a></li>
				<li><a href="/member/property">Property</a></li>
				<li><a href="/member/logout">Log Out</a></li>
			</ul>
		<?php
		}
		else
		{
			?>
			<a href="/member" class="list-group-item side-list-group-item <?=(isset($act8)) ? $act8 : '';?>">Login / SignUp</a>
			<?php
		}
		?>

	  </div>
	</div><!--/.sidebar-offcanvas-->

</div>

<?php

use Main\DB\Medoo\MedooFactory;

$db = MedooFactory::getInstance();

$stmt = $db->pdo->prepare(' select id, name from project where is_recent = 1 limit 5');
$stmt->execute();
$recent = $stmt->fetchAll(\PDO::FETCH_ASSOC);

$stmt = $db->pdo->prepare(' select id, name from project where is_popular = 1 limit 5');
$stmt->execute();
$popular = $stmt->fetchAll(\PDO::FETCH_ASSOC);

?>

<footer class="pg-footer pan">
	<div class="backgroundLowlight content contentResponsive">

		<div class="col-md-12 cont1 mgt30">

			<div class="col-md-2 col-md-offset-1">
				<div class="dirCall">
					<div class="dtext">Direct Call</div>
					<div class="dnumber">087-760-5555<br>02-652-7982</div>
				</div>
			</div>
		
			<div class="col-md-7 col-md-offset-1 hidden-xs">
				<div class="col-md-3">
					<div class="list-sitemap">
						<div class="stitle">Popular Project</div>
						<ul class="lst mgt10">
							<?php
							foreach( $popular as $pop )
							{
								?>
								<li><a href="/project/<?=$pop['id'];?>"><?=$pop['name'];?></a></li>
								<?php
							}
							?>
							<li class="vw_all"><a href="">View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-3">
					<div class="list-sitemap">
						<div class="stitle">Recent Project</div>
						<ul class="lst mgt10">
							<?php
							foreach( $recent as $rec )
							{
								?>
								<li><a href="/project/<?=$rec['id'];?>"><?=$rec['name'];?></a></li>
								<?php
							}
							?>
							<li class="vw_all"><a href="/list_project">View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-3">
					<div class="list-sitemap">
						<div class="stitle">Prime Location</div>
						<ul class="lst mgt10">
							<li>Sukhumvit </li>
							<li>Sathorn</li>
							<li>Silom</li>
							<li>Ratchada</li>
							<li>Riverside</li>
							<li class="vw_all"><a href="">View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-3">
					<div class="list-sitemap">
						<div class="stitle">Province</div>
						<ul class="lst mgt10">
							<li>Pattaya</li>
							<li>Hua Hin</li>
							<li>Chiang Mai</li>
							<li class="vw_all"><a href="">View All <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>

		</div>

		<div class="foot_banner col-md-12 mgt30 pd0 hidden-xs hidden-sm">
			<div class="row">
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-3 f_img"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/s_advanced.png")?>" alt=""></div>
						<div class="col-md-9 f_detail">
							<div class="ftitle">Advance Search</div>
							<div class="ftext">Find your dream house with deep in details, customize search to suit your need. </div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-3 f_img"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/s_transport.png")?>" alt=""></div>
						<div class="col-md-8 f_detail">
							<div class="ftitle">Transportation Search</div>
							<div class="ftext">Hop around Bangkok’s transportation system, explore all the units around BTS, MRT, Airport link and BRT. </div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-3 f_img"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/s_map.png")?>" alt=""></div>
						<div class="col-md-8 f_detail">
							<div class="ftitle">Map Search</div>
							<div class="ftext">See the whole Bangkok, pick your dream destination and explore the area. </div>
						</div>
					</div>
				</div>
			</div>	
		</div>
		
		<div class="clearfix"></div>
		
		<div class="social_bar hidden-sm hidden-md hidden-lg mgt20">
			<div class="col-xs-12"><a href="mailto:info@agent168th.com"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/email.png")?>" alt=""></a></div>
			<div class="col-xs-12"><a href="http://line.me/ti/p/@agent168" target="_blank"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/line.png")?>" alt=""></a></div>
			<div class="col-xs-12 lst"><a href="http://www.facebook.com/agent168th/" target="_blank"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/facebook.png")?>" alt=""></a></div>
		</div>

		<div class="foot_end  mgt20 pd0">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">© 2017 Agent168 Co., Ltd. All rights reserved.</div>
				<div class="col-xs-12 col-sm-6 col-md-6 hidden-xs">
					<div class="col-md-4"><a href="mailto:info@agent168th.com"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/email.png")?>" alt=""></a></div>
					<div class="col-md-4"><a href="http://line.me/ti/p/@agent168" target="_blank"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/line.png")?>" alt=""></a></div>
					<div class="col-md-4"><a href="http://www.facebook.com/agent168th/" target="_blank"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/facebook.png")?>" alt=""></a></div>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>
	</div>
</footer>