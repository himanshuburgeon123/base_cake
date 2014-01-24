 <style>
.boxx{float:left; width:45%; margin:0 20px 10px 0;}
.re-link{float:left; margin-right:10px;}
</style>
 <style type="text/css">

.margin{margin-top: 10px;}
.error-message {
padding-left: 0px;
}
form.link_form {
    margin-top:0;
    min-height: 0;
    padding-bottom: 0;
	
}
form.link_form > article{
position:relative;
}
/**
 * Nestable
 */

.dd { position: relative; display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; }

.dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
.dd-list .dd-list { padding-left: 30px; }
.dd-collapsed .dd-list { display: none; }

.dd-item,
.dd-empty,
.dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

.dd-handle { display: block; height: 30px; margin: 5px 0 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd-handle:hover { color: #2ea8e5; background: #fff; }

.dd-item > button:not(.caret-down) { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
.dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
.dd-item > button[data-action="collapse"]:before { content: '-'; }

.dd-placeholder,
.dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
.dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
    background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), 
                      -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), 
                         -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), 
                              linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;
}

.dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
.dd-dragel > .dd-item .dd-handle { margin-top: 0; }
.dd-dragel .dd-handle {
    -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
}
.caret-down {
    background: url("/img/caret-down.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0); border: medium none; box-shadow: none; float: right; height: 6px; margin-top:-17px; width: 12px; padding:4px 10px;
}
.caret-down:hover{background: url("/img/caret-down.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);}
/**
 * Nestable Extras
 */

.nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; border: 0; border-top: 2px solid #ddd; border-bottom: 2px solid #ddd; }

#nestable-menu { padding: 0; margin: 20px 0; }

#nestable-output,
#nestable2-output { width: 100%; height: 7em; font-size: 0.75em; line-height: 1.333333em; font-family: Consolas, monospace; padding: 5px; box-sizing: border-box; -moz-box-sizing: border-box; }

#nestable2 .dd-handle {
    color: #fff;
    border: 1px solid #999;
    background: #bbb;
    background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
    background:    -moz-linear-gradient(top, #bbb 0%, #999 100%);
    background:         linear-gradient(top, #bbb 0%, #999 100%);
}
#nestable2 .dd-handle:hover { background: #bbb; }
#nestable2 .dd-item > button:before { color: #fff; }

@media only screen and (min-width: 700px) { 

    .dd { float: left; width: 48%; }
    .dd + .dd { margin-left: 2%; }

}

.dd-hover > .dd-handle { background: #2ea8e5 !important; }

/**
 * Nestable Draggable Handles
 */

.dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd3-content:hover { color: #2ea8e5; background: #fff; }

.dd-dragel > .dd3-item > .dd3-content { margin: 0; }

.dd3-item > button { margin-left: 30px; }

.dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
    border: 1px solid #aaa;
    background: #ddd;
    background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:         linear-gradient(top, #ddd 0%, #bbb 100%);
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
.dd3-handle:hover { background: #ddd; }
.absolute-button{
	position:absolute;
	right:20px;
	bottom:20px;
}
    </style>

<article>
	<header>
		<h2><?=$parent_detail['Menu']['name']?></h2>
	</header>
</article>

   

    <div>
		<div style="width:48%; float:left;">
		<?php echo $this->Form->create('Link',array('name'=>'Link','class'=>'link_form')); ?>
        <article class="nested">
            <header>
                    <h2>Select Pages</h2>
            </header>
            <section>
                <div class="menu-select">
                    <?php echo $this->Menu->show_pages($pages); ?>
                    <div class="clear-both"></div>
                    
                </div>
                <a href="#" class="select-all" style="float:left; margin-top:5px;">Select All</a>
                <button type="submit" style="float:right;">Add to Menu</button>
                <span class="loader" id="add-menu-loader" style="display:none; float:right;" original-title=""></span>
                
                  
            </section>
        </article>
        <?php echo $this->Form->end(); ?>
        
        <?php echo $this->Form->create('Link',array('name'=>'Link','class'=>'link_form','id'=>'CustomLinkAdminIndexForm','noValidate')); ?>
        <article class="nested">
            <header>
                    <h2>Custom Link</h2>
            </header>
            <section>
                <div class="menu-select123">
				<dl class="margin">
                    <dt><label>URL</label></dt>
                    <dd><?php echo $this->Form->text('url',array('class'=>'small'));?></dd>
                    
                    <dt><label>Link Text</label></dt>
                    <dd><?php echo $this->Form->text('name',array('class'=>'small'));?></dd>
                </dl>
                    <div class="clear-both"></div>
                </div>
                <!--<a href="#" class="select-all" style="float:left; margin-top:5px;">Select All</a>-->
                <button type="submit" style="float:right;">Add to Menu</button>
                <span class="loader" id="add-menu-loader1" style="display:none; float:right;" original-title=""></span>
            </section>
        </article>
        <?php echo $this->Form->end(); ?>
        </div>
        <div style="width:48%; float:right;">
        <?php echo $this->Form->create('Link',array('name'=>'Link','id'=>'LinkSubmitForm','url'=>array('action'=>'add',$menu_id),'class'=>'link_form')); ?>
        <?php echo $this->Form->hidden('links',array('id'=>'menu_data')); ?>
        
        <article class="nested clearrm">
            <header>
                    <h2>Menu</h2>
            </header>
            <section>
            <div class="menu-list dd dd-full-width" id="nestable2">
               <?php echo $this->Menu->show_links($links); ?>
            </div>
            <button class="absolute-button" style="position:relative; float:right; bottom:0; right:0; margin-top:20px;" type="submit">Save Menu</button>
            </section>
        </article>
         <?php echo $this->Form->end(); ?>
         </div>
    </div>
    <div class="clear-both"></div>
    <!--
    <p><strong>Serialised Output (per list)</strong></p>
    <textarea id="nestable2-output"></textarea>
    -->

<?php echo $this->Html->script('jquery.nestable.js'); ?>
<script>
 
$(document).ready(function(){
	var changes = false;
	events_all();   
	var updateOutput = function(e){
		var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
			//$('#menu_data').val(window.JSON.stringify(list.nestable('serialize')));
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
    
    $('#LinkSubmitForm').submit(function(){
		changes = false;
		return true;
		});
    
    // activate Nestable for list 2
    $('#nestable2').nestable({
        group: 1
    })
    .on('change', updateOutput);

    // output initial serialised data
    updateOutput($('#nestable2').data('output', $('#nestable2-output , #menu_data')));
  
    $('.dd-item > button').on('click',function(){
		
		$(this).next('.caret-div').toggle();
	});
	
	function events_all(){
		$('.caret-div > .re-link > .remove-link').on('click',function(){
			var link_id = $(this).parent().parent().parent().attr('data-id');
			$(this).parent().parent().parent().remove();
			changes = true;
			$.ajax({
                url: '<?=Router::url(array('action'=>'ajax_remove',$menu_id))?>',
                async: false,
				data: {'link_id':link_id},
                dataType:'json', 
                type:'post',
                success: function(data) {
					
					updateOutput($('#nestable2').data('output', $('#nestable2-output , #menu_data')));
					
                   
                   }
            });
			
			
			
			
			
			return false;
		});
		$('.select-all').on('click',function(){
			$(this).closest('form').find('input:checkbox').attr('checked','checked');
			return false;
			
			});
		$('.caret-div > div > .cancel-link').on('click',function(){
			$(this).parent().parent().toggle();
			return false;
		});
	}
	
	$('#LinkAdminIndexForm,#CustomLinkAdminIndexForm').submit(function(){
		changes = true;
		var formData = $(this);
		$(this).find('button:submit').attr('disabled','disabled');
		$(this).find('.loader').show();
		
		/* Check validation for Custom Link */
		if(($(this).attr('id'))=='CustomLinkAdminIndexForm'){
			var data = new FormData(this);
            //var formData = $(this);
            var status = 0;
           
			$.each(this,function(i,v){
                $(v).removeClass('invalid form-error');
                });
            $('.error-message').remove();
            //$('#PageCms > span#for_owner_cms').show();
            //$('#PageCms > button[type=submit]').attr({'disabled':true});
            //$('#loader_add').show();
			$.ajax({
                url: '<?=Router::url(array('admin'=>false,'action'=>'validation','CustomLink'))?>',
                async: false,
				data: data,
                dataType:'json', 
                type:'post',
				cache: false,
				contentType: false,
				processData: false,
                success: function(data) {
                    if(data.error==1){
                        $.each(data.errors,function(i,v){							
							$('#'+i).addClass("invalid form-error").after('<br class="error-message"><span class="error-message">'+v+'</span>');
                        });                       
                    }else{
                        status = 1;
                    }
				}

            });
            if(status==0){
				$(this).find('button:submit').attr('disabled',false);
				$(this).find('.loader').hide();
                return false;               
            }
            //$(this).find('button:submit').attr('disabled',false);
			//return (status===1)?'':false; 
		}
		/* End Check validation for Custom Link */
		 
		 var data = $(this).serializeArray();
		 $.ajax({
                url: '<?=Router::url(array('action'=>'ajax_save',$menu_id))?>',
                async: false,
				data: data,
                dataType:'json', 
                type:'post',
                success: function(data) {
					$.each(data,function(i,v){
						if($('#nestable2 > ol').length==0){
							$('#nestable2').prepend('<ol class="dd-list"></ol>');
						}
						var url = (v.url!='')?'<div class="boxx"><label>URL</label><input id="Link'+v.id+'Url" type="text" value="'+v.url+'" name="data[Link]['+v.id+'][url]"></div>':'';
						$('#nestable2 > ol').append('<li class="dd-item" data-id="'+v.id+'"><div class="dd-handle">'+v.name+'</div><span class="item-type">'+v.module+'</span><button type="button" class="action caret-down"></button><div class="caret-div" ><div class="boxx"><label>Navigation Label</label><input id="Link'+v.id+'Name" type="text" value="'+v.name+'"name="data[Link]['+v.id+'][name]"></div><div class="boxx"><label>Title Attribute</label><input id="Link'+v.id+'TagTitle" type="text" value="" name="data[Link]['+v.id+'][tag_title]"></div>'+url+'<br clear="all" /><div><input id="" type="hidden" value="0" name="data[Link]['+v.id+'][new_window]"><input id="Link'+v.id+'NewWindow" type="checkbox" value="1" name="data[Link]['+v.id+'][new_window]">Open link in a new window/tab </div><div class="re-link"><a href="#" class="remove-link">Remove</a></div><div><a href="#" class="cancel-link">Cancel</a></div></div></li>');
						$('#LinkAdminIndexForm  input:checkbox').attr('checked',false);
						
						});
						 $('.dd-item > button').on('click',function(){
							$(this).next('.caret-div').toggle();
						});
					updateOutput($('#nestable2').data('output', $('#nestable2-output , #menu_data')));
					events_all();
                   }				
            });
        $(this).find('.loader').hide();
        $(this).find('button:submit').attr('disabled',false);
		return false;
		
		});
		window.onbeforeunload = function(e) {
            if (changes)
            {
				//alert(e.returnValue);
                return "";
            }
        }
		
		
});

	
</script>

