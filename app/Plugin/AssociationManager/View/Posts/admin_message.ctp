<div>
    <article>
        <header>
            <h2>
                <?php
                    if (isset($this->request->data['Post']['id']) && $this->request->data['Post']['id']):
                          echo  __('Update Message');
                    else:
                          echo  __('Add Message');
                    endif;
                ?>
                 <?php if(!empty($account)){ ?>
                [<?=$account['Account']['name']?>]
				<?php } ?>
            </h2>
        </header>
    </article>
	
    <?php echo $this->element('admin/message');?>
     <?php echo $this->Form->create('Post',array('id'=>'Post','action'=>'message/'.$account_id.'/'.$id, 'type'=>'file'))?>
	<?php echo $this->Form->hidden('id');?>
    <?php echo $this->Form->hidden('status');?>
    <?php echo $this->Form->hidden('account_id',array('value'=>$account_id));?>
    <?=$this->Form->hidden('redirect', array('value' => $url)); ?>
    
    <fieldset>
        <dl>
            <dt>
                <label>Message<span style="color:red;">*</span></label>
            </dt>
            <dd>
				<?=$this->Form->textarea('message',array('class'=> 'small','required'=>false)); ?>
				<?=$this->Form->error('message',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
            </dd>
          
        </dl>
    </fieldset>
    <div id="loader_add" style="display:none; margin:7px; float:left;"><?=$this->Html->image('admin/icons/ajax-loader.gif');?></div>
	<button type="submit">
            <?php 
            
                if (isset($this->request->data['Post']['id']) && $this->request->data['Post']['id']):
                    echo __('Update');
                else:
                    echo __('Add');
                endif;								
            ?>
        </button> or 
        <?php echo $this->Html->link('Cancel', array('controller'=>'posts', 'action' => 'messages',$account_id));?>
                                
	<?php echo $this->Form->end();?>
</div>


<script type="text/javascript">
	 <?php $path = $this->Html->webroot; ?>
	
    $(document).ready(function(){
		$('#Post').submit(function(){

			//var data = $(this).serializeArray();
			var data = new FormData(this);
            var formData = $(this);
            var status = 0;
           
			$.each(this,function(i,v){
                $(v).removeClass('invalid form-error');
                });
            $('.error-message').remove();
            $('#Post > span#for_owner_cms').show();
            $('#Post > button[type=submit]').attr({'disabled':true});
            $('#loader_add').show();
			$.ajax({
                url: '<?=$path?>association_manager/posts/message_validation',
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
               $('#Post > button[type=submit]').attr({'disabled':false});
               $('#Post > span#for_owner_cms').hide();
            }
		return (status===1)?true:false; 
        });
    });
 </script>
