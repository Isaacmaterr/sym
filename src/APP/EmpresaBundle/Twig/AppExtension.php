<?php

namespace APP\EmpresaBundle\Twig;


class AppExtension extends \Twig_Extension {


  

    public function getFilters() {

        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
            new \Twig_SimpleFilter('params', array($this, 'params')),
         
        
        );
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',') {
        
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$' . $price;

        return $price;
    }

   public function  params($string) {
        $pattern = "#Controller\\\([a-zA-Z]*)Controller#";
            $matches = array();
            preg_match($pattern,$string, $matches['Controle']);
            
            $pattern = "#::([a-zA-Z]*)Action#";
            
            preg_match($pattern,$string, $matches['Action']);

          
       return $matches;
   } 

    public function getName() {
        return 'app_extension';
    }

}
