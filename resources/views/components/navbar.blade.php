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
                     <ul class="dropdown-menu">
                         <li><a class="dropdown-item msg-card-item" href="#">Action</a></li>
                         <li><a class="dropdown-item msg-card-item" href="#">Another action</a></li>
                         <li><a class="dropdown-item" href="#">Something else here</a></li>
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
                         <li><a class="dropdown-item msg-card-item" href="#">Action</a></li>
                         <li><a class="dropdown-item msg-card-item" href="#">Another action</a></li>
                         <li><a class="dropdown-item" href="#">Something else here</a></li>
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
