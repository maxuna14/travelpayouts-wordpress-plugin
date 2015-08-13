<?php
/**
 * Created by PhpStorm.
 * User: freeman
 * Date: 12.08.15
 * Time: 15:43
 */

class TPWidgetButtonsController extends KPDAdminMediaButtonsController{

    public function action($args = array())
    {
        // TODO: Implement action() method.
        $args = wp_parse_args( $args, array(
            'target'    => 'content',
            'text'      => __( 'Insert widget', KPDPlUGIN_TEXTDOMAIN  ),
            'class'     => 'button',
            'icon'      =>  KPDPlUGIN_URL.'app/public/images/tp_button_widget.png',
            'echo'      => true,
            'shortcode' => false
        ) );
        // Prepare icon
        if ( $args['icon'] ) $args['icon'] = '<img src="' . $args['icon'] . '" /> ';
        $button = '<a href="#" id="constructorWidgetButton" class="su-generator-button '.$args['class'].'">'.
            $args['icon'] . $args['text'].'</a>';
        add_action( 'wp_footer',    array( &$this, 'render' ) );
        add_action( 'admin_footer', array( &$this, 'render' ) );
        wp_enqueue_media();
        if ( $args['echo'] ) echo $button;
        return $button;
    }

    public function render()
    {
        // TODO: Implement render() method.
        $pathView = KPDPlUGIN_DIR."/app/includes/views/admin/media_buttons/TPWidgetButtons.view.php";
        parent::loadView($pathView);
    }
}