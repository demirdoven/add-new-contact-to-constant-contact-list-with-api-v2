<?php
if( $_POST['email'] && $_POST['email']!='' ){
    add_new_constant_contact_item_to_contact_list( $_POST['email'] );
}
?>
