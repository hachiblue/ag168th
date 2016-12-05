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

            a.bell-alert {
                color:red;
            }

    </style>
    <div class="container">
        <div id="sidebar">
            <ul>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/enquiries') ?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Enquiries</a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/properties') ?>"><i class="fa fa-building fa-2"></i> Properties</a></li>

                <?php if($_SESSION['login']['level_id'] != 4){?>
                <li>
                    <a href="<?php echo \Main\Helper\URL::absolute('/admin/enquiries#/rentalexpire') ?>">Rental Expire (<?php echo (isset($params['exCount'])?$params['exCount']:0);?>)</a>
                </li>
                <?php }?>

                <?php if($_SESSION['login']['level_id'] == 4){?>
                <li>
                    <a href="<?php echo \Main\Helper\URL::absolute('/admin/enquiries#/wishlist') ?>">Wish List</a>
                </li>
                <?php }?>

                <?php if($_SESSION['login']['level_id'] == 1){?>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/manager') ?>"><i class="fa fa-user-secret fa-3"></i> Manager</a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/admin') ?>"><i class="fa fa-user-secret fa-3"></i> Admin</a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/sale') ?>"><i class="fa fa-user-secret fa-3"></i> Sale</a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/layout') ?>"><i class="fa fa-user-secret fa-3"></i> Layout</a></li>
                <?php }?>
                <?php if($_SESSION['login']['level_id'] == 1 || $_SESSION['login']['level_id'] == 2){?>
                <!-- <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/customer') ?>"><i
                            class="fa fa-user-secret fa-3"></i> Customer</a></li> -->
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/project') ?>"><i class="fa fa-user-secret fa-3"></i> Project</a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/phonereq') ?>"><i class="fa fa-user-secret fa-3"></i> Phone Request (<?php echo $params['pqCount'];?>)</a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/reportproperty') ?>"><i class="fa fa-user-secret fa-3"></i> Report Property</a></li>

                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/reportuser') ?>"><i class="fa fa-user-secret fa-3"></i> Report User</a></li>

                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/article') ?>"><i class="fa fa-user-secret fa-3"></i> Article</a></li>
                <?php }?>
                <?php if($_SESSION['login']['level_id'] == 1 ||
                $_SESSION['login']['level_id'] == 2 ||
                $_SESSION['login']['level_id'] == 3){?>
                  <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/bookreq') ?>"><i
                              class="fa fa-user-secret fa-3"></i> Booking request</a></li>
                <?php }?>

                <li><a href="<?php echo \Main\Helper\URL::absolute('/admin/login') ?>"><i class="fa fa-sign-out fa-3"></i> Sign Out</a></li>
            </ul>
        </div>
        <div class="main-content">
            <!-- <div class="swipe-area"></div> -->
            <a href="" data-toggle=".container" id="sidebar-toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </a>
            <?php
            use Main\DB\Medoo\MedooFactory;

            $db = MedooFactory::getInstance();

            $item = array();

            if( $_SESSION["login"]["username"] == 'somporn' )
            {
                $sql = "SELECT COUNT(p.id) AS cnt FROM property p WHERE p.property_status_id = 10 AND p.property_pending_date > '0000-00-00' AND p.property_pending_date <= now() ORDER BY p.property_pending_date ";  
            }
            else
            {
                $sql = "SELECT 
                      COUNT(p.id) AS cnt 
                    FROM
                      property p 
                    WHERE p.property_status_id = 10 
                      AND p.property_pending_date > '0000-00-00'
                      AND p.property_pending_date <= now()
                      AND p.id IN 
                      (SELECT 
                        property_id 
                      FROM
                        property_comment 
                      WHERE comment_by = '".$_SESSION['login']['id']."'
                      GROUP BY property_id)
                      ORDER BY p.property_pending_date ";   
            }
           
            $r = $db->query($sql);
            $istatus = $r->fetch(\PDO::FETCH_ASSOC);

            $sql = "SELECT 
                      COUNT(id) AS cnt 
                    FROM
                      enquiry_comment
                    WHERE user_remind = '".$_SESSION['login']['id']."' AND read_status = 'noread'  ";   
            $r = $db->query($sql);
            $iremind = $r->fetch(\PDO::FETCH_ASSOC);

            ?>
            <div class="navbar">
              <ul class="nav navbar-nav navbar-right">

                <?php
                $dsp_iremind = 'hide';
                if( $iremind["cnt"] > 0 )
                {
                    $dsp_iremind = 'show';
                ?>
                <li>
                    <a class="bell-alert" id="open-userremind" data-toggle="modal" data-target="#userremind-model" style="cursor:pointer; font-size:20px;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <span>[<?=$iremind["cnt"];?>]</span></a>
                </li>
                <?php
                }

                if( $_SESSION['login']["level"]["id"] == 1 || $_SESSION['login']["level"]["id"] == 2 )
                {
                ?>
                <li>
                    <a class="bell-alert" id="open-pending" data-toggle="modal" data-target="#pending-model" style="cursor:pointer; background: red;color:#fff; font-size:20px;"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span> <span>[<?=$istatus["cnt"];?>]</span></a>
                </li>
                <?php
                }
                ?>
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

            $("#open-pending").click(function() {
                $("#pending-model").toggleClass('show');
            });

            $("#open-userremind").click(function() {
                $("#userremind-model").toggleClass('show');
            });

            $("button[name=model-dismiss]").click(function() {
                closeModel();
            });
        });

        function closeModel()
        {
            $("#pending-model").removeClass('show').addClass('hide');
            $("#userremind-model").removeClass('show').addClass('hide');
        };

        function openModel()
        {
            $("#pending-model").removeClass('hide').addClass('show');
        };

    </script>

<!-- Modal -->
<div class="modal hide" id="pending-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="overflow: scroll;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" name="model-dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Properties Pending</h4>
      </div>
      <div class="modal-body">
        
        <?php
        if( $_SESSION["login"]["username"] == 'somporn' )
        {
            $sql = "SELECT p.*  FROM property p WHERE p.property_status_id = 10 AND p.property_pending_date > '0000-00-00' AND p.property_pending_date <= now()  ORDER BY p.property_pending_date ";  
        }
        else
        {
            $sql = "SELECT 
                  p.*
                FROM
                  property p 
                WHERE p.property_status_id = 10 
                  AND p.property_pending_date > '0000-00-00'
                  AND p.property_pending_date <= now()
                  AND p.id IN 
                  (SELECT 
                    property_id 
                  FROM
                    property_comment 
                  WHERE comment_by = '".$_SESSION['login']['id']."'
                  GROUP BY property_id)
                  ORDER BY p.property_pending_date ";   
        }

        $r = $db->query($sql);
        $items = $r->fetchAll(\PDO::FETCH_ASSOC);

        //print_r($items);

        ?>
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Create Date</th>
                <th>Update Date</th>
                <th>Pending Date</th>
                <th>Admin</th>
                <th>LINK</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach( $items as $item )
            {
            ?>
            <tr>
                <td><?=$item["reference_id"];?></td>
                <td><?=$item["created_at"];?></td>
                <td><?=$item["updated_at"];?></td>
                <td><?=$item["property_pending_date"];?></td>
                <td><?=getuseradmin($item["id"], $db);?></td>
                <td><a class="btn btn-info" href="properties#/edit/<?=$item["id"];?>" target="_blank">View</a></td>
            </tr>
            <?php
            }

            function getuseradmin($id, $db)
            {   
                $sql = " SELECT 
                  a.name
                FROM
                  property p , property_comment c, account a
                WHERE p.id = '".$id."'  AND p.id = c.property_id AND c.comment_by = a.id ORDER BY c.updated_at DESC LIMIT 1";  

                $r = $db->query($sql);
                $items = $r->fetch(\PDO::FETCH_ASSOC);

                return $items['name'];
            }

            ?>
            </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" name="model-dismiss" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal <?=$dsp_iremind;?>" id="userremind-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="overflow: scroll;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" name="model-dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">User #</h4>
      </div>
      <div class="modal-body">
        
        <?php
        $sql = "SELECT 
              *
            FROM
              enquiry_comment
            WHERE user_remind = '".$_SESSION['login']['id']."' AND read_status = 'noread'  ";   
           
        $r = $db->query($sql);
        $items = $r->fetchAll(\PDO::FETCH_ASSOC);

        //print_r($items);

        ?>
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>Enquiry Id</th>
                <th>Uploaded</th>
                <th>LINK</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach( $items as $item )
            {
            ?>
            <tr>
                <td><?=$item["enquiry_id"];?></td>
                <td><?=$item["updated_at"];?></td>
                <td><a class="btn btn-info" href="enquiries#/edit/<?=$item["enquiry_id"];?>" target="_blank">View</a></td>
            </tr>
            <?php
            }

            ?>
            </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" name="model-dismiss" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
$this->import("/admin/layout/footer");
