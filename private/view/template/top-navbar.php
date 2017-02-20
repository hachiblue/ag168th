
<?php extract($params); ?>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">

			<div class="row-offcanvas row-offcanvas-right">

				<a class="navbar-brand" href="/home">
					<img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/mark.png")?>" class="img_logo img-responsive" alt="">
					<div class="site-brand">AGENT168</div>
				</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>

					<div class="flol menu-toggle-bar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</div>
					<div class="flol menu-toggle">
						Menu
					</div>
				</button>

				<div class="col-xs-6 col-sm-3  sidebar-offcanvas hidden-sm hidden-md hidden-lg pda pd0">

					<div id="navbar" class="navbar-collapse pd0 no-border">
						<ul class="nav navbar-nav navbar-right side_bar_list mg0">
							<li class="mgt3 active_red"><a href="/investment">Investment  <img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/invest_icon.png")?>" alt=""><span class="sr-only">(current)</span></a>
							</li>
							<li class="mg7_3"><a href="#" class="f_gray fav_list"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/fav_icon.png")?>" alt=""></a>
							</li>
							<li class="mg7_0"><a href="" class="f_gray"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/comp_icon.png")?>" alt=""></a>
							</li>
						</ul>
					</div>
				</div>

			</div>

        </div>
        <div id="navbar" class="navbar-collapse collapse">
           
            <ul class="nav navbar-nav navbar-right">
                <li class="<?=(isset($act1)) ? $act1 : '';?>"><a href="/home">Home</a></li>
                <li class="<?=(isset($act2)) ? $act2 : '';?>"><a href="/list?requirement_id=1">Buy</a></li>
                <li class="<?=(isset($act3)) ? $act3 : '';?>"><a href="/list?requirement_id=2">Rent</a></li>
                <li class="<?=(isset($act4)) ? $act4 : '';?>"><a href="/list_project">Project Search</a></li>
                <li class="<?=(isset($act5)) ? $act5 : '';?>"><a href="/regisprops">List Your Property</a></li>
                <li class="<?=(isset($act6)) ? $act6 : '';?>"><a href="/editorial">Editorial</a></li>
                <li class="<?=(isset($act7)) ? $act7 : '';?>"><a href="/contact">Contact</a></li>
                <li class="active_red"><a href="/investment">Investment  <img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/invest_icon.png")?>" alt=""><span class="sr-only">(current)</span></a></li>
				
				<?php
				if( isset($_SESSION['member']) && !empty($_SESSION['member']) )
				{
					$txtWelcome = !empty($_SESSION['member']['name'])? $_SESSION['member']['name'] : $_SESSION['member']['email'];
				?>
                <li class="">
					<a href="#" class="dropdown-toggle mem-barwelcome" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome, <?=$txtWelcome;?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="/member/profile">Profile</a></li>
						<li><a href="/member/enquiry">Enquiry</a></li>
						<li><a href="/member/property">Property</a></li>
						<li><a href="/member/logout">Log Out</a></li>
					</ul>
					<script type="text/javascript">
					<!--
						var _fav = <?=json_encode(explode(',', $_SESSION['member']['fav_property']));?>;
						var _comp = <?=(isset($_SESSION['comp']))? json_encode($_SESSION['comp']) : "[]";?>;
					//-->
					</script>
				</li>
				<?php
				}
				else
				{ ?>
				<li class="<?=(isset($act8)) ? $act8 : '';?>"><a href="/member">Login / SignUp</a></li>
			
				<?php
				}
				?>

				<li><a href="#" class="f_gray fav_list"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/fav_icon.png")?>" alt=""></a></li>
				<li><a href="" class="f_gray lst"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/comp_icon.png")?>" alt=""></a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>

</nav>

<div class="clearfix"></div>	

<div class="container-fluid pd0 row-offcanvas row-offcanvas-right">