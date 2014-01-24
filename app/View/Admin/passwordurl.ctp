
<body class="login">
	<section role="main">
	
		<img src="<?=Configure::read('Site.admin_logo');?>" />
		<!-- Login box -->
		<article id="login-box">
		
			<div class="article-container">				
				<?php echo $this->element('admin/message');?>
				<?php echo $this->Form->create('User', array('name' => 'user','url' => array('controller'=>'admin','action'=>'passwordurl/'.$str),'onSubmit'=>'//return validatefields()'));?>
			<fieldset>
        
					<dt style="width:120px"><label>New Password <span style="color:red;">*</span></label></dt>
						<dd style="left:130px; width: 184px !important;">
							<?=$this->Form->hidden('form-name',array('required'=>false,'value'=>'ResetRegistrationPasswordForm')); ?>
							
							<?php echo $this->Form->password('password', array('class'=>'mediaum','size' => 20,'required'=>false)); ?>
							<div id="password"></div>
							<?=$this->Form->error('password',null,array('wrap' => 'span', 'class' => 'error-message', 'style' => 'padding-left:0 !important;')); ?>
							</dd>
					<dt style="width:120px"><label>Confirm Password <span style="color:red;">*</span></label></dt>
						<dd style="left:130px; width: 184px !important;"><?php echo $this->Form->password('password2', array('class'=>'mediaum','size' => 20,'required'=>false)); ?>
						<?=$this->Form->error('password2',null,array('wrap' => 'span', 'class' => 'error-message', 'style' => 'padding-left:0 !important;')); ?>
						<div id="password2"></div>
						</dd>
			</fieldset>
				<button type="submit">Save Password</button>
					<?php echo $this->Form->end();?>		
			</div>
		
		</article>
		<!-- /Login box -->
		
		
	</section>

	
</body>

<script type="text/javascript">
	<?php $path = $this->Html->webroot; ?>
    $(document).ready(function(){
		$('#UserPasswordurlForm').submit(function(){
			
			var data = $(this).serializeArray();
            var formData = $(this);
            var status = 0;
           
            $.each(this,function(i,v){
                $(v).removeClass('form-error');
                });
            $('.error-message').remove();
            $('#UserPasswordurlForm > span#for_owner_cms').show();
            $('#UserPasswordurlForm > button[type=submit]').attr({'disabled':true});
           
			$.ajax({
                url: '<?=$path?>subadmin_manager/users/validation',
                async: false,
				data: data,
                dataType:'json', 
                type:'post',
                success: function(data) {
                    if(data.error==1){
						 
                        $.each(data.errors,function(i,v){
							if(i=="UserPassword"){
								i="password";
							}
							if(i=="UserPassword2"){
								i="password2";
							}
							$('#'+i).addClass("form-error").after('<span class="error-message">'+v+'</span>');
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
               $("html, body").animate({ scrollTop: 0 }, "slow");
               $('#UserPasswordurlForm > button[type=submit]').attr({'disabled':false});
               $('#UserPasswordurlForm > span#for_owner_cms').hide();
            }
           return (status===1)?true:false; 
            
        });
        
        
    });
 </script>
