<div id="jws_cars_metabox" class='jws_cars_metabox'>
    <div class="tabs ui-tabs-vertical">
          <ul>
                <li><a href="#tab1"><?php echo esc_html__('General','idealauto'); ?></a></li>
                <li><a href="#tab2"><?php echo esc_html__('Color Theme','idealauto'); ?></a></li>
          </ul>
          <div class="meta-container"> 
            <div id="tab1">
                <?php
                   $this->select(
                        array(
                            'id' => 'page_select_header',
                    		'label'=> esc_html__('Select Header For Page','idealauto'),
                    	    'option'=> '',
                            'default'=> '',
                    		'desc'=> '',
                            'post_type'=> 'hf_template'
                        )
                	);
                     $this->select(
                        array(
                            'id' => 'page_select_footer',
                    		'label'=> esc_html__('Select Footer For Page','idealauto'),
                    	    'option'=> '',
                            'default'=> '',
                    		'desc'=> '',
                            'post_type'=> 'hf_template'
                        )
                	);
                    $this->checkbox(
                            array(
                                'id' => 'turn_off_header',
                        		'label'=> esc_html__('Turn Off Header','idealauto'),
                        		'desc'=> '',
                            )
                   );
                   $this->checkbox(
                            array(
                                'id' => 'turn_off_footer',
                        		'label'=> esc_html__('Turn Off Footer','idealauto'),
                        		'desc'=> '',
                            )
                   );
                    $this->checkbox(
                            array(
                                'id' => 'title_bar_checkbox',
                        		'label'=> esc_html__('Turn Off Title Bar','idealauto'),
                        		'desc'=> '',
                            )
                   );
                   $this->select(
                        array(
                            'id' => 'page_select_titlebar',
                    		'label'=> esc_html__('Select Custom Title Bar For Page','idealauto'),
                    	    'option'=> '',
                            'default'=> '',
                    		'desc'=> '',
                            'post_type'=> 'hf_template'
                        )
                	);
                    $this->checkbox(
                            array(
                                'id' => 'page_header_absolute',
                        		'label'=> esc_html__('Header Absolute','idealauto'),
                        		'desc'=> '',
                            )
                   );
                ?>
            </div> 
            <div id="tab2">
                <?php 
                    $this->colorpicker(
                            array(
                                'id' => 'main_color',
                        		'label'=> esc_html__('Main Color','idealauto'),
                        		'desc'=> '',
                            )
                   );
                   $this->colorpicker(
                            array(
                                'id' => 'button-bgcolor',
                        		'label'=> esc_html__('Button Background Color','idealauto'),
                        		'desc'=> '',
                            )
                   );
                   $this->colorpicker(
                            array(
                                'id' => 'button-bgcolor2',
                        		'label'=> esc_html__('Button Background Color Hover','idealauto'),
                        		'desc'=> '',
                            )
                   );
                ?>
            </div>
          </div> 
    </div>
</div>    
           