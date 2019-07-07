<?php

/**
 * @copyright Frederic G. Østby
 * @license   http://www.makoframework.com/license
 */

namespace mako\repl\commands;

use mako\database\midgard\ORM;
use mako\database\query\Result;
use mako\database\query\ResultSet;
use mako\reactor\Command;
use mako\repl\Caster;
use mako\syringe\traits\ContainerAwareTrait;
use Psy\Configuration;
use Psy\Shell;

/**
 * Command that starts a interactive shell.
 *
 * @author Frederic G. Østby
 */
class Repl extends Command
{
	/**
	 * Make the command strict.
	 *
	 * @var bool
	 */
	protected $isStrict = true;

	/**
	 * Command information.
	 *
	 * @var array
	 */
	protected $commandInformation =
	[
		'description' => 'Starts a interactive shell.',
	];

	/**
	 * Displays a helping message.
	 */
	protected function displayHelp(): void
	{
		$message  = '----------------------------------------------';
		$message .= PHP_EOL;
		$message .= 'Type <yellow>help</yellow> to see a list of available commands.';
		$message .= PHP_EOL;
		$message .= '----------------------------------------------';

		$this->write($message);
	}

	/**
	 * Returns a container aware class.
	 *
	 * @return object
	 */
	protected function getMako()
	{
		$mako = new class
		{
			use ContainerAwareTrait;

			public function getContainer()
			{
				return $this->container;
			}
		};

		$mako->setContainer($this->container);

		return $mako;
	}

	/**
	 * Builds the shell configuration.
	 *
	 * @return \Psy\Configuration
	 */
	protected function buildConfiguration(): Configuration
	{
		$configuration = new Configuration($this->config->get('mako-repl::configuration'));

		$configuration->addCasters(
		[
			ORM::class       => Caster::class . '::orm',
			Result::class    => Caster::class . '::result',
			ResultSet::class => Caster::class . '::resultSet',
		]);

		return $configuration;
	}

	/**
	 * Starts the interactive shell.
	 */
	protected function startShell(): void
	{
		$shell = new Shell($this->buildConfiguration());

		$shell->setScopeVariables(
		[
			'mako' => $this->getMako(),
		]);

		$shell->run();
	}

	/**
	 * Executes the command.
	 */
	public function execute(): void
	{
		$this->displayHelp();

		$this->startShell();
	}
}
