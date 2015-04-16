<?php

namespace Fish\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Fish\Bundle\Entity\EnqueteEntity;
use Symfony\Component\HttpFoundation\Request;
use Fish\Bundle\Entity\PerguntaEntity;

class EnqueteController extends Controller
{
    /**
     * @Route("/enquete/{id}.{_format}")
     * @Template()
     */
    public function findAction($id, $_format)
    {
    	$pergunta = new PerguntaEntity();
    	$pergunta->setPergunta('Tostines e fesquinho prq e mais gostoso ou mais gostoso prq e frenquinho?');
    	$enquete1 = new EnqueteEntity();
    	$enquete1->setId(1);
    	$enquete1->setTitulo('Enquete 01');
    	$enquete1->setPergunta($pergunta);
    	#
    	$enquetes = array($enquete1,);
        return new Response(json_encode($enquete1));
    }

    /**
     * @Route("/enquete/.{_format}")
     * @Template()
     */
    public function readAction(Request $request, $_format)
    {
    	#
    	$pergunta = new PerguntaEntity();
    	$pergunta->setPergunta('Tostines e fesquinho prq e mais gostoso ou mais gostoso prq e frenquinho?');
    	$enquete1 = new EnqueteEntity();
    	$enquete1->setId(1);
    	$enquete1->setTitulo('Enquete 01');
    	$enquete1->setPergunta($pergunta);
    	#
    	$enquete2 = new EnqueteEntity();
    	$enquete2->setId(2);
    	$enquete2->setTitulo('Enquete 02');
    	#
    	$enquetes = array($enquete1, $enquete2);
    	return new Response(json_encode($enquetes));
    }
}
