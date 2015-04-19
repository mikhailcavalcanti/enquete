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

class PerguntaController extends Controller
{
    /**
     * @Route("/pergunta/{id}.{_format}")
     * @Template()
     */
    public function findAction(Request $request, $id, $_format)
    {
    	$pergunta = new PerguntaEntity();
    	$pergunta->setId(1);
    	$pergunta->setPergunta('Pergunta 01');
    	#
    	$request->query->set('pergunta', $pergunta);
    }

    /**
     * @Route("/pergunta/.{_format}")
     * @Template()
     */
    public function readAction(Request $request, $_format)
    {
    	$pergunta1 = new PerguntaEntity();
    	$pergunta1->setId(1);
    	$pergunta1->setPergunta('Pergunta 01');
    	$pergunta2 = new PerguntaEntity();
    	$pergunta2->setId(2);
    	$pergunta2->setPergunta('Pergunta 02');
    	$pergunta3 = new PerguntaEntity();
    	$pergunta3->setId(3);
    	$pergunta3->setPergunta('Pergunta 03');
    	#
    	$perguntas = array($pergunta1, $pergunta2, $pergunta3);
    	$request->query->set('perguntas', $perguntas);
    }
}
