<!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ Route('dashboard') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>

                  <li><a><i class="fa fa-tasks"></i> Datas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ Route('participants') }}">Participants</a></li>
                      @php
                      $user = Auth::user();
                      if($user['role_id'] != 3) {
                        // user yang login memiliki role admin
                        echo '<li><a href="' . route('kelompok'). '">Kelompok</a></li>';
                      }
                    @endphp
                      {{-- <li><a href="{{ Route('kelompok') }}">Kelompok</a></li> --}}
                    </ul>
                  </li>

                  @php
                    $user = Auth::user();
                    if($user['role_id'] != 3) {
                      // user yang login memiliki role admin
                      echo '<li><a href="' . route('user.index') . '"><i class="fa fa-users '.(request()->is('user') ? 'active' : '').'"></i> User Accounts</a></li>';
                    }
                  @endphp
                  
                  {{-- <li><a href="{{ Route('user.index') }}"><i class="fa fa-users {{ (request()->is('user')) ? 'active' : '' }}"></i> User Accounts</a></li>' --}}
                  
                  
                </ul>
              </div>

              <div class="menu_section">
                <h3>Private</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ Route('profil') }}"><i class="fa fa-user"></i> Profil</a></li>
                  <li><a href="{{ route('auth.logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->