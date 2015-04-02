<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Acme\HelloBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use HB\BlogBundle\Entity\Article;

class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        
        for ($count=1;$count<10;$count++) {
            $numUser = rand(0,9);
            if ($numUser != 0) {
                $user = $this->getReference("user".$numUser);
            }
            else {
                $user = null;
            }
            $article = new Article();
            $article->setTitle('#'.$count.' Un article de test');
            $article->setContent('Ceci est test de fixtures avec inclusion dynamique pour premiere phase de test');
            $article->setPublished(true);
            $article->setAuthor($user);
            $manager->persist($article);

//            $article2 = new Article();
//            $article2->setTitle('Un Nouvel article de test');
//            $article2->setContent('Ceci est nouveau test de fixtures avec inclusion dynamique pour premiere phase de test.<br><br>Avec test de saut de ligne via balise HTML.');
//    //        $article2->setAuthor(rand(1,10));
//            $article2->setPublished(true);

//            $manager->persist($article2);
        }
        
            $manager->flush();
        
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // l'ordre dans lequel les fichiers sont chargés
    }
}