<?php

namespace APP\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Validator\Constraints as Assert;

use \Serializable;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="APP\UsuarioBundle\Repository\UsuarioRepository")
 */
class Usuario implements AdvancedUserInterface, EquatableInterface{

    public function __construct() {

        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 32);
    }

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
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;
    
     /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles=[];
    
    function getRoles() {
        $roles = $this->roles;
      
        return array_unique($roles);
      
    }

    function setRoles(array $roles) {
        $this->roles = $roles;
    }

        /**
     * @ORM\OneToOne(targetEntity="Endereco", inversedBy="usuario")
     * @ORM\JoinColumn(name="endereco_id", referencedColumnName="id")
     */
    private $endereco;

    /**
     * @ORM\OneToMany(targetEntity="Telefone", mappedBy="usuario")
     */
    private $telefones;

    /**
     * @ORM\OneToOne(targetEntity="APP\EmpresaBundle\Entity\Empresar", mappedBy="usuario")
     */
    private $empresa;
    
      /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status=1;

      /**
     * @var bool
     *
     * @ORM\Column(name="perfil", type="boolean")
     */
    private $perfil=1;
    
    
    
    function getStatus() {
        return $this->status;
    }

    function getPerfil() {
        return $this->perfil;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    

    function getEmpresa() {
        return $this->empresa;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function getTelefones() {
        return $this->telefones;
    }

    function setTelefones($telefones) {
        $this->telefones = $telefones;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    /**
     * 
     * @return type
     */
    function getPassword() {
        return $this->password;
    }

    function getSalt() {
        return $this->salt;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setSalt($salt) {
        $this->salt = $salt;
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
     * @return Usuario
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
     * @return Usuario
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

    public function eraseCredentials() {
        
    }

    public function getUsername() {
          return $this->email;
    }

  public function isEqualTo(UserInterface $user) {
        return $this->getId() == $user->getId();
    }

    public function isAccountNonExpired() {
        return true;
    }

    public function isAccountNonLocked() {
        return true;
    }

    public function isCredentialsNonExpired() {
        return true;
    }


    public function isEnabled() {
        return $this->status;
    }

    


    
    
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
           
        ));
    }

  public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            
        ) = unserialize($serialized);
    }

    
    
   public function __toString() {
    return $this->email;
} 
    
    
}
