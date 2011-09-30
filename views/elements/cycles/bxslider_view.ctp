<?php
/* jQuery BXSLIDER
 * More Info: http://bxslider.com/
*/
//if(!$uuid) { $uuid = $this->uuid('div', '/'); }
if($autoplay == 1) { $autoplay = true; } else { $autoplay = false; } // This plugin uses booleans in some cases and numbers in other cases...This is one where it uses a boolean, but all values in the database are 0/1 for on/off or true/false.
if(!$letterbox_color) { $letterbox_color = array(0,0,0); } // black if not specified
?>
<style>
.bx-wrapper .bx-window li {
  background-color: <?php echo $letterbox_color;?>;
}
.bx-wrapper .bx-prev {
  position: absolute;
  top: 78px;
  left: -55px;
  width: 31px;
  height: 31px;
  text-indent: -999999px;
  background: url(/cycle/img/bxSlider/icon_arrow_left.png) no-repeat 0 -31px;
}
.bx-wrapper .bx-next {
  position: absolute;
  top: 78px;
  right: -40px;
  width: 31px;
  height: 31px;
  text-indent: -999999px;
  background: url(/cycle/img/bxSlider/icon_arrow_right.png) no-repeat 0 -31px; }
.bx-wrapper .bx-pager,
.bx-wrapper .bx-captions {
  text-align: center;
}
.bx-wrapper .bx-pager a {
  font-size: 16px;
  color: #838383;
  padding: 0 10px;
}
.bx-wrapper .bx-pager .pager-active, .bx-wrapper .bx-pager a:hover {
  color: #DE312A;
  text-decoration: none;
}
</style>
<div style="margin:0 0 30px 60px;width: <?php echo $width; ?>px;height: <?php echo $height; ?>px;">
<ul id="<?php echo $uuid; ?>">
  <?php foreach($records as $record) { ?>
    <li>
      <?php echo $this->ImageVersion->version(array('image' => 'cycle_images/'.$record['path'], 'size' => array($width, $height), 'quality' => 90, 'crop' => false, 'letterbox' => $letterbox_color, 'sharpen' => true), array('title' => $record['caption'], 'alt' => $record['caption'])); ?>
      <!--<div class="panel-overlay">
        <strong><?php echo $record['title']; ?></strong><br />
        <?php echo $record['caption']; ?>
      </div>-->
    </li>  
    <?php } ?>   
</ul>
</div>

<?php // not sure these can have "false" as the second argument to move it to scripts for layout because of caching issues, if it is set to false, the index listing of nodes must be shown first, then it will be ok. If the view page for the specific node is shown and cached the index listing/paginated pages won't get the javascript 
echo $this->Html->script('/cycle/js/bxSlider/jquery.easing.1.3.js'); 
echo $this->Html->script('/cycle/js/bxSlider/jquery.bxSlider.min.js'); 
?>
<script type="text/javascript">
$(document).ready(function(){ 
  $('#<?php echo $uuid; ?>').bxSlider({
    mode: 'horizontal',
    pause: <?php echo $delay*1000;?>,
    infiniteLoop: <?php echo ($loop == 1)? 'true' : 'false';?>,
    auto: <?php echo ($autoplay)? 'true' : 'false';?>,
    captions: true,
    speed: 800,
    pager: true
  });
});
</script>
