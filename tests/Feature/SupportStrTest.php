<?php

namespace Tests\Feature;

use Tests\TestCase;

class SupportStrTest extends TestCase
{
    public function testIs()
    {
        $this->assertTrue(\Str::is('/', '/'));
        $this->assertFalse(\Str::is('/', ' /'));
        $this->assertFalse(\Str::is('/', '/a'));
        $this->assertTrue(\Str::is('foo/*', 'foo/bar/baz'));
        $this->assertTrue(\Str::is('*/foo', 'blah/baz/foo'));
    }
}
