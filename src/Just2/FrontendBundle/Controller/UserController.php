<?php

namespace Just2\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Just2\BackendBundle\Entity\Member;
use Just2\FrontendBundle\Form\MemberType;
use JVJ\UserBundle\Entity\User;
use Just2\FrontendBundle\Form\UserType;
use Just2\FrontendBundle\Util\Notification;

class UserController extends Controller {

    public function registerAction() {

        $entityMember = new Member();
        $entityUser = new User();
        $formUser = $this->createForm(new UserType(), $entityUser);

        $peticion = $this->getRequest();
        //       $em = $this->getDoctrine()->getEntityManager();
        //       $formData = $peticion->request->get('just2_backendbundle_usertype', 'no se obtuvo');

        if ($peticion->getMethod() == 'POST') {

            $formUser->bindRequest($peticion);

            if ($formUser->isValid()) {

                $em = $this->getDoctrine()->getEntityManager();


                $role = $em->getRepository('JVJUserBundle:Group')->find($id = 2);

                // Completar las propiedades que el usuario no rellena en el formulario
                $entityUser->setSalt(md5(time()));

                $encoder = $this->get('security.encoder_factory')->getEncoder($entityUser);
                $passwordCodificado = $encoder->encodePassword(
                        $entityUser->getPassword(), $entityUser->getSalt()
                );


                $entityUser->setPassword($passwordCodificado);
                $entityUser->setIsActive(false);
                $entityUser->addGroup($role);
                $codeActivation = $entityUser->generateCodeActivation(40, false, true, false);
                $entityUser->setCodeActivation($codeActivation);
                $entityUser->setMember($entityUser->getMember());
                $entityUser->getMember()->setUser($entityUser);
                $entityUser->setIsActive(false);

                //if ($this->sendEmail($entityUser) != true) {
                //throw $this->createNotFoundException('No se ha podido enviar correo de activacion...');
                //   $entityUser->setIsActive(true);
                //  $error = 'No se el codigo de activacion se procedio a la activacion rapida';
                // }
                // Guardar el nuevo usuario en la base de datos
                //if ($em->getRepository('JVJUserBundle:User')->userValidation($formData['username'], $formData['email']) == 0) {
                $body = "Active Your Account: http://www.just2test.ioio.com.au/activation/" . $entityUser->getEmail() . "/" . $entityUser->getCodeActivation();
                if ($this->sendMail($entityUser->getEmail(), 'Codigo de Activation - Just2', $body, null)) {
                    $em->persist($entityUser->getMember());
                    $em->persist($entityUser);
                    $em->flush();
                } else {

                    return $this->redirect($this->generateUrl('usuario_register', array(
                                        'info' => 'error undefined',
                                    )));
                }

                return $this->redirect('login');




                // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
            }
        }
        $request = $this->getRequest();
        $info = $request->query->get('info', null);

        return $this->render('Just2FrontendBundle:User:register.html.twig', array(
                    'formUser' => $formUser->createView(),
                    'info' => $info
                ));
    }

    public function sendEemail(User $usuario) {
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

    public function adminDateFinishedAction($id) {
        $date = $this->getDoctrine()
                ->getRepository('Just2BackendBundle:DateJust')
                ->find($id);

        $auction = $this->getDoctrine()
                ->getRepository('Just2BackendBundle:Auction')
                ->findOneByDateJust($date);


        $totalbidsfordate = $this->getDoctrine()
                ->getRepository('Just2BackendBundle:Bid')
                ->countBidsForDate($date->getId());


        $request = $this->getRequest();
        $info = $request->query->get('info');

        switch ($date->getEstate()) {
            case 3:
                return  $this->render('Just2FrontendBundle:User:DateJust/pendingPayment.html.twig', array(
                    'date' => $date,
                    'totalbids' => $totalbidsfordate,
                    'auction' => $auction,
                    'info' => $info
                ));
                
            case 4:
                return $this->render('Just2FrontendBundle:User:DateJust/paid.html.twig', array(
                    'date' => $date,
                    'totalbids' => $totalbidsfordate,
                    'auction' => $auction,
                    'info' => $info
                ));
            case 5:
                return $this->render('Just2FrontendBundle:User:/DateJust/without.html.twig', array(
                    'date' => $date,
                    'totalbids' => $totalbidsfordate,
                    'auction' => $auction,
                    'info' => $info
                ));
            case 6:
                return $this->render('Just2FrontendBundle:User:DateJust/finished.html.twig', array(
                    'date' => $date,
                    'totalbids' => $totalbidsfordate,
                    'auction' => $auction,
                    'info' => $info
                ));
        }




//        $return = $this->render('Just2FrontendBundle:DateJust:justEnd.html.twig', array(
//            'date' => $date,
//            'totalbids' => $totalbidsfordate,
//            'mybiddate' => $memberBidsForDate,
//            'auction' => $auction,
//            'info' => $info
//                ));
//        return $return;
    }

    public function datePaimentAuctionAction($id) {
        $date = $this->getDoctrine()
                ->getRepository('Just2BackendBundle:DateJust')
                ->find($id);

        $em = $this->getDoctrine()->getEntityManager();
        $date = $em->getRepository('Just2BackendBundle:DateJust')
                ->find($id);
        $date->setEstate(4);
        $em->persist($date);
        $em->flush();
        
        return $this->adminDateFinishedAction($id);
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

        return $this->render('Just2FrontendBundle:User:DateJust/bidsDate.html.twig', array(
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

    public function sendMail($to, $subject, $body, $theme = null) {
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "From: Just2 \r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";


        if (is_array($to)) {
            $send = 0;
            $notsend = 0;
            foreach ($to as $i => $to) {
                if (mail($to, $subject, $this->body($body), $headers)) {
                    $send = +1;
                } else {
                    $notsend = +1;
                }
            }

            if ($send >= 1) {
                return true;
            } else {
                return false;
            }
        } else {
            if (mail($to, $subject, $this->body($body), $headers)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function body($body, $theme = null) {
        return $this->render('Just2FrontendBundle:Util:notifications.html.twig', array(
                    'body' => $body,
                    'theme' => $theme
                ));
    }

    public function panelAction() {
        
        if ($this->get('security.context')->isGranted('ROLE_USER')) {

            $id = $this->get('security.context')->getToken()->getUser()->getMember()->getId();

            $em = $this->getDoctrine()->getEntityManager();
            $member = $em->getRepository('Just2BackendBundle:Member')->find($id);
            $date = $em->getRepository('Just2BackendBundle:DateJust')->findOneBy(array(
                'member' => $id,
                'estate' => 6
                ));
            if($date){
                $winner = $em->getRepository('Just2BackendBundle:Auction')->findOneBy(array(
                    'dateJust' => $date->getId()
                    ));
                $reservation = $em->getRepository('Just2BackendBundle:Reservation')->find($winner->getReservation());
            }else{
                $winner = NULL;
                $reservation = NULL;
            }
            $message = $em->getRepository('Just2BackendBundle:Message')->newMessagesIndex($id);
            $interests = $em->getRepository('Just2BackendBundle:Interest')->getInterestsByMember($id);


            // echo $interests[0]->getId();return;
            
            return $this->render('Just2FrontendBundle:User:Panel/panelView.html.twig',array(
                'member' => $member,
                'date'   => $date,
                'winner' => $winner,
                'reservation' => $reservation,
                'message' => $message,
                'interests' => $interests
                ));            
        }        
    }

    public function pdfAction() {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {

            $id = $this->get('security.context')->getToken()->getUser()->getMember()->getId();

            $em = $this->getDoctrine()->getEntityManager();
            $member = $em->getRepository('Just2BackendBundle:Member')->find($id);
            $date = $em->getRepository('Just2BackendBundle:DateJust')->findOneBy(array(
                'member' => $id,
                'estate' => 6
                ));
            if($date){
                $winner = $em->getRepository('Just2BackendBundle:Auction')->findOneBy(array(
                    'dateJust' => $date->getId()
                    ));
                // print_r($winner);return;
                $reservation = $em->getRepository('Just2BackendBundle:Reservation')->find($winner->getReservation());

                $pdf = $this->container->get("white_october.tcpdf")->create();

                $pdf->setFooterData($tc=array(0,64,0), $lc=array(0,64,128));
                
                // set default font subsetting mode
                $pdf->setFontSubsetting(true);

                $pdf->SetFont('dejavusans', '', 14, '', true);

                // Add a page
                // This method has several options, check the source code documentation for more information.
                $pdf->AddPage();

                // set text shadow effect
                $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

                // Set some content to print
                $html = '<img src ="/bundles/just2frontend/images/logo.png" style="width: 95px;">
                <h1>Date Confirmation</h1><br>
                <div>
                    <img src="/images_user/'.$member->getUser()->getFace().'png">
                    Reserved Date: '.$member->getFirstName().' '.$member->getLastName().'<br>
                    Dating Partner: '.$winner->getWinningMember()->getFirstName().' '.$winner->getWinningMember()->getLastName().'<br>
                    Confirmation Number: '.$reservation->getCodeReservation().
                '</div>

                <div>
                    <img src="/images_user/'.$winner->getWinningMember()->getUser()->getFace().'png">
                    Dating Partner: '.$winner->getWinningMember()->getFirstName().' '.$winner->getWinningMember()->getLastName().'<br>
                    Reserved Date: '.$member->getFirstName().' '.$member->getLastName().'<br>
                    Confirmation Number: '.$reservation->getCodeReservation().
                '</div>
                
                <div>
                    <img src="/img/venues/'.$reservation->getVenue()->getImage().'" style="width:200">
                    Venue: '.$reservation->getVenue()->getName().'<br>
                    Ocassion: '.$reservation->getOcassion()->getName().'<br>
                    When: '.$date->getDateEnd()->format('M d, Y H:i:s').'<br>
                    Location: '.$date->getVenue()->getAddress().'<br>
                    Phone: '.$date->getVenue()->getPhone().'<br>
                    Confirmation Number: '.$reservation->getCodeReservation().
                '</div>'
                ;
                $pdf->writeHTML($html, true, false, true, false, '');
                $pdf->Output('confirmation.pdf', 'I');
            }
        }
    }    
}
