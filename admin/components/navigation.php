<!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./home.php" class="text-nowrap logo-img">

            <div style="display: inline-block; vertical-align: middle;">
              <img src="../assets/images/logo.png" class="img-fluid">
            </div>
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="fa-solid fa-x"></i>
          </div>
        </div>

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">GENERAL</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./home.php" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-house"></i>
                </span>
                <span class="hide-menu">Home</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="./complaints.php?f=Sanitation" aria-expanded="false">
                <span class="d-flex">
                  <i class="fa-solid fa-clipboard-list"></i>
                </span>
                <span class="hide-menu">Complaints</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
              <li class="sidebar-item">
              <a class="sidebar-link" href="./complaints.php?f=Sanitation" aria-expanded="false">
                <span>
                </span>
                <span class="hide-menu">Sanitation</span>
              </a>
            </li>
                <li class="sidebar-item">
                <a class="sidebar-link" href="./complaints.php?f=Infrastructure" aria-expanded="false">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Infrastructure</span>
                  </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link" href="./complaints.php?f=Neighbor Concerns" aria-expanded="false">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Neighbor Concerns</span>
                  </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link" href="./complaints.php?f=Security" aria-expanded="false">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Security</span>
                  </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link" href="./complaints.php?f=Other Concern" aria-expanded="false">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
            
                    <span class="hide-menu">Other Concerns</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">REPORTS</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="./complaints-history.php?f=Sanitation" aria-expanded="false">
                <span class="d-flex">
                  <i class="fa-solid fa-file-lines"></i>
                </span>
                <span class="hide-menu">History of Complaints</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link" href="./complaints-history.php?f=Sanitation">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Sanitation</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="./complaints-history.php?f=Infrastructure" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Infrastructure</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="./complaints-history.php?f=Neighbor Concerns" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Neighbor Concerns</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="./complaints-history.php?f=Security" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Security</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="./complaints-history.php?f=Other Concern" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Other Concerns</span>
                  </a>
                </li>
              </ul>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="./decomplains.php?f=Sanitation" aria-expanded="false">
                <span class="d-flex">
                <i class="fa-solid fa-trash"></i>
                </span>
                <span class="hide-menu">Declined Complains</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link" href="./decomplains.php?f=Sanitation">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Sanitation</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="./decomplains.php?f=Infrastructure" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Infrastructure</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="./decomplains.php?f=Neighbor Concerns" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Neighbor Concerns</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="./decomplains.php?f=Security" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Security</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="./decomplains.php?f=Other Concern" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">Other Concerns</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./logs.php" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-users-viewfinder"></i>
                </span>
                <span class="hide-menu">Logs</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="./meetings.php" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-list-check"></i>
                </span>
                <span class="hide-menu">Meetings</span>
              </a>
            </li>

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Manage</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./residents.php" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-people-group"></i>
                </span>
                <span class="hide-menu">List of Residents</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./account.php" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-user-plus"></i>
                </span>
                <span class="hide-menu">Account</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./register-account.php" aria-expanded="false">
                <span>
                <i class="fa-solid fa-id-card"></i>
                </span>
                <span class="hide-menu">Registered Accounts</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./user-profile.php" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-clipboard-user"></i>
                </span>
                <span class="hide-menu">User Profile</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->