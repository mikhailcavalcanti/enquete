<?php

namespace Fish\Bundle\Controller;

use Fish\Bundle\Entity\RespostaEntity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    
    /**
     * @Route("/resposta/create")
     * @ParamConverter("resposta", class="EnqueteBundle:Model:RespostaModel")
     */
    public function create($resposta)
    {
//        $resposta = new RespostaEntity();
//        $resposta->setResposta($request->get('resposta'));
        exit(var_dump($resposta));
        $this->get('resposta_model')->create($resposta);
        return 'lol';
    }
}
