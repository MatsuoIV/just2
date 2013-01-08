<?php

namespace JVJ\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use JVJ\UsuarioBundle\Entity\Usuario;
use JVJ\UsuarioBundle\Form\Type\UsuarioType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function crearAction() {
        $entity = new Usuario();
        $request = $this->getRequest();
        $form = $this->createForm(new UsuarioType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity->setIsActive(true);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('usuarios_usuario_show', array('id' => $entity->getId())));
        }

        return $this->render('JVJUsuarioBundle:Usuario:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView()
                ));
    }

    public function registroAction() {
        $peticion = $this->getRequest();
        $sesion = $peticion->getSession();

        $error = $peticion->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR, $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
        );

        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();

        $usuario = new Usuario();

        $formulario = $this->createForm(new UsuarioType(), $usuario);

        if ($peticion->getMethod() == 'POST') {

            $formulario->bindRequest($peticion);

            if ($formulario->isValid()) {

                $em = $this->getDoctrine()->getEntityManager();
                $privilegio = $em->getRepository('JVJUsuarioBundle:Privilegio')->find($id = 2);

                // Completar las propiedades que el usuario no rellena en el formulario
                $usuario->setSalt(md5(time()));

                $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
                $passwordCodificado = $encoder->encodePassword(
                        $usuario->getPassword(), $usuario->getSalt()
                );
                $usuario->setPassword($passwordCodificado);
                $usuario->setIsActive(true);
                $usuario->addPrivilegio($privilegio);
                $codigoActivacion = $usuario->generaCodigoActivacion(40, false, true, false);
                $usuario->setCodigoActivacion($codigoActivacion);

                if (!$this->enviaEmail($usuario)) {
                    throw $this->createNotFoundException('No se ha podido enviar correo de activacion...');
                }



                // Guardar el nuevo usuario en la base de datos
                $em->persist($usuario);
                $em->flush();


                // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente

                return $this->redirect('login');
            }
        }

        return $this->render('JVJUsuarioBundle:Default:registro.html.twig', array(
                    'formulario' => $formulario->createView(),
                    'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
                    'error' => $error
                ));
    }

    public function enviaEmail(Usuario $usuario) {
        $message = \Swift_Message::newInstance()
                ->setSubject('Codigo de Activacion')
                ->setFrom('jvjsoftware@gmail.com')
                ->setTo($usuario->getEmail())
                ->setBody($this->renderView('JVJUsuarioBundle:Default:email.txt.twig', array('usuario' => $usuario)));
        $this->get('mailer')->send($message);
        
        return true;
    }
    

}
