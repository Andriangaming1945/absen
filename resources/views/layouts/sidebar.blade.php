<nav id="sidebar" class="col-lg-2 d-lg-block d-none sidebar py-2" style="height: fit-content;">
    <img src="/assets/images/telkomschool.png" class="img-fluid" alt="">
    <div class="position-sticky bg-white mt-3 shadow-sm">
        <ul class="navbar-nav ps-3 flex-column">
            @can('get-user')
                <li class="nav-item">
                    <a class="nav-link" href="/user-managements"><i class="fa-solid fa-users" style="width: 20px"></i> <span
                            class="ms-2">User</span></a>
                </li>
            @endcan
            @can('get-role')
                <li class="nav-item">
                    <a class="nav-link" href="/role-managements"><i class="fa-solid fa-handshake"
                            style="width: 20px"></i><span class="ms-2">Role</span></a>
                </li>
            @endcan
            @can('get-permission')
                <li class="nav-item">
                    <a class="nav-link" href="/permission-managements"><i class="fa-solid fa-passport"
                            style="width: 20px"></i><span class="ms-2">Permission</span></a>
                </li>
            @endcan
            @can('get-classroom')
                <li class="nav-item">
                    <a class="nav-link" href="/classrooms"><i class="fa-solid fa-people-roof" style="width: 20px"></i><span
                            class="ms-2">Classroom</span></a>
                </li>
            @endcan
            @can('get-information-permit')
                <li class="nav-item">
                    <a class="nav-link" href="/information-permits"><i class="fa-regular fa-file-lines"
                            style="width: 20px"></i></i><span class="ms-2">Information Perizinan</span></a>
                </li>
            @endcan
            @can('get-presence')
            <li class="nav-item">
                <a class="nav-link" href="/presences"><i class="fa-regular fa-file-word" style="width: 20px"></i> <span class="ms-2">Presence</span></a>
            </li>
            @endcan
            @can('get-permit')
            <li class="nav-item">
                <a class="nav-link" href="/permits"><i class="fa-regular fa-file-word" style="width: 20px"></i> <span class="ms-2">Perizinan</span></a>
            </li>
            @endcan
            @can('get-task')
            <li class="nav-item">
                <a class="nav-link" href="/tasks"><i class="fa-regular fa-file-word" style="width: 20px"></i> <span class="ms-2">Task</span></a>
            </li>
            @endcan
        </ul>
    </div>
</nav>
