<?php $this->load->view('layout/sidebar'); ?>



<!-- Main Content -->
<div id="content">

  <?php $this->load->view('layout/navbar'); ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url("/"); ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
      </ol>
    </nav>

    
    <?php if ($message = $this->session->flashdata('sucesso')): ?>
      <div class="row">
        <div class="col-md-12">

          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="far fa-smile-wink"></i>&nbsp&nbsp<?php echo $message ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>

    <?php endif; ?>
    
    <?php if ($message = $this->session->flashdata('error')): ?>
      <div class="row">
        <div class="col-md-12">

          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-exclamation-triangle"></i>&nbsp&nbsp<?php echo $message ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>

    <?php endif; ?>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">

        <form method="POST" name="form_edit">

          <div class="form-group row">

            <div class="col-md-3">
              <label>Razao Social</label>
              <input type="text" class="form-control" name="sistema_razao_social" placeholder="Razao social" value="<?php echo $sistema->sistema_razao_social; ?>">
              <?php echo form_error('sistema_razao_social', '<small class="form-text text-danger">', '</small>'); ?>
            </div>

            <div class="col-md-3">
              <label>Nome Fantasia</label>
              <input type="text" class="form-control" name="sistema_nome_fantasia" placeholder="Nome Fantasia" value="<?php echo $sistema->sistema_nome_fantasia; ?>">
              <?php echo form_error('sistema_nome_fantasia', '<small class="form-text text-danger">', '</small>'); ?>
            </div>

            <div class="col-md-3">
              <label>CNPJ</label>
              <input type="text" class="form-control cnpj" name="sistema_cnpj" placeholder="CNPJ" value="<?php echo $sistema->sistema_cnpj; ?>">
              <?php echo form_error('sistema_cnpj', '<small class="form-text text-danger">', '</small>'); ?>
            </div>

            <div class="col-md-3">
              <label>Insc.Estadual</label>
              <input type="text" class="form-control" name="sistema_ie" placeholder="I.E." value="<?php echo $sistema->sistema_ie; ?>">
              <?php echo form_error('sistema_ie', '<small class="form-text text-danger">', '</small>'); ?>
            </div>

          </div>

          <div class="form-group row">

            <div class="col-md-3">
              <label>Telefone Fixo</label>
              <input type="text" class="form-control phone_with_ddd" name="sistema_telefone_fixo" placeholder="Telefone Fixo" value="<?php echo $sistema->sistema_telefone_fixo; ?>">
              <?php echo form_error('sistema_telefone_fixo', '<small class="form-text text-danger">', '</small>'); ?>
            </div>

            <div class="col-md-3">
              <label>Telefone Celular</label>
              <input type="text" class="form-control sp_celphones" name="sistema_telefone_movel" placeholder="Telefone Celular" value="<?php echo $sistema->sistema_telefone_movel; ?>">
              <?php echo form_error('sistema_telefone_movel', '<small class="form-text text-danger">', '</small>'); ?>
            </div>

            <div class="col-md-3">
              <label>Site</label>
              <input type="text" class="form-control" name="sistema_site_url" placeholder="Url do site" value="<?php echo $sistema->sistema_site_url; ?>">
              <?php echo form_error('sistema_site_url', '<small class="form-text text-danger">', '</small>'); ?>
            </div>

            <div class="col-md-3">
              <label>E-mail</label>
              <input type="text" class="form-control" name="sistema_email" placeholder="e-mail" value="<?php echo $sistema->sistema_email; ?>">
              <?php echo form_error('sistema_email', '<small class="form-text text-danger">', '</small>'); ?>
            </div>

          </div>
          <div class="form-group row">

            <div class="col-md-12">
              <label>Texto da ordem de serviço e venda</label>
              <textarea class="form-control" name="sistema_txt_ordem_servico" 
                  placeholder="Texto da ordem de serviço e venda"><?php echo $sistema->sistema_txt_ordem_servico; ?></textarea>
              <?php echo form_error('sistema_txt_ordem_servico', '<small class="form-text text-danger">', '</small>'); ?>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
        </form>

      </div>
    </div>



  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->