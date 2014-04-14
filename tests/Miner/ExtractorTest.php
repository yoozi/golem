<?php

use Yoozi\Miner\Extractor;
use Buzz\Client\Curl;

class ExtractorTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \Yoozi\Miner\Extrator
     */
    protected $extractor;

    public function setUp()
    {
        $this->extractor = new Extractor();
    }

    public function teardown()
    {
        unset($this->extractor);
    }

    public function testParseUTF8SourceWithMetaParser()
    {
        $this->extractor->getConfig()->set('parser', 'meta');
        $meta = $this->extractor->fromSource($this->file('utf-8'))->run();

        $this->assertEquals($meta['title'], '【专治不明觉厉】之“大数据”');
        $this->assertEquals($meta['author'], '虎嗅网');
        $this->assertEquals($meta['keywords'], explode(',', '科技资讯,商业评论,明星公司动态,宏观趋势,精选,有料,干货,有用,细节,内幕'));
        $this->assertEquals($meta['description'], '大数据，官方定义是指那些数据量特别大、数据类别特别复杂的数据集。大数据的主要特点为数据量大，数据类别复杂，数据处理速度快和数据真实性高。');
        $this->assertEquals($meta['image'], '');

        $meta = $this->extractor->fromSource($this->file('utf-8'))->run(function($meta) {
            $meta['title'] = 'replaced';
            return $meta;
        });

        $this->assertEquals($meta['title'], 'replaced');

        $og = $this->extractor->fromSource($this->file('utf-8-with-og'))->run();

        $this->assertEquals($og['title'], 'AP sources: US considers release of spy Pollard');
        $this->assertEquals($og['author'], NULL);
        $this->assertEquals($og['keywords'], array());
        $this->assertEquals($og['description'], 'JERUSALEM (AP) — The United States is talking with Israel about releasing convicted spy Jonathan Pollard early from his life sentence as an incentive to the Israelis in the troubled Mideast peace negotiations, people familiar with the talks said Monday. Releasing Pollard, a thorn in U.S.-Israeli relations for three decades, would be an extraordinary step underscoring the urgency of U.S. peace efforts.');
        $this->assertEquals($og['image'], 'http://l.yimg.com/bt/api/res/1.2/vQUly0xl2admpd8f4_adyQ--/YXBwaWQ9eW5ld3M7cT04NTt3PTYwMA--/http://media.zenfs.com/en_us/News/ap_webfeeds/dafd55e7b1230e0c500f6a706700734c.jpg');
    }

    private function file($name)
    {
        return file_get_contents(__DIR__ . '/fixtures/' . $name . '.html');
    }
}
