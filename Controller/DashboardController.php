<?php

namespace Unrtech\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Yaml\Parser;
use Unrtech\UserBundle\Entity\User;
use Unrtech\UserBundle\Entity\UserGroup;
use Unrtech\UserBundle\Entity\Permission;

/**
 * Admin controller
 */
class DashboardController extends Controller {

    /**
     *
     * @var array all the possible action set by navigation action function
     */
    private $actions = array();

    /**
     * Index Action executed when arrive on dashboard
     * 
     * @return template
     */
    public function indexAction() {

        return $this->render('UnrtechBackOfficeBundle:Admin:dashboard.html.twig', array());
    }

    /**
     * Render the navigation bar
     * 
     * @return template
     */
    public function navigationAction() {
        $entities = array();
        $entityActions = $this->getEntityAction();
        $boEntities = \Unrtech\BackOfficeBundle\Entity\Entities::getEntities();
        foreach ($boEntities as $entityBundle) {
            list($bundle, $entity) = explode(':', $entityBundle);
            array_push($entities, array(
                'name' => $entity,
                'bundle' => $bundle,
                'actions' => $entityActions
            ));
        }

        return $this->render('UnrtechBackOfficeBundle:Admin:admin_nav.html.twig', array(
                    'entities' => $entities
                        )
        );
    }

    /**
     * Dashboard action when click on action buttons
     * 
     * @param string $class  The current class
     * @param string $bundle The current bundle
     * @param string $action The action to launch
     * 
     * @return \Response
     */
    public function dashBoardAdminAction($class, $bundle, $action) {

        switch ($action) {
            case 'List' :
                return $this->listAction($bundle . ':' . $class);
                break;
            case 'Create' :
                break;
            case 'Edit' :
                break;
            case 'Show' :
                break;
            case 'Delete' :
                break;
            default :
                return $this->indexAction();
                break;
        }
        return new \Symfony\Component\HttpFoundation\Response('entity : ' . $bundle . ':' . $class . ' action :' . $action);
    }

    /**
     * Return the list of the entity
     * 
     * @param string $entityName The full name of the entity
     * 
     * @return template
     */
    public function listAction($entityName) {
        $this->getEntityAction();
        list($bundle, $name) = explode(':', $entityName);
        $adminEntity = $this->get(strtolower($name) . '_admin_entity');
        $entities = $this->getDoctrine()->getEntityManager()->getRepository($entityName)->findAll();

        return $this->render('UnrtechBackOfficeBundle:Lists:list.html.twig', array(
                    'entityName' => $name,
                    'bundle' => $bundle,
                    'adminEntity' => $name,
                    'entities' => $entities,
                    'headers' => $adminEntity->getHeaders(),
                    'labels' => $adminEntity->getLabels(),
                    'actions' => $this->actions
                        )
        );
    }

    public function adminAddAction($entity, $bundle, $id) {
        
    }

    public function adminEditAction($entity, $bundle, $id) {
        
    }

    public function adminShowAction($entity, $bundle, $id) {
        $adminEntity = $this->get(strtolower($entity) . '_admin_entity');
        $entity = strtoupper(substr($entity, 0, 1)) . substr($entity, 1);
        $entity = $this->getDoctrine()->getEntityManager()->getRepository($bundle . ':' . $entity)->find($id);

        return $this->render('UnrtechBackOfficeBundle:Forms:show.html.twig', array(
                    'entity' => $entity,
                    'inputs' => $adminEntity->getInputs()
                        )
        );
    }

    public function adminDeleteAction($entity, $bundle, $id) {
        
    }

    /**
     * Return the possibles action for an entity
     * 
     * @return array
     */
    private function getEntityAction() {
        $currentUser = $this->getDoctrine()->getEntityManager()->getRepository('UnrtechUserBundle:User')->find(1);
        $currentGroup = $currentUser->getUserGroup();
        $entityActions = array();
        foreach ($currentGroup->getPermissions() as $permission) {
            if ($permission->getSlug() == 'add') {
                array_push($entityActions, 'Create');
            }
            if ($permission->getSlug() == 'list') {
                array_push($entityActions, 'List');
            }
            if ($permission->getSlug() == 'show') {
                array_push($this->actions, 'show');
            }
            if ($permission->getSlug() == 'edit') {
                array_push($this->actions, 'edit');
            }
            if ($permission->getSlug() == 'delete') {
                array_push($this->actions, 'delete');
            }
        }

        return $entityActions;
    }

}
