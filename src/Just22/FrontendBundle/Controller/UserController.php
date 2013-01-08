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

                if (!$this->sendEmail($entityMember->getUser())) {
                    throw $this->createNotFoundException('No se ha podido enviar correo de activacion...');
                }
                // Guardar el nuevo usuario en la base de datos
                $em->persist($entityMember);
                $em->persist($entityMember->getUser());
                $em->flush();


                // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente

                return $this->redirect('admin_register');
            }
        }


        return $this->render('Just2FrontendBundle:User:register.html.twig', array(
                    'formMember' => $formMember->createView()
                ));
    }

    public function sendEmail(User $usuario) {
        $message = \Swift_Message::newInstance()
                ->setSubject('Codigo de Activacion')
                ->setFrom('jvjsoftware@gmail.com')
                ->setTo($usuario->getEmail())
                ->setContentType("text/html")
                ->setBody($this->renderView('Just2FrontendBundle:User:correoActivation.html.twig', array('user' => $usuario)));
        $this->get('mailer')->send($message);

        return true;
    }

    public function userActiveAction($email,$codeActivate) {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('JVJUserBundle:User')->userActivation($email,$codeActivate);
    
        if($user){
            $user->setIsActive(1);
            
            $em->persist($user);
            $em->flush();
            
                    
        }
        
        return $this->render('Just2FrontendBundle:User:userActivation.html.twig', array(
                    'usuario' => $user
                ));
        
    }
    
//    public function 

}
