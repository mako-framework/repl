<?php

/**
 * @copyright Frederic G. Østby
 * @license   http://www.makoframework.com/license
 */

namespace mako\repl\tests\unit;

use mako\database\midgard\ORM;
use mako\database\query\Result;
use mako\database\query\ResultSet;
use mako\repl\Caster;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class CasterTest extends TestCase
{
	use MockeryPHPUnitIntegration;

	/**
	 *
	 */
	public function testOrm(): void
	{
		$orm = Mockery::mock(ORM::class);

		$orm->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);

		$this->assertSame(['foo' => 'bar'], Caster::orm($orm));
	}

	/**
	 *
	 */
	public function testResult(): void
	{
		$result = Mockery::mock(Result::class);

		$result->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);

		$this->assertSame(['foo' => 'bar'], Caster::result($result));
	}

	/**
	 *
	 */
	public function testResultSet(): void
	{
		$resultSet = Mockery::mock(ResultSet::class);

		$resultSet->shouldReceive('getItems')->once()->andReturn(['foo' => 'bar']);

		$this->assertSame(['foo' => 'bar'], Caster::resultSet($resultSet));
	}
}
