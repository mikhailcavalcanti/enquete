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
use Fish\Bundle\Entity\RespostaEntity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class EnqueteController extends Controller
{
    /**
     * @Route("/enquete/")
     * @Method({"POST"})
	 * @ ParamConverter("post", class="EnqueteBundle:EnqueteEntity")
     * @Template()
     */
    public function createAction(Request $request)
    {
    	$enqueteJson = $this->get("request")->getContent();
    	if ($enqueteJson) {
    		$enqueteJson = json_decode($enqueteJson);
    		$enquete = new EnqueteEntity();
    		$enquete->setTitulo($enqueteJson->titulo);
    		
    		if (isset($enqueteJson->pergunta)) {
    			$pergunta = new PerguntaEntity();
    			$pergunta->setPergunta($enqueteJson->pergunta->pergunta);
    			$enquete->setPergunta($pergunta);
    		}
    	}
    	dump($enquete,1);
    	$enquete = new EnqueteEntity();
    	return new Response(null, Response::HTTP_CREATED);
    	dump('aee',1);
    }
    /**
     * @Route("/enquete/{id}.{_format}")
     * @Template()
     */
    public function findAction(Request $request, $id, $_format)
    {
    	$pergunta = new PerguntaEntity();
    	$pergunta->setPergunta('Tostines e fesquinho prq e mais gostoso ou mais gostoso prq e frenquinho?');
    	$enquete = new EnqueteEntity();
    	$enquete->setId(1);
    	$enquete->setTitulo('Enquete 01');
    	$enquete->setPerguntas(array($pergunta));
    	#
    	$request->query->set('enquete', $enquete);
    }

    /**
     * @Route("/enquete/.{_format}")
     * @Template()
     */
    public function readAction(Request $request, $_format)
    {
    	#
    	{
	    	$resposta1 = new RespostaEntity();
	    	$resposta1->setId(1);
	    	$resposta1->setResposta('Resposta 01');
	    	$resposta2 = new RespostaEntity();
	    	$resposta2->setId(2);
	    	$resposta2->setResposta('Resposta 02');
	    	#
	    	$pergunta1 = new PerguntaEntity();
	    	$pergunta1->setPergunta('Porque usar PHP?');
	    	$pergunta1->setRespostas(array($resposta1, $resposta2));
	    	$pergunta2 = new PerguntaEntity();
	    	$pergunta2->setPergunta('Porque nao usar PHP?');
	    	$pergunta2->setRespostas(array($resposta1, $resposta2));
	    	#
	    	$enquete1 = new EnqueteEntity();
	    	$enquete1->setId(1);
	    	$enquete1->setTitulo('Enquete 01');
	    	$enquete1->setPerguntas(array($pergunta1, $pergunta2));
    	}
    	#
    	{
	    	$enquete2 = new EnqueteEntity();
	    	$enquete2->setId(2);
	    	$enquete2->setTitulo('Enquete 02');
    	}
    	#
    	$enquetes = array($enquete1, $enquete2);
    	$request->query->set('enquetes', $enquetes);
    }
}
