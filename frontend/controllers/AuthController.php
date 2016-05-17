<?php
/**
 * Created by PhpStorm.
 * User: Виктор Сидоренко
 * Date: 15.05.2016
 * Time: 9:08
 */

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use frontend\rbac\AuthorRule;

class AuthController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // Reset all
        $auth->removeAll();

        // add "createReservation" permission
        $permCreateReservation = $auth->createPermission('createReservation');
        $permCreateReservation->description = 'Create a reservation';
        $auth->add($permCreateReservation);

        // add "updatePost" permission
        $permUpdateReservation = $auth->createPermission('updateReservation');
        $permUpdateReservation->description = 'Update reservation';
        $auth->add($permUpdateReservation);

        // add "operator" role and give this role the "createReservation" permission
        $roleOperator = $auth->createRole('operator');
        $auth->add($roleOperator);
        $auth->addChild($roleOperator, $permCreateReservation);

        // add "admin" role and give this role the "reservation" permission
        // as well as the permissions of the "operator" role
        $roleAdmin = $auth->createRole('admin');
        $auth->add($roleAdmin);
        $auth->addChild($roleAdmin, $permUpdateReservation);
        $auth->addChild($roleAdmin, $roleOperator);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($roleOperator, 2);
        $auth->assign($roleAdmin, 1);
    }
    public function actionUor(){
        $auth = Yii::$app->authManager;

// add the rule
        $rule = new AuthorRule;
        $auth->add($rule);

// add the "updateOwnPost" permission and associate the rule with it.
        $updateOwnReservation = $auth->createPermission('updateOwnReservation');
        $updateOwnReservation->description = 'Update own reservation';
        $updateOwnReservation->ruleName = $rule->name;
        $auth->add($updateOwnReservation);
$updateReservation = $auth->getPermission('updateReservation');
// "updateOwnPost" will be used from "updatePost"
        $auth->addChild($updateOwnReservation, $updateReservation);
$author = $auth->getRole('operator');
// allow "author" to update their own posts
        $auth->addChild($author, $updateOwnReservation);
    }
}