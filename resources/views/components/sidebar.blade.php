<!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ Route('dashboard') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>

                  <li><a><i class="fa fa-tasks"></i> Datas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ Route('participants') }}">Participants</a></li>
                      <li><a href="projects.html">Projects</a></li>
                    </ul>
                  </li>

                  @php
                    $user = Auth::user();
                    if($user['role_id'] == 1) {
                      // user yang login memiliki role admin
                      echo '<li><a href="' . route('user.index') . '"><i class="fa fa-users '.(request()->is('user') ? 'active' : '').'"></i> User Accounts</a></li>';
                    }
                  @endphp
                  
                  {{-- <li><a href="{{ Route('user.index') }}"><i class="fa fa-users {{ (request()->is('user')) ? 'active' : '' }}"></i> User Accounts</a></li>' --}}
                  
                  
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->