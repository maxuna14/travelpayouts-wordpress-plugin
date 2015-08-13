<?php
/**
 * Created by PhpStorm.
 * User: freeman
 * Date: 13.08.15
 * Time: 13:31
 */

class TPSubscriptionsWidgetController extends TPWigetsShortcodesController{

    public function initShortcode()
    {
        // TODO: Implement initShortcode() method.
        add_shortcode( 'tp_subscriptions_widget', array(&$this, 'action'));
    }

    public function render($data)
    {
        // TODO: Implement render() method.
        $widgets = 4;
        $origin_i = '';
        $destination_i = '';
        if(!empty(TPPlugin::$options['widgets'][$widgets]['origin'])){
            preg_match('/\[(.+)\]/',  TPPlugin::$options['widgets'][$widgets]['origin'], $origin_iata);
            $origin_i = $origin_iata[1];
        }
        if(!empty(TPPlugin::$options['widgets'][$widgets]['destination'])){
            preg_match('/\[(.+)\]/',  TPPlugin::$options['widgets'][$widgets]['destination'], $destination_iata);
            $destination_i = $destination_iata[1];
        }
        $defaults = array(
            'origin' => $origin_i,
            'destination' => $destination_i,
            'width' => TPPlugin::$options['widgets'][$widgets]['width']
        );
        extract( wp_parse_args( $data, $defaults ), EXTR_SKIP );
        $color = rawurlencode(TPPlugin::$options['widgets'][$widgets]['color']);
        $width = (isset($responsive) && $responsive == 'true')? "?" : "?width={$width}px&";
        //error_log($width);
        $output = '';
        $output = '<script async src="//www.travelpayouts.com/subscription_widget/widget.js'.$width.'backgroundColor='.$color
            .'&marker='.$this->view->getMarker($widgets).'&host='.$this->view->getWhiteLabel($widgets).'
            &originIata='.$origin.'&destinationIata='.$destination.'"></script>';
        return $output;
    }
}