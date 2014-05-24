<?php
// src/JFC/AdminBundle/Controller/SecurityController.php

namespace JFC\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\SecurityBundle\Tests\Functional\SecurityRoutingIntegrationTest;

/**
 * Class SecurityController
 */
class SecurityController extends Controller
{
    /**
     * Login
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Response
     *
     * @Route("/login", name="jfc_admin_security_login")
     * @Template("JFCAdminBundle:Security:login.html.twig")
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        // Retrieve login error if applicable
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            // Last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error
        );
    }

    /**
     * Login check
     *
     * @Route("/login_check", name="jfc_admin_security_logincheck")
     */
    public function loginCheckAction()
    {
    }

    /**
     * Logout
     *
     * @Route("logout", name="jfc_admin_security_logout")
     */
    public function logoutAction()
    {

    }

}