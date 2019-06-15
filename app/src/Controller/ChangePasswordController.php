<?php
/**
 * Change Password controller.
 */

namespace App\Controller;

use App\Entity\ChangePassword;
use App\Form\ChangePasswordType;
use App\Form\CountryType;
use App\Repository\CountryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChangePasswordController extends AbstractController
{

    /**
     * @Route("/changepassword", name="change_password")
     */
public function ChangePassword(Request $request)
{
    $changePassword = new ChangePassword();
    $form = $this->createForm( ChangePasswordType::class, $changePassword);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $user->setPassword(
            $passwordEncoder->encodePassword(
                $user,
                $ChangePassword->getNewPassword()
            )
        );
        return $this->redirectToRoute('destination_index');
    }

    return $this->render('registration/register.html.twig', array(
    'form' => $form->createView(),
));
}
}