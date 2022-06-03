<?php

namespace App\Controllers;

use App\Models\TodosModel;

class Todos extends BaseController
{
    public function __construct()
    {
      $this->todosModel = new TodosModel();
    }

    public function index()
    {
      $data = [
        'title' => 'Todos',
    ];

    return view('todos/home', $data);
    }

    public function historyTodo()
    {
      $data = [
        'title' => 'Todos Todo',
    ];

    return view('todos/history', $data);
    }

    public function getTodosByStatus(){
      $status = $this->request->getVar('status');
      $todosActive = $this->todosModel->getTodos($status);

      echo json_encode($todosActive);
    }

    public function saveToDo(){

      $this->todosModel->save([
        'listname' => $this->request->getVar('entryTodo'),
        'status' => 'Active'
      ]);
      echo json_encode([
        'status' => 200,
        'message' => 'Data berhasil disimpan'
      ]);
    }

    public function finishToDo($id){

      $this->todosModel->save([
        'id' => $id,
        'status' => 'Inactive'
      ]);
      echo json_encode([
        'status' => 200,
        'message' => 'Todo diselesaikan'
      ]);
      // return redirect()->to('/');
    }

    public function unFinishToDo($id){

      $this->todosModel->save([
        'id' => $id,
        'status' => 'Active'
      ]);
      echo json_encode([
        'status' => 200,
        'message' => 'Todo dikembalikan ke task'
      ]);
      // return redirect()->to('/');
    }

    public function deleteToDo($id){
      $this->todosModel->delete($id);
      echo json_encode([
        'status' => 200,
        'message' => 'Data berhasil dihapus'
      ]);
      // return redirect()->to('/');
    }
}
