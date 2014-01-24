<div>
	<article>
        <header>
            <h2><?=$heading?></h2>
        </header>
    </article>
	
    <?php echo $this->element('admin/message');?>
    <?php echo $this->Form->create('Link',array('name'=>'links','id'=>'LinkCms','action'=>'add/'.$menu_id,'onsubmit'=>'//return validatefields();','type'=>'file','novalidate'=>true))?>
    <?php echo $this->Form->hidden('id');?>
    <?php echo $this->Form->hidden('status');?>
    <?php echo $this->Form->hidden('menu_id', array('value'=>$menu_id)); ?>
    <?=$this->Form->hidden('redirect', array('value' => $url)); ?>
    
    <fieldset>
        <dl>
            <dt>
                <label>Name <span style="color:red;">*</span></label>
            </dt>
            <dd>
                <?=$this->Form->text('name',array('class'=> 'small','size'=>'45')); ?>
                <?=$this->Form->error('name',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
                  
            </dd>
            
            <dt>
                <label>SEO Keyword <span style="color:red;">*</span></label>
            </dt>
            
            <dd>
                <?=$this->Form->text('url_key',array('class'=> 'small','size'=>'45','required'=>false)); ?>
                <?=$this->Form->error('url_key',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
                 
            </dd>
        </dl>
    </fieldset>
	<button type="submit">
            <?php 
                if (isset($this->request->data['Link']['id']) && $this->request->data['Link']['id']):
                    echo __('Update');
                else:
                    echo __('Add');
                endif;								
            ?>
        </button> or 
        <?php echo $this->Html->link('Cancel', array('controller'=>'links', 'action' => 'index',$menu_id));?>
                                
	<?php echo $this->Form->end();?>
</div>

<script type="text/javascript">
	<?php $path = $this->Html->webroot; ?>
    $(document).ready(function(){
		$('#LinkCms').submit(function(){
			
			var data = $(this).serializeArray();
            var formData = $(this);
            var status = 0;
           
           $.each(this,function(i,v){
                $(v).removeClass('form-error');
                });
            $('.error-message').remove();
            $('#LinkCms > span#for_owner_cms').show();
            $('#LinkCms > button[type=submit]').attr({'disabled':true});
           
           $.ajax({
                url: '<?=$path?>content_manager/links/validation',
                async: false,
				data: data,
                dataType:'json', 
                type:'post',
                success: function(data) {
					 
                    if(data.error==1){
						 
                        $.each(data.errors,function(i,v){
							
							$('#'+i).addClass("form-error").after('<span class="error-message">'+v+'</span>');
                            
                        });
                       
                    }else{
                        status = 1;
                    }
                   
                   }


            });
            if(status==0){
               $("html, body").animate({ scrollTop: 0 }, "slow");
               $('#LinkCms > button[type=submit]').attr({'disabled':false});
               $('#LinkCms > span#for_owner_cms').hide();
            }
           
          
          
           return (status===1)?true:false; 
            
        });
        
        
    });
 </script>
