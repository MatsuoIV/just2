<?php

namespace Just2\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Just2\BackendBundle\Entity\Member;
use Just2\FrontendBundle\Form\MemberType;
use JVJ\UserBundle\Entity\User;
use JVJ\UserBundle\Form\UserFrontendType;

class UserController extends Controller {

    public function registerAction() {

        $entityMember = new Member();
        $formMember = $this->createForm(new MemberType(), $entityMember);

        $entityUser = new User();
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();
        $formData = $peticion->request->get('just2_backendbundle_membertype', 'no se obtuvo');

        if ($peticion->getMethod() == 'POST') {

            $formMember->bindRequest($peticion);


            if ($formMember->isValid()) {

                $em = $this->getDoctrine()->getEntityManager();


                $role = $em->getRepository('JVJUserBundle:Group')->find($id = 2);

                // Completar las propiedades que el usuario no rellena en el formulario
                $entityMember->getUser()->setSalt(md5(time()));

                $encoder = $this->get('security.encoder_factory')->getEncoder($entityMember->getUser());
                $passwordCodificado = $encoder->encodePassword(
                        $entityMember->getUser()->getPassword(), $entityMember->getUser()->getSalt()
                );


                $entityMember->getUser()->setPassword($passwordCodificado);
                $entityMember->getUser()->setIsActive(false);
                $entityMember->getUser()->addGroup($role);
                $codeActivation = $entityUser->generateCodeActivation(40, false, true, false);
                $entityMember->getUser()->setCodeActivation($codeActivation);
                $entityMember->getUser()->setMember($entityMember);
                $entityMember->getUser()->setIsActive(true);


                //if ($this->sendEmail($entityMember->getUser()) != true) {
                //throw $this->createNotFoundException('No se ha podido enviar correo de activacion...');
                //   $entityMember->getUser()->setIsActive(true);
                //  $error = 'No se el codigo de activacion se procedio a la activacion rapida';
                // }
                // Guardar el nuevo usuario en la base de datos
                if ($em->getRepository('JVJUserBundle:User')->userValidation($formData['user']['username'], $formData['user']['email']) == 0) {

                    $em->persist($entityMember);
                    $em->persist($entityMember->getUser());
                    $em->flush();
                } else {

                    return $this->redirect($this->generateUrl('usuario_register', array(
                                        'info' => 'username or email duplicate entry',
                                    )));
                }

                return $this->redirect('login');




                // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
            }
        }
        $request = $this->getRequest();
        $info = $request->query->get('info', null);

        return $this->render('Just2FrontendBundle:User:register.html.twig', array(
                    'formMember' => $formMember->createView(),
                    'info' => $info
                ));
    }

    public function sendEmail(User $usuario) {
        $message = \Swift_Message::newInstance()
                ->setSubject('Codigo de Activacion')
                ->setFrom('jvjsoftware@gmail.com')
                ->setTo($usuario->getEmail())
                ->setBody($this->renderView('Just2FrontendBundle:User:correoActivation.html.twig', array('user' => $usuario)));


        try {
            $this->get('mailer')->send($message);
            return true;
        } catch (Swift_TransportException $e) {
            //$result = array(false, 'There was a problem sending email: ' . $e->getMessage() );
            return false;
        }
    }

    public function userActiveAction($email, $codeActivate) {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('JVJUserBundle:User')->userActivation($email, $codeActivate);

        if ($user) {
            $user->setIsActive(1);

            $em->persist($user);
            $em->flush();
        }

        return $this->render('Just2FrontendBundle:User:userActivation.html.twig', array(
                    'usuario' => $user
                ));
    }

    public function ForgottenAction($email, $tipe) {
        switch ($tipe) {
            case 'id':


                break;
            case 'restore':

                break;
        }
    }

    public function adminDateBidsAction($id) {
        $date = $this->getDoctrine()
                ->getRepository('Just2BackendBundle:DateJust')
                ->find($id);

        $bids = $this->getDoctrine()
                ->getRepository('Just2BackendBundle:Bid')
                ->bidsForDate($date->getId());


        $highestBid = $this->getDoctrine()
                ->getRepository('Just2BackendBundle:Bid')
                ->highestBid($id);

        $totalbidsfordate = $this->getDoctrine()
                ->getRepository('Just2BackendBundle:Bid')
                ->countBidsForDate($id);

        return $this->render('Just2FrontendBundle:User:bidsDate.html.twig', array(
                    'date' => $date,
                    'bids' => $bids,
                    'highestBid' => $highestBid,
                    'info' => $info = null,
                    'totalbids' => $totalbidsfordate,
                ));
    }

    public function adminDateBidsAceptedAction($id) {
        $member = $this->get('security.context')->getToken()->getUser()->getMember()->getId();

        $em = $this->getDoctrine()->getEntityManager();

        $bid = $em->getRepository('Just2BackendBundle:Bid')
                ->find($id);

        $date = $this->getDoctrine()->getRepository('Just2BackendBundle:DateJust')
                ->findMemberDate($bid->getDateJust()->getId(), $member);

        if ($date) {

            $bid->setEstate(1);
            $em->persist($bid);
            $em->flush();

            return $this->redirect($this->generateUrl('bids_date', array(
                                'id' => $bid->getdateJust()->getId(),
                                'info' => 'Ok'
                            )));
        }
        return $this->redirect($this->generateUrl('bids_date', array(
                            'id' => $bid->getdateJust()->getId(),
                            'info' => 'Not'
                        )));
    }

    public function adminDateBidsRejecteredAction($id) {
        $member = $this->get('security.context')->getToken()->getUser()->getMember()->getId();

        $em = $this->getDoctrine()->getEntityManager();

        $bid = $em->getRepository('Just2BackendBundle:Bid')
                ->find($id);

        $date = $this->getDoctrine()->getRepository('Just2BackendBundle:DateJust')
                ->findMemberDate($bid->getDateJust()->getId(), $member);

        if ($date) {

            $bid->setEstate(3);
            $em->persist($bid);
            $em->flush();

            return $this->redirect($this->generateUrl('bids_date', array(
                                'id' => $bid->getdateJust()->getId(),
                                'info' => 'Ok'
                            )));
        }
        return $this->redirect($this->generateUrl('bids_date', array(
                            'id' => $bid->getdateJust()->getId(),
                            'info' => 'Not'
                        )));
    }

//    public function 
}
