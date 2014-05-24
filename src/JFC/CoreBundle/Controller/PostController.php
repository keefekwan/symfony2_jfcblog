<?php
// src/JFC/CoreBundle/Controller/PostController.php

namespace JFC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use JFC\ModelBundle\Entity\Comment;
use JFC\ModelBundle\Form\CommentType;
use JFC\CoreBundle\Services\PostManager;

/**
 * Class PostController
 *
 * @Route("/{_locale}", requirements={"_locale"="en|es"}, defaults={"_locale"="en"})*
 */
class PostController extends Controller
{
    /**
     * Show the posts index
     *
     * @return array
     *
     * @Route("/", name="jfc_core_post_index")
     * @Template("JFCCoreBundle:Post:index.html.twig")
     */
    public function indexAction()
    {
        // Original before refactoring using service PostManager
//        $posts = $this->getDoctrine()->getRepository('JFCModelBundle:Post')
//            ->findAll();
//
//        $latestPosts = $this->getDoctrine()->getRepository('JFCModelBundle:Post')
//            ->findLatest(5);

        // Refactored using PostManager service
        $posts = $this->getPostManager()->findAll();

        $latestPosts = $this->getPostManager()->findLatest(5);

        return array(
            'posts'       => $posts,
            'latestPosts' => $latestPosts
        );
    }

    /**
     * Show a post
     *
     * @param string $slug
     *
     * @throws NotFoundHttpException
     * @return array
     *
     * @Route("/{slug}", name="jfc_core_post_show")
     * @Template("JFCCoreBundle:Post:show.html.twig")
     */
    public function showAction($slug)
    {
        // Original before refactoring using service PostManager
//        $post = $this->getDoctrine()->getRepository('JFCModelBundle:Post')
//            ->findOneBy(array(
//                'slug' => $slug
//            ));
//
//        if (null === $post) {
//            throw $this->createNotFoundException('Post was not found');
//        }
//
//        $form = $this->createForm(new CommentType());

        // Refactored using PostManager service
        $post = $this->getPostManager()->findBySlug($slug);

        $form = $this->createForm(new CommentType());

        return array(
            'post' => $post,
            'form' => $form->createView()
        );
    }

    /**
     * Create comment
     *
     * @param Request $request
     * @param string $slug
     *
     * @return array
     *
     * @Route("/{slug}/create-comment", name="jfc_core_post_createcomment")
     * @Method("POST")
     * @Template("JFCCoreBundle:Post:show.html.twig")
     */
    public function createCommentAction(Request $request, $slug)
    {
        // Original before refactoring using service PostManager
//        $post = $this->getDoctrine()->getRepository('JFCModelBundle:Post')
//            ->findOneBy(array(
//                'slug' => $slug
//            ));
//
//        if (null === $post) {
//            throw $this->createNotFoundException('Post was not found');
//        }

//        $comment = new Comment();
//        $comment->setPost($post);
//
//        $form = $this->createForm(new CommentType(), $comment);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $this->getDoctrine()->getManager()->persist($comment);
//            $this->getDoctrine()->getManager()->flush();
//
//            $this->get('session')->getFlashBag()->add('success', 'Your comment was submitted successfully');
//
//            return $this->redirect($this->generateUrl('jfc_core_post_show', array(
//                'slug' => $post->getSlug()
//            )));
//        }

        // Refactored using PostManager service
        $post = $this->getPostManager()->findBySlug($slug);
        $form = $this->getPostManager()->createComment($post, $request);

        if (true === $form) {
            $this->get('session')->getFlashBag()->add('success', 'Your comment was submitted successfully');

            return $this->redirect($this->generateUrl('jfc_core_post_show', array('slug' => $post->getSlug())));
        }

        return array(
            'post' => $post,
            'form' => $form->createView()
        );
    }

    /**
     * Get Post Manager
     *
     * @return PostManager
     */
    private function getPostManager()
    {
        return $this->get('postManager');
    }
}