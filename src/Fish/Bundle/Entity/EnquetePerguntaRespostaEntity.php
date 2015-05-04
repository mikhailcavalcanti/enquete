<?php

/**
 * 
 */

namespace Fish\Bundle\Entity;

/**
 * 
 */
class EnquetePerguntaRespostaEntity extends AbstractEntity
{

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var EnqueteEntity
     */
    private $enquete;

    /**
     *
     * @var PerguntaEntity
     */
    private $pergunta;

    /**
     *
     * @var RespostaEntity
     */
    private $resposta;

    /**
     *
     * @var integer
     */
    private $quantidadeDeVotos;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set enquete
     *
     * @param EnqueteEntity $enquete
     * @return EnquetePerguntaRespostaEntity
     */
    public function setEnquete(EnqueteEntity $enquete)
    {
        $this->enquete = $enquete;
        return $this;
    }

    /**
     * Get enquete
     *
     * @return EnqueteEntity
     */
    public function getEnquete()
    {
        return $this->enquete;
    }

    /**
     * Set pergunta
     *
     * @param PerguntaEntity $pergunta
     * @return EnquetePerguntaRespostaEntity
     */
//    public function setPergunta(PerguntaEntity $pergunta)
    public function setPergunta($pergunta)
    {
        $this->pergunta = $pergunta;
        return $this;
    }

    /**
     * Get pergunta
     *
     * @return PerguntaEntity
     */
    public function getPergunta()
    {
        return $this->pergunta;
    }

    /**
     * Set resposta
     *
     * @param RespostaEntity $resposta
     * @return EnquetePerguntaRespostaEntity
     */
    public function setResposta(RespostaEntity $resposta)
    {
        $this->resposta = $resposta;
        return $this;
    }

    /**
     * Get resposta
     *
     * @return RespostaEntity
     */
    public function getResposta()
    {
        return $this->resposta;
    }


    /**
     * Set quantidadeDeVotos
     *
     * @param integer $quantidadeDeVotos
     * @return EnquetePerguntaRespostaEntity
     */
    public function setQuantidadeDeVotos($quantidadeDeVotos)
    {
        $this->quantidadeDeVotos = $quantidadeDeVotos;
        return $this;
    }

    /**
     * Get quantidadeDeVotos
     *
     * @return integer 
     */
    public function getQuantidadeDeVotos()
    {
        return $this->quantidadeDeVotos;
    }
    
    public function __toString()
    {
        return json_encode($this);
    }
}
