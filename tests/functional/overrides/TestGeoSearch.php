<?php
/**
 *
 * TestGeoSearch.php
 *
 * Date: 30/03/15
 * Time: 17:01
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */

namespace tests\overrides;


use dosamigos\leaflet\plugins\geosearch\GeoSearch;

class TestGeoSearch extends GeoSearch
{
    public function registerAssetBundle($view)
    {
        switch ($this->service) {
            case static::SERVICE_OPENSTREETMAP:
            case static::SERVICE_BING:
            case static::SERVICE_ESRI:
            case static::SERVICE_GOOGLE:
            case static::SERVICE_NOKIA:
                TestGeoSearchAsset::register($view)->js[] = "js/l.geosearch.provider.{$this->service}.js";
                break;
            default:
                TestGeoSearchAsset::register($view);
        }
        return $this;
    }
}
