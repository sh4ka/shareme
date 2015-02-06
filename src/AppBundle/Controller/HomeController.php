<?php
/**
 * Created by PhpStorm.
 * User: jesus
 * Date: 31/01/15
 * Time: 16:37
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class HomeController extends Controller {

    /**
     * @Route("/", name="landing_home")
     */
    public function homeAction(){
        return $this->render(
            'home/home.html.twig'
        );
    }
}