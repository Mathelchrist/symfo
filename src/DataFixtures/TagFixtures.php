<?php
/**
 * Created by PhpStorm.
 * User: wilder6
 * Date: 26/11/18
 * Time: 14:14
 */

namespace App\DataFixtures;


use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    const TAG = [
        'PHP Storm',
        'Web Storm',
        'Java Storm',
        'Ruby Storm',
        'Dev0ps Storm'
    ];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::TAG as $key => $value) {
            $tag = new Tag();
            $tag->setName($value);
            $manager->persist($tag);
            $this->addReference('tag_' . $key, $tag);
        }
        $manager->flush();
    }
}