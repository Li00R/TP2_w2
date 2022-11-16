<?php
require_once './app/models/champs.Model.php';
require_once './app/views/api.view.php';
require_once 'app/helpers/auth.api.helper.php';

class ChampsApiController {
    private $model;
    private $view;
    private $authHelper;
    private $data;

    public function __construct() {
        $this->model = new ChampsModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getChamps($params = null) { //se podria agregar variable de limit
        $config = new stdClass();
        if (isset($_GET['sort'])) {
            $config->sort = $_GET['sortBy'];
        } else {
            $config->sort = "ID_champ";
        }
        if (isset($_GET['order'])) {
            $config->order = $_GET['order'];
        } else {
            $config->order = "ASC";
        }
        if (isset($_GET['filter'])) {
            $config->filter = $_GET['filter'];
        } else {
            $config->filter = "";
        }
        if (isset($_GET['page'])) {
            $aux = (int) $_GET['page']; // para comprobar que lo que se ingrega sea unicamente integer
            $aux = (string) $aux;
            if ($_GET['page'] > 0 && $aux == $_GET['page'])  {
                $config->page = $_GET['page'] * 10 - 10; //para acomodar el paginado con limite de 10
            } else {
                $config->page = "1.1"; //por si pone algo que no sea int, esto es lo mismo, el modelo va a tener error y se devolvera 400
            }
        } else {
            $config->page = "0";
        }
        $champs = $this->model->getItems($config);
        if (isset($champs)) {
            $this->view->response($champs);
        } else {
            $this->view->response("Ha ocurrido un error, revisa los datos ingresados", 400);
        }
    }

    public function getChamp($params = null) {
        $id = $params[':ID'];
        $champ = $this->model->get($id);
        if ($champ)
            $this->view->response($champ);
        else 
            $this->view->response("El champ con el ID=$id no existe", 404);
    }

    public function addChamp() {
        if(!$this->authHelper->isLogged()){
            $this->view->response("No estas logeado", 401);
            return;
        }
        // Se usa id y no nombre o similar porque desde el trabajo anterior se estaba usando
        // de esta forma, ya que no se tenia otro valor unico, por lo tanto es indistinto a la hora 
        //de entender el funcionamiento y la funcionalidad del mismo
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
        if(!$this->authHelper->isLogged()){
            $this->view->response("No estas logeado", 401);
            return;
        }
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
        if(!$this->authHelper->isLogged()){
            $this->view->response("No estas logeado", 401);
            return;
        }
        $id = $params[':ID'];
        if (empty($id)) {
            $this->view->response("No se ha seleccionado que borrar", 400);
        }  else {
            $champ = $this->model->get($id);
            if ($champ) {
                $this->model->delete($id);
                if (!$this->model->get($id)) {
                    $this->view->response("El campeon se borro correctamente");
                }
            } else {
                $this->view->response("La tarea con el id=$id no existe", 404);
            }
        }
    }

    public function badURL() {
        $this->view->response("Peticion incorrecta", 404);
    }
}