<aside id="aside_layout">
    <ul>
        @if(Auth::check())
        <li><h1 id="user-login">{{ ucfirst(Auth::user()->username) }}</h1></li>
        <li class="aside_link">{{ link_to('home', 'home') }}</li>
        <li class="aside_link">{{ link_to('post/create', 'create post') }}</li>
        <li class="aside_link">{{ link_to('post/myposts', 'my posts') }}</li>
        <li class="aside_link">{{ link_to('user/edit', 'edit profile') }}</li>
        <li class="aside_link">{{ link_to('user/message', 'message') }}</li>
        <li class="aside_link">{{ link_to('user/logout', 'logout') }}</li>
        @else
        <li class="aside_link">{{ link_to('login', 'connect') }}</li>
        <li class="aside_link">{{ link_to('register', 'register') }}</li>
        <li class="aside_link">{{ link_to('home', 'home') }}</li>
        @endif
        <li class="aside_link">{{ link_to('search', 'search') }}</li>
    </ul>
</aside>

