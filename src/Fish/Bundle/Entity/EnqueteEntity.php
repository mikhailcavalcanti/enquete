<?php

namespace Fish\Bundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @author Mikhail Cavalcanti <mikhail.cavalcanti@gmail.com>
 */
class EnqueteEntity extends AbstractEntity
{

    /**
     *
     * @var int
     */
    private $id = null;

    /**
     *
     * @var string
     */
    private $titulo = null;

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
     * Set titulo
     *
     * @param string $titulo
     * @return EnqueteEntity
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Add enquetePerguntaResposta
     *
     * @param EnquetePerguntaRespostaEntity $enquetePerguntaResposta
     * @return EnqueteEntity
     */
    public function addEnquetePerguntaResposta(EnquetePerguntaRespostaEntity $enquetePerguntaResposta)
    {
        $this->enquetePerguntaResposta[] = $enquetePerguntaResposta;
        return $this;
    }

    /**
     * Remove enquetePerguntaResposta
     *
     * @param EnquetePerguntaRespostaEntity $enquetePerguntaResposta
     */
    public function removeEnquetePerguntaResposta(EnquetePerguntaRespostaEntity $enquetePerguntaResposta)
    {
        $this->enquetePerguntaResposta->removeElement($enquetePerguntaResposta);
    }

    /**
     * Set enquetePerguntaResposta
     *
     * @param ArrayCollection $enquetePerguntaRespostas
     * @return EnqueteEntity
     */
    public function setEnquetePerguntaResposta(ArrayCollection $enquetePerguntaRespostas)
    {
        $this->enquetePerguntaResposta = $enquetePerguntaRespostas;
        return $this;
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
