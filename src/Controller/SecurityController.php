<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        /******** 
        // Check if the user is already logged in
        if ($user = $this->getUser()) {
            // Check if the user has the admin role
            if (in_array('ROLE_ADMIN', $user->getRoles())) {
                // Redirect to the admin page
                return $this->redirectToRoute('admin_dashboard');
            }

            // Redirect to a default page if not an admin
            return $this->redirectToRoute('default_page');
        }
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }
        **********/

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
