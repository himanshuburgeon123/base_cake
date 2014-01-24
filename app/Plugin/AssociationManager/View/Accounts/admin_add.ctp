<div>
    <article>
        <header>
            <h2>
                <?php
                    if (isset($this->request->data['Account']['id']) && $this->request->data['Account']['id']):
                          echo  __('Update Account');
                    else:
                          echo  __('Add Account');
                    endif;
                ?>
            </h2>
        </header>
    </article>
	
    <?php echo $this->element('admin/message');?>
    <?php echo $this->Form->create('Account',array('name'=>'accounts','id'=>'AccountAdd','action'=>'add','type'=>'file'))?>
    <?php echo $this->Form->input('id');?>
    <?php echo $this->Form->input('Profile.id');?>
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
                <label>Age<span style="color:red;">*</span></label>
            </dt>
            
            <dd>
                <?=$this->Form->text('age',array('class'=> 'small','size'=>'45','required'=>false)); ?>
				<?=$this->Form->error('age',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
                  
            </dd>
               <dt>
                <label></label>
            </dt>
             <dd>
                <label>Profile Summary</label>
            </dd>
            <dt>
                <label>Company Name<span style="color:red;">*</span></label>
            </dt>
            
            <dd>
                <?=$this->Form->text('Profile.company',array('class'=> 'small','size'=>'45','required'=>false)); ?>
				<?=$this->Form->error('Profile.company',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
            </dd>
            
             <dt>
                <label>Position<span style="color:red;">*</span></label>
            </dt>
            
            <dd>
                <?=$this->Form->text('Profile.position',array('class'=> 'small','size'=>'45','required'=>false)); ?>
				<?=$this->Form->error('Profile.position',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
            </dd>
		
        </dl>
    </fieldset>
    <div id="loader_add" style="display:none; margin:7px; float:left;"><?=$this->Html->image('admin/icons/ajax-loader.gif');?></div>
	<button type="submit">
            <?php 
                if (isset($this->request->data['Account']['id']) && $this->request->data['Account']['id']):
                    echo __('Update');
                else:
                    echo __('Add');
                endif;								
            ?>
        </button> or 
        <?php echo $this->Html->link('Cancel', array('controller'=>'accounts', 'action' => 'index'));?>
                                
	<?php echo $this->Form->end();?>
</div>


<script type="text/javascript">
	 <?php $path = $this->Html->webroot; ?>
	
    $(document).ready(function(){
		$('#AccountAdd').submit(function(){

			//var data = $(this).serializeArray();
			var data = new FormData(this);
            var formData = $(this);
            var status = 0;
           
			$.each(this,function(i,v){
                $(v).removeClass('invalid form-error');
                });
            $('.error-message').remove();
            $('#AccountAdd > span#for_owner_cms').show();
            $('#AccountAdd > button[type=submit]').attr({'disabled':true});
            $('#loader_add').show();
			$.ajax({
                url: '<?=$path?>association_manager/accounts/validation',
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
							$('#'+i).addClass("invalid form-error").after('<span class="error-message">'+v+'</span>');
                        });
                    }else{
                        status = 1;
                    }
				}

            });
            if(status==0){
               $("html, body").animate({ scrollTop: 0 }, "slow");
               $('#AccountAdd > button[type=submit]').attr({'disabled':false});
               $('#AccountAdd > span#for_owner_cms').hide();
            }
		return (status===1)?true:false; 
        });
    });
 </script>
