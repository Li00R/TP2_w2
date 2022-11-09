<?php
require_once './app/models/champs.Model.php';
require_once './app/views/api.view.php';

class ChampsApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new ChampsModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getChamps($params = null) {
        $champs = $this->model->getAll();
        $this->view->response($champs);
    }

    public function getChamp($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $champ = $this->model->get($id);

        // si no existe devuelvo 404
        if ($champ)
            $this->view->response($champ);
        else 
            $this->view->response("El champ con el id=$id no existe", 404);
    }

    public function addChamp($params = null) {
        $champ = $this->getData();

        if (empty($champ->Champ_name) || empty($champ->ID_rol) || empty($champ->Line_name)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->add($champ->Champ_name, $champ->ID_rol, $champ->Line_name);
            $champ = $this->model->get($id);
            $this->view->response($champ, 201);
        }
    }

    public function editChamp($params = null) {
        $champ = $this->getData();
        $id= $params[':ID'];
        if (empty($champ->Champ_name) || empty($champ->ID_rol) || empty($champ->Line_name)) {
            $this->view->response("Complete los datos", 400);
        } else {
            if ($this->model->get($id)) {
                $edited = $this->model->edit($champ->Champ_name, $champ->ID_rol, $champ->Line_name, $id);
                if (isset($edited)) {
                    $champ = $this->model->get($id);
                    $this->view->response($champ, 200);
                } else {
                    $this->view->response("Ha ocurrio un error, revisa los datos ingresados", 400);
                }
            } else {
                $this->view->response("El champ con el id=$id no existe", 404);
            }
        }
    }

    public function deleteChamp($params = null) {
        $id = $params[':ID'];
        if (empty($id)) {
            $this->view->response("No se ha seleccionado que borrar", 400);
        }  else {
            $champ = $this->model->get($id);
            if ($champ) {
                $this->model->delete($id);
                $this->view->response($champ);
            } else {
                $this->view->response("La tarea con el id=$id no existe", 404);
            }
        }
    }

    public function badURL() {
        $this->view->response("Peticion incorrecta", 404);
    }
}