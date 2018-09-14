<?php

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;


class SecurityPlugin extends Plugin
{
    public function getAcl()
    {
        if (!isset($this->persistent->acl)) {

            $acl = new AclList();

            $acl->setDefaultAction(Acl::DENY);

            // Register roles
            $roles = [
                'users' => new Role(
                    'Users',
                    'Member privileges, granted after sign in.'
                ),
                'guests' => new Role(
                    'Guests',
                    'Anyone browsing the site who is not signed in is considered to be a "Guest".'
                ),
                'admin' => new Role(
                        'Admin',
                        'The Lord!'
                ),
            ];

            foreach ($roles as $role) {
                $acl->addRole($role);
            }

            //Private area resources
            $privateResources = [
                'index' => ['index', 'start'],
            ];

            foreach ($privateResources as $resource => $actions) {
                $acl->addResource(new Resource($resource), $actions);
            }

            //Public area resources
            $publicResources = [
                'session' => ['index', 'start'],
            ];


            foreach ($publicResources as $resource => $actions) {
                $acl->addResource(new Resource($resource), $actions);
            }

            //Grant access to public areas to both users and guests
            foreach ($roles as $role) {
                foreach ($publicResources as $resource => $actions) {
                    foreach ($actions as $action) {
                        $acl->allow($role->getName(), $resource, $action);
                    }
                }
            }
        }
    }

    /**
     * This action is executed before execute any action in the application
     *
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @return bool
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        $auth = $this->session->get('auth');
        if (!$auth) {
            $role = 'Guests';
        } else {
            $role = 'Users';
        }

        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        $acl = $this->getAcl();

        if (!$acl->isResource($controller)) {
            $dispatcher->forward(
                [
                    'controller' => 'errors',
                    'action' => 'show404',
                ]
            );

            return false;
        }

        $allowed = $acl->isAllowed($role, $controller, $action);
        if (!$allowed) {
            $dispatcher->forward(
                [
                    'controller' => 'errors',
                    'action' => 'show401',
                ]
            );
            $this->session->destroy();

            return false;
        }
    }
}