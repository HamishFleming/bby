<?php 


    
    $product_question = get_post_meta( get_the_ID(), 'product_questions', true );

    if($product_question) {
      echo '<a href="'.get_the_permalink($product_question).'" target="_blank">'.get_the_title($product_question).'</a>';
    }
    $this->text(
        array(
            'id' => 'product_name',
    		'label'=> 'Name',
    		'desc'=> '',
        )
    );
    $this->text(
        array(
            'id' => 'product_email',
    		'label'=> 'Email',
    		'desc'=> '',
        )
    );
    $this->textarea(
        array(
            'id' => 'answer_content',
    		'label'=> 'Answer Content',
    		'desc'=> '',
        )
    );
?>