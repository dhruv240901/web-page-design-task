 <nav class="navbar navbar-expand navbar-dark bg-dark px-2">
    @auth
     <div class="side-nav-button p-2 me-3 text-light" id="sidenav-btn">
         <i class="fa-solid fa-bars"></i>
     </div>
     @endauth

     <a class="navbar-brand px-4" href="#"><b>Admin</b>Panel</a>

     <div class="navbar-collapse nav-items">
        @auth
         <ul class="navbar-nav me-auto">
             <li class="nav-item">
                 <div class="p-2 me-3 dropdown">
                     <a class="dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
                         aria-expanded="false">
                         <i class="fa-solid fa-message"></i>
                     </a>
                     <ul class="dropdown-menu" style="width: 250px">
                         <li><a class="dropdown-item msg-card-item" href="#"><b>New Messages</b></a></li>
                         <li><a class="dropdown-item msg-card-item d-flex" href="#"><img src="{{asset('images/profile-1.png')}}" class="contact-icon"><small class="px-2"><b>Rohan Shah</b><br>Hi how are you...</small></a></li>
                         <li><a class="dropdown-item msg-card-item d-flex" href="#"><img src="{{asset('images/profile-2.png')}}" class="contact-icon"><small class="px-2"><b>Geeta Joshi</b><br>Bye...</small></a></li>
                         <li><a class="dropdown-item d-flex" href="#"><img src="{{asset('images/profile-3.png')}}" class="contact-icon"><small class="px-2"><b>Jay Patel</b><br>Okay</small></a></li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item">
                 <div class="p-2 me-3 dropdown">
                     <a class="dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
                         aria-expanded="false">
                         <i class="fa-solid fa-envelope"></i>
                     </a>
                     <ul class="dropdown-menu" style="width: 250px">
                         <li><a class="dropdown-item msg-card-item" href="#"><b>New Mails</b></a></li>
                         <li><a class="dropdown-item msg-card-item d-flex" href="#"><img src="https://ui-avatars.com/api/?name=Meet&size=41&background=4285F4&color=FFFFFF" class="google-icon"><small class="px-2"><b>Meet Patel</b><br>Document Sharing</small></a></li>
                         <li><a class="dropdown-item msg-card-item d-flex" href="#"><img src="https://ui-avatars.com/api/?name=sahil&size=41&background=008000&color=FFFFFF" class="google-icon"><small class="px-2"><b>Sahil Patel</b><br>Apply for job</small></a></li>
                         <li><a class="dropdown-item d-flex" href="#"><img src="https://ui-avatars.com/api/?name=Ravi&size=41&background=ff0000&color=FFFFFF" class="google-icon"><small class="px-2"><b>Ravi Patel</b><br>Confirmation Letter</small></a></li>
                     </ul>
                 </div>
             </li>
         </ul>
        @endauth
     </div>

     @auth
     <div class="p-2 me-3 text-light" id="profile-icon" style="cursor: pointer;font-size:1.5rem">
         <i class="fa-solid fa-user"></i>
     </div>
     @endauth

     @guest
     <li class="p-2 me-3">
         <a href="{{route('login')}}" type="button" class="btn btn-success">Login</a>
     </li>
     @endguest
 </nav>
