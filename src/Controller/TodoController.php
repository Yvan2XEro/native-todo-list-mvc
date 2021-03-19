<?php

namespace App\Controller;

use App\Model\Todo;
use App\Utils\Dev\VarDumper;
use App\Utils\CustomTools\UrlTools;
use App\Utils\Navigation\SessionData;
use App\Kernel\Persistance\ResourceNotFoundException;

class TodoController extends Controller{

    public function allTodos()
    {
        $this->authFireWall();
        return $this->render("alltodos", $this->entityManager->findAll('todo'));
    }
    
    public function showTodo(int $id)
    {
        $this->authFireWall();
        $todos= $this->entityManager->findBy('todo', ['id'=>$id]);
        if(isset($todos[0]))
            return $this->render("showtodo", $todos[0]);
        
        return $this->render("error", ["message"=>"Resource todo with id $id dos not exists!"], 404);
    }

    public function add()
    {
        $this->authFireWall();
        $todo = new Todo();
        SessionData::addValueInPost('userId', SessionData::getUserData('id'));
        $this->entityManager->add('todo', $todo->hydrate($_POST)->normalize());
        return $this->redirect('/todos');
    }

    public function updateTodo(int $id)
    {
        $this->authFireWall();
        $todo = new Todo();
        $todo->hydrate($_POST);
        if(!array_key_exists('statut',$_POST))
            $todo->setStatut(Todo::UNFINISHED);
        try{
            $todo = $todo->normalize(true);

            // TODO: gerer la modification de createdAt
            unset($todo['createdAt']);
            $this->entityManager->update('todo', $todo, ['id'=>$id]);
            return $this->showtodo($id);
        }catch(ResourceNotFoundException $e){
            return $this->render("error", ["message"=>"Resource todo with id $id dos not exists!"], 404);
        }
    }

    public function delete(int $id)
    {
        $this->authFireWall();
        if (
        $this->entityManager->delete('todo', ['id'=>$id]))
        return $this->redirect('/todos');
    }

    public function setStatut(int $id)
    {
        $this->authFireWall();
        $todo = $this->entityManager->findBy('todo', ['id'=>$id])[0];
        $todo->toggleStatut();
        $this->entityManager->update('todo', $todo->normalize(), ['id'=>$id]);
        return $this->redirect('/todos');
    }
}