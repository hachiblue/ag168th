<?php
$projectId = $params['project_id'];
?>
<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("/public/css/skylo.css");?>" />
<script type="text/javascript" src="<?php echo \Main\Helper\URL::absolute("/public/js/skylo.js");?>"></script>
<div>
  <h4>Add image</h4>
  <form id="form-upload" enctype="multipart/form-data">
    <input type="hidden" name="project_id" value="<?php echo $projectId;?>">
    <input type="file" name="image[]" multiple> <button class="btn btn-info">Upload</button>
  </form>
</div>
<hr>
<div id="block-imgs">

</div>
<button id="deleteImages" class="btn btn-danger">REMOVE ALL SELECT</button>
<script type="text/javascript">

$(function() {

	"use strict";

	var id = <?php echo json_encode($projectId);?>;
	var $blockList = $('#block-imgs');

	function init() 
	{
		$.get('../../../api/project/image', { project_id: id }, function(data){
			for (var i in data.data) 
			{
				insertEl(data.data[i]);
			}
		}, 'json');
	}

	function insertEl(row) 
	{
		var $el = $('<div class="block-img"><label><input class="ch-box" type="checkbox"><img class="imgThumb" /><label></div>');
		var $img = $('.imgThumb', $el);
		$img.attr('src', row.image_url);
		// $img.attr('width', 80);
		$img.attr('height', 60);
		var $chBox = $('.ch-box', $el);
		$chBox.val(row.id);
		$blockList.append($el);
	}

	function clearBlocks() 
	{
		$('.block-img').remove();
	}

  $('#form-upload').submit(function(e){
    e.preventDefault();
    var fData = new FormData(this);

    $.skylo('start');
    $.ajax({
      url: '../../../api/project/image',
      type: 'post',
      data: fData,
			dataType: "json",
			cache: false,
			contentType: false,
			processData: false,
      xhr: function() {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
                var percentComplete = (evt.loaded / evt.total)*100;
                $.skylo('set', parseInt(percentComplete));
                console.log(percentComplete);
            }
       }, false);

       xhr.addEventListener("progress", function(evt) {
           if (evt.lengthComputable) {
               var percentComplete = (evt.loaded / evt.total)*100;
               $.skylo('set', parseInt(percentComplete));
               console.log(percentComplete);
           }
       }, false);

       return xhr;
			},
      success: function(data) {
        $.skylo('end');
        clearBlocks();
        init();
      },
      error: function(){
        $.skylo('end');
        clearBlocks();
        init();
      }
    });
  });

  $('#deleteImages').click(function(e) {
    e.preventDefault();

    if(!window.confirm('Are you sure?')) return;

    var listId = $('.ch-box:checked').map(function(){
      return $(this).val();
    }).get();

    $.post('../../../api/project/image/delete', { project_id: id, list_id: listId }, function(data){
      clearBlocks();
      init();
    }, 'json');
  });

  init();
});
</script>
