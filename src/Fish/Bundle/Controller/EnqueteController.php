<?php

namespace Fish\Bundle\Controller;

use Fish\Bundle\Entity\EnqueteEntity;
use InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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

    /**
     * @Route("/enquete/{id}")
     * @Method({"PUT"})
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function updateAction(Request $request, $id)
    {
        try {
            /* @var $enquete EnqueteEntity */
            $enquete = $this->get('enquete_entity');
            $enquete->setTitulo($request->request->get('titulo'));
            foreach ($request->request->get('perguntas', array()) as $perguntaRequest) {
                $enquete->addPergunta($this->get('pergunta_model')->read($perguntaRequest['id']));
            }
            $enqueteUpdated = $this->get('enquete_model')->update($id, $enquete);

            return new Response($this->get('jms_serializer')->serialize($enqueteUpdated, 'json'), Response::HTTP_OK, array('content-type' => 'application/json'));
        } catch (InvalidArgumentException $exception) {
            return new JsonResponse(array('messages' => $exception->getMessage()), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @Route("/enquete/{id}")
     * @Method({"DELETE"})
     * @param int $id
     * @return \Fish\Bundle\Controller\JsonResponse
     */
    public function deleteAction($id)
    {
        try {
            $this->get('enquete_model')->delete($id);
            return new JsonResponse('', Response::HTTP_NO_CONTENT);
        } catch (NoResultException $exception) {
            return new JsonResponse(array('messages' => $exception->getMessage()), Response::HTTP_NOT_FOUND);
        }
    }

}
