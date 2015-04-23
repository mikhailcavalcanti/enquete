<?php

/**
 * 
 */

namespace Fish\Bundle\Entity;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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

}
