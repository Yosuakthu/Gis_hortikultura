    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('assets/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">GisZNT</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
                 <li class="nav-item">
              <a href="{{route('dashboard-admin')}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/admin/data" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Pengguna
              </p>
            </a>
        </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('adpeta')}}" class="nav-link">
              <i class="nav-icon fas fa-map"></i>
              <p>
                Peta
              </p>
            </a>
        </li>
          <li class="nav-item has-treeview">
              <a href="{{ route('csv.table')}}" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Data CSV</i>
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="/" class="nav-link">
                    <i class="nav-icon fas fa-globe"></i>
                  <p>
                    Website
                  </p>
                </a>

            </li>
          <li class="nav-item has-treeview">
              <a href="#" id="logout-link" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  keluar
                </p>
              </a>
          </li>
        </ul>

        <script>
            document.getElementById('logout-link').addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah link default

                if (confirm('Apakah Anda yakin ingin logout?')) {
                // Membuat form sementara untuk logout
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/admin/logout';

                // Menambahkan token CSRF ke form
                var csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                // Menambahkan form ke body dan submit
                document.body.appendChild(form);
                form.submit();
                }
            });
        </script>


        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
