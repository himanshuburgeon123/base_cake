<div>
    <article>
        <header>
            <h2>
                <?php
                    if (isset($this->request->data['Page']['id']) && $this->request->data['Page']['id']):
                          echo  __('Update Content');
                    else:
                          echo  __('Add Content');
                    endif;
                ?>
            </h2>
        </header>
    </article>
	
    <?php echo $this->element('admin/message');?>
    <?php echo $this->Form->create('Page',array('name'=>'pages','id'=>'PageCms','action'=>'add/'.$parent_id,'onsubmit'=>'//return validatefields();','type'=>'file'))?>
    <?php echo $this->Form->input('id');?>
    <?php echo $this->Form->hidden('parent_id', array('value'=>$parent_id)); ?>
    <?=$this->Form->hidden('redirect', array('value' => $url)); ?>
    
    <fieldset>
        <dl>
            <dt>
                <label>Name<span style="color:red;">*</span></label>
            </dt>
            <dd>
				<?=$this->Form->text('name',array('class'=> 'small','size'=>'45','required'=>false)); ?>
				<?=$this->Form->error('name',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
            </dd>
            <dt>
                <label>SEO Title <span style="color:red;">*</span></label>
            </dt>
            
            <dd>
                <?=$this->Form->text('page_title',array('class'=> 'small','size'=>'45','required'=>false)); ?>
				<?=$this->Form->error('page_title',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
                  
            </dd>
            <dt>
				<label>Banner Image<span style="color:red;">*</span></label>
			</dt>
			
			<dd>
			<?php echo $this->Form->file('banner_image',array('class'=> 'fileupload customfile-input')); ?>
			<p>(Only png, gif, jpg, jpeg types are allowed. Max Image Size is 250KB )( 1400 X 350 px)</p>
			<div id="error_message_image"></div>
			<?=$this->Form->error('banner_image',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
			<?php 
				/* Resize Image */
					if(isset($this->data['Page']['banner_image'])) {
						$imgArr = array('source_path'=>Configure::read('Path.Banner'),'img_name'=>$this->data['Page']['banner_image'],'width'=>Configure::read('image_edit_width'),'height'=>Configure::read('image_edit_height'),'noimg'=>Configure::read('Path.NoImage'));
						$resizedImg = $this->ImageResize->ResizeImage($imgArr);
						echo $this->Html->image($resizedImg,array('border'=>'0'));
					}
			?>
			</dd>
			
             <dt>
                <label>Slug Url <span style="color:red;">*</span></label>
            </dt>
            
            <dd>
                <?=$this->Form->text('url_key',array('class'=> 'small','size'=>'45','required'=>false)); ?>
				<?=$this->Form->error('url_key',null,array('wrap' => 'span', 'class' => 'error-message')); ?> 
            </dd>
            <dt>
				<label>Page Template</label>
            </dt>
            <dd>
				<?=$this->Form->input('page_template', array('type' => 'select', 'options' =>  Configure::read('PageTemplates'),'label'=>false,'div'=>false,'style'=>'requestform','error'=>false)); ?>
            </dd>
             <dt>
                <label>Sub Page</label>
            </dt>
            
            <dd>
                <?=$this->Form->checkbox('sub_page',array('required'=>false)); ?>
                 
            </dd>

<!--
			 <dt>
                <label>Manage Gallary </label>
            </dt>
            
            <dd>
                <?=$this->Form->checkbox('gallery',array('required'=>false)); ?>
                 
            </dd>
-->

            <dt>
                <label>Meta Keywords</label>
            </dt>
            <dd>
                <?=$this->Form->textarea('page_metakeyword',array('class'=>'small','style'=>'height:100px;width:300px'));?>
				<?=$this->Form->error('page_metakeyword',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
            </dd>
            
            <dt>
                <label>Meta Description</label>
            </dt>
            <dd>
                <?=$this->Form->textarea('page_metadescription',array('class'=>'small','style'=>'height:100px;width:300px'));?>
				<?=$this->Form->error('page_metadescription',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
            </dd>
            

            <dt>
                <label>Page Short Description</label>
            </dt>
            
            <dd>
                <?php echo $this->Form->textarea('page_shortdescription', array('cols' => '60', 'rows' => '3'));
                   //echo $fck->load('Page.content');
                ?>
                <div class="float_left"><a href="Javascript:void(0);" onclick="removeeditor(0)">hide editor</a> |
                <a href="Javascript:void(0);" onclick="addeditor(0,'PagePageShortdescription')">show editor</a>
                </div>
            </dd>

            
            <dt>
                <label>Page Long Description</label>
            </dt>
            
            <dd>
                <?php 	
                    echo $this->Form->textarea('page_longdescription', array('cols' => '60', 'rows' => '3'));
                   // echo $fck->load('Page.content');
                ?>
                <div class="float_left"><a href="Javascript:void(0);" onclick="removeeditor(1)">hide editor</a> |
                <a href="Javascript:void(0);" onclick="addeditor(1,'PagePageLongdescription')">show editor</a>
                </div>
            </dd>
            
         
			
		
        </dl>
    </fieldset>
    <div id="loader_add" style="display:none; margin:7px; float:left;"><?=$this->Html->image('admin/icons/ajax-loader.gif');?></div>
	<button type="submit">
            <?php 
                if (isset($this->request->data['Page']['id']) && $this->request->data['Page']['id']):
                    echo __('Update');
                else:
                    echo __('Add');
                endif;								
            ?>
        </button> or 
        <?php echo $this->Html->link('Cancel', array('controller'=>'pages', 'action' => 'index'));?>
                                
	<?php echo $this->Form->end();?>
</div>

 <script type="text/javascript">
     <?php $path = $this->Html->webroot; ?>
     var fckeditor = new Array;
			addeditor(0,'PagePageShortdescription')
			addeditor(1,'PagePageLongdescription')
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
    $(document).ready(function(){
		$('#PageCms').submit(function(){

			//var data = $(this).serializeArray();
			var data = new FormData(this);
            var formData = $(this);
            var status = 0;
           
			$.each(this,function(i,v){
                $(v).removeClass('invalid form-error');
                });
            $('.error-message').remove();
            $('#PageCms > span#for_owner_cms').show();
            $('#PageCms > button[type=submit]').attr({'disabled':true});
            $('#loader_add').show();
			$.ajax({
                url: '<?=$path?>content_manager/pages/validation',
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
							if(i=="PageBannerImage"){
								i="error_message_image";
							}
							$('#'+i).addClass("invalid form-error").after('<span class="error-message">'+v+'</span>');
                        });
                    }else{
                        status = 1;
                    }
				}

            });
            if(status==0){
               $("html, body").animate({ scrollTop: 0 }, "slow");
               $('#PageCms > button[type=submit]').attr({'disabled':false});
               $('#PageCms > span#for_owner_cms').hide();
            }
		return (status===1)?true:false; 
        });
    });
 </script>
