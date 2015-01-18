<?php
/**
 * Created by PhpStorm.
 * User: jesus
 * Date: 18/01/15
 * Time: 0:11
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller {

    /**
     * @Route("/home", name="admin_home")
     */
    public function homeAction(){
        // get latest submissions, older ones first
        $pendingSubmissions = $this->getDoctrine()->getRepository('AppBundle:Submission')->findBy(array('banned' => '0'));
        return $this->render(
            'admin/home.html.twig',
            array('submissions' => $pendingSubmissions)
        );
    }
}