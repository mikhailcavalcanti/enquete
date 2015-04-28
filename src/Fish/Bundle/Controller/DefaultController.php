<?php

namespace Fish\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @author Mikhail Cavalcanti <mikhailcavalcanti@gmail.com>
 */
class DefaultController extends Controller
{
    /**
     * @Route("/enquete")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
