<?php
namespace Unrtech\BackOfficeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Fixtures for categories
 */
class LoadAdminPermissionsData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    /**
     * Fixture order
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }

    /**
     * Set container
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {

        //Create permissions
        $permissionAdd = new \Unrtech\UserBundle\Entity\Permission();
        $permissionAdd->setName('add');
        $permissionEdit = new \Unrtech\UserBundle\Entity\Permission();
        $permissionEdit->setName('edit');
        $permissionDelete = new \Unrtech\UserBundle\Entity\Permission();
        $permissionDelete->setName('delete');
        $permissionList = new \Unrtech\UserBundle\Entity\Permission();
        $permissionList->setName('list');
        $permissionShow = new \Unrtech\UserBundle\Entity\Permission();
        $permissionShow->setName('show');
        $manager->persist($permissionAdd);
        $manager->persist($permissionEdit);
        $manager->persist($permissionDelete);
        $manager->persist($permissionList);
        $manager->persist($permissionShow);

        //Flush tyhem
        $manager->flush();

        $permissions = $manager->getRepository('UnrtechUserBundle:Permission')->findAll();

        $adminGroup = new \Unrtech\UserBundle\Entity\UserGroup();
        $adminGroup->setName('administrators');
        $adminGroup->setPermissions($permissions);
        $manager->persist($adminGroup);
        $manager->flush();

        //Create admin user
        $adminUser = new \Unrtech\UserBundle\Entity\User();
        $adminUser->setName('admin');
        $adminUser->setSurname('admin');
        $adminUser->setLogin('administrator');
        $adminUser->setPassword('administrator');
        $adminUser->setEmail('mail@mail.fr');
        $adminUser->setConfirmed(true);
        $adminUser->setUserGroup($adminGroup);
        $manager->persist($adminUser);
        $adminGroup->addUser($adminUser);
        $manager->flush();

        
    }
}