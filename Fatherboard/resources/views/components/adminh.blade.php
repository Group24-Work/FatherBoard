<header class="main-header">
    <div class="container">
        <a href="/home">
            <img class="logo" src="{{asset('images/FatherboardTransparentCrop.png')}}" id="logo" alt="FatherBoard Logo"
                width="100" height="50">
        </a>


        <nav class="main-nav">
            <ul class="main-nav-list">
                <li>
                    <a href="{{ route('settings') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-user">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                            <path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                        </svg>
                    </a>
                    <ul class="dropdown">
                        <li><a href="/settings#!personal">Settings</a></li>
                        <li><a href="/settings#!history">History</a></li>
                        <li><a id="logout_button">Logout</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('home') }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"
                  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                  class="icon icon-tabler icons-tabler-outline icon-tabler-logout"><path stroke="none" d="M0 0h24v24H0z" 
                  fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                  <path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg></a></li>
            </ul>
        </nav>
    </div>
                    <div class="container">
                        <nav class="lower-nav">
                            <ul class="lower-nav-list">
                                <li>
                                    <a href="/accounts">Account Manage</a>
                                    <a href="/tags">Tag Manage</a>
                                    <a href="/admin/product_manage">Product Manage</a>
                                    <a href="/messages">Messages</a>
                                    <a href="/admin/products">Product Manage (Interactive)</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

</header>