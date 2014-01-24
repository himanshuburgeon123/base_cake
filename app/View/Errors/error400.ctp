<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>

<!---------Start Content---------->
<h2>404 Error</h2>
       <div class="left-side-div">
          <p>Don't worry you will be back on track in no time!</p>
          <?php echo $this->Html->image('404-error.png');?>
         
          <p>Page doesn't exist or some other error occured.<br />Go to our <a href="index.html">home page</a></p>
       </div><!--end left-side-div-->
       <div class="right-side-div">
		    <?php echo $this->Html->image('are-you-lost.png');?>
          
       </div><!--end right-side-div-->
<!---------End Content---------->
