<?php
namespace FieldTypes\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use FieldTypes\View\Helper\FieldTypesFormHelper;

/**
 * FieldTypes\View\Helper\FieldTypesFormHelper Test Case
 */
class FieldTypesFormHelperTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->FieldTypesForm = new FieldTypesFormHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FieldTypesForm);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
