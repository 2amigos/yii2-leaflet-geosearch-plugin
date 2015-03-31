<?php

namespace tests;


use tests\overrides\TestGeoSearch;

class GeoSearchTest extends TestCase
{
    public function testEncode()
    {
        $plugin = new TestGeoSearch();
        $plugin->map = 'testMap';
        $this->assertEquals('plugin:geosearch', $plugin->getPluginName());
        $this->assertEquals(
            'new L.Control.GeoSearch({"provider":new L.GeoSearch.Provider.OpenStreetMap(),"position":"topcenter","showMarker":true}).addTo(testMap)',
            $plugin->encode()
        );

        $plugin->clientOptions = [];
        $plugin->service = TestGeoSearch::SERVICE_BING;
        $this->assertEquals(
            'new L.Control.GeoSearch({"provider":new L.GeoSearch.Provider.Bing(),"position":"topcenter","showMarker":true}).addTo(testMap)',
            $plugin->encode()
        );

        $plugin->clientOptions = [];
        $plugin->service = TestGeoSearch::SERVICE_ESRI;
        $this->assertEquals(
            'new L.Control.GeoSearch({"provider":new L.GeoSearch.Provider.Esri(),"position":"topcenter","showMarker":true}).addTo(testMap)',
            $plugin->encode()
        );

        $plugin->clientOptions = [];
        $plugin->service = TestGeoSearch::SERVICE_GOOGLE;
        $this->assertEquals(
            'new L.Control.GeoSearch({"provider":new L.GeoSearch.Provider.Google(),"position":"topcenter","showMarker":true}).addTo(testMap)',
            $plugin->encode()
        );

        $plugin->clientOptions = [];
        $plugin->service = TestGeoSearch::SERVICE_NOKIA;
        $plugin->name = 'test';
        $this->assertEquals(
            'var test = new L.Control.GeoSearch({"provider":new L.GeoSearch.Provider.Nokia(),"position":"topcenter","showMarker":true}).addTo(testMap);',
            $plugin->encode()
        );

        $this->setExpectedException('yii\base\InvalidConfigException');
        $plugin->service = 'wrongService';
        $plugin->encode();
    }

    public function testRegister()
    {
        $view = $this->getView();
        $plugin = new TestGeoSearch();

        $this->assertEquals($plugin, $plugin->registerAssetBundle($view));

        $this->assertCount(2, $view->assetBundles);

        $this->assertArrayHasKey('tests\overrides\TestGeoSearchAsset', $view->assetBundles);

        $this->assertEquals(
            'js/l.control.geosearch.js',
            $view->assetBundles['tests\overrides\TestGeoSearchAsset']->js[0]
        );
        $this->assertEquals(
            'js/l.geosearch.provider.openstreetmap.js',
            $view->assetBundles['tests\overrides\TestGeoSearchAsset']->js[1]
        );
    }

}
