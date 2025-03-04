<?php 

namespace App\twig;

use App\Classe\Cart;
use Twig\TwigFilter;
use Twig\Extension\GlobalsInterface;
use Twig\Extension\AbstractExtension;
use App\Repository\CategoryRepository;

class AppExtentions extends AbstractExtension implements GlobalsInterface
{
    private $categoryRepository; 
    private $cart;
    
    public function __construct(CategoryRepository $categoryRepository, Cart $cart){
        
        $this ->categoryRepository = $categoryRepository;
        $this->cart = $cart; 
    }

    public function  getFilters()
    {
        return [
            new TwigFilter ('price', [ $this, 'formatPrice']),
        
        
        ];
    }
    public function formatPrice($number)
    {
        return number_format ($number,'2', ',' ). '€';
    
    }
    // cette méthode getGlobals va nous permettre de créé des variables globales que nous allons pouvoir utiliser partout dans notre environement twig // 
    public function getGlobals(): array 

    {
        return [
            'allCategories' => $this->categoryRepository->findAll(),
            'fullCartQuantity' => $this->cart->fullQuantity()

        ];
    }
}