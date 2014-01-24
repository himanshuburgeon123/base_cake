<!---------Start Content---------->
<div class="wrapper">
  <h1>Infrastructure</h1>
  <?=$this->Html->image('sepreter.png');?>
  <div class="center-content">
    <div class='demonstrations'> 
    <?php $i = $this->paginator->counter('{:start}'); ?>
		<?php foreach($galleries as $gallery){?>
		<?php if(isset($gallery['Gallery']['image'])) {
					$frontImage = array('source_path'=>Configure::read('Path.Gallery'),'img_name'=>$gallery['Gallery']['image'],'width'=>Configure::read('image_front_width'),'height'=>Configure::read('image_front_height'),'noimg'=>Configure::read('Path.NoImage'));
					$resizedImg = $this->ImageResize->ResizeImage($frontImage);
					
				}?>
			<?php $img = 'img/gallery/'.$gallery['Gallery']['image'] ; ?>
			<a href='<?php echo $this->webroot.$img; ?>' class='lightview' data-lightview-group='example' data-lightview-title="" data-lightview-caption="">
				<div class="block"><?=$this->Html->image($resizedImg);?>
					<div class="gallery-hover-effect"><?=$this->Html->image('gallery-hover.png');?></div>
				<!--end gallery-hover-effect--> 
				</div><!--end block--> 
			</a>
		<?php } ?>	
		<div id="loader_pagination" style="display:none;width:100%;text-align:center;padding-top:20px;">
		<div><?=$this->Html->image('loader.gif');?></div></div>
      </div>
      <?php if (!$galleries) { ?>
		<div style='color:#FF0000'>No Gallery Found</div>
			<?php }else{ ?>
			<div class="clear"></div>
				<noscript>
				<ul class="pagination">
						
					<?php if($this->Paginator->first()){?>
					<li><?php echo $this->Paginator->first('« First',array('class'=>'')); ?></li>
					<?php } ?>
					
					<?php if($this->Paginator->hasPrev()){?>
					<li><?php echo $this->Paginator->prev('< Previous',array('class'=>''), null, array('class'=>'disabled'));?>&nbsp;... &nbsp;</li>
					
					<?php } ?>
					
					<?=$this->Paginator->numbers(array('modulus'=>6,'tag'=>'li','class'=>'','separator'=>'')); ?>
					
					<?php if($this->Paginator->hasNext()){?>
					
						<li><?php echo $this->Paginator->next('Next >',array('class'=>''));?></li>
					<?php } ?>
					<?php if($this->Paginator->last()){?>
					<li><?php echo $this->Paginator->last('Last »',array('class'=>'')); ?></li>
					<?php } ?>
				</ul>
				</noscript>
			<?php } ?>	  
    <div class="clear"></div>
  </div>
  <div class="shadow1"></div>
</div>
<!---------End Content---------->

<script type='text/javascript'>
    $(function(){
      //Keep track of last scroll
      var lastScroll = 0;
      var loading_start = 0;
      var page = <?=$this->paginator->counter('{:page}')?>;
      var pages = <?=$this->paginator->counter('{:pages}')?>;
      $(window).bind('scroll',function(event){
           //Sets the current scroll position
          var st = $(this).scrollTop();
          var win_height = $(this).height();
          var doc_height = $(document).height();
          var scrollBottom = doc_height - win_height - st;
          var scroll_value=200;
        
            if((scrollBottom <= scroll_value) && (pages >= (page+1))){
                if(loading_start===0){
                    loading_start = 1;
                    page++;
                    $('#loader_pagination').show();
                    $.ajax({
                        url:'<?=Router::url(array('plugin'=>'content_manager','controller'=>'galleries','action'=>'index','page:'));?>'+page,
                        async:false,
                        success:function(data){
                            $('.demonstrations').append(data);
                            loading_start = 0;
                            $('#loader_pagination').hide();
                        }
                    });
                }
            }
        
            
          lastScroll = st;
          
          
      });
      
    });
</script>
