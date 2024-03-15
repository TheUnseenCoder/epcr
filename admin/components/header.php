<style>
  .app-header{
    background-color: #ffa351;
  }
</style>

<!--  Header Start -->
<header class="app-header">
  <nav class="navbar navbar-expand-lg navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item d-block d-xl-none">
        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
          <i class="fa-solid fa-bars" style="color: #FFF;"></i>
        </a>
      </li>
    </ul>
    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
      <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

        <div class="btn-group">
        <a href="../index.php" class="btn btn-success mx-3 mt-2 d-block"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up">
            <li>
              <button class="d-flex align-items-center gap-2 dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#update-modal">
              <i class="fa-solid fa-gear"></i>
                <p class="mb-0 fs-3">Change System Logo</p>
              </button>
            </li>
            <li>
              <a href="../index.php" class="btn btn-outline-primary mx-3 mt-2 d-block"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </li>
          </ul>
        </div>
      </ul>
    </div>
  </nav>
</header>