
<!-- END BROWSERIE -->
<!-- BEGIN BROWSERMOZ -->
<style type="text/css">
    ul.Main {
        list-style-type: none; margin-left:0;
    }
    .ui-state-highlight { height: 30px; line-height: 25px; }
    /*
    ul.Main {
        list-style-type: none;
        margin-left:-40px;
        padding:0;
        margin-top:-1px;
        margin-left:0;
    }
    ul li.Main2 {
        color:#000000;
        border: 1px solid #cccccc;
        cursor: move;
        margin-bottom: 0px;
        background:  #FFFFFF;
        border: 1px solid #efefef;
        /*width: 763px; *
        text-align: left;
        font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;
    }	
    ul li.Main3 {
        color:#000000;
        border: 1px solid  #FFE8E8;
        cursor: move;
        margin-bottom: 0px;
        background: #FFE8E8;
        border: 1px solid #efefef;
        width: 763px;
        text-align: left;
        font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;

    }
.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
*/
</style>


<div>
    <article>
        <header>
            <h2>Association (Saving Record in multiple tables)
            
            </h2>
             <div style="float:right;">
                <?php echo $this->Html->link('New', array('controller' => 'accounts', 'action' => 'add'), array('escape' => false, 'class' => 'button')); ?>
            </div>
        </header>
    </article>
   
    <form method="post">
    <div class="input text" style="overflow:hidden;">
	Search:
	<input id="search" type="text" style="margin-left:10px; margin-right:10px;" name="search" value="<?=$search?>" />
	<button type="submit" style="margin-top:10px; margin-left:10px" >search</button>
    </div>
    </form>
    <?php echo $this->element('admin/message'); ?>
    <?=$this->Form->create('Account', array('name' => 'account', 'action' => 'index' , 'id' => 'AccountDeleteForm', 'onSubmit' => 'return validate(this)', 'class' => 'table-form')); ?>
    <?=$this->Form->hidden('action', array('id' => 'action', 'value' => '')); ?>
    <?=$this->Form->hidden('redirect', array('value' => $url)); ?>

    <table width="100%">
        <tr>
            <th width="5%"><?= $this->Form->checkbox('check', array('value' => 1, 'onchange' => "CheckAll(this.value)", 'class' => 'check-all')); ?></th>
            <th width="1%">&nbsp;</th>
            <th width="6%">SNo.</th>
            <th width="30%">Name</th>
            <th width="40%">Company</th>
            <th width="20%">Actions</th>
        </tr>
        <tr>
            <td colspan="6">
                <ul class="Main">
                <?php
				$i = $this->paginator->counter('{:start}');
                    //$i = 0;
                    foreach ($accounts as $account) {
                ?>
                    <li id="sort_<?= $account['Account']['id'] ?>">
                        <table width="100%">
                            <tr>
                                <td width="5%"><?php echo $this->Form->checkbox('Account.id.'.$i, array('value' => $account['Account']['id'])); ?></td>
                                <td width="6%"><?php echo $i++; ?></td>
                                <td width="30%"><?php echo $account['Account']['name']; ?></td>
								<td width="40%"><?php echo $account['Profile']['company']; ?></td>
                                <td width="20%">
                                    <ul class="actions">
                                        <li><?php echo $this->Html->link('edit', array('controller' => 'accounts', 'action' => 'add', $account['Account']['id']), array('escape' => false, 'class' => 'edit', 'title' => 'Edit Page', 'rel' => 'tooltip')); ?></li>
                                        <li><?=$this->Html->link('view', array('controller' => 'accounts', 'action' => 'view', $account['Account']['id']), array('escape' => false,'class'=>'view fancybox','title'=> __('View'),'rel'=>'tooltip'))?></li>
										<li><?=$this->Html->link('Messages', array('controller' => 'posts', 'action' => 'messages', $account['Account']['id']), array('escape' => false,'class'=>'view','title'=> __('View Messages'),'rel'=>'tooltip'))?></li>

                                    </ul >
                                </td> 
                            </tr>
                        </table>
                    </li>
                    <?php } ?>
                </ul>
            </td>
        </tr>
    <tr>
        <td colspan="6" id="loader_pagination" style="display:none;"><div><?=$this->Html->image('admin/icons/ajax_loading_ladder.gif');?></div></td>
    </tr>
        <tfoot>
        <tr>
                <td colspan="7">
                    <?php if (!$accounts) { ?>
                    <div style='color:#FF0000'>No Record Found</div>
                    <?php }else{ ?>
                    <noscript>
                    <ul class="pagination">
							
						<?php if($this->Paginator->first()){?>
						<li><?php echo $this->Paginator->first('« First',array('class'=>'')); ?></li>
						<?php } ?>
						
						<?php if($this->Paginator->hasPrev()){?>
						<li><?php echo $this->Paginator->prev('< Previous',array('class'=>''), null, array('class'=>'disabled'));?>&nbsp;... &nbsp;</li>
						<?php } ?>
						
						<?=$this->Paginator->numbers(array('modulus'=>6,'tag'=>'li','class'=>'','separator'=>'')); ?>
						<?php if($this->Paginator->hasNext()){?>
						
						<li><?php echo $this->Paginator->next('Next >',array('class'=>''));?></li>
						<?php } ?>
						<?php if($this->Paginator->last()){?>
						<li><?php echo $this->Paginator->last('Last »',array('class'=>'')); ?></li>
						<?php } ?>
					</ul>
					</noscript>
                    <?php } ?>
                     

                </td>
            </tr>
        </tfoot>

    </table>
</form>

</div>
