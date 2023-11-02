 <nav class="navbar navbar-expand px-2">
     @auth
     @if(auth()->user()->is_first_login=='0')
         <div class="side-nav-button p-2 me-3 text-light" id="sidenav-btn">
             <i class="fa-solid fa-bars"></i>
         </div>
     @endif
     @endauth

     <a class="navbar-brand px-4" href="#"><b>Admin</b>Panel</a>

     <div class="navbar-collapse nav-items">
     </div>
     @auth
     @if(auth()->user()->is_first_login=='0')
         <ul class="navbar-nav me-auto">
             <li class="nav-item">
                 <div class="p-2 me-3 dropdown">
                     <a class="dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
                         aria-expanded="false">
                         <i class="fa-solid fa-message"></i>
                     </a>
                     <ul class="dropdown-menu">
                         <li><a class="dropdown-item msg-card-item" href="#"><b>New Messages</b></a></li>
                         <li><a class="dropdown-item msg-card-item d-flex" href="#"><img
                                     src="{{ asset('images/profile-1.png') }}" class="contact-icon"><small
                                     class="px-2"><b>Rohan Shah</b><br>Hi how are you...</small></a></li>
                         <li><a class="dropdown-item msg-card-item d-flex" href="#"><img
                                     src="{{ asset('images/profile-2.png') }}" class="contact-icon"><small
                                     class="px-2"><b>Geeta Joshi</b><br>Bye...</small></a></li>
                         <li><a class="dropdown-item d-flex" href="#"><img src="{{ asset('images/profile-3.png') }}"
                                     class="contact-icon"><small class="px-2"><b>Jay Patel</b><br>Okay</small></a></li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item">
                 <div class="p-2 me-3 dropdown">
                     <a class="dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
                         aria-expanded="false">
                         <i class="fa-solid fa-envelope"></i>
                     </a>
                     <ul class="dropdown-menu">
                         <li><a class="dropdown-item msg-card-item" href="#"><b>New Mails</b></a></li>
                         <li><a class="dropdown-item msg-card-item d-flex" href="#"><img
                                     src="https://ui-avatars.com/api/?name=Meet&size=41&background=4285F4&color=FFFFFF"
                                     class="google-icon"><small class="px-2"><b>Meet Patel</b><br>Document
                                     Sharing</small></a></li>
                         <li><a class="dropdown-item msg-card-item d-flex" href="#"><img
                                     src="https://ui-avatars.com/api/?name=sahil&size=41&background=008000&color=FFFFFF"
                                     class="google-icon"><small class="px-2"><b>Sahil Patel</b><br>Apply for
                                     job</small></a></li>
                         <li><a class="dropdown-item d-flex" href="#"><img
                                     src="https://ui-avatars.com/api/?name=Ravi&size=41&background=ff0000&color=FFFFFF"
                                     class="google-icon"><small class="px-2"><b>Ravi Patel</b><br>Confirmation
                                     Letter</small></a></li>
                     </ul>
                 </div>
             </li>
         </ul>
     @endif
     @endauth
     @auth
        @if(auth()->user()->is_first_login=='0')
        <div class="p-2 me-3 dropdown text-light profile-dropdown-icon">
            <a class="dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa-solid fa-user"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item msg-card-item" href="#"><svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" width="25%">
                    <path
                        d="M1.29167 15.5C1.29167 15.5 0 15.5 0 14.2083C0 12.9167 1.29167 9.04167 7.75 9.04167C14.2083 9.04167 15.5 12.9167 15.5 14.2083C15.5 15.5 14.2083 15.5 14.2083 15.5H1.29167ZM7.75 7.75C8.77771 7.75 9.76334 7.34174 10.49 6.61504C11.2167 5.88834 11.625 4.90271 11.625 3.875C11.625 2.84729 11.2167 1.86166 10.49 1.13496C9.76334 0.408258 8.77771 0 7.75 0C6.72229 0 5.73666 0.408258 5.00996 1.13496C4.28326 1.86166 3.875 2.84729 3.875 3.875C3.875 4.90271 4.28326 5.88834 5.00996 6.61504C5.73666 7.34174 6.72229 7.75 7.75 7.75Z"
                        fill="#717171" />
                </svg>
                <span class="px-3">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</span></a></li>
                <li><a class="dropdown-item msg-card-item d-flex" href="#"><i class="fa-solid fa-user"></i><span class="px-2">My
                    Profile</span></a></li>
                <li><a class="dropdown-item msg-card-item d-flex" href="#"><i class="fa-solid fa-gear"></i><span class="px-2">Account
                    Settings</span></a></li>
                <li><a class="dropdown-item d-flex" href="#" id="logout-btn"><i class="fa-solid fa-power-off"></i><span class="px-2">Logout</span></a></li>
            </ul>
        </div>
        @endif
        @endauth

     @if(auth()->check() ==false || (auth()->check() ==true && auth()->user()->is_first_login=="1") )
         <li class="p-2 me-3">
             <a href="{{ route('login') }}" type="button" class="btn btn-success">Login</a>
         </li>
     @endif
 </nav>
