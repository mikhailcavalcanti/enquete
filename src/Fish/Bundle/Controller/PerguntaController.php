<?php

namespace Fish\Bundle\Controller;

use Fish\Bundle\Entity\PerguntaEntity;
use JMS\Serializer\SerializerBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        return new JsonResponse('', Response::HTTP_CREATED);
    }

    /**
     * @Route("/pergunta/{id}")
     */
    public function readAction(PerguntaEntity $pergunta)
    {
        $serializer = SerializerBuilder::create()->build();
        $jsonContent = $serializer->serialize($pergunta, 'json');
        return new Response($jsonContent, Response::HTTP_OK, array('content-type' => 'application/json'));
    }

}
