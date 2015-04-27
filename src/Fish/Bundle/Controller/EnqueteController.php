<?php

namespace Fish\Bundle\Controller;

use Fish\Bundle\Entity\EnqueteEntity;
use Fish\Bundle\Entity\PerguntaEntity;
use Fish\Bundle\Entity\RespostaEntity;
use InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api")
 */
class EnqueteController extends Controller
{

    /**
     * @Route("/enquete")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        try {
            /* @var $enquete EnqueteEntity */
            $enquete = $this->get('enquete_entity');
            $enquete->setTitulo($request->request->get('titulo'));
            foreach ($request->request->get('perguntas', array()) as $perguntaRequest) {
                $enquete->addPergunta($this->get('pergunta_model')->read($perguntaRequest['id']));
            }
            $this->get('enquete_model')->create($enquete);
            return new Response($this->get('jms_serializer')->serialize($enquete, 'json'), Response::HTTP_CREATED, array('content-type' => 'application/json'));
        } catch (InvalidArgumentException $exception) {
            return new JsonResponse(array('messages' => $exception->getMessage()), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @Route("/enquete/{id}")
     * @Method({"GET"})
     * @param EnqueteEntity $enquete
     * @return Response
     */
    public function readAction(EnqueteEntity $enquete = null)
    {
        $stauts = empty($enquete) ? Response::HTTP_NOT_FOUND : Response::HTTP_OK;
        return new Response($this->get('jms_serializer')->serialize($enquete, 'json'), $stauts, array('content-type' => 'application/json'));
    }

}
