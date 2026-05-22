<?php

defined('BASEPATH') or exit('Ação não permitida');

class Clientes extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
        }
    }
    public function index()
    {

        $data = array(

            'titulo' => 'Clientes cadastrados',

            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'clientes' =>  $this->core_model->get_all('clientes'),
        );

        // echo '<pre>';
        // print_r($data['usuarios']);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('clientes/index');
        $this->load->view('layout/footer');
    }

    public function edit($cliente_id = NULL)
    {

        if (!$cliente_id || !$this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id))) {
            $this->session->set_flashdata('error', 'cliente não encontrado');
            redirect('clientes');
        } else {

            $this->form_validation->set_rules('cliente_nome', '', 'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('cliente_sobrenome', '', 'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('cliente_data_nascimento', '', 'required');
            $this->form_validation->set_rules('cliente_cpf_cnpj', '', 'trim|required|exact_length[18]');
            $this->form_validation->set_rules('cliente_rg_ie', '', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('cliente_email', '', 'trim|required|valid_email|max_length[50]');
            $this->form_validation->set_rules('cliente_telefone', '', 'trim|max_length[14]');
            $this->form_validation->set_rules('cliente_celular', '', 'trim|max_length[15]');
            $this->form_validation->set_rules('cliente_cep', '', 'trim|required|exact_length[9]');
            $this->form_validation->set_rules('cliente_endereco', '', 'trim|required|min_length[3]|max_length[155]');
            $this->form_validation->set_rules('cliente_numero_endereco', '', 'trim|max_length[20]');
            $this->form_validation->set_rules('cliente_bairro', '', 'trim|max_length[45]');
            $this->form_validation->set_rules('cliente_complemento', '', 'trim|max_length[150]');
            $this->form_validation->set_rules('cliente_cidade', '', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('cliente_estado', '', 'trim|required|max_length[2]');
            $this->form_validation->set_rules('cliente_obs', '', 'trim|max_length[500]');

            if ($this->form_validation->run()) {
                echo '<pre>';
                print_r($this->input->post());
                exit();
            } else {

                $data = array(

                    'titulo' => 'Atualizar Cliente',

                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                    ),
                    'cliente' => $this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id)),
                );

 //               echo '<pre>';
 //               print_r($data['cliente']);
 //               exit();
                $this->load->view('layout/header', $data);
                $this->load->view('clientes/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function add()
    {
        $this->form_validation->set_rules('first_name', '', 'trim|required');
        $this->form_validation->set_rules('last_name', '', 'trim|required');
        $this->form_validation->set_rules('email', '', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('username', '', 'trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Senha', 'required|min_length[5]|max_length[255]');
        $this->form_validation->set_rules('confirm_password', 'Confirme', 'matches[password]');

        if ($this->form_validation->run()) {

            $username = $this->security->xss_clean($this->input->post('username'));
            $password = $this->security->xss_clean($this->input->post('password'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'username' =>  $this->input->post('username'),
                'active' => $this->input->post('active'),
            );
            $group = array($this->input->post('perfil_usuario')); // Sets user to admin.

            $additional_data = $this->security->xss_clean($additional_data);

            $group =  $this->security->xss_clean($group);

            if ($this->ion_auth->register($username, $password, $email, $additional_data, $group)) {

                $this->session->set_flashdata('sucess', 'Dados salvos com sucesso');
            } else {
                $this->session->set_flashdata('error', 'Dados não foram salvos');
            };

            redirect('usuarios');
        } else {

            // erro de validacao

            $data = array(
                'titulo' => 'Cadastrar usuário',

            );

            $this->load->view('layout/header', $data);
            $this->load->view('usuarios/add');
            $this->load->view('layout/footer');
        }
    }


    public function del($usuario_id = NULL)
    {

        if (!$usuario_id || !$this->ion_auth->user($usuario_id)->row()) {
            $this->session->set_flashdata('error', 'usuario não encontrado');
            redirect('usuarios');
        }
        if ($this->ion_auth->is_admin($usuario_id)) {

            $this->session->set_flashdata('error', 'usuario é administrador');
            redirect('usuarios');
        }
        if ($this->ion_auth->delete_user($usuario_id)) {
            $this->session->set_flashdata('sucesso', 'usuario excluido com sucesso');
            redirect('usuarios');
        } else {
            $this->session->set_flashdata('error', 'usuario é administrador');
            redirect('usuarios');
        }
    }

    public function email_check($email)
    {

        $usuario_id = $this->input->post('usuario_id');

        if ($this->core_model->get_by_id('users', array('email' => $email, 'id != ' => $usuario_id))) {

            $this->form_validation->set_message('email_check', 'email ja existente.');

            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function username_check($username)
    {

        $usuario_id = $this->input->post('usuario_id');

        if ($this->core_model->get_by_id('users', array('username' => $username, 'id != ' => $usuario_id))) {

            $this->form_validation->set_message('username_check', 'Esse usuario ja existe.');

            return FALSE;
        } else {

            return TRUE;
        }
    }
}
