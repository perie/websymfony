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
use HB\BlogBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $usersTab = array();
        for ($count=1;$count<10;$count++) {
            $user = new User();
            $user->setBirthDate(new \DateTime());
            $user->setEmail('user'.$count.'@mydomain.com');
            $user->setLogin('user'.$count);
            $user->setName('userName'.$count);
            $user->setPassword('SecretUser'.$count);
            $user->setEnabled(true);
            
            $usersTab["user".$count] = $user;
            $manager->persist($user);
        }
        
//        $user2 = new User();
//        $user2->setTitle('Un Nouvel article de test');
//        $user2->setContent('Ceci est nouveau test de fixtures avec inclusion dynamique pour premiere phase de test.<br><br>Avec test de saut de ligne via balise HTML.');
//        $user2->setPublished(true);
//
//        $manager->persist($user2);
//        
        $manager->flush();
        
        // On stocke dans le repository des Fixtures les objets à partagé.
        
                
        for ($count=1;$count<10;$count++) {
                $this->addReference("user".$count, $usersTab["user".$count]);
        }
    }

/**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // l'ordre dans lequel les fichiers sont chargés
    }
}