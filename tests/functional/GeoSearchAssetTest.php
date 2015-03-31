<?php

namespace tests;

use tests\overrides\TestGeoSearchAsset;
use yii\web\AssetBundle;

class GeoSearchAssetTest extends TestCase
{
    public function testRegister()
    {
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        TestGeoSearchAsset::register($view);
        $this->assertEquals(2, count($view->assetBundles));
        $this->assertTrue($view->assetBundles['tests\\overrides\\TestGeoSearchAsset'] instanceof AssetBundle);
        $content = $view->render('//layouts/rawlayout.php');
        $this->assertContains('leaflet.css', $content);
        $this->assertContains('l.geosearch.css', $content);
        $this->assertContains('leaflet-src.js', $content);
        $this->assertContains('l.control.geosearch.js', $content);

    }
}
