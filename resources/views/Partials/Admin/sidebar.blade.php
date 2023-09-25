<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item @if ($title == 'Dashboard') active @endif">
        <a href="{{ route('indexAdmin') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Pages</span>
    </li>
    <li class="menu-item @if ($title == 'Posts') active @endif">
        <a href="{{ route('indexAdminPosts') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Posts</div>
        </a>
    </li>
</ul>
