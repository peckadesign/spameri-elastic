<?php declare(strict_types = 1);

namespace Spameri\Elastic\Commands;

class RemoveAlias extends \Symfony\Component\Console\Command\Command
{

	private \Spameri\Elastic\Model\Indices\RemoveAlias $removeAlias;


	public function __construct(
		\Spameri\Elastic\Model\Indices\RemoveAlias $removeAlias
	)
	{
		parent::__construct(NULL);
		$this->removeAlias = $removeAlias;
	}


	protected function configure(): void
	{
		$this
			->setName('spameri:elastic:remove-alias')
			->setDescription('Adds alias to existing index.')
			->addArgument('index', \Symfony\Component\Console\Input\InputArgument::REQUIRED)
			->addArgument('alias', \Symfony\Component\Console\Input\InputArgument::REQUIRED)
		;
	}


	protected function execute(
		\Symfony\Component\Console\Input\InputInterface $input,
		\Symfony\Component\Console\Output\OutputInterface $output
	): int
	{
		/** @var string $index */
		$index = $input->getArgument('index');
		/** @var string $alias */
		$alias = $input->getArgument('alias');
		$output->writeln('Starting');

		$this->removeAlias->execute($alias, $index);

		$output->writeln('Done');

		return 0;
	}

}
