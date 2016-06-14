<?php
/**
 * Created by PhpStorm.
 * User: freeman
 * Date: 13.08.15
 * Time: 10:33
 */
namespace app\includes\models\site\shortcodes;
class TPCheapestFlightsShortcodeModel extends \app\includes\models\site\TPShortcodesChacheModel{
    /**
     * @param array $args
     * @return array|bool
     */
    public function get_data($args = array())
    {
        // TODO: Implement get_data() method.

        $defaults = array( 'origin' => false, 'destination' => false, 'departure_at' => false, 'return_at' => false,
            'currency' => 'RUB', 'title' => '', 'paginate' => true, 'off_title' => '', 'subid' => '' );
        extract( wp_parse_args( $args, $defaults ), EXTR_SKIP );
        $attr = array( 'origin' => $origin, 'destination' => $destination,
            'departure_at' => $departure_at, 'return_at' => $return_at,
            'currency' => $this->typeCurrency() );
        $name_method = "***************".__METHOD__."***************";
        $method = __CLASS__." -> ". __METHOD__." -> ".__LINE__
            ." 3. Самые дешевые билеты по направлению ";
        if(TPOPlUGIN_ERROR_LOG)
            error_log($name_method);
        if(TPOPlUGIN_ERROR_LOG)
            error_log($method);
        if($this->cacheSecund()) {
            if(TPOPlUGIN_ERROR_LOG)
                error_log("{$method} -> cache");
            if (false === ($rows = get_transient($this->cacheKey('4', $origin . $destination)))) {
                if(TPOPlUGIN_ERROR_LOG)
                    error_log("{$method} -> cache false");
                $return = \app\includes\TPPlugin::$TPRequestApi->get_cheapest($attr);
                if(TPOPlUGIN_ERROR_LOG)
                    error_log("{$method} cache false ".print_r($return, true));

                $cacheSecund = 0;
                if( ! $return ) {
                    $rows = array();
                    $cacheSecund = $this->cacheEmptySecund();
                } else {
                    $rows = $this->iataAutocomplete($this->tpSortCheapestFlightsShortcodes($return), 4);
                    $cacheSecund = $this->cacheSecund();
                }
                if(TPOPlUGIN_ERROR_LOG)
                    error_log("{$method} cache secund = ".$cacheSecund);

                set_transient( $this->cacheKey('4', $origin.$destination) , $rows, $cacheSecund);
            }
        }else{
            $return = \app\includes\TPPlugin::$TPRequestApi->get_cheapest($attr);
            if( ! $return )
                return false;
            $rows = $this->iataAutocomplete($this->tpSortCheapestFlightsShortcodes($return), 4);
        }
        if(TPOPlUGIN_ERROR_LOG)
            error_log("{$method} rows = ".print_r($rows, true));
        if(TPOPlUGIN_ERROR_LOG)
            error_log($name_method);
        return array('rows' => $rows, 'type' => 4, 'origin' => $this->iataAutocomplete($origin, 0),
            'destination' => $this->iataAutocomplete($destination, 0, 'destination'), 'title' => $title,
            'origin_iata' => $origin, 'destination_iata' => $destination  , 'paginate' => $paginate,
            'off_title' => $off_title, 'subid' => $subid
        );
    }
}