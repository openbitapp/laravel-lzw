<?php

namespace Openbitapp\LZW\Test;

use Openbitapp\LZW\LZW;
use Openbitapp\LZW\LZWFacade;
use Openbitapp\LZW\LZWProvider;
use Orchestra\Testbench\TestCase;

class Test extends TestCase
{
    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            LZWProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'LZW' => LZWFacade::class,
        ];
    }

    /** @test */
    public function test_service_provider()
    {
        $lzw = $this->app['laravel-lzw'];

        $this->assertInstanceOf(\Openbitapp\LZW\LZW::class, $lzw);
    }

    /** @test */
    public function test_compression()
    {
        $lzw = $this->app['laravel-lzw'];

        $string = 'Text to be compressed.';

        $result = $lzw->compress($string);

        $stringResult = $result->toString();

        $this->assertIsString($stringResult);
        $this->assertEquals('84,101,120,116,32,116,111,32,98,101,32,99,111,109,112,114,101,115,115,101,100,46', $stringResult);

        $arrayResult = $result->toArray();

        $this->assertIsArray($arrayResult);
        $this->assertEquals([84,101,120,116,32,116,111,32,98,101,32,99,111,109,112,114,101,115,115,101,100,46], $arrayResult);

        $jsonResult = $result->toJson();

        $this->assertIsString($jsonResult);
        $this->assertEquals('[84,101,120,116,32,116,111,32,98,101,32,99,111,109,112,114,101,115,115,101,100,46]', $jsonResult);
    }

    /** @test */
    public function test_decompression()
    {
        $lzw = $this->app['laravel-lzw'];

        $compressedString = '84,101,120,116,32,116,111,32,98,101,32,99,111,109,112,114,101,115,115,101,100,46';
        $compressedArray = [84,101,120,116,32,116,111,32,98,101,32,99,111,109,112,114,101,115,115,101,100,46];

        $stringResult = $lzw->decompress($compressedString);

        $this->assertEquals('Text to be compressed.', $stringResult);

        $arrayResult = $lzw->decompress($compressedArray);

        $this->assertEquals('Text to be compressed.', $arrayResult);
    }
}
