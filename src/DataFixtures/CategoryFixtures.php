<?php
/**
 * Created by PhpStorm.
 * User: wilder6
 * Date: 25/11/18
 * Time: 17:35
 */

namespace App\DataFixtures;


use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'PHP',
        'JavaScipt',
        'Java',
        'Ruby',
        'Dev0ps'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key => $value) {
        $category = new Category();
        $category->setName($value);
        $manager->persist($category);
        $this->addReference('categorie_' . $key, $category);
    }
        $manager->flush();
    }
}