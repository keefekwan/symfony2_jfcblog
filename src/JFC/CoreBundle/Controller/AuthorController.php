<?php

namespace JFC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use JFC\CoreBundle\Services\AuthorManager;

/**
 * Class AuthorController
 *
 * @Route("/{_locale}", requirements={"_locale"="en|es"}, defaults={"_locale"="en"})
 */
class AuthorController extends Controller
{
    /**
     * Show posts by Author
     *
     * @param string $slug
     *
     * @throws NotFoundHttpException
     * @return array
     *
     * @Route("/author/{slug}", name="jfc_core_author_show")
     * @Template("JFCCoreBundle:Author:show.html.twig")
     */
    public function showAction($slug)
    {
        // Original before refactoring using service AuthorManager
//        $author = $this->getDoctrine()->getRepository('JFCModelBundle:Author')
//            ->findOneBy(array(
//                'slug' => $slug
//            ));

//        if (null === $author) {
//            throw $this->createNotFoundException('Author was not found');
//        }

//        $posts = $this->getDoctrine()->getRepository('JFCModelBundle:Post')
//            ->findBy(array(
//               'author' => $author
//            ));

        // Refactored using AuthorManager service
        $author = $this->getAuthorManager()->findBySlug($slug);
        $posts  = $this->getAuthorManager()->findPosts($author);

        return array(
            'author' => $author,
            'posts'  => $posts
        );
    }

    /**
     * Get Author Manager
     *
     * @return AuthorManager
     */
    private function getAuthorManager()
    {
        return $this->get('authorManager');
    }
}
