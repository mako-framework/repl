<?php

/**
 * @copyright Frederic G. Østby
 * @license   http://www.makoframework.com/license
 */

namespace mako\repl;

use mako\database\midgard\ORM;
use mako\database\query\Result;
use mako\database\query\ResultSet;

/**
 * Caster.
 */
class Caster
{
	/**
	 * Casts ORM to array.
	 */
	public static function orm(ORM $orm): array
	{
		return $orm->toArray();
	}

	/**
	 * Casts result to array.
	 */
	public static function result(Result $result): array
	{
		return $result->toArray();
	}

	/**
	 * Casts result set to array.
	 */
	public static function resultSet(ResultSet $resultSet): array
	{
		return $resultSet->getItems();
	}
}
