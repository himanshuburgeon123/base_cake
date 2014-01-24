
<div>
	<article>
		<header>
			<h2>Administrator</h2>
		</header>
	</article>
	<?=$this->element('admin/message');?>
	<?=$this->Form->create('User',array('name'=>'user','url'=>array('controller'=>'admin','action'=>'adminprofile'),'onsubmit'=>'return validate();' ))?>
	<fieldset>
		<dl>
			<dt>
				<label>Name <span style="color:red;">*</span></label>
			</dt>
			<dd>
				<?=$this->Form->input('name',array('class'=> 
				'medium','size'=>'60','div'=>false,'label'=>false)); ?>
			</dd>
			
			<dt>
				<label>Last Name <span style="color:red;">*</span></label>
			</dt>
			<dd>
				<?=$this->Form->input('lname',array('class'=> 
				'medium','size'=>'60','div'=>false,'label'=>false)); ?>
			</dd>
		
			<dt>
				<label>Admin Email <span style="color:red;">*</span></label>
			</dt>
			<dd>
				<?=$this->Form->text('email',array('class'=> 
				'medium','size'=>'60','div'=>false,'label'=>false)); ?>
			</dd>
		
		</dl>

                    
                 
    </fieldset>
    <button type="submit"><?=__('Save');?></button>
         <?=$this->Form->end();?>
        </div>
