<?php

defined('BASEPATH') or exit('Ação não permitida');

class Sistema extends CI_Controller
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
            'titulo' => 'Editar informações do sistema',

            'scripts' => array (
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
            'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
        );
       
        $this->form_validation->set_rules('sistema_razao_social', 'Razão Social', 'required|min_length[5]|max_length[145]');
        $this->form_validation->set_rules('sistema_nome_fantasia', 'Nome fantasia', 'required|min_length[5]|max_length[145]');
        $this->form_validation->set_rules('sistema_cnpj', 'CNPJ', 'required|exact_length[18]');
        $this->form_validation->set_rules('sistema_ie', '', 'required|min_length[5]|max_length[20]');
        //$this->form_validation->set_rules('sistema_telefone_fixo','','required|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('sistema_telefone_movel', '', 'required|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('sistema_email', '', 'required|valid_email|max_length[100]');
        //$this->form_validation->set_rules('sistema_site_url','','required|valid_url|max_length[145]');
        //$this->form_validation->set_rules('sistema_txt_ordem_servico','','required|min_length[5]|max_length[145]');

        if ($this->form_validation->run()) {

            $data = elements(
                array(
                    'sistema_razao_social',
                    'sistema_nome_fantasia',
                    'sistema_cnpj',
                    'sistema_ie',
                    'sistema_telefone_fixo',
                    'sistema_telefone_movel',
                    'sistema_email',
                    'sistema_site_url',
                    'sistema_txt_ordem_servico',
                ),
                $this->input->post()
            );
            $data = html_escape($data);

            $this->core_model->update('sistema', $data, array('sistema_id' => 1));

            redirect('sistema');

        } else {

            // erro de validacao
        }

        $this->load->view('layout/header', $data);
        $this->load->view('sistema/index');
        $this->load->view('layout/footer');
    }
}
