<?php

namespace Tmdb\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\Network\Request;
use Cake\View\View;
use Tmdb\View\Helper\TmdbHelper;

class TmdbHelperTest extends TestCase
{
    public function testImage()
    {
        $tmdb = $this->getMockBuilder('Tmdb\View\Helper\TmdbHelper')
            ->setMethods(['imageHelper'])
            ->setConstructorArgs([new View()])
            ->getMock();

        $tmdb->expects($this->once())
            ->method('imageHelper')
            ->willReturn(new MockImageHelper());

        $expects = '<img src="http://image.tmdb.org/t/p/w154/z2DqVxj17aW6xpimRlCLfhKSfUm.jpg" width="154" height="80" alt=""/>';
        $this->assertEquals($expects, $tmdb->image('z2DqVxj17aW6xpimRlCLfhKSfUm.jpg', 'w154', ['width' => 154, 'height' => 80]));
    }
}

class MockImageHelper
{
    public function getUrl($path, $size)
    {
        return 'http://image.tmdb.org/t/p/' . $size . '/' . $path;
    }
}
