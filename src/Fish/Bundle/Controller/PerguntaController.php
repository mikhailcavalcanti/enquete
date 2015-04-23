<?php

namespace Fish\Bundle\Controller;

use Fish\Bundle\Entity\PerguntaEntity;
use JMS\Serializer\SerializerBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        return new Response($this->get('jms_serializer')->serialize($pergunta, 'json'), Response::HTTP_OK, array('content-type' => 'application/json'));
    }

    /**
     * @Route("/pergunta/{id}")
     * @Method({"GET"})
     */
    public function readAction(PerguntaEntity $pergunta)
    {
        return new Response($this->get('jms_serializer')->serialize($pergunta, 'json'), Response::HTTP_OK, array('content-type' => 'application/json'));
    }

    /**
     * @Route("/pergunta/{id}")
     * @Method({"PUT"})
     * @param Request $request
     * @param PerguntaEntity $pergunta
     * @return Response
     */
    public function updateAction(Request $request)
    {
        /* @var $pergunta PerguntaEntity */
        $pergunta = $this->get('pergunta_entity');
        $pergunta->setPergunta($request->request->get('pergunta'));
        foreach ($request->request->get('respostas') as $respostaRequest) {
            $pergunta->addResposta($this->get('resposta_model')->read($respostaRequest['id']));
        }
        $this->get('pergunta_model')->update($request->attributes->get('id'), $pergunta);

        return new Response($this->get('jms_serializer')->serialize($pergunta, 'json'), Response::HTTP_OK, array('content-type' => 'application/json'));
    }

}
