<?php
/**
 * Created by PhpStorm.
 * User: wilder6
 * Date: 25/11/18
 * Time: 17:35
 */

namespace App\DataFixtures;


use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{

    const CATEGORIES = [
        'PHP',
        'JavaScipt',
        'Java',
        'Ruby',
        'Dev0ps'
    ];


    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($c = 0; $c < 5; $c++) {
            for ($i = 0; $i < 10; $i++) {
                $article = new Article();
                $article->setTitle(mb_strtolower($faker->name));
                $article->setContent($faker->text(20));

                $manager->persist($article);
                $article->setCategory($this->getReference('categorie_' . $c));
                $manager->flush();
            }
        }
    }
}