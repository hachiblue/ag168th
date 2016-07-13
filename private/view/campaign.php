<?php
$this->import('/layout/header');
?>

<style>

    .labelText, .labelText2, .underText{
        font-family: 'Arial', sans-serif;
        margin-top: 20px;
        color: #1957a4;
        margin-left: 100px;
    }
   .labelText{
       font-size: 14px;
   }

   .labelText2{
       font-size: 20px;
   }

   .labelImg {
       text-align: center;
       margin-top: 30px;
   }

    .underText{
        font-size: 18px;
    }

</style>

<hr style="border: 1px solid #000000; width: 100%">

<div class="container">
    <?php foreach($params['items'] as $item){?>
    <div class="div labelText">
      <a href="<?php echo \Main\Helper\URL::absolute("/campaign/".$item["id"]);?>">
        <?php echo $item["name"];?>
        <img src="<?php echo $item["image_url"];?>" width="100%" height="200" style="object-fit: cover;" />
      </a>
    </div>
    <?php }?>
    <div class="underText"></div>
</div>
<br><br><br>
<?php
$this->import('/layout/footer');
?>
