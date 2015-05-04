<?php

/**
 * 
 */

namespace Fish\Bundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * 
 */
class RespostaEntity extends AbstractEntity
{

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var string
     */
    private $resposta;

    /**
     *
     * @var ArrayCollection
     */
    private $enquetePerguntaResposta;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enquetePerguntaResposta = new ArrayCollection();
    }

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
     * Set resposta
     *
     * @param string $resposta
     * @return RespostaEntity
     */
    public function setResposta($resposta)
    {
        $this->resposta = $resposta;
        return $this;
    }

    /**
     * Get resposta
     *
     * @return string 
     */
    public function getResposta()
    {
        return $this->resposta;
    }

    /**
     * Add enquetePerguntaResposta
     *
     * @param EnquetePerguntaRespostaEntity $enquetePerguntaResposta
     * @return RespostaEntity
     */
    public function addEnquetePerguntaRespostum(EnquetePerguntaRespostaEntity $enquetePerguntaResposta)
    {
        $this->enquetePerguntaResposta[] = $enquetePerguntaResposta;
        return $this;
    }

    /**
     * Remove enquetePerguntaResposta
     *
     * @param EnquetePerguntaRespostaEntity $enquetePerguntaResposta
     */
    public function removeEnquetePerguntaRespostum(EnquetePerguntaRespostaEntity $enquetePerguntaResposta)
    {
        $this->enquetePerguntaResposta->removeElement($enquetePerguntaResposta);
    }

    /**
     * Get enquetePerguntaResposta
     *
     * @return Collection 
     */
    public function getEnquetePerguntaResposta()
    {
        return $this->enquetePerguntaResposta;
    }

}
