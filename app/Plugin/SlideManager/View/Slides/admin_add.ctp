 
<script language="javascript">
function saveform()
{
	document.getElementById('SlidePublish').value=1;
	document.getElementById('Slide').submit();
}
</script>

<div>
    <article>
        <header>
            <h2>
                <?php
                    if (isset($this->request->data['Slide']['id']) && $this->request->data['Slide']['id']):
                          echo  __('Update Slide');
                    else:
                          echo  __('Add Slide');
                    endif;
                ?>
            </h2>
        </header>
    </article>
	
    <?php echo $this->element('admin/message');?>
    <?php echo $this->Form->create('Slide',array('name'=>'slides','id'=>'Slide','action'=>'add' ,'onsubmit'=>'//return validatefields();','type'=>'file'))?>
    <?php echo $this->Form->input('id');?>
     <?php echo $this->Form->hidden('status');?>
    
    <?=$this->Form->hidden('redirect', array('value' => $url)); ?>
    
    <fieldset>
        <dl>
            
            
            <dt>
                <label>Slide Name <span style="color:red;">*</span></label>
            </dt>
            
            <dd>
                <?=$this->Form->text('name',array('class'=> 'small','size'=>'45','required'=>false)); ?>
                  
            </dd>
              <dt>
                <label>Title <span style="color:red;">*</span></label>
            </dt>
            
            <dd>
                <?=$this->Form->text('title',array('class'=> 'small','size'=>'45','required'=>false)); ?>
                  
            </dd>
             <dt>
                <label>Image <span style="color:red;">*</span></label>
            </dt>
            
            <dd>
                <?php echo $this->Form->file('image', array('class'=> 'fileupload customfile-input')); ?>
				 <p style="padding-bottom:15px;">(Only png, gif, jpg, jpeg types are allowed. Max Image Size is 250KB.)</p>
				 <span id="image_error"></span>
				<?php 
				/* Resize Image */
					if(isset($this->data['Slide']['image'])) {
						$imgArr = array('source_path'=>Configure::read('Path.Slide'),'img_name'=>$this->data['Slide']['image'],'width'=>Configure::read('image_edit_width'),'height'=>Configure::read('image_edit_height'),'noimg'=>Configure::read('Path.Noimage'));
						$resizedImg = $this->ImageResize->ResizeImage($imgArr);
						echo $this->Html->image($resizedImg,array('border'=>'0'));
					}
					?>
			 </dd>
            
           
             <dt>
                <label>Description <span style="color:red;">*</span></label>
            </dt>
            
            <dd>
                <?=$this->Form->textarea('description', array('cols' => '60', 'rows' => '3','required'=>false)); ?>
				<?=$this->Form->error('description',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
				<div class="float_left"><a href="Javascript:void(0);" onclick="removeeditor(0)">hide editor</a> |
                <a href="Javascript:void(0);" onclick="addeditor(0,'SlideDescription')">show editor</a>
                </div>
            </dd>
<!--
             <dt>
                <label>Logo <span style="color:red;">*</span></label>
            </dt>
            
            <dd>
                <?php// echo $this->Form->file('logo', array('class'=> 'fileupload customfile-input')); ?>
				
				<br/> <div id="image_error_logo"></div>
				<?php 
				/* Resize Image */
					//if(isset($this->data['Slide']['logo'])) {
						//$imgArr = array('source_path'=>Configure::read('Path.Slide'),'img_name'=>$this->data['Slide']['logo'],'width'=>Configure::read('image_edit_width'),'height'=>Configure::read('image_edit_height'),'noimg'=>Configure::read('Path.Noimage'));
						//$resizedImg = $this->ImageResize->ResizeImage($imgArr);
						//echo "<pre>";pr($resizedImg);die;
						//echo $this->Html->image($resizedImg,array('border'=>'0'));
					//}
					?>
			 </dd>
-->
            
            
        </dl>
    </fieldset>
    <div id="loader_add" style="display:none; margin:7px; float:left;"><?=$this->Html->image('admin/icons/ajax-loader.gif');?></div>
	<button type="submit">
            <?php 
                if (isset($this->request->data['Slide']['id']) && $this->request->data['Slide']['id']):
                    echo __('Update');
                else:
                    echo __('Add');
                endif;								
            ?>
        </button> or 
        <?php echo $this->Html->link('Cancel', array('controller'=>'slides', 'action' => 'index'));?>
                                
	<?php echo $this->Form->end();?>
</div>

<script type="text/javascript">
     <?php $path = $this->Html->webroot; ?>
     var fckeditor = new Array;
			addeditor(0,'SlideDescription')
			
     function removeeditor(id){
         fckeditor[id].destroy();
     }
     
     function addeditor(id,name){
         fckeditor[id] = CKEDITOR.replace(name,{
                                language : 'eng',
                                uiColor : '#e6e6e6',
                                toolbar : 'Basic',
                                customConfig : '../editor.js',
                                filebrowserBrowseUrl : '<?=$path?>js/ckfinder/ckfinder.html',
                                filebrowserImageBrowseUrl : '<?=$path?>js/ckfinder/ckfinder.html',
                                filebrowserUploadUrl : '<?=$path?>js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                filebrowserImageUploadUrl : '<?=$path?>js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                        });
     }
     
     
    </script>

<script type="text/javascript">
	 <?php $path = $this->Html->webroot; ?>
    $(document).ready(function(){
		$('#Slide').submit(function(){
			
			//var data = $(this).serializeArray();
			var data = new FormData(this);
			var formData = $(this);
            var status = 0;
           
           $.each(this,function(i,v){
                $(v).removeClass('invalid form-error');
                });
            $('.error-message').remove();
            $('#Slide > span#for_owner_cms').show();
            $('#Slide > button[type=submit]').attr({'disabled':true});
            $('#loader_add').show();
           $.ajax({
                url: '<?=$path?>slide_manager/slides/validation',
                async: false,
				data: data,
                dataType:'json', 
                type:'post',
                cache: false,
				contentType: false,
				processData: false,
                success: function(data) {
					$('#loader_add').hide(); 
                    if(data.error==1){
						 
                        $.each(data.errors,function(i,v){
							
							if(i=="SlideImage"){
								i="image_error";
								$('#'+i).addClass("invalid form-error").after('<span class="error-message">'+v+'</span><br />');
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
               $('#Slide > button[type=submit]').attr({'disabled':false});
               $('#Slide > span#for_owner_cms').hide();
            }
           
          
			
           return (status===1)?true:false; 
            
        });
        
        
    });
 </script>
