<?php

namespace APP\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Endereco
 *
 * @ORM\Table(name="endereco")
 * @ORM\Entity(repositoryClass="APP\UsuarioBundle\Repository\EnderecoRepository")
 */
class Endereco
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="endereco", type="string", length=255)
     */
    private $endereco;

    /**
     * @var string
     *
     * @ORM\Column(name="bairro", type="string", length=255)
     */
    private $bairro;

    /**
     * @var string
     *
     * @ORM\Column(name="uf", type="string", length=2)
     */
    private $uf;

    /**
     * @var string
     *
     * @ORM\Column(name="cep", type="string", length=8)
     */
    private $cep;
     /**
     * @ORM\OneToOne(targetEntity="Usuario", mappedBy="endereco")
     */
    private $usuario;
    
    function getUsuario() {
        return $this->usuario;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set endereco
     *
     * @param string $endereco
     *
     * @return Endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get endereco
     *
     * @return string
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set bairro
     *
     * @param string $bairro
     *
     * @return Endereco
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get bairro
     *
     * @return string
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set uf
     *
     * @param string $uf
     *
     * @return Endereco
     */
    public function setUf($uf)
    {
        $this->uf = $uf;

        return $this;
    }

    /**
     * Get uf
     *
     * @return string
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * Set cep
     *
     * @param string $cep
     *
     * @return Endereco
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get cep
     *
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }
}

