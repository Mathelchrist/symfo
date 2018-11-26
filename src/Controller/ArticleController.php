<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Tag;
use App\Form\ArticleSearchType;
use App\Service\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     * @param Request $request
     * @param Slugify $slugify
     * @return Response
     */
    public function index(Request $request, Slugify $slugify)
    {

        //AJOUTER UN ARTICLE    AJOUTER UN ARTICLE    AJOUTER UN ARTICLE    AJOUTER UN ARTICLE    AJOUTER UN ARTICLE    AJOUTER UN ARTICLE
        {
            $article = new Article();
            // création du formulaire
            $form = $this->createForm(ArticleSearchType::class, $article);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $article->setSlug($slugify->generate($article->getTitle()));
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

    /**
     * @Route("/article/edit/{id}", name="article_edit", methods="GET|POST")
     */
    public function edit(Request $request, Article $article, Slugify $slugify): Response
    {
        //EDITER UN ARTICLE EDITER UN ARTICLE EDITER UN ARTICLE EDITER UN ARTICLE EDITER UN ARTICLE EDITER UN ARTICLE
        $form = $this->createForm(ArticleSearchType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $article->setSlug($slugify->generate($article->getTitle()));
            $em->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }
}
