<?php

namespace Fish\Bundle\Controller;

use Doctrine\ORM\NoResultException;
use Fish\Bundle\Entity\PerguntaEntity;
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
class PerguntaController extends Controller
{

    /**
     * @Route("/pergunta")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        try {
            /* @var $pergunta PerguntaEntity */
            $pergunta = $this->get('pergunta_entity');
            $pergunta->setPergunta($request->request->get('pergunta'));
            if ($request->request->get('respostas')) {
                foreach ($request->request->get('respostas') as $respostaRequest) {
                    $pergunta->addResposta($this->get('resposta_model')->read($respostaRequest['id']));
                }
            }
            $this->get('pergunta_model')->create($pergunta);
            return new Response($this->get('jms_serializer')->serialize($pergunta, 'json'), Response::HTTP_CREATED, array('content-type' => 'application/json'));
        } catch (InvalidArgumentException $exception) {
            return new JsonResponse(array('messages' => $exception->getMessage()), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @Route("/pergunta/{id}", defaults={"id" = null})
     * @Method({"GET"})
     * @param type $id
     * @return Response|JsonResponse
     */
    public function readAction($id = null)
    {
        try {
            return new Response($this->get('jms_serializer')->serialize($this->get('pergunta_model')->read($id), 'json'), Response::HTTP_OK, array('content-type' => 'application/json'));
        } catch (NoResultException $exception) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Route("/pergunta/{id}")
     * @Method({"PUT"})
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function updateAction(Request $request, $id)
    {
        try {
            /* @var $pergunta PerguntaEntity */
            $pergunta = $this->get('pergunta_entity');
            $pergunta->setPergunta($request->request->get('pergunta'));
            foreach ($request->request->get('respostas', array()) as $respostaRequest) {
                $pergunta->addResposta($this->get('resposta_model')->read($respostaRequest['id']));
            }
            $perguntaUpdated = $this->get('pergunta_model')->update($id, $pergunta);

            return new Response($this->get('jms_serializer')->serialize($perguntaUpdated, 'json'), Response::HTTP_OK, array('content-type' => 'application/json'));
        } catch (InvalidArgumentException $exception) {
            return new JsonResponse(array('messages' => $exception->getMessage()), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @Route("/pergunta/{id}")
     * @Method({"DELETE"})
     * @param int $id
     * @return \Fish\Bundle\Controller\JsonResponse
     */
    public function deleteAction($id)
    {
        try {
            $this->get('pergunta_model')->delete($id);
            return new JsonResponse('', Response::HTTP_NO_CONTENT);
        } catch (NoResultException $exception) {
            return new JsonResponse(array('messages' => $exception->getMessage()), Response::HTTP_NOT_FOUND);
        }
    }

}
