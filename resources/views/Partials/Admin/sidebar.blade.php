<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item @if ($title == 'Dashboard') active @endif">
        <a href="{{ route('admin.dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Pages</span>
    </li>
    <li class="menu-item @if ($title == 'Posts') active @endif">
        <a href="{{ route('admin.posts.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-file"></i>
            <div data-i18n="Analytics">Posts</div>
        </a>
    </li>
    <li class="menu-item @if ($title == 'Comments') active @endif">
        <a href="{{ route('admin.comments.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-comment"></i>
            <div data-i18n="Analytics">Comments</div>
        </a>
    </li>
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">User</span>
    </li>
    <li class="menu-item @if ($title == 'User') active @endif">
        <a href="{{ route('admin.user.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Analytics">User</div>
        </a>
    </li>
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Tools</span>
    </li>
    <li class="menu-item @if ($title == 'Fetch Tool') active @endif">
        <a href="{{ route('admin.tools.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-sync"></i>
            <div data-i18n="Analytics">Auto Machine</div>
        </a>
    </li>
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Links</span>
    </li>
    <li class="menu-item">
        <a href="{{ route('home.index') }}" class="menu-link" target="_blank">
            <i class="menu-icon tf-icons bx bx-link-external"></i>
            <div data-i18n="Analytics">Open Website</div>
        </a>
    </li>
</ul>
