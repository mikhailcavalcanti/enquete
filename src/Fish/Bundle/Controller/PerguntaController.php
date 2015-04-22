<?php

namespace Fish\Bundle\Controller;

use Fish\Bundle\Entity\PerguntaEntity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api")
 */
class PerguntaController extends Controller
{

    /**
     * @Route("/pergunta")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        /* @var $pergunta PerguntaEntity */
        $pergunta = $this->get('pergunta_entity');
        $pergunta->setPergunta($request->request->get('pergunta'));
        foreach ($request->request->get('respostas') as $respostaRequest) {
            $pergunta->addResposta($this->get('resposta_model')->read($respostaRequest['id']));
        }
        $this->get('pergunta_model')->create($pergunta);
        return new JsonResponse('', \Symfony\Component\HttpFoundation\Response::HTTP_CREATED);
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
