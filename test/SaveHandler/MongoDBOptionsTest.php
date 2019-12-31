<?php

/**
 * @see       https://github.com/laminas/laminas-session for the canonical source repository
 * @copyright https://github.com/laminas/laminas-session/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-session/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\Session\SaveHandler;

use Laminas\Session\SaveHandler\MongoDBOptions;

/**
 * @group      Laminas_Session
 */
class MongoDBOptionsTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaults()
    {
        $options = new MongoDBOptions();
        $this->assertNull($options->getDatabase());
        $this->assertNull($options->getCollection());
        $mongoVersion = phpversion('mongo') ?: '0.0.0';
        $defaultSaveOptions = version_compare($mongoVersion, '1.3.0', '<') ? array('safe' => true) : array('w' => 1);
        $this->assertEquals($defaultSaveOptions, $options->getSaveOptions());
        $this->assertEquals('name', $options->getNameField());
        $this->assertEquals('data', $options->getDataField());
        $this->assertEquals('lifetime', $options->getLifetimeField());
        $this->assertEquals('modified', $options->getModifiedField());
    }

    public function testSetConstructor()
    {
        $options = new MongoDBOptions(array(
            'database' => 'testDatabase',
            'collection' => 'testCollection',
            'saveOptions' => array('w' => 2),
            'nameField' => 'testName',
            'dataField' => 'testData',
            'lifetimeField' => 'testLifetime',
            'modifiedField' => 'testModified',
        ));

        $this->assertEquals('testDatabase', $options->getDatabase());
        $this->assertEquals('testCollection', $options->getCollection());
        $this->assertEquals(array('w' => 2), $options->getSaveOptions());
        $this->assertEquals('testName', $options->getNameField());
        $this->assertEquals('testData', $options->getDataField());
        $this->assertEquals('testLifetime', $options->getLifetimeField());
        $this->assertEquals('testModified', $options->getModifiedField());
    }

    public function testSetters()
    {
        $options = new MongoDBOptions();
        $options->setDatabase('testDatabase')
                ->setCollection('testCollection')
                ->setSaveOptions(array('w' => 2))
                ->setNameField('testName')
                ->setDataField('testData')
                ->setLifetimeField('testLifetime')
                ->setModifiedField('testModified');

        $this->assertEquals('testDatabase', $options->getDatabase());
        $this->assertEquals('testCollection', $options->getCollection());
        $this->assertEquals(array('w' => 2), $options->getSaveOptions());
        $this->assertEquals('testName', $options->getNameField());
        $this->assertEquals('testData', $options->getDataField());
        $this->assertEquals('testLifetime', $options->getLifetimeField());
        $this->assertEquals('testModified', $options->getModifiedField());
    }

    /**
     * @expectedException Laminas\Session\Exception\InvalidArgumentException
     */
    public function testInvalidDatabase()
    {
        $options = new MongoDBOptions(array(
            'database' => null,
        ));
    }

    /**
     * @expectedException Laminas\Session\Exception\InvalidArgumentException
     */
    public function testInvalidCollection()
    {
        $options = new MongoDBOptions(array(
            'collection' => null,
        ));
    }

    /**
     * @expectedException Laminas\Session\Exception\InvalidArgumentException
     */
    public function testInvalidSaveOptions()
    {
        $options = new MongoDBOptions(array(
            'saveOptions' => null,
        ));
    }

    /**
     * @expectedException Laminas\Session\Exception\InvalidArgumentException
     */
    public function testInvalidNameField()
    {
        $options = new MongoDBOptions(array(
            'nameField' => null,
        ));
    }

    /**
     * @expectedException Laminas\Session\Exception\InvalidArgumentException
     */
    public function testInvalidModifiedField()
    {
        $options = new MongoDBOptions(array(
            'modifiedField' => null,
        ));
    }

    /**
     * @expectedException Laminas\Session\Exception\InvalidArgumentException
     */
    public function testInvalidLifetimeField()
    {
        $options = new MongoDBOptions(array(
            'lifetimeField' => null,
        ));
    }

    /**
     * @expectedException Laminas\Session\Exception\InvalidArgumentException
     */
    public function testInvalidDataField()
    {
        $options = new MongoDBOptions(array(
            'dataField' => null,
        ));
    }
}
