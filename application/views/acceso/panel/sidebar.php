<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  <!-- Navbar Brand-->
  <a class="navbar-brand ps-3" href="https://www.myonlineprinting.net/" target="_new">MyOnlineprinting</a>
  <!-- Sidebar Toggle-->
  <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
  <!-- Navbar Search-->
  <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    <div class="input-group">
      <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
      <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
    </div>
  </form>
  <!-- Navbar-->
  <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="<?php echo base_url() ?>admin/admin/change_password">Change Password</a></li>
        <li><a class="dropdown-item" href="<?php echo base_url() ?>admin/admin/site_setting">Site Setting</a></li>
        <li><a class="dropdown-item" href="<?php echo base_url() ?>admin/admin/change_account">Change Account Detail</a></li>
        <li>
          <hr class="dropdown-divider" />
        </li>
        <li><a class="dropdown-item" href="<?php echo base_url()  ?>admin/admin/logout">Logout</a></li>
      </ul>
    </li>
  </ul>
</nav>
<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <div class="sb-sidenav-menu-heading">Menu Principal</div>
          <a class="nav-link" href="<?php echo base_url()  ?>admin/admin/home">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Dashboard
          </a>
          <div class="sb-sidenav-menu-heading">Sistema</div>

          <!-- menus desplegables -->
          <!-- 1 -->
          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            Products
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link" href="<?php echo base_url(); ?>admin/products/manage_products">Productos</a>
              <a class="nav-link" href="<?php echo base_url(); ?>admin/sub_products/manage_subproducts">SubProductos</a>
              <a class="nav-link" href="<?php echo base_url(); ?>admin/attributes/manage_attributes">Atributos</a>
              <a class="nav-link" href="<?php echo base_url(); ?>admin/assign_attributes">Asignar Atributos</a>
              <a class="nav-link" href="<?php echo base_url(); ?>admin/pricing/manage_price">Asignar Precio</a>
              <a class="nav-link" href="<?php echo base_url(); ?>admin/values/manage_values">Valores de Atributos</a>

            </nav>
          </div>
          <!-- 3 -->
          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePagesGeneral" aria-expanded="false" aria-controls="collapsePagesGeneral">
            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
            General
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="collapsePagesGeneral" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
              <a class="nav-link" href="<?php echo base_url() ?>admin/slider">Sliders</a>
              <a class="nav-link" href="<?php echo base_url() ?>admin/pages">Pages</a>
              <a class="nav-link" href="<?php echo base_url() ?>admin/users">Users</a>
              <a class="nav-link" href="<?php echo base_url() ?>admin/common/manage_quantities">Quantities</a>
              <a class="nav-link" href="<?php echo base_url() ?>admin/common/manage_sizes">Sizes</a>
            </nav>
          </div>
          <!-- 3 -->
          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePagesSidebar" aria-expanded="false" aria-controls="collapsePagesSidebar">
            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
            Manage Sidebar
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="collapsePagesSidebar" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
              <a class="nav-link" href="<?php echo base_url() ?>admin/right_sidebar/edit_sidebar/1">Sidebar 01</a>
              <a class="nav-link" href="<?php echo base_url() ?>admin/right_sidebar/edit_sidebar/2">Sidebar 02</a>
              <a class="nav-link" href="<?php echo base_url() ?>admin/right_sidebar/edit_sidebar/3">Sidebar 03</a>
            </nav>
          </div>


          <div class="sb-sidenav-menu-heading">Addons</div>
          <a class="nav-link" href="<?php echo base_url(); ?>admin/copyservice/change_contact_address">
            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
            Contact Us Page
          </a>
          <a class="nav-link" href="<?php echo base_url(); ?>admin/copyservice/list_contact_us">
            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
            Contact Us List
          </a>
          <a class="nav-link" href="<?php echo base_url(); ?>admin/order">
            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
            Orders
          </a>
        </div>
      </div>
      <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        Admin
      </div>
    </nav>
  </div>
  <div id="layoutSidenav_content">