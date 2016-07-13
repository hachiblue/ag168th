<?php
$this->import("/admin/layout/header");
?>
    <style>
    body, html {
                height: 100%;
                margin: 0;
                overflow-x: hidden;
                font-family: helvetica;
                font-weight: 100;
            }

            .container {
                position: relative;
                height: 100%;
                width: 100%;
                left: 0;
                -webkit-transition: left 0.4s ease-in-out;
                -moz-transition: left 0.4s ease-in-out;
                -ms-transition: left 0.4s ease-in-out;
                -o-transition: left 0.4s ease-in-out;
                transition: left 0.4s ease-in-out;
            }

            .container.open-sidebar {
                left: 240px;
            }

            .swipe-area {
                position: absolute;
                width: 50px;
                left: -14px;
                top: 0;
                height: 100%;
                background: #f3f3f3;
                z-index: 0;
            }

            #sidebar {
                background: #DF314D;
                position: absolute;
                width: 240px;
                height: 100%;
                left: -240px;
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }

            #sidebar ul {
                margin: 0;
                padding: 0;
                list-style: none;
            }

            #sidebar ul li {
                margin: 0;
            }

            #sidebar ul li a {
                padding: 15px 20px;
                font-size: 16px;
                font-weight: 100;
                color: white;
                text-decoration: none;
                display: block;
                border-bottom: 1px solid #C9223D;
                -webkit-transition: background 0.3s ease-in-out;
                -moz-transition: background 0.3s ease-in-out;
                -ms-transition: background 0.3s ease-in-out;
                -o-transition: background 0.3s ease-in-out;
                transition: background 0.3s ease-in-out;
            }

            #sidebar ul li:hover a {
                background: #C9223D;
            }

            .main-content {
                width: 100%;
                /*height: 100%;*/
                padding: 10px;
                box-sizing: border-box;
                -moz-box-sizing: border-box;
                position: relative;
            }

            .main-content .content h1 {
                font-weight: 100;
            }

            .main-content .content p {
                width: 100%;
                line-height: 160%;
            }

            .main-content #sidebar-toggle {
                background: #DF314D;
                border-radius: 3px;
                display: block;
                position: relative;
                padding: 10px 7px;
                float: left;
                margin-left: -16px;
            }

            .main-content #sidebar-toggle .bar {
                display: block;
                width: 18px;
                margin-bottom: 3px;
                height: 2px;
                background-color: #fff;
                border-radius: 1px;
            }

            .main-content #sidebar-toggle .bar:last-child {
                margin-bottom: 0;
            }

    </style>
    <div class="container">
        <div id="sidebar">
            <ul>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/enquiries') ?>"><span
                            class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Enquiries</a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/properties') ?>"><i
                            class="fa fa-building fa-2"></i> Properties</a></li>
                <?php if($_SESSION['login']['level_id'] == 1){?>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/manager') ?>"><i
                            class="fa fa-user-secret fa-3"></i> Manager</a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/admin') ?>"><i
                            class="fa fa-user-secret fa-3"></i> Admin</a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/sale') ?>"><i
                            class="fa fa-user-secret fa-3"></i> Sale</a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/layout') ?>"><i
                            class="fa fa-user-secret fa-3"></i> Layout</a></li>
                <?php }?>
                <?php if($_SESSION['login']['level_id'] == 1 || $_SESSION['login']['level_id'] == 2){?>
                <!-- <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/customer') ?>"><i
                            class="fa fa-user-secret fa-3"></i> Customer</a></li> -->
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/project') ?>"><i
                            class="fa fa-user-secret fa-3"></i> Project</a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/phonereq') ?>"><i
                    class="fa fa-user-secret fa-3"></i> Phone Request (<?php echo $params['pqCount'];?>)</a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/reportproperty') ?>"><i
                            class="fa fa-user-secret fa-3"></i> Report Property</a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/article') ?>"><i
                            class="fa fa-user-secret fa-3"></i> Article</a></li>
                <?php }?>
                <?php if($_SESSION['login']['level_id'] == 1 ||
                $_SESSION['login']['level_id'] == 2 ||
                $_SESSION['login']['level_id'] == 3){?>
                  <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/bookreq') ?>"><i
                              class="fa fa-user-secret fa-3"></i> Booking request</a></li>
                <?php }?>

                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/login') ?>"><i
                            class="fa fa-sign-out fa-3"></i> Sign Out</a></li>
            </ul>
        </div>
        <div class="main-content">
            <!-- <div class="swipe-area"></div> -->
            <a href="" data-toggle=".container" id="sidebar-toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </a>
            <div class="navbar">
              <ul class="nav navbar-nav navbar-right">
                <li><a href=""><?php echo $_SESSION['login']['email'];?> [<?php echo $_SESSION['login']['level']['name'];?>]</a></li>
                <!-- <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </li> -->
              </ul>
            </div>
            <div class="content">
                <?php
                if (empty($params['view'])) {
                    $this->import("/admin/enquiries");
                } else {
                    $this->import("/admin/" . $params['view']);
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        var $ = jQuery;
        $(document).ready(function () {
            $("[data-toggle]").click(function (e) {
                e.preventDefault();
                var toggle_el = $(this).data("toggle");
                $(toggle_el).toggleClass("open-sidebar");
                return false;
            });
        });
    </script>
<?php
$this->import("/admin/layout/footer");
