<?php

namespace Tests\Unit;

use Tests\UnitTest;

class HelperTest extends UnitTest
{
    public function test_isActiveUrl()
    {
        $path = '/info/buchung-einlagerung';

        $this->assertTrue(
            isActiveUrl('/info', true, $path)
        );

        $this->assertNull(
            isActiveUrl('/info/foo', true, $path)
        );

        $this->assertTrue(
            isActiveUrl('/info/buchung-einlagerung', true, $path)
        );

        $this->assertTrue(
            isActiveUrl('/info/buchung-einlagerung/foo', true, $path)
        );

        $this->assertNull(
            isActiveUrl('/buch', true, $path)
        );

        $this->assertNull(
            isActiveUrl('/buch/foo', true, $path)
        );
    }
}
