 <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading"><?php echo utf8_encode(__('Iniciar Sesión')); ?></p>
            <div class="block-body">
            	<?php echo $this->Form->create('User',array('action' => 'login','type' => 'post'));?>
                    <?php echo $this->Form->input('username', array('label' =>__('Nombre de usuario'), 'class' => 'span12')); ?>
                    <?php echo $this->Form->input('password',array('label' =>utf8_encode(__('Contraseña')), 'type' => 'password', 'class' => 'span12')); ?>
                    <button type="submit" class="btn btn-primary pull-right">
						<?php echo __('Ingresar'); ?>
					</button>
                    <label class="remember-me"><input type="checkbox"> Remember me</label>
                    <div class="clearfix"></div>
                </form>    
            </div>
        </div>
        <p class="pull-right" style=""><a href="http://www.portnine.com" target="blank">Theme by Portnine</a></p>
        <p><a href="reset-password.html">Forgot your password?</a></p>
    </div>
</div>

