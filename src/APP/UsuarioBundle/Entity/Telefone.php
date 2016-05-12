<?php

namespace APP\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Telefone
 *
 * @ORM\Table(name="telefone")
 * @ORM\Entity(repositoryClass="APP\UsuarioBundle\Repository\TelefoneRepository")
 */
class Telefone {

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
     * @ORM\Column(name="numero", type="string", length=11)
     */
    private $numero;

    /**
     * @var bool
     *
     * @ORM\Column(name="whatzap", type="boolean")
     */
    private $whatzap;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="telefones")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="APP\EmpresaBundle\Entity\Clientes", inversedBy="telefones")
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     */
    private $cliente;

    function getCliente() {
        return $this->cliente;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }

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
    public function getId() {
        return $this->id;
    }

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return Telefone
     */
    public function setNumero($numero) {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero() {
        return $this->numero;
    }

    /**
     * Set whatzap
     *
     * @param boolean $whatzap
     *
     * @return Telefone
     */
    public function setWhatzap($whatzap) {
        $this->whatzap = $whatzap;

        return $this;
    }

    /**
     * Get whatzap
     *
     * @return bool
     */
    public function getWhatzap() {
        return $this->whatzap;
    }

}
