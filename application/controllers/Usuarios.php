<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
    
    public function __construct() {
        return parent::__construct();
    }

    public function index() {

      $data = array(

          'titulo' => 'Usuarios do sistema',

          'styles' => array(
              'vendor/datatables/dataTables.bootstrap4.min.css'
          ),
          'scripts' => array(
            'vendor/datatables/jquery.dataTables.min.js',
            'vendor/datatables/dataTables.bootstrap4.min.js',
            'vendor/datatables/app.js',
        ),
          'usuarios' => $this->ion_auth->users()->result(),
      );

//      echo '<pre>';
//     print_r ($data['usuarios']);
//     exit();

      $this->load->view('layout/header', $data);
      $this->load->view('usuarios/index');
      $this->load->view('layout/footer');

    }

    public function edit($user_id = NULL) {

        if (!$user_id || !$this->ion_auth->user($user_id)->row()) {

            exit('Usuário não encontrato');
        } else {
            $data = array(
                'titulo' => 'Editar Usuário',
                'usuario' => $this->ion_auth->user($user_id)->row(),
            );

            echo '<pre>';
            print_r ($data['usuario']);
            exit();
                   
            $this->load->view('layout/header', $data);
            $this->load->view('usuarios/edit');
            $this->load->view('layout/footer');
        }

    }
}

