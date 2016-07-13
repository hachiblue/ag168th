<?php
$this->import('/layout/header');
$db = \Main\DB\Medoo\MedooFactory::getInstance();
$provinces = $db->select("province", "*");
$proptypes = $db->select("property_type", "*");
?>

<style>



    .al.start .allLetter{
        opacity: 0;
        -ms-transform: translateY(1000px);
        -webkit-transform: translateY(1000px);
        transform: translateY(1000px);

    }

    .al{

    }

    .allLetter{
        transition: 2s ease;
    }


    .interest{
        color: #FF0000;
        display: inline-block;
    }

    .letter{
        text-align: center;
        position: absolute;
        z-index: 10;
        margin-top: -450px;
        margin-left: 155px;
        color: #1957a4;
        transition: 2s;
        transition-delay: 0.04s;
    }

    .labelText {
        display: inline-block;
        width: 180px;
        text-align: left;
        vertical-align: top;
        margin-left: 50px;
    }

    .formRight{
        display: inline-block;
    }

    .formClass {
        padding-top: 10px;
        font-size: 18px;
    }

    .textareaClass {
        resize: none;
        width: 200px;
    }

    .selected{
        width: 200px;
    }
    .divRight {
        text-align: right;
        margin-top: 7px;
    }

    .textLetter{
        font-size: 24px;
    }

    .textLetter2{
        font-size: 16px;
    }


</style>

<div class="container">
    <div class=" col-md-8" >
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs" style="margin-left: 45px">
            <li class="active"><a href="#first" data-toggle="tab" id="tab1">Property Information</a></li>
            <li><a href="#second" data-toggle="tab" id="tab2">Contact Information</a></li>
            <li><a href="#third" data-toggle="tab" id="tab3">Finish</a></li>
        </ul>
        <form method="post" enctype="multipart/form-data">
        <div id="my-tab-content" class="tab-content">
            <div class="tab-pane active" id="first">
                    <div class="formClass">
                        <div class="labelText">
                            Property is :<div class="interest">*</div>
                        </div>
                        <div class="formRight">
                            <label class="radio-inline"><input name="requirement" value="For Sale" type="radio" name="saleRent" required checked>For Sale</label>
                            <label class="radio-inline"><input name="requirement" value="For Rent" type="radio" name="saleRent" required>For Rent</label>
                            <label class="radio-inline"><input name="requirement" value="For Sale/Rent" type="radio" name="saleRent" required>For Sale/Rent</label>
                        </div>
                    </div>

                    <div class="formClass">
                        <div class="labelText">
                            Province :
                        </div>
                        <div class="formRight">
                            <select name="province" class="form-control selected" required>
                                <option></option>
                                <?php foreach($provinces as $pv) {?>
                                <option><?php echo $pv["name"];?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="interest">*</div>
                    </div>

                    <div class="formClass">
                        <div class="labelText">
                            Property Type :
                        </div>
                        <div class="formRight">
                            <select name="property_type" class="form-control selected" required>
                                <option></option>
                                <?php foreach($proptypes as $pt) {?>
                                <option><?php echo $pt["name"];?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="interest">*</div>
                    </div>

                    <div class="formClass" id="selling">
                        <div class="labelText">
                            Selling Price :
                        </div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <input type="text" name="sell_price" class="form-control selected">
                            </div>
                        </div>
                        <div class="interest">*</div>
                    </div>

                    <div class="formClass" id="rental">
                        <div class="labelText">
                            Rental Price / Month :
                        </div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <input type="text" name="rent_price" class="form-control selected">
                            </div>
                        </div>
                        <div class="interest">*</div>
                    </div>

                    <div class="formClass">
                        <div class="labelText"></div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <div class="interest">The minimum price we would accept is 1,500,000<br>
                                    Bath and 13,000 Bath for sale and rent<br>
                                    respectively.</div>
                            </div>
                        </div>
                    </div>

                    <div class="formClass">
                        <div class="labelText">
                            Project name :
                        </div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <input type="text" name="project" class="form-control selected">
                            </div>
                        </div>
                    </div>

                    <div class="formClass">
                        <div class="labelText">
                            Unit No. & Address :
                        </div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <input type="text" name="unit_no" class="form-control selected" required>
                            </div>
                        </div>
                        <div class="interest">*</div>
                    </div>

                    <div class="formClass">
                        <div class="labelText">
                            Size (Sq.m.) :
                        </div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <input type="text" name="size" class="form-control selected" required>
                            </div>
                        </div>
                        <div class="interest">*</div>
                    </div>

                    <div class="formClass">
                        <div class="labelText">
                            Floor No. :
                        </div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <select name="floor" class="form-control selected" required>
                                    <option></option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                    <option>13</option>
                                    <option>14</option>
                                    <option>15</option>
                                </select>
                            </div>
                        </div>
                        <div class="interest">*</div>
                    </div>

                    <div class="formClass">
                        <div class="labelText">
                            No. of Bedroom :
                        </div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <select name="bedroom" class="form-control selected">
                                    <option></option>
                                    <option>Studio</option>
                                    <option>1 Bedroom</option>
                                    <option>2 Bedrooms</option>
                                    <option>3 Bedrooms</option>
                                    <option>4 Bedrooms</option>
                                    <option>5 Bedrooms</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="formClass">
                        <div class="labelText">
                            No. of Bathroom :
                        </div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <select name="bathroom" class="form-control selected">
                                    <option></option>
                                    <option>1 Bathroom</option>
                                    <option>2 Bathrooms</option>
                                    <option>3 Bathrooms</option>
                                    <option>4 Bathrooms</option>
                                    <option>5 Bathrooms</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="formClass">
                        <div class="labelText">
                            Full Description :
                        </div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <textarea name="description" rows="3" cols="50" class="textareaClass form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="formClass">
                        <div class="labelText">
                            Upload a photo :
                        </div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <div>
                                    <a id="img-a" class="btn btn-primary">SELECT FILE</a>
                                    <span id="img-name"></span>
                                    <input type="file" name="image" id="img-input" style="display: none;" />
                                </div>Allow .jpg .gif .png and Max file size per image is not 1Mb
                            </div>
                        </div>
                    </div>

                    <div class="formClass">
                        <div class="labelText"></div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <div>
                                    <a class="btn btn-default" id="step1">Next Step</a>
                                </div>
                            </div>
                        </div>
                        <br><br><br>
                    </div>
            </div>

            <div class="tab-pane" id="second">
                    <div class="formClass">
                        <div class="labelText">
                            Title :
                        </div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <select name="title" class="form-control selected">
                                    <option value="">Not Specific</option>
                                    <option>Mr.</option>
                                    <option>Miss</option>
                                    <option>Mrs.</option>
                                    <option>Dr.</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="formClass">
                        <div class="labelText">
                            First Name :
                        </div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <input name="first_name" type="text" class="form-control selected" required>
                            </div>
                        </div>
                        <div class="interest">*</div>
                    </div>

                    <div class="formClass">
                        <div class="labelText">
                            Last Name :
                        </div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <input name="last_name" type="text" class="form-control selected" required>
                            </div>
                        </div>
                        <div class="interest">*</div>
                    </div>

                    <div class="formClass">
                        <div class="labelText">
                            E-mail :
                        </div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <input name="email" type="text" class="form-control selected" required>
                            </div>
                        </div>
                        <div class="interest">*</div>
                    </div>

                    <div class="formClass">
                        <div class="labelText">
                            Mobile No. :
                        </div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <input name="mobile_no" type="text" class="form-control selected" required>
                            </div>
                        </div>
                        <div class="interest">*</div>
                    </div>

                    <div class="formClass">
                        <div class="labelText">
                            Telephone No. :
                        </div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <input name="phone" type="text" class="form-control selected">
                            </div>
                        </div>
                    </div>
                    <hr style="float: left;width: 52%;margin-left: 50px">
                    <br><br><br><br>
                    <div class="formClass">
                        <div class="labelText"></div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <div class="selected">How do you know our company?</div>
                            </div>
                        </div>
                        <div class="interest">*</div>
                    </div>

                    <div class="formClass">
                        <div class="labelText"></div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <select name="how_know_company" class="form-control selected" required>
                                    <option></option>
                                    <option>Search Engine</option>
                                    <option>Other Website</option>
                                    <option>Email</option>
                                    <option>SMS</option>
                                    <option>Brochure</option>
                                    <option>Direct Mail</option>
                                    <option>Magazine</option>
                                    <option>Newspaper</option>
                                    <option>Billboard</option>
                                    <option>Referrals</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="formClass">
                        <div class="labelText"></div>
                        <div class="formRight">
                            <div class="formRight   formWidth ">
                                <div>
                                    <a class="btn btn-default" id="backBTN"><< back</a> <button href="#" class="btn btn-primary" id="step2">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="formClass">
                        <div class="labelText" style="padding-left: 185px;">

                        </div>
                    </div>
                <br><br>
            </div>

            <div class="tab-pane " id="third">
                <div class="al start">
                    <div class="allLetter">
                        <img src="<?php echo \Main\Helper\URL::absolute("/public/images/letter.png")?>">
                        <div class="letter">
                                <div class="textLetter">THANK YOU!</div>
                                <div class="textLetter2">
                                    you for trusting us with your property. We will be taking great<br>
                                    care in handing your request and will respond promptly as soon as<br>
                                    we find your match.
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </form>
    </div>
    <div class="col-md-4 divRight">
        <?php
            $this->import('/rightProperty');
        ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#step1").click(function(e){
          $("#tab2").click();
          return false;
        });
        $("#tab2").click(function(e){
            var isAll = true;
            $('#first input, #first select').filter('[required]').each(function(index, el){
              var $el = $(el);
              var val = $.trim($el.val());
              if(!val) {
                $el.focus();
                alert('require ' + $el.attr('name'));
                isAll = false;
                return false;
              }
            });
            if(!isAll) {
              return false;
            }
        });
        $("#step2").click(function(e){ $("#tab3").click(); return false; });
        $("#tab3").click(function(){
            // second
            var isAll = true;
            $('#second input, #second select').filter('[required]').each(function(index, el){
              var $el = $(el);
              var val = $.trim($el.val());
              if(!val) {
                $el.focus();
                alert('require ' + $el.attr('name'));
                isAll = false;
                return false;
              }
            });
            if(isAll) {
              $("#tab3").click();
            }
            else {
              return false;
            }
        });

        $('#backBTN').click(function(e){
          e.preventDefault();
          $('#tab1').click();
          return false;
        });
    });
</script>

<script>
    function isElementInViewport(elem) {
        var $elem = $(elem);

        // Get the scroll position of the page.
        var scrollElem = ((navigator.userAgent.toLowerCase().indexOf('webkit') != -1) ? 'body' : 'html');
        var viewportTop = $(scrollElem).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        // Get the position of the element on the page.
        var elemTop = Math.round( $elem.offset().top );
        var elemBottom = elemTop + $elem.height();

        console.log(elemTop, viewportTop);

        return ((elemTop < viewportBottom) && (elemBottom > viewportTop));
    }
    $(function(){
        $('#tab3').click(function(){
//            var el = $('.allLetter');
//            if(isElementInViewport(el)){
                setTimeout(function(){
                    $('.al').removeClass('start');
                },100);
//            }
        });
    });

    $(function(){
      $('#img-a').click(function(e) {
        $('#img-input').click();
      });

      var $imgName = $('#img-name');
      $('#img-input').change(function(e){
        console.log(e.target.files);
        try {
          var f = e.target.files[0];
          $imgName.text(f.name);
        }
        catch (err) {
          console.log(err);
          $imgName.text("");
        }
      });

      $('input[name=requirement]').change(function(e) {
        if(!this.checked) return;

        var val = this.value;
        // $('input[name=radioName]:checked')

        $('#selling input, #rental input').prop('required', false);
        $('#selling .interest, #rental .interest').hide();

        if(val == 'For Sale') {
          $('#selling input').prop('required', true);
          $('#selling .interest').show();
        }
        else if(val == 'For Rent') {
          $('#rental input').prop('required', true);
          $('#rental .interest').show();
        }
        else {
          $('#selling input, #rental input').prop('required', true);
          $('#selling .interest, #rental .interest').show();
        }
      });
      $('input[name=requirement]').change();
    });

</script>
<?php
$this->import('/layout/footer');
?>
