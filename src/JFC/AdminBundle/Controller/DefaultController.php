<?php

namespace JFC\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    /**
     * Redirection
     *
     * @return RedirectResponse
     *
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('jfc_admin_post_index'));
    }
}
