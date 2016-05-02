<?php

namespace APP\EmpresaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clientes
 *
 * @ORM\Table(name="clientes")
 * @ORM\Entity(repositoryClass="APP\EmpresaBundle\Repository\ClientesRepository")
 */
class Clientes {

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
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="endereco", type="string", length=255)
     */
    private $endereco;

    /**
     * @ORM\ManyToOne(targetEntity="Empresar", inversedBy="clientes")
     * @ORM\JoinColumn(name="empresar_clientes_id", referencedColumnName="id",nullable=false)
     */
    private $empresar;

    
    /**
     * @ORM\OneToMany(targetEntity="Receita", mappedBy="cliente")
     */
    private $receitas;
    
    function getEmpresar() {
        return $this->empresar;
    }

    function getReceitas() {
        return $this->receitas;
    }

    function setEmpresar($empresar) {
        $this->empresar = $empresar;
    }

    function setReceitas($receitas) {
        $this->receitas = $receitas;
    }

        
    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Clientes
     */
    public function setNome($nome) {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Clientes
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set endereco
     *
     * @param string $endereco
     *
     * @return Clientes
     */
    public function setEndereco($endereco) {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get endereco
     *
     * @return string
     */
    public function getEndereco() {
        return $this->endereco;
    }
 public function __toString() {
        return $this->nome;
    }
}
