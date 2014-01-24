
   <?php echo $this->Form->create('Page', array('name'=>'pages', 'id'=>'Contact','url'=>array('plugin'=>'content_manager','controller'=>'pages','action'=>'view',$id),'novalidate' => true)); ?>
          <fieldset>
            <ol class="clearfix">
              <li>
                <label for="firstname">Name<span style="color:#ff0000;">*</span>:</label>
				<?=$this->Form->text('name',array('required'=>false,'size'=>'35','style'=>'text-transform:capitalize')); ?>
				<?=$this->Form->error('name',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
              </li>
              <li>
                <label for="email">E-mail<span style="color:#ff0000;">*</span> :</label>
                <?=$this->Form->email('email',array('required'=>false,'size'=>'35')); ?>
				<?=$this->Form->error('email',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
              </li>
              <li>
                <label for="email">Phone<span style="color:#ff0000;">*</span> :</label>
                <?=$this->Form->tel('phone',array('required'=>false,'size'=>'35')); ?>
				<?=$this->Form->error('phone',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
              </li>
              <li>
                <label for="email">City<span style="color:#ff0000;">*</span> :</label>
                <?=$this->Form->text('city',array('required'=>false,'size'=>'35')); ?>
				<?=$this->Form->error('city',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
              </li>
              <li>
                <label for="content">Message<span style="color:#ff0000;">*</span> :</label>
                <?=$this->Form->textarea('message',array('required'=>false,'cols'=>'32','rows'=>'4')); ?>
				<?=$this->Form->error('message',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
              </li>
              <li class="last">
                <input name="submit" id="submit" value="Submit" type="submit">
              </li>
            </ol>
          </fieldset>
	<?php echo $this->Form->end(); ?> 

<script type="text/javascript">
    <?php $path = $this->Html->webroot; ?>
    $(document).ready(function(){
		//alert('etst');
		$('#Contact').submit(function(){
			var data = $(this).serializeArray();
            var formData = $(this);
            var status = 0;
            $.each(this,function(i,v){
                $(v).removeClass('invalid form-error');
                });
            $('.error-message').remove();
            $('#Contact > span#for_owner_cms').show();
            $('#Contact > button[type=submit]').attr({'disabled':true});
            $.ajax({
                url: '<?=$path?>content_manager/pages/validation',
                async: false,
				data: data,
                dataType:'json', 
                type:'post',
                success: function(data) {
                    if(data.error==1){
                        $.each(data.errors,function(i,v){
							$('#'+i).addClass("invalid form-error").after('<span class="error-message">'+v+'</span>');
							$('#'+i).bind('click',function(){
								$(this).removeClass('invalid form-error');
								$(this).next().remove();
								});
                        });
                       
                    }else{
                        status = 1;
                    }
				}
            });
            if(status==0){
               //$("html, body").animate({ scrollTop: 0 }, "slow");
               $('#Contact > button[type=submit]').attr({'disabled':false});
               $('#Contact > span#for_owner_cms').hide();
            }
			return (status===1)?true:false; 
        });
    });
</script>

