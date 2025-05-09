<!-- main-sidebar -->
<div class="sticky">
   <aside class="app-sidebar">
      <div class="main-sidebar-header active">
         <a class="header-logo active" href="{{url('index')}}">
         <img src="{{asset('assets/img/brand/logo.png')}}" class="main-logo  desktop-logo" alt="logo">
         <img src="{{asset('assets/img/brand/logo-white.png')}}" class="main-logo  desktop-dark" alt="logo">
         <img src="{{asset('assets/img/brand/favicon.png')}}" class="main-logo  mobile-logo" alt="logo">
         <img src="{{asset('assets/img/brand/favicon-white.png')}}" class="main-logo  mobile-dark" alt="logo">
         </a>
      </div>
      <div class="main-sidemenu">
         <div class="slide-left disabled" id="slide-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
               <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/>
            </svg>
         </div>
         <ul class="side-menu">
            <li class="side-item side-item-category">Main</li>
            <li class="slide">
               <a class="side-menu__item" data-bs-toggle="slide" href="{{url('dashboard')}}" wire:navigate>
                  <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                     <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/>
                  </svg>
                  <span class="side-menu__label">Dashboards</span><i class="angle fe fe-chevron-right"></i>
               </a>
            </li>
            <li class="slide">
               <a class="side-menu__item" data-bs-toggle="slide" href="{{url('attendance')}}" wire:navigate>
                  <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                     <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/>
                  </svg>
                  <span class="side-menu__label">Attendance</span><i class="angle fe fe-chevron-right"></i>
               </a>
            </li>
            @if(auth()->user()->roles->contains('id', 1))
            <li class="slide">
               <a class="side-menu__item" data-bs-toggle="slide" href="{{route('superadmin.companies')}}" wire:navigate>
                  <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                     <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/>
                  </svg>
                  <span class="side-menu__label">Companies</span><i class="angle fe fe-chevron-right"></i>
               </a>
            </li>
            {{--
            <li class="slide">
               <a class="side-menu__item" data-bs-toggle="slide" href="{{route('superadmin.permissions')}}" wire:navigate>
                  <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                     <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/>
                  </svg>
                  <span class="side-menu__label">Permissions</span><i class="angle fe fe-chevron-right"></i>
               </a>
            </li>
            --}}
            <li class="slide">
               <a class="side-menu__item" data-bs-toggle="slide" href="{{route('superadmin.role-management')}}" wire:navigate>
                  <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                     <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/>
                  </svg>
                  <span class="side-menu__label">Role Management</span><i class="angle fe fe-chevron-right"></i>
               </a>
            </li>
            <li class="slide">
               <a class="side-menu__item" data-bs-toggle="slide" href="{{route('superadmin.signups.list')}}" wire:navigate>
                  <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                     <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/>
                  </svg>
                  <span class="side-menu__label">Signup Data</span><i class="angle fe fe-chevron-right"></i>
               </a>
            </li>
            @endif
            @if(auth()->user()->roles->contains('id', 2))
            <li class="slide">
               <a class="side-menu__item" data-bs-toggle="slide" href="{{route('admin.permissions')}}" wire:navigate>
                  <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                     <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/>
                  </svg>
                  <span class="side-menu__label">Manage Permission</span><i class="angle fe fe-chevron-right"></i>
               </a>
            </li>
            @endif
         </ul>
         <div class="slide-right" id="slide-right">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
               <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/>
            </svg>
         </div>
      </div>
   </aside>
</div>
<!-- main-sidebar -->
