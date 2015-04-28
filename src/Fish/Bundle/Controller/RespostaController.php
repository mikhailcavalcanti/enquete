<?php

namespace Fish\Bundle\Controller;

use Doctrine\ORM\NoResultException;
use Fish\Bundle\Entity\RespostaEntity;
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
class RespostaController extends Controller
{

//
    /**
     * @Route("/resposta")
     * @Method({"POST"})
     */
    public function create(Request $request)
    {
        try {
            /* @var $resposta RespostaEntity */
            $resposta = $this->get('resposta_entity');
            $resposta->setResposta($request->request->get('resposta'));
            $this->get('resposta_model')->create($resposta);
            return new Response($this->get('jms_serializer')->serialize($resposta, 'json'), Response::HTTP_CREATED, array('content-type' => 'application/json'));
        } catch (InvalidArgumentException $exception) {
            return new JsonResponse(array('messages' => $exception->getMessage()), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @Route("/resposta/{id}", defaults={"id" = null})
     * @Method({"GET"})
     */
    public function readAction($id = null)
    {
        try {
            return new Response($this->get('jms_serializer')->serialize($this->get('resposta_model')->read($id), 'json'), Response::HTTP_OK, array('content-type' => 'application/json'));
        } catch (NoResultException $exception) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Route("/resposta/{id}")
     * @Method({"PUT"})
     */
    public function updateAction(Request $request, $id)
    {
        try {
            /* @var $entity RespostaEntity */
            $resposta = $this->get('resposta_entity');
            $resposta->setResposta($request->request->get('resposta'));
            $respostaUpdated = $this->get('resposta_model')->update($id, $resposta);
            return new Response($this->get('jms_serializer')->serialize($respostaUpdated, 'json'), Response::HTTP_OK, array('content-type' => 'application/json'));
        } catch (InvalidArgumentException $exception) {
            return new JsonResponse(array('messages' => $exception->getMessage()), Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (NoResultException $exception) {
            return $this->forward('Fish\Bundle\Controller\RespostaController::create');
        }
    }

    /**
     * @Route("/resposta/{id}")
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
        try {
            $this->get('resposta_model')->delete($id);
            return new JsonResponse('', Response::HTTP_NO_CONTENT);
        } catch (\Doctrine\ORM\NoResultException $exception) {
            return new JsonResponse('', Response::HTTP_NOT_FOUND);
        }
    }

}
