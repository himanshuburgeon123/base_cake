<!-- START REVOLUTION SLIDER 4.0.0 -->
<div id="rev_slider_7_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" >
	
		<div id="rev_slider_7_1" class="rev_slider fullwidthabanner">						
			<ul>
				<?php foreach($slider as $slide) {?>			
				<li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
					
					<?php 
					/* Resize Image */ 
						if(isset($slide['Slide']['image'])) {
							$imgArr = array('source_path'=>Configure::read('Path.Slide'),'img_name'=>$slide['Slide']['image'],'width'=>Configure::read('slide_image_width'),'height'=>Configure::read('slide_image_height'),'noimg'=>Configure::read('Path.NoImage'));
							$resizedImg = $this->ImageResize->ResizeImage($imgArr);
							echo $this->Html->image($resizedImg,array('class'=>'sliderbg','data-fullwidthcentering'=>'true'));
							
						}
					?>
                    <div class="tp-caption normal_white lft" data-x="0" data-y="80" data-speed="1500" data-start="1500" data-easing="easeOutExpo">
                          <?=$slide['Slide']['description']?>
                    </div>
                    <div class="tp-caption button_light lfr" data-x="0" data-y="300" data-speed="1500" data-start="3200" data-easing="easeOutExpo">
						
						<?php echo $this->Html->link($this->Html->image('big-btn.png'), array('plugin'=>'content_manager','controller'=>'pages','action'=>'view',28), array('escape' => false));?>
						
                   
                    </div>
                 </li>
               <?php } ?>  
                 
                 
                
			</ul>
		</div>
	
</div>
