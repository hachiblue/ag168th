

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">

			<div class="row-offcanvas row-offcanvas-right">

				<a class="navbar-brand" href="/home">
					<img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/logo.png")?>" class="img_logo img-responsive" alt="">
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
							<li class="mg7_3"><a href="" class="f_gray"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/fav_icon.png")?>" alt=""></a>
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
                <li class="<?=$act1;?>"><a href="/home">Home</a></li>
                <li class="<?=$act2;?>"><a href="/list?requirement_id=1">Buy</a></li>
                <li class="<?=$act3;?>"><a href="/list?requirement_id=2">Rent</a></li>
                <li class="<?=$act4;?>"><a href="/list_project">Project Search</a></li>
                <li class="<?=$act5;?>"><a href="/list_your_property">List Your Property</a></li>
                <li class="<?=$act6;?>"><a href="/board">Board</a></li>
                <li class="<?=$act7;?>"><a href="/contact">Contact</a></li>
                <li class="active_red"><a href="/investment">Investment  <img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/invest_icon.png")?>" alt=""><span class="sr-only">(current)</span></a></li>
				<li><a href="" class="f_gray"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/fav_icon.png")?>" alt=""></a></li>
				<li><a href="" class="f_gray lst"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/comp_icon.png")?>" alt=""></a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>

</nav>

<div class="clearfix"></div>	

<div class="container-fluid pd0 row-offcanvas row-offcanvas-right">