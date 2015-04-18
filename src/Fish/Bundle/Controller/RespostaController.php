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
use Fish\Bundle\Entity\RespostaEntity;

class RespostaController extends Controller
{
    /**
     * @Route("/resposta/{id}.{_format}")
     * @Template()
     */
    public function findAction(Request $request, $id, $_format)
    {
    	$resposta = new RespostaEntity();
    	$resposta->setId(1);
    	$resposta->setResposta('Resposta 01');
    	#
    	$request->query->set('resposta', $resposta);
    }

    /**
     * @Route("/resposta/.{_format}")
     * @Template()
     */
    public function readAction(Request $request, $_format)
    {
    	$resposta1 = new RespostaEntity();
    	$resposta1->setId(1);
    	$resposta1->setResposta('Resposta 01');
    	$resposta2 = new RespostaEntity();
    	$resposta2->setId(2);
    	$resposta2->setResposta('Resposta 02');
    	$resposta3 = new RespostaEntity();
    	$resposta3->setId(3);
    	$resposta3->setResposta('Resposta 03');
    	#
    	$respostas = array($resposta1, $resposta2, $resposta3);
    	$request->query->set('respostas', $respostas);
    }
}
