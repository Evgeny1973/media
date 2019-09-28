<?php

namespace App\DataFixtures;

use App\Model\Media\Entity\Id;
use App\Model\Media\Entity\Media;
use App\Model\Media\Entity\MediaRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class MediaFixtures extends AppFixtures
{
	/**
	 * @var MediaRepository
	 */
	protected $medias;
	private $faker;

	public function __construct(MediaRepository $medias)
	{
		$this->faker = Factory::create('ru_RU');

		$this->medias = $medias;
	}

	public function load(ObjectManager $manager)
	{
		for ($i = 0; $i < 10; $i++) {
			$media = new Media(Id::next(), $this->faker->jobTitle, $this->faker->company,
				new \DateTimeImmutable(sprintf('+%s day', $i)), random_int(5000, 350000));
			$this->medias->add($media);
		}
		$manager->flush();
	}
}
