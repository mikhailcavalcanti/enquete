<?php

namespace Fish\Bundle\Controller;

use Fish\Bundle\Entity\RespostaEntity;
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
        /* @var $entity RespostaEntity */
        $entity = $this->get('resposta_entity');
        $entity->setResposta($request->request->get('resposta'));
        $this->get('resposta_model')->create($entity);
        return new JsonResponse($entity, Response::HTTP_CREATED);
    }

    /**
     * @Route("/resposta/{id}", defaults={"id" = null})
     * @Method({"GET"})
     */
    public function readAction(RespostaEntity $entity)
    {
        return new JsonResponse($entity);
    }

    /**
     * @Route("/resposta/{id}")
     * @Method({"PUT"})
     */
    public function updateAction(Request $request, RespostaEntity $entity)
    {
        /* @var $entity RespostaEntity */
        $entity->setResposta($request->request->get('resposta'));
        return new JsonResponse($this->get('resposta_model')->update($entity));
    }

    /**
     * @Route("/resposta/{id}")
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
        $this->get('resposta_model')->delete($id);
        return new JsonResponse('', Response::HTTP_NO_CONTENT);
    }

}
