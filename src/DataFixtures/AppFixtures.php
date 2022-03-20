<?php

namespace App\DataFixtures;

use App\Entity\App;
use App\Entity\Cron;
use App\Entity\Job;
use App\Service\UserManager;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Uid\Uuid;

/**
 * @codeCoverageIgnore
 */
class AppFixtures extends Fixture
{
    public function __construct(
        public UserManager $userManager
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < $faker->numberBetween(2, 5); ++$i) {
            $app = new App();
            $app->setName($faker->word());
            $app->setDescription($faker->sentence());
            $app->setUuid(Uuid::v4());
            $manager->persist($app);

            for ($j = 0; $j < $faker->numberBetween(2, 5); ++$j) {
                $job = new Job();
                $job->setName($faker->word());
                $job->setDescription($faker->sentence());
                $job->setApp($app);
                $job->setUuid(Uuid::v4());
                $manager->persist($job);

                for ($k = 0; $k < $faker->numberBetween(5, 10); ++$k) {
                    $cron = new Cron();
                    $date = $faker->dateTimeBetween('-6 month', 'now');
                    $cron->setStartAt(DateTimeImmutable::createFromMutable($date))
                        ->setEndAt(DateTimeImmutable::createFromMutable($date->modify($faker->numberBetween(1, 6).' minutes')))
                        ->setJob($job)
                        ->setStatus($faker->randomElement([
                                Cron::$STATUS_FAILURE,
                                Cron::$STATUS_SUCCESS,
                                Cron::$STATUS_RUNNING,
                            ]
                        )
                    );
                    $manager->persist($cron);
                }
            }
        }

        $this->userManager->createUser('admin@admin.com', 'admin');

        $manager->flush();
    }
}
