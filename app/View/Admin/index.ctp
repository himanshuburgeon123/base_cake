
 
        <section role="main">
			<img src="<?=Configure::read('Site.admin_logo');?>" />
			<!-- Login box -->
            <article id="login-box">
			
                <div class="article-container">	
                <?=$this->element('admin/message'); ?>
                    <!-- Notification -->
                     <?php //print_r($_SESSION); ?>
                    <?php if ($this->Session->check('Message.auth')): ?>
                      
                        <div class="notification error">
                            <a href="#" class="close-notification" title="Hide Notification" rel="tooltip">x</a>
                            <p><strong>Error notification</strong>
                                <?php echo $this->Session->flash('auth'); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                    <!-- /Notification -->
                    <h1><?=$setting['site']['site_name']?> ! Administrator Login</h1>
                    <?= $this->AdminForm->create('User', array('url' =>'index')); ?>
                    <fieldset>
                        <dl>
							<?=$this->AdminForm->hidden('form-name',array('required'=>false,'value'=>'AdminLogin')); ?>
                            <?php echo $this->AdminForm->input('username',array('required'=>false)); ?>
                             <?=$this->AdminForm->error('name',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
                            <?php echo $this->AdminForm->input('password',array('type'=>'password','required'=>false)); ?>
                             <?=$this->AdminForm->error('name',null,array('wrap' => 'span', 'class' => 'error-message')); ?>
                            
                            
                        </dl>
                    </fieldset>
                    <button type="submit" class="right">Log in</button>					
                    </form>

                </div>

            </article>
            <!-- /Login box -->
            <ul class="login-links">
                <li><?php echo $this->Html->link('Lost password?', array('controller' => 'admin', 'action' => 'resetpassword'), array('class' => 'leftnav')); ?></li>
                <li><?php echo $this->Html->link('Return to Site Home Page', '/', array('class' => '', 'target' => '_blank')); ?></li>
            </ul>

        </section>

       

    


<script type="text/javascript">
   

    $(document).ready(function(){
		$('#UserIndexForm').submit(function(){
			var data = $(this).serializeArray();
			var formData = $(this);
            var status = 0;
			$.each(this,function(i,v){
                $(v).removeClass('invalid form-error');
                });
            $('.error-message').remove();
            $('#UserIndexForm > span#for_owner_cms').show();
            $('#UserIndexForm > button[type=submit]').attr({'disabled':true});
           
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
               $('#UserIndexForm > button[type=submit]').attr({'disabled':false});
               $('#UserIndexForm > span#for_owner_cms').hide();
            }
           return (status===1)?true:false; 
        });
    });
</script>
