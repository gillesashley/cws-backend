 <!--start top header-->
 <header class="top-header">
     <nav class="navbar navbar-expand gap-3">
         <div class="mobile-menu-button"><ion-icon name="menu-sharp"></ion-icon></div>
         <form class="searchbar">
             <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><ion-icon
                     name="search-sharp"></ion-icon></div>
             <input class="form-control" type="text" placeholder="Search for anything">
             <div class="position-absolute top-50 translate-middle-y search-close-icon"><ion-icon
                     name="close-sharp"></ion-icon></div>
         </form>
         <div class="top-navbar-right ms-auto">

             <ul class="navbar-nav align-items-center">
                 <li class="nav-item mobile-search-button">
                     <a class="nav-link" href="javascript:;">
                         <div class="">
                             <ion-icon name="search-sharp"></ion-icon>
                         </div>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link dark-mode-icon" href="javascript:;">
                         <div class="mode-icon">
                             <ion-icon name="moon-sharp"></ion-icon>
                         </div>
                     </a>
                 </li>
                 <li class="nav-item dropdown dropdown-large dropdown-apps">
                     <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                         data-bs-toggle="dropdown">
                         <div class="">
                             <ion-icon name="apps-sharp"></ion-icon>
                         </div>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                         <div class="row row-cols-3 g-3 p-3">
                            
                             <div class="col text-center">
                                 <div class="app-box mx-auto bg-gradient-danger text-white"><ion-icon
                                         name="videocam-sharp"></ion-icon>
                                 </div>
                                 <div class="app-title">Media</div>
                             </div>
                             <div class="col text-center">
                                 <div class="app-box mx-auto bg-gradient-warning text-white"><ion-icon
                                         name="file-tray-sharp"></ion-icon>
                                 </div>
                                 <div class="app-title">Campaigns</div>
                             </div>
                             <div class="col text-center">
                                 <div class="app-box mx-auto bg-gradient-branding text-white"><ion-icon
                                         name="notifications-sharp"></ion-icon>
                                 </div>
                                 <div class="app-title">Alerts</div>
                             </div>
                         </div>
                     </div>
                 </li>
                 <li class="nav-item dropdown dropdown-large">
                     <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                         data-bs-toggle="dropdown">
                         <div class="position-relative">
                             <span class="notify-badge">0</span>
                             <ion-icon name="notifications-sharp"></ion-icon>
                         </div>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end">
                         <a href="javascript:;">
                             <div class="msg-header">
                                 <p class="msg-header-title">Notifications</p>
                                 <p class="msg-header-clear ms-auto">Marks all as read</p>
                             </div>
                         </a>
                         <div class="header-notifications-list">
                         <a href="javascript:;">
                             <div class="text-center msg-footer">No Notifications</div>
                         </a>
                     </div>
                 </li>
                 <li class="nav-item dropdown dropdown-user-setting">
                     <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                         data-bs-toggle="dropdown">
                         <div class="user-setting">
                             <img src="{{ asset('assets/images/avatars/06.png') }}" class="user-img" alt="">
                         </div>
                     </a>
                     <ul class="dropdown-menu dropdown-menu-end">
                         <li>
                             <a class="dropdown-item" href="#">
                                 <div class="d-flex flex-row align-items-center gap-2">
                                     <img src="{{ asset('assets/images/avatars/06.png') }}" alt=""
                                         class="rounded-circle" width="54" height="54">
                                     <div class="">
                                         <h6 class="mb-0 dropdown-user-name">{{ session('user')->name ?? 'User' }}</h6>
                                         <small
                                             class="mb-0 dropdown-user-designation text-secondary">{{ session('user')->email ?? 'email@example.com' }}</small>
                                     </div>

                                 </div>
                             </a>
                         </li>
                         <li>
                             <hr class="dropdown-divider">
                         </li>
                         <li>
                             <a class="dropdown-item" href="pages-user-profile.html">
                                 <div class="d-flex align-items-center">
                                     <div class=""><ion-icon name="person-outline"></ion-icon></div>
                                     <div class="ms-3"><span>Profile</span></div>
                                 </div>
                             </a>
                         </li>
                         <li>
                             <hr class="dropdown-divider">
                         </li>
                         <li>
                             <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                 style="display: none;">
                                 @csrf
                             </form>
                             <a class="dropdown-item" href="#"
                                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                 <div class="d-flex align-items-center">
                                     <div class=""><ion-icon name="log-out-outline"></ion-icon></div>
                                     <div class="ms-3"><span>Logout</span></div>
                                 </div>
                             </a>
                         </li>
                     </ul>
                 </li>

             </ul>

         </div>
     </nav>
 </header>
 <!--end top header-->
