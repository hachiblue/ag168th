<link href="../public/app/enquiry/add.css" rel="stylesheet">

<div class="container" ng-controller="AddCTL">
  <form ng-submit="addSubmit()" ng-if="addStep==1">
		<!-- <ul class="nav nav-tabs tabs-add" >
    	<li class="active"><a href="">Enquiry</a></li>
    	<li><a href="">Match Property</a></li>
    	<li><a href="">Touring Report</a></li>
  	</ul> -->
		<!-- nav-tab-->

  	<div class="tab-content">
    	<div id="enquiry" class="tab-pane fade in active tab-1">
      		<!-- <div class="row detail-create">
            	<div class="col-md-5">
                	<div class="enq-id">
                    	<span><i class="id"><strong>Enquiry ID:</strong></i>
                        <i class="num-id">S07031520</i></span>
                        <i class="name-id">Rangsilkarn Maneerungraungroj</i>
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="remark">
                    	<i class="rm"><strong>Remark:</strong></i>
                    </div>
                </div>
                <div class="col-md-4">
                	<div class="rating">
                    	<i class="col-md-2 rat"><strong>Rating:</strong> N/A</i>
                        <ul class="col-md-2 member">
                        	<li>sale</li>
                            <li>customer</li>
                        </ul>
                    </div>
                </div>
            </div> -->
						<!--row-->
            <div class="row detail-type">
            	<div class="col-md-12 form-group">
                  <label class="require">Enquiry Type</label><strong>:</strong>
                  <select class="form-control" id="type" ng-model="form.enquiry_type_id" ng-init="form.enquiry_type_id=1" required>
                    <option value="1">Individual</option>
                    <option value="2">Investment</option>
                    <option value="3">Corporate</option>
                  </select>
							</div>
                <div class="col-md-7">
            			<div class="form-group">

                    <div class="col-sm-2">
                      <label class="require">Customer</label><strong>: </strong>
                    </div>

                    <div class="col-sm-10">
                      <div class="col-sm-4"><input type="text" class="form-control cbox" id="cname" placeholder="name" ng-model="form.ncustomer" required></div>
                      <div class="col-sm-4">
                        <div class="col-sm-3">
                          <input type="text" class="form-control cbox" id="ctel1" name="cphone" ng-model="form.t1customer" maxlength="3" required>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" class="form-control cbox" id="ctel2" name="cphone" ng-model="form.t2customer" maxlength="3" required>
                        </div>
                        <div class="col-sm-5">
                          <input type="text" class="form-control cbox" id="ctel3" name="cphone" ng-model="form.t3customer" maxlength="4" required>
                        </div>
                      </div>
                      <div class="col-sm-4"><input type="text" class="form-control cbox" id="cemail" placeholder="email, line id" ng-model="form.ecustomer"></div>
                    </div>



                    <!-- <br><small style="margin-left: 88px;">คั่นรายละเอียดการติดต่อด้วยลูกน้ำ " , "</small> --> 
                  </div>
            	</div>
                <!-- <div class="col-md-6">
									<div class="form-inline">
                  		<div class="form-group">
                            <label for="contact-sale">Contact (manager)</label><strong>: </strong>
                            <select class="form-contro class="require"l" id="contact" ng-model="form.sale_id">
															<option value="">Please select</option>
														</select>
                      </div>
                  </div>
									<div class="form-inline">
                  		<div class="form-group">
                            <label for="contact-sale">Contact (sale)</label><strong>: </strong>
                            <select class="form-control" id="contact" ng-model="form.sale_id">
															<option value="">Please select</option>
														</select>
                      </div>
                  </div>
            	  </div> -->
                <div class="col-md-12 hr"></div>

                <div class="col-md-6">
                	<div class="form-group">
                  		<i class="col-md-6 box-1"><label>Requirement Type</label><strong>:</strong></i>
                        <i class="col-md-5 box-2">
                        	<select class="form-control"
													ng-model="form.requirement_id"
													ng-options="item.id as item.name_for_enquiry for item in collection.requirement | filter: {id: '!4'}"
													ng-init="form.requirement_id=1"
                          required>
                        	</select>
                        </i>
                    </div>
                  	<div class="form-group">
                    	<i class="col-md-6 box-1"><label>Property Type</label><strong>:</strong></i>
                      	<i class="col-md-5 box-2">
                        	<select class="form-control"
													ng-model="form.property_type_id"
													ng-options="item.id as item.name for item in collection.property_type"
													ng-init="form.property_type_id=1"
													required>
                      		</select>
                    	</i>
                    </div>

                  	<div class="form-group">
                  		<i class="col-md-6 box-1"><label>Branch</label><strong>:</strong></i>
                  		<i class="col-md-5 box-2">
                        	<select class="form-control"
													ng-model="form.province_id"
													ng-options="item.id as item.name for item in thailocation.province"
													ng-init="form.province_id=1"
													required>
                  			</select>
                    	</i>
                  	</div>
                    <div class="form-group">
                  		<i class="col-md-6 box-1"><label>Project</label><strong>:</strong></i>
                  		<i class="col-md-5 box-2">
                        	<select chosen class="form-control"
													ng-model="form.project_id"
                          ng-change="formProjectIdChange()"
										      ng-options="item.id as item.name for item in collection.project"
													required>
                          <option value="">-Please Select-</option>
                  			</select>
                    	</i>
					          </div>
                    <div class="form-group">
            	        <i class="col-md-6 box-1"><label>Buying Budget</label><strong>:</strong></i>
           	            <i class="col-md-5 box-2">
       	                	<span><input type="text" class="form-control" ng-model="form.buy_budget_start"> to
                      		<input type="text" class="form-control" ng-model="form.buy_budget_end"></span>
                      	</i>
                    </div>
                    <div class="form-group">
            	        <i class="col-md-6 box-1"><label>Rental Budget</label><strong>:</strong></i>
           	            <i class="col-md-5 box-2">
       	                	<span><input type="text" class="form-control" ng-model="form.rent_budget_start"> to
                      		<input type="text" class="form-control" ng-model="form.rent_budget_end"></span>
                      	</i>
                    </div>
                    <div class="form-group">
            	       <i class="col-md-6 box-1"><strong>Zone: </strong></i>
                       <i class="col-md-5 box-2">
          	             <select class="form-control"
                         ng-model="form.zone_id"
                         ng-options="item.id as item.name group by getZoneGroupName(item.zone_group_id) for item in collection.zone"
                         >
                         <option value="">-Please Select-</option>
                         </select>
                    	</i>
					          </div>
                    <div class="form-group">
            	        <i class="col-md-6 box-1"><strong>Enquiry is the decision maker:</strong></i>
           	            <select class="form-control" style="width: 100px;" ng-mode="form.decision_maker">
           	              <option value="1">Yes</option>
           	              <option value="0">No</option>
           	            </select>
                    </div>

                    <div class="form-group">
            	       <i class="col-md-6 box-1"><strong>Period time to purchasing or leasing: </strong></i>
                       <i class="col-md-5 box-2">
                         <select class="form-control" ng-model="form.ptime_to_pol" required>
     	                    <option>Within a week</option>
                            <option>Within a month</option>
                            <option>Within 3 months</option>
                         </select>
                     	</i>
					          </div>
                </div><!--col-md-6-->
                <div class="col-md-6">
                	<div class="form-group">
            	        <i class="col-md-3 box-1"><strong>No. of bed Roooms: </strong></i>
           	            <i class="col-md-8 box-2">
       	                	<input type="text" class="form-control" ng-model="form.bedroom" ng-disabled="form.is_studio">
                      		<span><input type="checkbox" ng-model="form.is_studio" ng-change="vm.changeStudio()" ng-true-value="1" ng-false-value="0"> Studio</span>
                      	</i>
                    </div>
                  <div class="clearfix"></div>
                	<div class="form-group">
                 		<i class="col-md-3 box-1"><strong>Size: </strong></i>
                    	<i class="col-md-8 box-2">
                        	<input type="text" class="form-control" ng-model="form.size">
                  			<select class="form-control size" ng-model="form.size_unit_id" required>
                    			<option value="1">Sq. m.</option>
                    			<option value="2">Sq. wa</option>
                    			<option value="3">Rai</option>
                  			</select>
                    	</i>
                  	</div>
                    <div class="form-group">
                 		<i class="col-md-3 box-1"><strong>Nearest BTS: </strong></i>
                  		<i class="col-md-8 box-2">
                        	<select class="form-control"
                          ng-model="form.bts_id"
                          ng-options="item.id as item.name for item in collection.bts"
                          >
                    			<option value="">Please select</option>
                  			</select>
                  		</i>
                     </div>
                     <div class="form-group">
             	        <i class="col-md-3 box-1"><strong>Nearest MRT: </strong></i>
                        <i class="col-md-8 box-2">
    	                    <select class="form-control"
                          ng-model="form.mrt_id"
                          ng-options="item.id as item.name for item in collection.mrt"
                          >
                            <option value="">Please select</option>
                            </select>
                        </i>
                   	</div>
                    <div class="form-group">
                     <i class="col-md-3 box-1"><strong>Nearest Airport-link: </strong></i>
                       <i class="col-md-8 box-2">
                         <select class="form-control"
                         ng-model="form.airport_link_id"
                         ng-options="item.id as item.name for item in collection.airport_link"
                         >
                           <option value="">Please select</option>
                           </select>
                       </i>
                   </div>
                 <div class="clearfix"></div>
                    <div class="form-group">
            	       <i class="col-md-3 box-1"><strong>Status: </strong></i>
                       <i class="col-md-8 box-2">
          	             <select class="form-control"
                         ng-model="form.enquiry_status_id"
                         ng-options="item.id as item.name for item in collection.enquiry_status"
                         ng-init="form.enquiry_status_id=1"
                         required>
                         <option value="">Please select</option>
                         </select>
                     	</i>
					          </div>
                    <div class="form-group">
            	        <i class="col-md-3 box-1"><strong>Exact location required:</strong></i>
           	            <i class="col-md-8 box-2">
       	                	<textarea class="form-control" rows="2" id="comment" ng-model="form.ex_location"></textarea>
                      	</i>
                    </div>
                </div><!--col-md-6-->
                <hr class="clear-fix">
        	</div><!--detail-type-->
            <div class="row detail-type">
            	<div class="col-md-12 specific">
                	<div class="col-md-2">
                    	<p><label>Specific requirement</label><strong>:</strong></p>
                    </div>
                    <div class="col-md-3">
                    	<div><input type="checkbox" ng-model="form.sq_furnish" ng-true-value="1" ng-false-value="0"> Fully Furnish / ตกแต่งครบ</div>
                        <div><input type="checkbox" ng-model="form.sq_park" ng-true-value="1" ng-false-value="0"> Close park / ใกล้สวนสาธารณะ</div>
                        <div><input type="checkbox" ng-model="form.sq_airport" ng-true-value="1" ng-false-value="0"> Close airport / ใกล้สนามบิน</div>
                    </div>
                    <div class="col-md-3">
                    	<div><input type="checkbox" ng-model="form.sq_hospital" ng-true-value="1" ng-false-value="0"> Close to hospital / ใกล้โรงพยาบาล</div>
                        <div><input type="checkbox" ng-model="form.sq_bts" ng-true-value="1" ng-false-value="0"> Close to BTS/MRT / ติดรถไฟฟ้า</div>
                        <div><input type="checkbox" ng-model="form.sq_mainroad" ng-true-value="1" ng-false-value="0"> Close to main road / ติดถนนใหญ่</div>
                    </div>
                    <div class="col-md-3">
                    	<div><input type="checkbox" ng-model="form.sq_school" ng-true-value="1" ng-false-value="0"> Close school / University / ใกล้โรงเรียน</div>
                        <div><input type="checkbox" ng-model="form.sq_shopmall" ng-true-value="1" ng-false-value="0"> Close shopping mall / ใกล้ห้างสรรพสินค้า</div>
                        <div>Others / อื่นๆ <input type="text" ng-model="form.sq_other"> </div>
                    </div>
                </div>
            </div><!--detail-type-->
      		<div class="row detail-type">
            	<!-- <div class="col-md-12">
            	    <label>Source</label><strong>:</strong>
                    <select name="firstSelection" id="firstSelection"
                    ng-model="form.source_id"
                    ng-change="triggerChangeSource()"
                    disabled>
                        <option value="">--Select--</option>
                        <option value='1'>Online Marketing</option>
                        <option value='2'>Walkin</option>
                        <option value='3'>Call</option>
                        <option value='4'>Referal</option>
                        <option value='5'>Event</option>
                    </select>
                    <select name="secondSelection" id="online"
                    ng-show="form.source_id"
                    ng-model="form.sub_source_id"
                    ng-init="form.sub_source_id=1"
                     ng-change="triggerSource()"
                     required>
                        <option value="">--Select--</option>
                        <option value="1" ng-if="form.source_id==1">Website</option>
                        <option value="2" ng-if="form.source_id==1">Social Media</option>
                        <option value="3" ng-if="form.source_id==1">Online Ads.</option>
                        <option value="4" ng-if="form.source_id==1">Email</option>
                        <option value="5" ng-if="form.source_id==1">Line</option>line

                        <option value="6" ng-if="form.source_id==2">Site</option>
                        <option value="7" ng-if="form.source_id==2">Head ofince</option>

                        <option value="" ng-if="form.source_id==3">--Select--</option>
                        <option value="8" ng-if="form.source_id==3">Callcenter</option>
                        <option value="9" ng-if="form.source_id==3">Site</option>

                        <option value="10" ng-if="form.source_id==4">Friends</option>
                        <option value="11" ng-if="form.source_id==4">Customers</option>
                    </select>
					          <select name="thirdSelection" id="website"
                    ng-model="form.from_website_id"
                    ng-show="form.source_id==1 && form.sub_source_id==1">
                        <option value="">--Select--</option>
                        <option value="1">agent168th.com</option>
                        <option value="2">prakard.com</option>
                        <option value="3">thinkofliving.com</option>
                        <option value="4">ddproperty.com</option>
                        <option value="5">kobkid.com</option>
                        <option value="6">bangkokpost.com</option>
                    </select>
                </div> -->
                <!--col-md-12-->
                <div class="col-md-2 contact-type">
                	<label>Contact Type</label><strong>:</strong>
                    <select class="form-control" ng-model="form.contact_type_id">
                        <option value="">-Please select-</option>
                        <option value="1">Online</option>
                        <option value="2">Walkin</option>
                        <option value="3">Call</option>
                    </select>
                </div><!--col-md-12-->
                <div style="clear:both;"></div>
                <div class="col-md-2 contact-type">
                  <label>User List</label><strong>:</strong>
                  <select class="form-control"
                  ng-model="form.account"
                  ng-options="item.id*1 as item.name for item in collection.account"
                  required>
                    <option value="">-Please select-</option>
                  </select>
                </div>

                <div class="col-md-12 form-group">
                  <label>
                  	<strong>Remark.</strong>
                  </label>
                  <small>(กรุณาใส่รายละเอียดความต้องการของลูกค้าให้ครบถ้วน)</small>
                  <br>
                	<textarea ng-model="form.comment" class="form-control" rows="2" id="comment" style="min-height:80px; margin:10px 0 10px 10px; display: inline; vertical-align: middle;"></textarea>
                </div>
            </div><!--detail-type-->
            <div class="col-md-12 comment text-center" style="margin:20px 0; text-align:center;">
            	<!-- <label>Comment/Remark</label><strong>:</strong>
               	<textarea class="form-control" rows="2" id="comment" style="min-height:100px; margin-top:10px; margin-left:10px; width:1000px; display: inline; vertical-align: middle; background-color: #fff; padding:5px;"></textarea> -->
          	     <button class="btn btn-success update" type="submit" style="">Submit</button>
                 <a class="btn btn-warning update" type="button" href="#/">Cancel</a>
            </div>
    	</div><!--enquiry-->
  	</div><!--tab-conent-->
    <!-- <div>
      <pre>
      {{form}}
      </pre>
      <pre>
      {{vm}}
      </pre>
    </div> -->
  </form>
  <div ng-if="addStep==2">
    <form ng-submit="addForm3()">
      <div class="detail-type">
        Auto assign manager: <strong style="color: orange;">{{collection2.auto_assign.name}}</strong>
        <br>
        <button type="submit" class="btn btn-success">Auto Assign Manager</button>
      </div>
    </form>
    <form ng-submit="addForm2()">
      <div class="detail-type">
        <div class="form-group">
          <label>Assign manager</label>
          <select
          class="form-control"
          ng-model="form2.assign_manager_id"
          ng-options="item.id as item.name for item in collection2.accounts"
          >
          <option value="">-Please Select-</option>
          </select>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div><!--container-->
