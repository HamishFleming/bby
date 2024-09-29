<?php if ( $settings['show_ribbon'] == 'yes' ) : ?>
 <div class="jws-price-table__ribbon-inner">
 <?php if ( ! empty( $settings['ribbon_text'] ) ) {
   echo  ''.$settings['ribbon_text'];
 }
 
 ?>
 </div>   
<?php endif; ?>
<?php if ( $settings['heading'] || $settings['sub_heading'] ) : ?>
	<div class="jws-price-table__header">      
    
		<?php if ( ! empty( $settings['heading'] ) ) : ?>
			<h3 <?php echo wp_kses_post($this->get_render_attribute_string( 'heading' )); ?>><?php echo esc_html($settings['heading']); ?> </h3>
		<?php endif; ?>
		<?php if ( ! empty( $settings['sub_heading'] ) ) : ?>
    			<span <?php echo wp_kses_post($this->get_render_attribute_string( 'sub_heading' )); ?>><?php echo ''.$settings['sub_heading']; ?></span>
    		<?php endif; ?>


	</div>
<?php endif; ?>
<div class="jws-price-content">
<div class="jws-price-table__price">
	<?php if ( ! empty( $settings['price'] ) ) : ?>
             <?php echo '<h1 class="price">'.wp_kses_post($settings['price']).'</h1> '.$period_element;?>   
	<?php endif; ?>

</div>

</div>
<?php if ( ! empty( $settings['features_list'] ) ) : ?>
	<ul class="jws-price-table__features-list">
		<?php
		foreach ( $settings['features_list'] as $index => $item ) :
			$repeater_setting_key = $this->get_repeater_setting_key( 'item_text', 'features_list', $index );
			$this->add_inline_editing_attributes( $repeater_setting_key );

			$migrated = isset( $item['__fa4_migrated']['selected_item_icon'] );
			// add old default
			if ( ! isset( $item['item_icon'] ) && ! $migration_allowed ) {
				$item['item_icon'] = 'fa fa-check-circle';
			}
			$is_new = ! isset( $item['item_icon'] ) && $migration_allowed;
			?>
			<li class="jws-repeater-item-<?php echo esc_attr($item['_id']); ?>">
				<div class="jws-price-table__feature-inner">
					<?php if ( ! empty( $item['item_icon'] ) || ! empty( $item['selected_item_icon'] ) ) :
						if ( $is_new || $migrated ) :
							\Elementor\Icons_Manager::render_icon( $item['selected_item_icon'], [ 'aria-hidden' => 'true' ] );
						else : ?>
							<i class="<?php echo esc_attr( $item['item_icon'] ); ?>" aria-hidden="true"></i>
							<?php
						endif;
					endif; ?>
					<?php if ( ! empty( $item['item_text'] ) ) : ?>
						<span <?php echo ''.$this->get_render_attribute_string( $repeater_setting_key ); ?>>
							<?php echo ''.$item['item_text']; ?>
						</span>
						<?php
					else :
						echo '&nbsp;';
					endif;
					?>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>

<?php if ( ! empty( $settings['button_text'] ) || ! empty( $settings['footer_detail'] ) ) : ?>
	<div class="jws-price-table__footer elementor-button-wrapper jws-button">
		<?php if ( ! empty( $settings['button_text'] ) ) : ?>
			<a <?php echo ''.$this->get_render_attribute_string( 'button_text' ); ?>>
            <span class="elementor-button-text"> <?php echo ''.$settings['button_text']; ?> </span>
            <span class="button__horizontal"></span>
            <span class="button__vertical"></span>
            </a>
		<?php endif; ?>

		<?php if ( ! empty( $settings['footer_detail'] ) ) : ?>
			<a <?php echo ''.$this->get_render_attribute_string( 'footer_detail' ); ?>><?php echo ''.$settings['footer_detail']; ?><span class="icon-arrow-right2"></span></a>
		<?php endif; ?>
	</div>
<?php endif; ?>