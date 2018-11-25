<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Tag;
use App\Form\ArticleSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index(Request $request )
    {
        {
            // création du formulaire
            $article = new Article();
            $form = $this->createForm(ArticleSearchType::class, $article);
            $form->handleRequest($request);

            if ($form->isSubmitted()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();

            }
            return $this->render('article/index.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function show(Article $article) :Response
    {
        return $this->render('article/article.html.twig', ['article'=>$article, 'category' => $article->getCategory(), 'tags' => $article->getTags()]);
    }

    /**
     * @Route("/article/tag/{name}", name="tag_show")
     */
    public function showTag(Tag $tags) :Response
    {
        return $this->render('article/tag.html.twig', ['tags'=>$tags, 'articles' => $tags->getArticles()]);
    }
}
