<?php declare(strict_types = 1);

namespace SpameriTests\Elastic\Data\Entity\Person;

class Job implements \Spameri\Elastic\Entity\EntityInterface
{

	public const VIDEO_DIRECTOR = 'Directed by ';
	public const SERIES_DIRECTOR = 'Series Directed by ';
	public const VIDEO_PRODUCER = 'Produced by ';
	public const SERIES_PRODUCER = 'Series Produced by ';
	public const VIDEO_WRITER = "Writing Credits\n  ";
	public const SERIES_WRITER = "Series Writing Credits\n  ";

	/**
	 * @var \SpameriTests\Elastic\Data\Entity\Property\ImdbId
	 */
	private $id;

	/**
	 * @var \SpameriTests\Elastic\Data\Entity\Property\Name
	 */
	private $name;

	/**
	 * @var \SpameriTests\Elastic\Data\Entity\Property\Description
	 */
	private $description;

	/**
	 * @var \SpameriTests\Elastic\Data\Entity\Property\ImdbId|NULL
	 */
	private $episode;


	public function __construct(
		\SpameriTests\Elastic\Data\Entity\Property\ImdbId $id,
		\SpameriTests\Elastic\Data\Entity\Property\Name $name,
		\SpameriTests\Elastic\Data\Entity\Property\Description $description,
		?\SpameriTests\Elastic\Data\Entity\Property\ImdbId $episode
	)
	{
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
		$this->episode = $episode;
	}


	public function entityVariables(): array
	{
		return \get_object_vars($this);
	}


	public function key(): string
	{
		return (string) $this->id->value();
	}


	public function name(): \SpameriTests\Elastic\Data\Entity\Property\Name
	{
		return $this->name;
	}


	public function rename(\SpameriTests\Elastic\Data\Entity\Property\Name $name): void
	{
		$this->name = $name;
	}


	public function description(): \SpameriTests\Elastic\Data\Entity\Property\Description
	{
		return $this->description;
	}


	public function setDescription(\SpameriTests\Elastic\Data\Entity\Property\Description $description): void
	{
		$this->description = $description;
	}


	public function id(): \SpameriTests\Elastic\Data\Entity\Property\ImdbId
	{
		return $this->id;
	}


	public function episode(): ?\SpameriTests\Elastic\Data\Entity\Property\ImdbId
	{
		return $this->episode;
	}


	public function setEpisode(\SpameriTests\Elastic\Data\Entity\Property\ImdbId $episode): void
	{
		$this->episode = $episode;
	}

}
