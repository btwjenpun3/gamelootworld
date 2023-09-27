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
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Tools</span>
    </li>
    <li class="menu-item @if ($title == 'Fetch Tool') active @endif">
        <a href="{{ route('admin.tools.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-sync"></i>
            <div data-i18n="Analytics">Auto Machine</div>
        </a>
    </li>
</ul>
