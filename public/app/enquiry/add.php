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

				<div class="col-md-6">
					<div class="form-group">
						<label>Contact Phone</label><strong>:</strong>
						<input type="text" class="form-control" id="contact_phone" ng-model="form.contact_phone">
					</div>
				</div>

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

                    <div class="form-group" style="display:none;">
            	        <i class="col-md-6 box-1"><strong>Enquiry is the decision maker:</strong></i>
           	            <select class="form-control" style="width: 100px;" ng-mode="form.decision_maker">
           	              <option value="1">Yes</option>
           	              <option value="0">No</option>
           	            </select>
                    </div>

                    <div class="form-group" style="display:none;">
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
						<i class="col-md-3 box-1"><strong>Country: </strong></i>
						<i class="col-md-8 box-2">
							<select class="form-control" ng-model="form.country_id">
								<option value="" selected>-Please Select-</option>
								<option value="AF">Afghanistan</option>
								<option value="AX">Åland Islands</option>
								<option value="AL">Albania</option>
								<option value="DZ">Algeria</option>
								<option value="AS">American Samoa</option>
								<option value="AD">Andorra</option>
								<option value="AO">Angola</option>
								<option value="AI">Anguilla</option>
								<option value="AQ">Antarctica</option>
								<option value="AG">Antigua and Barbuda</option>
								<option value="AR">Argentina</option>
								<option value="AM">Armenia</option>
								<option value="AW">Aruba</option>
								<option value="AU">Australia</option>
								<option value="AT">Austria</option>
								<option value="AZ">Azerbaijan</option>
								<option value="BS">Bahamas</option>
								<option value="BH">Bahrain</option>
								<option value="BD">Bangladesh</option>
								<option value="BB">Barbados</option>
								<option value="BY">Belarus</option>
								<option value="BE">Belgium</option>
								<option value="BZ">Belize</option>
								<option value="BJ">Benin</option>
								<option value="BM">Bermuda</option>
								<option value="BT">Bhutan</option>
								<option value="BO">Bolivia, Plurinational State of</option>
								<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
								<option value="BA">Bosnia and Herzegovina</option>
								<option value="BW">Botswana</option>
								<option value="BV">Bouvet Island</option>
								<option value="BR">Brazil</option>
								<option value="IO">British Indian Ocean Territory</option>
								<option value="BN">Brunei Darussalam</option>
								<option value="BG">Bulgaria</option>
								<option value="BF">Burkina Faso</option>
								<option value="BI">Burundi</option>
								<option value="KH">Cambodia</option>
								<option value="CM">Cameroon</option>
								<option value="CA">Canada</option>
								<option value="CV">Cape Verde</option>
								<option value="KY">Cayman Islands</option>
								<option value="CF">Central African Republic</option>
								<option value="TD">Chad</option>
								<option value="CL">Chile</option>
								<option value="CN">China</option>
								<option value="CX">Christmas Island</option>
								<option value="CC">Cocos (Keeling) Islands</option>
								<option value="CO">Colombia</option>
								<option value="KM">Comoros</option>
								<option value="CG">Congo</option>
								<option value="CD">Congo, the Democratic Republic of the</option>
								<option value="CK">Cook Islands</option>
								<option value="CR">Costa Rica</option>
								<option value="CI">Côte d'Ivoire</option>
								<option value="HR">Croatia</option>
								<option value="CU">Cuba</option>
								<option value="CW">Curaçao</option>
								<option value="CY">Cyprus</option>
								<option value="CZ">Czech Republic</option>
								<option value="DK">Denmark</option>
								<option value="DJ">Djibouti</option>
								<option value="DM">Dominica</option>
								<option value="DO">Dominican Republic</option>
								<option value="EC">Ecuador</option>
								<option value="EG">Egypt</option>
								<option value="SV">El Salvador</option>
								<option value="GQ">Equatorial Guinea</option>
								<option value="ER">Eritrea</option>
								<option value="EE">Estonia</option>
								<option value="ET">Ethiopia</option>
								<option value="FK">Falkland Islands (Malvinas)</option>
								<option value="FO">Faroe Islands</option>
								<option value="FJ">Fiji</option>
								<option value="FI">Finland</option>
								<option value="FR">France</option>
								<option value="GF">French Guiana</option>
								<option value="PF">French Polynesia</option>
								<option value="TF">French Southern Territories</option>
								<option value="GA">Gabon</option>
								<option value="GM">Gambia</option>
								<option value="GE">Georgia</option>
								<option value="DE">Germany</option>
								<option value="GH">Ghana</option>
								<option value="GI">Gibraltar</option>
								<option value="GR">Greece</option>
								<option value="GL">Greenland</option>
								<option value="GD">Grenada</option>
								<option value="GP">Guadeloupe</option>
								<option value="GU">Guam</option>
								<option value="GT">Guatemala</option>
								<option value="GG">Guernsey</option>
								<option value="GN">Guinea</option>
								<option value="GW">Guinea-Bissau</option>
								<option value="GY">Guyana</option>
								<option value="HT">Haiti</option>
								<option value="HM">Heard Island and McDonald Islands</option>
								<option value="VA">Holy See (Vatican City State)</option>
								<option value="HN">Honduras</option>
								<option value="HK">Hong Kong</option>
								<option value="HU">Hungary</option>
								<option value="IS">Iceland</option>
								<option value="IN">India</option>
								<option value="ID">Indonesia</option>
								<option value="IR">Iran, Islamic Republic of</option>
								<option value="IQ">Iraq</option>
								<option value="IE">Ireland</option>
								<option value="IM">Isle of Man</option>
								<option value="IL">Israel</option>
								<option value="IT">Italy</option>
								<option value="JM">Jamaica</option>
								<option value="JP">Japan</option>
								<option value="JE">Jersey</option>
								<option value="JO">Jordan</option>
								<option value="KZ">Kazakhstan</option>
								<option value="KE">Kenya</option>
								<option value="KI">Kiribati</option>
								<option value="KP">Korea, Democratic People's Republic of</option>
								<option value="KR">Korea, Republic of</option>
								<option value="KW">Kuwait</option>
								<option value="KG">Kyrgyzstan</option>
								<option value="LA">Lao People's Democratic Republic</option>
								<option value="LV">Latvia</option>
								<option value="LB">Lebanon</option>
								<option value="LS">Lesotho</option>
								<option value="LR">Liberia</option>
								<option value="LY">Libya</option>
								<option value="LI">Liechtenstein</option>
								<option value="LT">Lithuania</option>
								<option value="LU">Luxembourg</option>
								<option value="MO">Macao</option>
								<option value="MK">Macedonia, the former Yugoslav Republic of</option>
								<option value="MG">Madagascar</option>
								<option value="MW">Malawi</option>
								<option value="MY">Malaysia</option>
								<option value="MV">Maldives</option>
								<option value="ML">Mali</option>
								<option value="MT">Malta</option>
								<option value="MH">Marshall Islands</option>
								<option value="MQ">Martinique</option>
								<option value="MR">Mauritania</option>
								<option value="MU">Mauritius</option>
								<option value="YT">Mayotte</option>
								<option value="MX">Mexico</option>
								<option value="FM">Micronesia, Federated States of</option>
								<option value="MD">Moldova, Republic of</option>
								<option value="MC">Monaco</option>
								<option value="MN">Mongolia</option>
								<option value="ME">Montenegro</option>
								<option value="MS">Montserrat</option>
								<option value="MA">Morocco</option>
								<option value="MZ">Mozambique</option>
								<option value="MM">Myanmar</option>
								<option value="NA">Namibia</option>
								<option value="NR">Nauru</option>
								<option value="NP">Nepal</option>
								<option value="NL">Netherlands</option>
								<option value="NC">New Caledonia</option>
								<option value="NZ">New Zealand</option>
								<option value="NI">Nicaragua</option>
								<option value="NE">Niger</option>
								<option value="NG">Nigeria</option>
								<option value="NU">Niue</option>
								<option value="NF">Norfolk Island</option>
								<option value="MP">Northern Mariana Islands</option>
								<option value="NO">Norway</option>
								<option value="OM">Oman</option>
								<option value="PK">Pakistan</option>
								<option value="PW">Palau</option>
								<option value="PS">Palestinian Territory, Occupied</option>
								<option value="PA">Panama</option>
								<option value="PG">Papua New Guinea</option>
								<option value="PY">Paraguay</option>
								<option value="PE">Peru</option>
								<option value="PH">Philippines</option>
								<option value="PN">Pitcairn</option>
								<option value="PL">Poland</option>
								<option value="PT">Portugal</option>
								<option value="PR">Puerto Rico</option>
								<option value="QA">Qatar</option>
								<option value="RE">Réunion</option>
								<option value="RO">Romania</option>
								<option value="RU">Russian Federation</option>
								<option value="RW">Rwanda</option>
								<option value="BL">Saint Barthélemy</option>
								<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
								<option value="KN">Saint Kitts and Nevis</option>
								<option value="LC">Saint Lucia</option>
								<option value="MF">Saint Martin (French part)</option>
								<option value="PM">Saint Pierre and Miquelon</option>
								<option value="VC">Saint Vincent and the Grenadines</option>
								<option value="WS">Samoa</option>
								<option value="SM">San Marino</option>
								<option value="ST">Sao Tome and Principe</option>
								<option value="SA">Saudi Arabia</option>
								<option value="SN">Senegal</option>
								<option value="RS">Serbia</option>
								<option value="SC">Seychelles</option>
								<option value="SL">Sierra Leone</option>
								<option value="SG">Singapore</option>
								<option value="SX">Sint Maarten (Dutch part)</option>
								<option value="SK">Slovakia</option>
								<option value="SI">Slovenia</option>
								<option value="SB">Solomon Islands</option>
								<option value="SO">Somalia</option>
								<option value="ZA">South Africa</option>
								<option value="GS">South Georgia and the South Sandwich Islands</option>
								<option value="SS">South Sudan</option>
								<option value="ES">Spain</option>
								<option value="LK">Sri Lanka</option>
								<option value="SD">Sudan</option>
								<option value="SR">Suriname</option>
								<option value="SJ">Svalbard and Jan Mayen</option>
								<option value="SZ">Swaziland</option>
								<option value="SE">Sweden</option>
								<option value="CH">Switzerland</option>
								<option value="SY">Syrian Arab Republic</option>
								<option value="TW">Taiwan, Province of China</option>
								<option value="TJ">Tajikistan</option>
								<option value="TZ">Tanzania, United Republic of</option>
								<option value="TH">Thailand</option>
								<option value="TL">Timor-Leste</option>
								<option value="TG">Togo</option>
								<option value="TK">Tokelau</option>
								<option value="TO">Tonga</option>
								<option value="TT">Trinidad and Tobago</option>
								<option value="TN">Tunisia</option>
								<option value="TR">Turkey</option>
								<option value="TM">Turkmenistan</option>
								<option value="TC">Turks and Caicos Islands</option>
								<option value="TV">Tuvalu</option>
								<option value="UG">Uganda</option>
								<option value="UA">Ukraine</option>
								<option value="AE">United Arab Emirates</option>
								<option value="GB">United Kingdom</option>
								<option value="US">United States</option>
								<option value="UM">United States Minor Outlying Islands</option>
								<option value="UY">Uruguay</option>
								<option value="UZ">Uzbekistan</option>
								<option value="VU">Vanuatu</option>
								<option value="VE">Venezuela, Bolivarian Republic of</option>
								<option value="VN">Viet Nam</option>
								<option value="VG">Virgin Islands, British</option>
								<option value="VI">Virgin Islands, U.S.</option>
								<option value="WF">Wallis and Futuna</option>
								<option value="EH">Western Sahara</option>
								<option value="YE">Yemen</option>
								<option value="ZM">Zambia</option>
								<option value="ZW">Zimbabwe</option>	
							</select>
						</i>
					</div>

                    <div class="form-group" style="display:none;">
            	        <i class="col-md-3 box-1"><strong>Exact location required:</strong></i>
           	            <i class="col-md-8 box-2">
       	                	<textarea class="form-control" rows="2" id="comment" ng-model="form.ex_location"></textarea>
                      	</i>
                    </div>
                </div><!--col-md-6-->
                <hr class="clear-fix">
        	</div><!--detail-type-->

            <div class="row detail-type" style="display:none;">
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
                <div class="col-md-2"></div>
                <div class="col-md-2 contact-type" style="display:none;">
                	<label>Contact Type</label><strong>:</strong>
                    <select class="form-control" ng-model="form.contact_type_id">
                        <option value="">-Please select-</option>
                        <option value="1">Online</option>
                        <option value="2">Walkin</option>
                        <option value="3">Call</option>
                    </select>
                </div><!--col-md-12-->
                
               <div class="col-md-2 col-md-offset-1 contact-type">
                    <br><label><input type="checkbox" id="chk1" ng-true-value="'Y'" ng-false-value="'N'" ng-model="form.chk1"> Agent 168</label>
                </div><!--col-md-12-->

                <div class="col-md-2 contact-type">
                    <br><label><input type="checkbox" id="chk2" ng-true-value="'Y'" ng-false-value="'N'" ng-model="form.chk2"> Hotstock</label>
                </div><!--col-md-12-->

                <div class="col-md-2 contact-type">
                    <br><label><input type="checkbox" id="chk3" ng-true-value="'Y'" ng-false-value="'N'" ng-model="form.chk3"> Individual</label>
                </div><!--col-md-12-->

                <div class="col-md-2 col-md-offset-1 contact-type">
                  <label>User List</label><strong>:</strong>
                  <select class="form-control"
                  ng-model="form.account"
                  ng-options="item.id*1 as item.name for item in collection.account">
                    <option value="">-Please select-</option>
                  </select>
                </div>

                <div style="clear:both;"></div>

                <div class="col-sm-3 col-sm-offset-3">
                    <select class="form-control" ng-model="form.contact_method">
                        <option value="" selected>-Please select-</option>
                        <option value="Tel">Tel</option>
                        <option value="Line">Line</option>
                        <option value="Email">Email</option>
                    </select>
                </div>

                <div style="clear:both;"></div>

                <div class="col-sm-3 col-sm-offset-3">
                    <input type="text" class="form-control cbox" id="cwebsite" name="cwebsite" ng-model="form.website" placeholder="Website">
                </div>

                <div class="col-md-12 form-group">
                  <label>
                  	<strong>Remark.</strong>
                  </label>
                  <small>(กรุณาใส่รายละเอียดความต้องการของลูกค้าให้ครบถ้วน)</small>
                  <br>
                	<textarea ng-model="form.comment" class="form-control" rows="2" id="bt_comment" style="min-height:80px; margin:10px 0 10px 10px; display: inline; vertical-align: middle;"></textarea>
                  &nbsp;&nbsp;(<span id="cnt_comment">0</span>/400) 
                </div>


                <div class="col-md-12 form-group">
                  <label>
                    <strong>Plan.</strong>
                  </label>
                  <small>(กรุณาใส่รายละเอียดความต้องการของลูกค้าให้ครบถ้วน)</small>
                  <br>
                  <textarea ng-model="form.plan" class="form-control" rows="2" id="bt_plan" style="min-height:80px; margin:10px 0 10px 10px; display: inline; vertical-align: middle;"></textarea>
                  &nbsp;&nbsp;(<span id="cnt_plan">0</span>/400) 
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
