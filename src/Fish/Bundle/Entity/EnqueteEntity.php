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
    private $perguntas = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->perguntas = new ArrayCollection();
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
     * Add perguntas
     *
     * @param PerguntaEntity $perguntas
     * @return EnqueteEntity
     */
    public function addPergunta(PerguntaEntity $perguntas)
    {
        $this->perguntas[] = $perguntas;

        return $this;
    }

    /**
     * Remove perguntas
     *
     * @param PerguntaEntity $perguntas
     */
    public function removePergunta(PerguntaEntity $perguntas)
    {
        $this->perguntas->removeElement($perguntas);
    }

    /**
     * Get perguntas
     *
     * @return Collection 
     */
    public function getPerguntas()
    {
        return $this->perguntas;
    }

    /**
     * Set perguntas
     *
     * @return Collection 
     */
    public function setPerguntas(ArrayCollection $perguntas)
    {
        $this->perguntas = $perguntas;
        return $this;
    }

}
