 
<script language="javascript">
function saveform()
{
	document.getElementById('GalleryPublish').value=1;
	document.getElementById('Gallery').submit();
}
</script>

<div>
    <article>
        <header>
            <h2>
                <?php
                    if (isset($this->request->data['Gallery']['id']) && $this->request->data['Gallery']['id']):
                          echo  __('Update Gallery');
                    else:
                          echo  __('Add Gallery');
                    endif;
                ?>
                <?php if(!empty($page)){ ?>
                [<?=$page['Page']['name']?>]
				<?php } ?>
            </h2>
        </header>
    </article>
	
    <?php echo $this->element('admin/message');?>
    <?php echo $this->Form->create('Gallery',array('name'=>'slides','id'=>'Gallery','action'=>'add/'.$page_id.'/'.$id,'onsubmit'=>'//return validatefields();','type'=>'file'))?>
    <?php echo $this->Form->hidden('id');?>
    <?php echo $this->Form->hidden('status');?>
    <?php echo $this->Form->hidden('page_id',array('value'=>$page_id));?>
    
    <?=$this->Form->hidden('redirect', array('value' => $url)); ?>
    
    <fieldset>
        <dl>
            
            
            <dt>
                <label>Gallery Name <span style="color:red;">*</span></label>
            </dt>
            
            <dd>
                <?=$this->Form->text('name',array('class'=> 'small','size'=>'45','required'=>false)); ?>
                  
            </dd>
             <dt>
                <label>Image <span style="color:red;">*</span></label>
            </dt>
            
            <dd>
                <?php echo $this->Form->file('image', array('class'=> 'fileupload customfile-input')); ?>
				 <p style="padding-bottom:15px;">(Only png, gif, jpg, jpeg types are allowed. Max Image Size is 150KB.)</p>
				 <span id="image_error"></span>
                <?php 
				/* Resize Image */
					if(isset($this->data['Gallery']['image'])) {
						$imgArr = array('source_path'=>Configure::read('Path.Gallery'),'img_name'=>$this->data['Gallery']['image'],'width'=>Configure::read('image_edit_width'),'height'=>Configure::read('image_edit_height'),'noimg'=>Configure::read('Path.Noimage'));
						$resizedImg = $this->ImageResize->ResizeImage($imgArr);
						echo $this->Html->image($resizedImg,array('border'=>'0'));
					}
					?>            
                 
            </dd>
            
             
            
             
            
            
        </dl>
    </fieldset>
	<button type="submit">
            <?php 
                if (isset($this->request->data['Gallery']['id']) && $this->request->data['Gallery']['id']):
                    echo __('Update');
                else:
                    echo __('Add');
                endif;								
            ?>
        </button> or 
        <?php echo $this->Html->link('Cancel', array('controller'=>'galleries', 'action' => 'index'));?>
                                
	<?php echo $this->Form->end();?>
</div>
<script type="text/javascript">
	 <?php $path = $this->Html->webroot; ?>
    $(document).ready(function(){
		$('#Gallery').submit(function(){
			
			//var data = $(this).serializeArray();
			var data = new FormData(this);
			var formData = $(this);
            var status = 0;
           
           $.each(this,function(i,v){
                $(v).removeClass('invalid form-error');
                });
            $('.error-message').remove();
            $('#Gallery > span#for_owner_cms').show();
            $('#Gallery > button[type=submit]').attr({'disabled':true});
           
           $.ajax({
                url: '<?=$path?>content_manager/galleries/validation',
                async: false,
				data: data,
                dataType:'json', 
                type:'post',
                cache: false,
				contentType: false,
				processData: false,
                success: function(data) {
					 
                    if(data.error==1){
						 
                        $.each(data.errors,function(i,v){
							if(i=="GalleryImage"){
								$('#image_error').html('<span class="error-message">'+v+'</span>');
							}else{
								$('#'+i).addClass("invalid form-error").after('<span class="error-message">'+v+'</span>');
                            }
							
                        });
                       
                    }else{
                        status = 1;
                    }
                   
                   }


            });
            if(status==0){
               $("html, body").animate({ scrollTop: 0 }, "slow");
               $('#Gallery > button[type=submit]').attr({'disabled':false});
               $('#Gallery > span#for_owner_cms').hide();
            }
           
          
			
           return (status===1)?true:false; 
            
        });
        
        
    });
 </script>

