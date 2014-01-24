
<script type="text/javascript">
    $(document).ready(function(){
		$('#UserResetpasswordForm').submit(function(){
			var data = $(this).serializeArray();
			var formData = $(this);
            var status = 0;
			$.each(this,function(i,v){
                $(v).removeClass('invalid form-error');
                });
            $('.error-message').remove();
            $('#UserResetpasswordForm > span#for_owner_cms').show();
            $('#UserResetpasswordForm > button[type=submit]').attr({'disabled':true});
           
			$.ajax({
               url: '<?=Router::url(array('controller'=>'admin','action'=>'validation'))?>',
                async: false,
				data: data,
                dataType:'json', 
                type:'post',
                success: function(data) {
                    if(data.error==1){
                        $.each(data.errors,function(i,v){
			    $('#'+i).addClass("invalid form-error").after('<div class="error-message">'+v+'</div>');
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
               $('#UserResetpasswordForm > button[type=submit]').attr({'disabled':false});
               $('#UserResetpasswordForm > span#for_owner_cms').hide();
            }
           return (status===1)?true:false; 
        });
    });
</script>

<body class="login">
	<section role="main">
	
		<img src="<?=Configure::read('Site.admin_logo');?>" />
	
		<!-- Login box -->
		<article id="login-box">
		
			<div class="article-container">				
				
				              
				<h1>Reset Password</h1>
				<?php echo $this->element('admin/message');?>
				<?php echo $this->Form->create('User', array('url'=>array('controller'=>'admin','action'=>'resetpassword'),'novalidate' => true,'type'=>'file'));?>
					<fieldset>
						<dl>
							<dt>
								<label>E-Mail</label>
							</dt>
							<dd>
								<?=$this->Form->hidden('form-name',array('required'=>false,'value'=>'ResetPasswordForm')); ?>
								<?php echo $this->Form->text('email', array('class' => 'fullwidth','size'=>'30')); ?>
								<?=$this->Form->error('email',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
							</dd>
							
						</dl>
					</fieldset>
					<button type="submit" class="right">Submit</button>
					<?php echo $this->Form->end(); ?>			
			</div>
		
		</article>
		<!-- /Login box -->
		<ul class="login-links">
			<li>
            <?php echo $this->Html->link('Return to site Home Page', '/', array('class'=>'leftnav','target'=>'_blank'));?>
            </li>
			<li><?php echo $this->Html->link('Login', array('controller'=>'admin','action'=>'index'), array('class'=>'leftnav'));?>
</li>
		</ul>
		
	</section>

	
</body>
</html>


