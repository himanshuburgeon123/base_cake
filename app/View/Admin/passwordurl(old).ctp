<div>
    <article>
            <header>
                    <h2> Password</h2>
            </header>
    </article>
    <?php echo $this->element('admin/message');?>
    <?php echo $this->Form->create('User', array('name' => 'user','url' => array('controller'=>'admin','action'=>'passwordurl/'.$str),'onSubmit'=>'//return validatefields()'));?>
    <fieldset>
        
        <dt><label>New Password <span style="color:red;">*</span></label></dt>
        <dd><?php echo $this->Form->password('password', array('class'=>'small','size' => 20,'required'=>false)); ?></dd>
        <dt><label>Confirm Password <span style="color:red;">*</span></label></dt>
        <dd><?php echo $this->Form->password('password2', array('class'=>'small','size' => 20,'required'=>false)); ?></dd>
    </fieldset>
    <button type="submit">Save Password</button>
    <?php echo $this->Form->end();?>
	
</div>
