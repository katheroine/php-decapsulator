<?php

declare(strict_types=1);

/*
 * This file is part of the Decapsulator package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\Decapsulator\ObjectDecapsulator;

/**
 * Magic get test.
 * PHPUnit test class for ObjectDecapsulator class.
 *
 * @package Decapsulator
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link http://github.com/exorg/decapsulator
 */
class MagicGetTest extends AbstractPropertyAccessorsTestCase
{
    /**
     * Test __get($name) magic method
     * throws InvalidObjectException
     * when the property does not exist.
     */
    public function testThrowsExceptionWhenPropertyDoesNotExist()
    {
        $property = self::NONEXISTENT_PROPERTY;

        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage("Property '{$property}' does not exist.");

        $this->decapsulator->$property;
    }

    /**
     * Test __get($name, $value) magic method
     * gets property value correctly.
     *
     * @dataProvider existingPropertiesProvider
     *
     * @param string $property
     */
    public function testGetsPropertyCorrectly(string $property)
    {
        $expectedValue =  rand();
        $this->setDecapsulatedObjectProperty($property, $expectedValue);

        $actualValue = $this->decapsulator->$property;

        $this->assertEquals($expectedValue, $actualValue);
    }
}
