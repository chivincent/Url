<?php

namespace Test;

use Chivincent\Url\Url;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    public function test_normal_url()
    {
        $url = new Url('https://www.google.com');

        $this->assertSame('https', $url->scheme);
        $this->assertNull($url->user);
        $this->assertNull($url->password);
        $this->assertSame('www.google.com', $url->host);
        $this->assertSame('/', $url->path);
        $this->assertNull($url->query);
        $this->assertNull($url->fragment);
    }

    public function test_with_non_ascii()
    {
        $url = new Url('https://中文.台灣/你好嗎?我=很好&大家都很好#你呢？');

        $this->assertSame('中文.台灣', $url->host);
        $this->assertSame('/你好嗎', $url->path);
        $this->assertSame('我=很好&大家都很好', $url->query);
        $this->assertSame('你呢？', $url->fragment);
    }
}