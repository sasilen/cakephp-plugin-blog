<?php
declare(strict_types=1);

namespace Sasilen\Blog\Test\TestCase\Model\Table;

use Sasilen\Blog\Model\Table\MediasTable;
use Cake\TestSuite\TestCase;

/**
 * Blog\Model\Table\MediasTable Test Case
 */
class MediasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Blog\Model\Table\MediasTable
     */
    protected $Medias;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Blog.Medias',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Medias') ? [] : ['className' => MediasTable::class];
        $this->Medias = $this->getTableLocator()->get('Medias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Medias);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
