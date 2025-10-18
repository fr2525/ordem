<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();

    }
    public function index() {

        $data = array(

            'titulo' => 'Usuários',

            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'usuarios' =>  $this->ion_auth->users()->result(),
        );

       // echo '<pre>';
       // print_r($data['usuarios']);
       // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/index');
        $this->load->view('layout/footer');

    }

    public function edit($usuario_id = NULL) {

        if(!$usuario_id || !$this->ion_auth->user($usuario_id)->row()) {

            //exit('Usuário não encontrado');
            $this->session->set_flashdata('error','Usuário não encontrado');
            redirect('usuarios');

        } else {

/*
    [first_name] => Admin
    [last_name] => istrator
    [email] => admin@admin.com
    [username] => administrator
    [active] => 1
    [perfil_usuario] => 1
    [password] => 
    [password1] => 
    [usuario_id] => 1
*/

        $this->form_validation->set_rules('first_name','','trim|required');
        $this->form_validation->set_rules('last_name','','trim|required');
        $this->form_validation->set_rules('email','','trim|required|valid_email|callback_email_check[email]');
        $this->form_validation->set_rules('username','','trim|required');
        $this->form_validation->set_rules('password','Senha','min_length[4]|max_length[100]');
        $this->form_validation->set_rules('password1','Confirma','matches[password]');
        
        if($this->form_validation->run()) {

            exit('Validado');

        } else {

             $data = array (

                'titulo' => 'Editar usuário',
                'usuario' => $this->ion_auth->user($usuario_id)->row(),
                'perfil_usuario' =>  $this->ion_auth->get_users_groups($usuario_id)->row(),
            );



            $this->load->view('layout/header', $data);
            $this->load->view('usuarios/edit');
            $this->load->view('layout/footer');

        }
           
           
        }

    }

    public function email_check($email) {

        $usuario_id = $this->input->post('usuario_id');

        if ($this->core_model->get_by_id('users',array('email = ' => $email , 'id != ' => $usuario_id))) {

            $this->form_validation->set_message('email_check','email ja existente.');

            return FALSE;

        } else {

            return TRUE;

        }
        
    }

}