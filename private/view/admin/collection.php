<?php
/**
 *  collection.php
 *  Project : bc
 *
 *  Created by Issarapong Wongyai on 18/3/2558 10:41
 *  Copyright 2015 Issarapong Wongyai. All rights reserved.
 *
 *
 */

use Main\ThirdParty\Xcrud\Xcrud;

?>
<style>
    .nav > li.active , .nav > li:hover , .nav > li:focus {
        color: inherit;
        background-color: rgba(0,0,0,.1);
    }
</style>
<div id="content">
    <div class="bs-component">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#accountLevel" data-toggle="tab">Account Level</a></li>
            <li><a href="#propertyType" data-toggle="tab">Property Type</a></li>
            <li><a href="#zone_group" data-toggle="tab">Zone Group</a></li>
            <li><a href="#zone" data-toggle="tab">Zone</a></li>
            <li><a href="#requirementType" data-toggle="tab">Requirement Type</a></li>
            <li><a href="#status" data-toggle="tab">Status</a></li>
            <li><a href="#project" data-toggle="tab">Developer</a></li>
            <li><a href="#specificArea" data-toggle="tab">Specific Area</a></li>
            <li><a href="#role" data-toggle="tab">Role</a></li>
            <li><a href="#roomType" data-toggle="tab">Room Type</a></li>
            <li><a href="#sizeType" data-toggle="tab">Size Unit</a></li>
            <li><a href="#BtsMrtBrt" data-toggle="tab">BTS / MRT / BRT</a></li>
            <li><a href="#specificReq" data-toggle="tab">Specific Req</a></li>
        </ul>
        <div id="my-tab-content" class="tab-content">
            <div class="tab-pane active" id="accountLevel">
                <div id="accountLevelAdd" class="crudAdd">
                    <h2><i class="mdi-action-face-unlock"></i> Account Level</h2>
                    <?php
                    $xcrud2 = Xcrud::get_instance();
                    $xcrud2->table('level');
                    $xcrud2->unset_title();
                    $xcrud2->table_name('Account Level');
                    $xcrud2->relation('role_id', 'role', 'id', 'name');
                    $xcrud2->fields('name, role_id');
                    $xcrud2->label('role_id','Role');
                    $xcrud2->hide_button('save_return,return,save_edit');
                    $xcrud2->set_lang('save_new', 'Add');
                    echo $xcrud2->render('create');
                    ?>
                </div>
                <div id="accountLevelShow" class="crudShow">
                    <?php
                    $xcrud1 = Xcrud::get_instance();
                    $xcrud1->table('level');
                    $xcrud1->unset_title();
                    $xcrud1->relation('role_id', 'role', 'id', 'name');
                    $xcrud1->label('role_id','Role');
                    $xcrud1->columns('name, role_id');

                    $xcrud1->hide_button('add');
                    $xcrud1->hide_button('save_edit,save_new');
                    $xcrud1->remove_confirm(false);
                    echo $xcrud1->render();
                    ?>
                </div>

            </div>
            <div class="tab-pane fade" id="propertyType" >
                <div id="propertyTypeAdd" class="crudAdd">
                    <?php
                    $property_type1 = Xcrud::get_instance();
                    $property_type1->table('property_type');
                    $property_type1->table_name('Property Type');
                    $property_type1->fields('code,name');
                    $property_type1->hide_button('save_return,return,save_edit');
                    $property_type1->set_lang('save_new', 'Add');
                    echo $property_type1->render('create');
                    ?>
                </div>
                <div id="propertyTypeShow" class="crudShow">
                    <?php
                    $property_type2 = Xcrud::get_instance();
                    $property_type2->table('property_type');
                    $property_type2->unset_title();
                    $property_type2->column_width('code', '10%');
                    $property_type2->hide_button('add');
                    $property_type2->hide_button('save_edit,save_new');
                    echo $property_type2->render();
                    ?>
                </div>
            </div>
            <!-- Zone Group -->
            <div class="tab-pane fade" id="zone_group">
                <h1>Zone</h1>
                <div class="crudAdd">
                    <h2><i class="mdi-action-face-unlock"></i> Zone Group</h2>
                    <?php
                    $xcrud2 = Xcrud::get_instance();
                    $xcrud2->table('zone_group');
                    $xcrud2->unset_title();
                    $xcrud2->table_name('Zone Group');

                    $xcrud2->relation('province_id', 'provinces', 'PROVINCE_ID', 'PROVINCE_NAME');
                    $xcrud2->fields('name, province_id, Zones');
                    $xcrud2->label('province_id','Province');

                    $xcrud2->fk_relation('Zones','id','zone_zone_group','zone_group_id','zone_id','zone','id',array('id','name'));

                    $xcrud2->hide_button('save_return,return,save_edit');
                    $xcrud2->set_lang('save_new', 'Add');
                    echo $xcrud2->render('create');
                    ?>
                </div>
                <div class="crudShow">
                    <?php
                    $xcrud1 = Xcrud::get_instance();
                    $xcrud1->table('zone_group');
                    $xcrud1->unset_title();

                    $xcrud1->relation('province_id', 'provinces', 'PROVINCE_ID', 'PROVINCE_NAME');
                    $xcrud1->label('province_id','Province');
                    $xcrud1->columns('name, province_id');

                    $xcrud1->fk_relation('Zones','id','zone_zone_group','zone_group_id','zone_id','zone','id',array('id','name'));
                    $xcrud1->fields('name, province_id, Zones');

                    $xcrud1->hide_button('add');
                    $xcrud1->hide_button('save_edit,save_new');
                    $xcrud1->remove_confirm(false);
                    echo $xcrud1->render();
                    ?>
                </div>
            </div>

            <!-- Zone -->
            <div class="tab-pane fade" id="zone">
                <h1>Zone</h1>
                <div class="crudAdd">
                    <h2><i class="mdi-action-face-unlock"></i> Account Level</h2>
                    <?php
                    $xcrud2 = Xcrud::get_instance();
                    $xcrud2->table('zone');
                    $xcrud2->unset_title();
                    $xcrud2->table_name('Zone');

//                    $xcrud2->relation('zone_group_id', 'zone_group', 'id', 'name');
//                    $xcrud2->fields('name, zone_group_id');
//                    $xcrud2->label('zone_group_id','Zone Group');

                    $xcrud2->hide_button('save_return,return,save_edit');
                    $xcrud2->set_lang('save_new', 'Add');
                    echo $xcrud2->render('create');
                    ?>
                </div>
                <div class="crudShow">
                    <?php
                    $xcrud1 = Xcrud::get_instance();
                    $xcrud1->table('zone');
                    $xcrud1->unset_title();

//                    $xcrud1->relation('zone_group_id', 'zone_group', 'id', 'name');
//                    $xcrud1->label('zone_group_id','Zone Group');
//                    $xcrud1->columns('name, zone_group_id');

                    $xcrud1->hide_button('add');
                    $xcrud1->hide_button('save_edit,save_new');
                    $xcrud1->remove_confirm(false);
                    echo $xcrud1->render();
                    ?>
                </div>
            </div>

            <!-- requirementType -->
            <div class="tab-pane fade" id="requirementType">
                <h2><i class="mdi-action-face-unlock"></i> Requirement Type</h2>
                <div id="requirementTypeAdd" class="crudAdd">
                    <?php
                    // $requirementType1 = Xcrud::get_instance();
                    // $requirementType1->table('requirement_type');
                    // $requirementType1->unset_title();
                    // $requirementType1->fields('name,name_for_enquiry');
                    // $requirementType1->hide_button('save_return,return,save_edit');
                    // $requirementType1->set_lang('save_new', 'Add');
                    // echo $requirementType1->render('create');
                    ?>
                </div>
                <div id="requirementTypeShow" class="crudShow">
                    <?php
                    // $requirementType2 = Xcrud::get_instance();
                    // $requirementType2->table('requirement_type');
                    // $requirementType2->unset_title();
                    // $requirementType2->columns('name,name_for_enquiry');
                    // $requirementType2->hide_button('add');
                    // $requirementType2->hide_button('save_edit,save_new');
                    // $requirementType2->remove_confirm(false);
                    // echo $requirementType2->render();
                    ?>
                </div>
            </div>
            <div class="tab-pane fade" id="status">
                <h2><i class="mdi-action-face-unlock"></i> Status</h2>
                <div id="statusAdd" class="crudAdd">
                    <?php
                    $requirementType1 = Xcrud::get_instance();
                    $requirementType1->table('status_type');
                    $requirementType1->unset_title();
                    $requirementType1->fields('name,description');
                    $requirementType1->hide_button('save_return,return,save_edit');
                    $requirementType1->set_lang('save_new', 'Add');
                    echo $requirementType1->render('create');
                    ?>
                </div>
                <div id="statusShow" class="crudShow">
                    <?php
                    $requirementType2 = Xcrud::get_instance();
                    $requirementType2->table('status_type');
                    $requirementType2->unset_title();
                    $requirementType2->columns('name,description');
                    $requirementType2->hide_button('add');
                    $requirementType2->hide_button('save_edit,save_new');
                    $requirementType2->remove_confirm(false);
                    echo $requirementType2->render();
                    ?>
                </div>
            </div>
            <div class="tab-pane fade" id="project">
                <h2><i class="mdi-action-face-unlock"></i> Developer</h2>
                <div id="projectAdd" class="crudAdd">
                    <?php
                    $projectType1 = Xcrud::get_instance();
                    $projectType1->table('developer');
                    $projectType1->unset_title();
                    $projectType1->fields('name');
                    $projectType1->hide_button('save_return,return,save_edit');
                    $projectType1->set_lang('save_new', 'Add');
                    echo $projectType1->render('create');
                    ?>
                </div>
                <div id="projectShow" class="crudShow">
                    <?php
                    $projectType2 = Xcrud::get_instance();
                    $projectType2->table('developer');
                    $projectType2->unset_title();
                    $projectType2->columns('name');
                    $projectType2->hide_button('add');
                    $projectType2->hide_button('save_edit,save_new');
                    $projectType2->remove_confirm(false);
                    echo $projectType2->render();
                    ?>
                </div>
            </div>
            <div class="tab-pane fade" id="specificArea">
                <h2><i class="mdi-action-face-unlock"></i> Specific Area</h2>
                <div id="specificAreaAdd" class="crudAdd">
                    <?php
                    $specificArea1 = Xcrud::get_instance();
                    $specificArea1->table('specific_area');
                    $specificArea1->unset_title();
                    $specificArea1->fields('name');
                    $specificArea1->hide_button('save_return,return,save_edit');
                    $specificArea1->set_lang('save_new', 'Add');
                    echo $specificArea1->render('create');
                    ?>
                </div>
                <div id="specificAreaShow" class="crudShow">
                    <?php
                    $specificArea2 = Xcrud::get_instance();
                    $specificArea2->table('specific_area');
                    $specificArea2->unset_title();
                    $specificArea2->columns('name');
                    $specificArea2->hide_button('add');
                    $specificArea2->hide_button('save_edit,save_new');
                    $specificArea2->remove_confirm(false);
                    echo $specificArea2->render();
                    ?>
                </div>
            </div>
            <div class="tab-pane fade" id="role">
                <h1>Role</h1>
                <div id="specificAreaAdd" class="crudAdd">
                    <?php
                    $specificArea1 = Xcrud::get_instance();
                    $specificArea1->table('role');
                    $specificArea1->unset_title();
                    $specificArea1->fields('name,menu');
                    $specificArea1->hide_button('save_return,return,save_edit');
                    $specificArea1->set_lang('save_new', 'Add');
                    echo $specificArea1->render('create');
                    ?>
                </div>
                <div id="specificAreaShow" class="crudShow">
                    <?php
                    $specificArea2 = Xcrud::get_instance();
                    $specificArea2->table('role');
                    $specificArea2->unset_title();
                    $specificArea2->columns('name,menu');
                    $specificArea2->hide_button('add');
                    $specificArea2->hide_button('save_edit,save_new');
                    $specificArea2->remove_confirm(false);
                    echo $specificArea2->render();
                    ?>
                </div>
            </div>
            <div class="tab-pane fade" id="roomType">
                <h2><i class="mdi-action-face-unlock"></i> Room Type</h2>
                <div id="roomTypeAdd" class="crudAdd">
                    <?php
                    $room_type1 = Xcrud::get_instance();
                    $room_type1->table('room_type');
                    $room_type1->unset_title();
                    $room_type1->fields('name');
                    $room_type1->hide_button('save_return,return,save_edit');
                    $room_type1->set_lang('save_new', 'Add');
                    echo $room_type1->render('create');
                    ?>
                </div>
                <div id="roomTypeShow" class="crudShow">
                    <?php
                    $room_type2 = Xcrud::get_instance();
                    $room_type2->table('room_type');
                    $room_type2->unset_title();
                    $room_type2->columns('name');
                    $room_type2->hide_button('add');
                    $room_type2->hide_button('save_edit,save_new');
                    $room_type2->remove_confirm(false);
                    echo $room_type2->render();
                    ?>
                </div>
            </div>
            <div class="tab-pane fade" id="sizeType">
                <h2><i class="mdi-action-face-unlock"></i> Size Unit</h2>
                <div id="sizeTypeAdd" class="crudAdd">
                    <?php
                    $sizeType1 = Xcrud::get_instance();
                    $sizeType1->table('size_unit');
                    $sizeType1->unset_title();
                    $sizeType1->fields('name');
                    $sizeType1->hide_button('save_return,return,save_edit');
                    $sizeType1->set_lang('save_new', 'Add');
                    echo $sizeType1->render('create');
                    ?>
                </div>
                <div id="sizeTypeShow" class="crudShow">
                    <?php
                    $sizeType2 = Xcrud::get_instance();
                    $sizeType2->table('size_unit');
                    $sizeType2->unset_title();
                    $sizeType2->columns('name');
                    $sizeType2->hide_button('add');
                    $sizeType2->hide_button('save_edit,save_new');
                    $sizeType2->remove_confirm(false);
                    echo $sizeType2->render();
                    ?>
                </div>
            </div>
            <div class="tab-pane" id="BtsMrtBrt">
                <h1>BTS / MRT / BRT</h1>

                <p>blue blue blue blue blue</p>
            </div>
            <div class="tab-pane fade" id="specificReq">
                <h2><i class="mdi-action-face-unlock"></i> Specific Requirement</h2>
                <div id="specificReqAdd" class="crudAdd">
                    <?php
                    $specificReq1 = Xcrud::get_instance();
                    $specificReq1->table('specific_req');
                    $specificReq1->unset_title();
                    $specificReq1->fields('name');
                    $specificReq1->hide_button('save_return,return,save_edit');
                    $specificReq1->set_lang('save_new', 'Add');
                    echo $specificReq1->render('create');
                    ?>
                </div>
                <div id="specificReqShow" class="crudShow">
                    <?php
                    $specificReq2 = Xcrud::get_instance();
                    $specificReq2->table('specific_req');
                    $specificReq2->unset_title();
                    $specificReq2->columns('name');
                    $specificReq2->hide_button('add');
                    $specificReq2->hide_button('save_edit,save_new');
                    $specificReq2->remove_confirm(false);
                    echo $specificReq2->render();
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>
<link href="<?php echo \Main\Helper\URL::absolute("/bower_components/select2/select2.css");?>" rel="stylesheet" />
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/select2/select2.min.js");?>"></script>
<script type="text/javascript">
    function fetchSelectMultiple(){
        $('select[multiple] > option[value=""]').remove();
        $('select[multiple]').select2();
    }
    fetchSelectMultiple();

    $(document).ready(function ($) {
        $('#tabs').tab();
    });
    $(document).on("xcrudafterrequest", function (event, container) {
        console.log(event);
        var c = jQuery(container).closest('.tab-pane');
        var i = $('.tab-pane').index(c);
        if (jQuery(container).closest(".crudAdd").size()) {
           Xcrud.reload('.tab-pane:eq('+i+') div.crudShow div.xcrud');
        }
        fetchSelectMultiple();
    });
    $.fn.stickyTabs = function() {
        context = this

        // Show the tab corresponding with the hash in the URL, or the first tab.
        var showTabFromHash = function() {
            var hash = window.location.hash;
            var selector = hash ? 'a[href="' + hash + '"]' : 'li:first-child a';
            $(selector, context).tab('show');
        }

        // Set the correct tab when the page loads
        showTabFromHash(context)

        // Set the correct tab when a user uses their back/forward button
        window.addEventListener('hashchange', showTabFromHash, false);

        // Change the URL when tabs are clicked
        $('a', context).on('click', function(e) {
            history.pushState(null, null, this.href);
        });

        return this;
    };
    $('.nav-tabs').stickyTabs();
</script>
