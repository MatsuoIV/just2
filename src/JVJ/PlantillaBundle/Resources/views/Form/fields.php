
<p>
    <?php
    
    $label=$view['form']->label($form, $label) ;
    echo $view['form']->errors($form);
    echo $view['form']->widget($form, array(
    'attr' => array('placeholder' => $label),)) 
    ?>
</p>
