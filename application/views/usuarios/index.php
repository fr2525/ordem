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
            <strong><i class="fas fa-smile-wink"></i>&nbsp&nbsp<?php echo $message ?></strong>
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

          <div class="alert alert-warning alert-dismissible fade show" role="alert">
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
      <div class="card-header py-3">
        <a title="Cadastrar novo usuário" href="<?php echo base_url('usuarios/add') ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-user-plus"></i>&nbspNovo </a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Usuario</th>
                <th>Login</th>
                <th>Perfil</th>
                <th>Ativo</th>
                <th class="text-right no-sort">Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                  <td><?php echo $usuario->id ?></td>
                  <td><?php echo $usuario->username ?></td>
                  <td><?php echo $usuario->email ?></td>
                  <td><?php echo ($this->ion_auth->is_admin($usuario->id) ? 'Administrador' : 'Vendedor'); ?></td>
                  <td>
                    <?php echo ($usuario->active == 1 ? '<span class="badge text-bg-primary btn-sm">Sim</span>' : '<span class="badge text-bg-warning btn-sm">Não</span>' ); 
                     ?>
                  </td>
                  <td class="text-right">
                    <a title="Editar" href="<?php echo base_url('usuarios/edit/' . $usuario->id) ?>" class="btn btn-primary"><i class="fas fa-user-edit"></i></a>
                    <a title="Excluir" href="" class="btn btn-danger"><i class="fas fa-user-times"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>



  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->