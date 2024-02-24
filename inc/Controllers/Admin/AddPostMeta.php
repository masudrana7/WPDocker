<?php
namespace MRWPDocker\Inc\Controllers\Admin;
class AddPostMeta{

    public function __construct(){
        add_action( 'admin_menu', array( $this, 'wpd_add_meta' ) );
        add_action( 'save_post', array( $this, 'wpd_save_metabox' ) );
    }

    private function is_secured($nonce_field, $action, $post_id){
        $nonce =  isset( $_POST[$nonce_field] ) ? $_POST[$nonce_field] :'';
        if($nonce == ''){
            return false;
        }
        if( ! wp_verify_nonce( $nonce, $action) ){
            return false;
        }

        if( ! current_user_can('edit_post', $post_id) ){
            return false;
        }

        if( wp_is_post_autosave( $post_id ) ){
            return false;
        }
        return true;
    }

    public function wpd_save_metabox($post_id){

        if(!$this->is_secured('wpd_noce_field', 'wpd_action', $post_id)){
            return $post_id;
        }

        $dosc_name = isset($_POST['wpd_docs_name']) ? $_POST['wpd_docs_name'] : '';
        $docs_mail = isset($_POST['wpd_docs_mail']) ? $_POST['wpd_docs_mail'] : '';
        if($dosc_name == '' || $docs_mail == ''){
            return $post_id;
        }
        $dosc_name = sanitize_text_field($dosc_name);
        $docs_mail = sanitize_text_field($docs_mail);
        update_post_meta($post_id, 'wpd_docs_name', $dosc_name);
        update_post_meta($post_id, 'wpd_docs_mail', $docs_mail);
    }


    public function wpd_add_meta(){
        add_meta_box( 'wpd_docs_information', __('Docs Information', 'MRWPDocker'), [ $this,'wpd_display_docs_name'], 'wpdocker_docs');
    }

    public function wpd_display_docs_name($post){
        $dosc_name = get_post_meta( $post->ID,'wpd_docs_name', true );
        $dosc_mail = get_post_meta( $post->ID,'wpd_docs_mail', true );
        $label1 = __ ('Docs Name','MRWPDocker');
        $label2 = __ ('E-mail','MRWPDocker');
        wp_nonce_field('wpd_action', 'wpd_noce_field');  
        $meta_html = <<<EOD
        <p>
            <label for= "wpd_docs_name">{$label1}</label>
            <input type="text" name ="wpd_docs_name" id ="wpd_docs_name" value="{$dosc_name}" />
            <br/>
            <label for= "wpd_docs_mail">{$label2}</label>
            <input type="email" name ="wpd_docs_mail" id ="wpd_docs_mail" value="{$dosc_mail}" />
        </p>
        EOD;
        echo $meta_html;
    }
}
