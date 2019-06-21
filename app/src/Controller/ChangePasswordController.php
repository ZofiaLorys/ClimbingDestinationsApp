<?php
/**
 * Change Password controller.
 */

namespace App\Controller;

use App\Entity\ChangePassword;
use App\Form\ChangePasswordType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ChangePasswordController extends AbstractController
{
    /**
     * @Route("/changepassword", name="change_password")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param UserRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function ChangePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder, UserRepository $repository)
    {
        $changePassword = new ChangePassword();
        $form = $this->createForm( ChangePasswordType::class, $changePassword);
        $form->handleRequest($request);
        $user = $this->getUser();

        # dump($user);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $changePassword->getNewPassword()
                )
            );


            try{
                $repository->save($user);
            }
            catch(\Exception $e){
                error_log($e->getMessage());
            }

            $this->addFlash('success', 'message.updated_successfully');
            return $this->redirectToRoute('destination_index');
        }

        return $this->render('changePassword/changepassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}