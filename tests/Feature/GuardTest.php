<?php

namespace Tests\Feature;

use Alpaca\Support\Guard;
use Tests\IntegrationTest;

class GuardTest extends IntegrationTest
{
    protected $gate;

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();
        $this->gate = new Guard(
            app('Illuminate\Contracts\Auth\Access\Gate'),
            app('cache.store')
        );
    }

    public function testHasPermission()
    {
        $this->assertTrue($this->gate->hasPermission('administrator.block.administer'));
        $this->assertFalse($this->gate->hasPermission('administrator.wohoo'));
    }

    public function testGetPermissionKeys()
    {
        $permissions = $this->gate->getPermissionFromDB();

        $this->assertEquals([
            0 => "administrator.block.administer",
            1 => "administrator.block.create",
            2 => "administrator.block.edit",
            3 => "administrator.block.delete",
            4 => "administrator.category.administer",
            5 => "administrator.category.create",
            6 => "administrator.category.edit",
            7 => "administrator.category.delete",
            8 => "administrator.contact.send",
            9 => "administrator.emailtemplate.show_template",
            10 => "administrator.image.administer",
            11 => "administrator.image.create",
            12 => "administrator.image.edit",
            13 => "administrator.image.delete",
            14 => "administrator.menu.administer",
            15 => "administrator.menu.create",
            16 => "administrator.menu.edit",
            17 => "administrator.menu.delete",
            18 => "administrator.menu.add_link",
            19 => "administrator.menu.edit_link",
            20 => "administrator.menu.delete_link",
            21 => "administrator.permission.administer",
            22 => "administrator.permission.edit",
            23 => "administrator.role.administer",
            24 => "administrator.role.create",
            25 => "administrator.role.edit",
            26 => "administrator.role.delete",
            27 => "administrator.user.administer",
            28 => "administrator.user.create",
            29 => "administrator.user.edit",
            30 => "administrator.user.delete",
            31 => "administrator.page.administer",
            32 => "administrator.page.create",
            33 => "administrator.page.edit",
            34 => "administrator.page.delete",
        ], $permissions);
    }
}
