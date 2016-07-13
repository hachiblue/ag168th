<?php
//session_start();
?>
<style>
.thumb {
  width: 80px;
  height: 80px;
  display: inline-block;
  position: relative;
  margin-right: 10px;
  margin-bottom: 10px;
}
.thumb.selected {
  opacity: 0.6;
}
.thumb .thumb-checkbox {
  position: absolute;
  top: 5px;
  right: 5px;
}
</style>
<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("/public/css/skylo.css");?>" />
<script type="text/javascript" src="<?php echo \Main\Helper\URL::absolute("/public/js/skylo.js");?>"></script>
<div>
  <h4>Add image</h4>
  <form id="form-upload" enctype="multipart/form-data">
    <input type="file" name="image[]" multiple> <button class="btn btn-info">Upload</button>
  </form>
</div>
<hr>
<div id="block-imgs">

</div>
<button id="deleteImages" class="btn btn-danger">REMOVE ALL SELECT</button>
<script type="text/javascript">
$(function(){
  "use strict";

  var layout = {};
  layout.header = (function(){
    var $blockList = $('#block-imgs');
    var $form = $('#form-upload');
    var $deleteImages = $('#deleteImages');
    var imgs = [];

    function Img(src) {
      this.$el = $('<div></div>', { class: 'thumb' });
      this.$img = $('<img>', { class: 'thumb-img', width: 80, height: 80, src: '../../../public/slide_1/'+ src });
      this.$checkbox = $('<input>', { class: 'thumb-checkbox', type: 'checkbox' });
      this.$el.append(this.$img);
      this.$el.append(this.$checkbox);
      this.getImgName = function(){ return src };

      var img = this;
      this.$checkbox.on('change', function(e){
        if(img.$checkbox.is(':checked')) {
          img.$el.addClass('selected');
        }
        else {
          img.$el.removeClass('selected');
        }
      });
    }

    function fetch() {
      $.get('../../../api/layout', function(data){
        var items;
        try {
          items = JSON.parse(data.slide_1);
        }
        catch(e) {
          items = [];
        }

        $.each(items, function(i, item){
          var img = new Img(item);
          $blockList.append(img.$el);
          imgs.push(img);
        });
      }, 'json');
    }

    function clearBlocks() {
      $('.thumb', $blockList).remove();
      imgs = [];
    }

    $deleteImages.on('click', function(e){
      var names = [];
      $.each(imgs, function(i, img){
        if(img.$checkbox.is(':checked')) names.push(img.getImgName());
      });
      $.skylo('start');
      $.post('../../../api/layout/slide1/delete', { images: JSON.stringify(names) }, function(data){
        $.skylo('end');
        clearBlocks();
        fetch();
      }, 'json');
    });

    $form.on('submit', function(e){
      e.preventDefault();
      var fData = new FormData(this);

      $('input[type="file"]', $form).val('');
      $.skylo('start');
      $.ajax({
        url: '../../../api/layout/slide1',
        type: 'post',
        data: fData,
  			dataType: "json",
  			cache: false,
  			contentType: false,
  			processData: false,
        xhr: createXhr,
        success: function(data) {
          $.skylo('end');
          clearBlocks();
          fetch();
        },
        error: function(){
          $.skylo('end');
          clearBlocks();
          fetch();
        }
      });
    });

    fetch();

    return {};
  })();

  function createXhr() {
    var xhr = new window.XMLHttpRequest();
    xhr.upload.addEventListener("progress", function(evt) {
      if (evt.lengthComputable) {
        var percentComplete = (evt.loaded / evt.total)*100;
        $.skylo('set', parseInt(percentComplete));
      }
    }, false);

    xhr.addEventListener("progress", function(evt) {
      if (evt.lengthComputable) {
        var percentComplete = (evt.loaded / evt.total)*100;
        $.skylo('set', parseInt(percentComplete));
      }
    }, false);

    return xhr;
  }
  //
  // $('#deleteImages').click(function(e) {
  //   e.preventDefault();
  //
  //   if(!window.confirm('Are you sure?')) return;
  //
  //   var listId = $('.ch-box:checked').map(function(){
  //     return $(this).val();
  //   }).get();
  //
  //   $.post('../../../api/project/image/delete', { project_id: id, list_id: listId }, function(data){
  //     clearBlocks();
  //     init();
  //   }, 'json');
  // });
  //
  // init();
});
</script>
