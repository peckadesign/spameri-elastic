<?php declare(strict_types = 1);

namespace Spameri\Elastic\Model;

class GetBy
{

	/**
	 * @var \Spameri\Elastic\ClientProvider
	 */
	private $clientProvider;

	/**
	 * @var \Spameri\ElasticQuery\Response\ResultMapper
	 */
	private $resultMapper;

	private VersionProvider $versionProvider;


	public function __construct(
		\Spameri\Elastic\ClientProvider $clientProvider,
		\Spameri\ElasticQuery\Response\ResultMapper $resultMapper,
		VersionProvider $versionProvider
	)
	{
		$this->clientProvider = $clientProvider;
		$this->resultMapper = $resultMapper;
		$this->versionProvider = $versionProvider;
	}


	/**
	 * @throws \Spameri\Elastic\Exception\ElasticSearch
	 */
	public function execute(
		\Spameri\ElasticQuery\ElasticQuery $options,
		string $index,
		?string $type = NULL
	): \Spameri\ElasticQuery\Response\ResultSearch
	{
		if ($type === NULL) {
			$type = $index;
		}

		if ($this->versionProvider->provide() >= \Spameri\ElasticQuery\Response\Result\Version::ELASTIC_VERSION_ID_7) {
			$type = NULL;
		}

		try {
			$response = $this->clientProvider->client()->search(
				(
					new \Spameri\ElasticQuery\Document(
						$index,
						new \Spameri\ElasticQuery\Document\Body\Plain($options->toArray()),
						$type
					)
				)
					->toArray()
			)
			;

		} catch (\Elasticsearch\Common\Exceptions\ElasticsearchException $exception) {
			throw new \Spameri\Elastic\Exception\ElasticSearch($exception->getMessage());
		}

		return $this->resultMapper->mapSearchResults($response);
	}

}
