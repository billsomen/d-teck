<?php

namespace ApiBundle\Controller;

use CoreBundle\Entity\User;
use Doctrine\ORM\Mapping\Id;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends FOSRestController
{
  /**
   * findById
   *
   * @param string $id
   * @return User
   * @throws NotFoundHttpException
   */
  private function findById($id) {
//    Finds the user by the provided id
    $user = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository("CoreBundle:User")
      ->findOneBy(
        array(
          'id' => $id
        )
      );

    return $user;
  }
  /**
   * findAll
   * @return [User]
   * @throws NotFoundHttpException
   */
  private function findAll() {
//    Get all the users
    $users = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository("CoreBundle:User")
      ->findAll();

    return $users;
  }

  /**
   * validateAndPersist
   *
   * @param User $user
   * @param Boolean $delete
   * @return View the view
   */
  private function validateAndPersist(User $user, $delete = false) {
//    Get the view
    $template = "CoreBundle:User:api.html.twig";

    $validator = $this->get('validator');
    $errors_list = $validator->validate($user);

    if (count($errors_list) == 0) {

      $em = $this->getDoctrine()->getManager();

      if ($delete === true) {
        $em->remove($user);
      } else {
        $em->persist($user);
      }

      $em->flush();

      $view = $this->view($user)
        ->setTemplateVar('user')
        ->setTemplate($template);
    } else {

      $errors = "";
      foreach ($errors_list as $error) {
        $errors .= (string) $error->getMessage();
      }

      $view = $this->view($errors)
        ->setTemplateVar('errors')
        ->setTemplate($template);

    }

    return $view;
  }


  /**
   * viewOne
   *
   * @param User $user
   * @return View the view
   */
  private function viewOne(User $user) {
//    View only the user without any validation
    $template = "CoreBundle:User:api.html.twig";
    $view = $this->view($user)
      ->setTemplateVar('user')
      ->setTemplate($template);

    return $view;
  }

  /**
   * viewMany
   * @param $users
   * @return View the view
   */
  private function viewMany($users) {
//    View Many users without any validation
    $template = "CoreBundle:User:api.html.twig";
    $view = $this->view($users)
      ->setTemplateVar('users')
      ->setTemplate($template);

    return $view;
  }

  /**
   * newAction
   *
   * "new_user" [POST] /api/users/new/[name]
   *
   * @Rest\Post("/api/users/new/{name}")
   *
   * @param Request $request
   * @param string $name The name of the user
   * @return String
   */
  public function newAction(Request $request, $name)
  {
    $user = new User($name);
//    $user->setName($request->get('name'));

    $view = $this->validateAndPersist($user);

    return $this->handleView($view);
  }

  /**
   * getAction
   *
   * "get_one_users" [GET] /api/users/[id]
   *
   * @Rest\Get("/api/users/{id}")
   *
   * @param Request $request
   * @param string $id The id of the user
   * @return String
   */
  public function getAction(Request $request, $id)
  {
//    get one user
    $user = $this->findById($id);
    if (! $user) {
      $view = $this->view("No user for this id:". $id, 404);
      return $this->handleView($view);
    }
    $view = $this->viewOne($user);

    return $this->handleView($view);
  }

  /**
   * getAllAction
   *
   * "get_all_users" [GET] /api/users
   *
   * @Rest\Get("/api/users")
   *
   * @param Request $request
   * @return String
   */
  public function getAllAction(Request $request)
  {
//    return all the users
    $users = $this->findAll();
    $view = $this->viewMany($users);

    return $this->handleView($view);
  }

  /**
   * deleteAction
   *
   * "delete_user" [DELETE] /api/users/[id]
   *
   * @Rest\Delete("/api/users/{id}")
   *
   * @param Request $request
   * @param string $id The id of the user
   * @return String
   */
  public function deleteAction(Request $request, $id)
  {
    $user = $this->findById($id);
    if (! $user) {
      $view = $this->view("No user for this id:". $id, 404);
      return $this->handleView($view);
    }

//    We provide de delete parameter
    $view = $this->validateAndPersist($user, true);

    return $this->handleView($view);
  }

  /**
   * editAction
   *
   * "edit_user" [PUT] /user/[id]?name=new_name
   *
   * @Rest\Put("/api/users/edit/{id}")
   *
   * @param Request $request
   * @param string $id
   * @return string
   */
  public function editAction(Request $request, $id) {
//    Update the user (his name only for now, but the template may handle any updates) with the id : $id
    $user = $this->findById($id);

    if (! $user) {
      $view = $this->view("No user for this id:". $id, 404);
      return $this->handleView($view);
    }
//  We get the name value param
    $name = $request->query->get("name");
    if(empty($name)){
      $view = $this->view("No name parameter provided for this user:". $id, 400);
      return $this->handleView($view);
    }
    $user->setName($name);

//    We validate and persist the user
    $view = $this->validateAndPersist($user);

    return $this->handleView($view);
  }
}
