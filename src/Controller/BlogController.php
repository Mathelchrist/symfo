<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog/{slug}", requirements={"slug"="([a-z0-9-]+)"}, name="blog_list")
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($slug = 'Mon article sans nom')
    {
        return $this->render('blog/index.html.twig', [
            'slug' => str_replace('-', ' ', ucwords($slug)),
        ]);
    }
}
