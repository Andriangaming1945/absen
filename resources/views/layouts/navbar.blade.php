<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid mx-3">
      <a class="navbar-brand" href="/">
        <img src="/assets/images/logo-telkom.png" class="img-fluid" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-lg-none">
          <li class="nav-item">
            <a class="nav-link" href="/user-managements">User Management</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/role-managements">Role Management</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/permission-managements">Permission Management</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/classrooms">Classroom</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/status-permits">Status Permit</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/information-permits">Information Permit</a>
          </li>
        </ul>
    </div>
    <div class="d-none d-lg-block">
        <ul class="navbar-nav ">
            <li class="nav-item">
                <div class="dropdown">
                  <button class="bg-white border-0 dropdown-toggle d-flex align-items-center gap-2" style="margin-right: 50px" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>{{ Auth::user()->name }}</span> <i class="fa-solid fa-circle-user fs-3"></i>
                  </button>
                  <ul class="dropdown-menu bg-white" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="/setting">Setting</a></li>
                    <li><a class="dropdown-item" href="/change-password">Change Password</a></li>
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button class="dropdown-item">Logout</button>
                        </form>
                    </li>
                  </ul>
                </div>
            </li>
          </ul>
    </div>
    </div>
  </nav>
