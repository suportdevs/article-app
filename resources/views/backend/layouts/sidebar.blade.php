<?php
  $urlPrefix = app()->master->urlPrefix;
  // dd(app());
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route(app()->master->routePrefix . 'dashboard') }}">
                <span class="icon-bg"><i class="icon-home menu-icon"></i></span>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            @can("articles_permission_module")
            <li class="nav-item {{ request()->is($urlPrefix . '/tags*') || request()->is($urlPrefix . '/category*') || request()->is($urlPrefix . '/post*') ? ' active' : '' }}">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-articles" aria-expanded="{{ request()->is($urlPrefix . '/tags*') || request()->is($urlPrefix . '/category*') || request()->is($urlPrefix . '/post*') ? 'true' : 'false' }}" aria-controls="ui-articles">
                <span class="icon-bg"><i class="icon-docs menu-icon"></i></span>
                <span class="menu-title">Artcles</span>
                <i class="menu-arrow"></i>
              </a> 
              <div class="collapse {{ request()->is($urlPrefix . '/tags*') || request()->is($urlPrefix . '/category*') || request()->is($urlPrefix . '/post*') ? ' show' : '' }}" id="ui-articles">
                <ul class="nav flex-column sub-menu">
                  @can("tag_list")
                  <li class="nav-item"> <a class="nav-link {{ request()->is($urlPrefix . '/tags*') ? ' active' : '' }}" href="{{ route(app()->master->routePrefix . 'tags.index') }}"><span class="icon-tag line-icon"></span> Tags</a></li>
                  @endcan
                  @can("category_list")
                  <li class="nav-item"> <a class="nav-link {{ request()->is($urlPrefix . '/category*') ? ' active' : '' }}" href="{{ route(app()->master->routePrefix . 'category.index') }}"><span class="icon-organization line-icon"></span> Category</a></li>
                  @endcan
                  @can("post_list")
                  <li class="nav-item"> <a class="nav-link {{ request()->is($urlPrefix . '/post*') ? ' active' : '' }}" href="{{ route(app()->master->routePrefix . 'post.index') }}"><span class="icon-doc line-icon"></span> Posts</a></li>
                  @endcan
                </ul>
              </div>
            </li>
            @endcan
            <li class="nav-item {{ request()->is($urlPrefix . '/tags*') || request()->is($urlPrefix . '/category*') || request()->is($urlPrefix . '/post*') ? ' active' : '' }}">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-users" aria-expanded="{{ request()->is($urlPrefix . '/tags*') || request()->is($urlPrefix . '/category*') || request()->is($urlPrefix . '/post*') ? 'true' : 'false' }}" aria-controls="ui-users">
                <span class="icon-bg"><i class="icon-people menu-icon"></i></span>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
              </a> 
              <div class="collapse {{ request()->is($urlPrefix . '/users*') || request()->is($urlPrefix . '/category*') || request()->is($urlPrefix . '/post*') ? ' show' : '' }}" id="ui-users">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link {{ request()->is($urlPrefix . '/users*') ? ' active' : '' }}" href="{{ route(app()->master->routePrefix . 'users.index') }}"><span class="icon-people line-icon"></span> Users</a></li>
                  <li class="nav-item"> <a class="nav-link {{ request()->is($urlPrefix . '/profile*') ? ' active' : '' }}" href="{{ route(app()->master->routePrefix . 'profile.index') }}"><span class="icon-user line-icon"></span> Profile</a></li>
                  <li class="nav-item"> <a class="nav-link {{ request()->is($urlPrefix . '/post*') ? ' active' : '' }}" href="{{ route(app()->master->routePrefix . 'post.index') }}">Posts</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item {{ request()->is($urlPrefix . '/subscriber*') ? ' active' : '' }}">
              <a class="nav-link" href="{{ route(app()->master->routePrefix . 'subscriber.index') }}">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title">Subscriber</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="icon-bg"><i class="mdi mdi-crosshairs-gps menu-icon"></i></span>
                <span class="menu-title">UI Elements</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/icons/mdi.html">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Icons</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/forms/basic_elements.html">
                <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
                <span class="menu-title">Forms</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/charts/chartjs.html">
                <span class="icon-bg"><i class="mdi mdi-chart-bar menu-icon"></i></span>
                <span class="menu-title">Charts</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="icon-bg"><i class="mdi mdi-table-large menu-icon"></i></span>
                <span class="menu-title">Tables</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="icon-bg"><i class="mdi mdi-lock menu-icon"></i></span>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item documentation-link">
              <a class="nav-link" href="http://www.bootstrapdash.com/demo/connect-plus-free/jquery/documentation/documentation.html" target="_blank">
                <span class="icon-bg">
                  <i class="mdi mdi-file-document-box menu-icon"></i>
                </span>
                <span class="menu-title">Documentation</span>
              </a>
            </li>
            <li class="nav-item sidebar-user-actions">
              <div class="user-details">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <div class="d-flex align-items-center">
                      <div class="sidebar-profile-img">
                        <img src="assets/images/faces/face28.png" alt="image">
                      </div>
                      <div class="sidebar-profile-text">
                        <p class="mb-1">Henry Klein</p>
                      </div>
                    </div>
                  </div>
                  <div class="badge badge-danger">3</div>
                </div>
              </div>
            </li>
            <li class="nav-item sidebar-user-actions">
              <div class="sidebar-user-menu">
                <a href="#" class="nav-link"><i class="mdi mdi-settings menu-icon"></i>
                  <span class="menu-title">Settings</span>
                </a>
              </div>
            </li>
            <li class="nav-item sidebar-user-actions">
              <div class="sidebar-user-menu">
                <a href="#" class="nav-link"><i class="mdi mdi-speedometer menu-icon"></i>
                  <span class="menu-title">Take Tour</span></a>
              </div>
            </li>
            <li class="nav-item sidebar-user-actions">
              <div class="sidebar-user-menu">
                <a href="#" class="nav-link"><i class="mdi mdi-logout menu-icon"></i>
                  <span class="menu-title">Log Out</span></a>
              </div>
            </li>
          </ul>
        </nav>