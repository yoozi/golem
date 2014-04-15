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

        $this->assertEquals($meta['title'], '剖析乐视X50air的成本魔术：2999超低价是这么实现');
        $this->assertEquals($meta['author'], '虎嗅网');
        $this->assertEquals($meta['keywords'], explode(',', '科技资讯,商业评论,明星公司动态,宏观趋势,精选,有料,干货,有用,细节,内幕'));
        $this->assertEquals($meta['description'], '@智能电视行业观察：乐视的X50 air弃日韩屏改用台湾屏；弃1+1芯片平台改单一芯片方案；把前框后盖做进外观；弃富士康改TPV；强制新购机用户购买两年观看费，做整机利润补充……');
        $this->assertEquals($meta['image'], '');

        $meta = $this->extractor->fromSource($this->file('utf-8'))->run(function($meta) {
            $meta['title'] = 'replaced title';
            return $meta;
        });

        $this->assertEquals($meta['title'], 'replaced title');

        $og = $this->extractor->fromSource($this->file('utf-8-with-og'))->run();

        $this->assertEquals($og['title'], 'AP sources: US considers release of spy Pollard');
        $this->assertEquals($og['author'], NULL);
        $this->assertEquals($og['keywords'], array());
        $this->assertEquals($og['description'], 'JERUSALEM (AP) — The United States is talking with Israel about releasing convicted spy Jonathan Pollard early from his life sentence as an incentive to the Israelis in the troubled Mideast peace negotiations, people familiar with the talks said Monday. Releasing Pollard, a thorn in U.S.-Israeli relations for three decades, would be an extraordinary step underscoring the urgency of U.S. peace efforts.');
        $this->assertEquals($og['image'], 'http://l.yimg.com/bt/api/res/1.2/vQUly0xl2admpd8f4_adyQ--/YXBwaWQ9eW5ld3M7cT04NTt3PTYwMA--/http://media.zenfs.com/en_us/News/ap_webfeeds/dafd55e7b1230e0c500f6a706700734c.jpg');
    }

    public function testParseUTF8SourceWithHybridParser()
    {
        $file = $this->file('utf-8');

        $this->extractor->getConfig()->set('parser', 'hybrid');
        $this->extractor->getConfig()->set('strip_tags', true);
        $meta = $this->extractor->fromSource($file)->run();

        $this->assertEquals($meta['title'], '剖析乐视X50air的成本魔术：2999超低价是这么实现');
        $this->assertEquals($meta['author'], '虎嗅网');
        $this->assertEquals($meta['keywords'], explode(',', '科技资讯,商业评论,明星公司动态,宏观趋势,精选,有料,干货,有用,细节,内幕'));
        $this->assertEquals($meta['image'], 'http://img.huxiu.com/portal/201404/13/075642tmtperw23rvpt3n5.png');
        $this->assertEquals(trim($meta['description']), trim($this->file('utf-8-readability', '.txt')));
    }

    public function testParseRemoteUrlWithHybridParser()
    {
        $this->extractor->getConfig()->set('parser', 'hybrid');
        $this->extractor->getConfig()->set('strip_tags', true);

        $meta = $this->extractor->fromUrl('http://www.example.com/', new Curl)->run();
        $this->assertEquals($meta['title'], 'Example Domain');
        $this->assertEquals($meta['url'], 'http://www.example.com/');
        $this->assertEquals($meta['host'], 'http://www.example.com');
        $this->assertEquals($meta['domain'], 'example.com');
        $this->assertEquals($meta['favicon'], 'http://www.google.com/s2/favicons?domain=example.com');

        $this->assertInstanceOf('Yoozi\Miner\Parsers\ParserInterface', $this->extractor->getParser());
        $this->assertInstanceOf('Yoozi\Miner\Config', $this->extractor->getConfig());
        $this->assertEquals($this->extractor->getCharset(), 'utf-8');
    }

    private function file($name, $ext = '.html')
    {
        return file_get_contents(__DIR__ . '/fixtures/' . $name . $ext);
    }
}
