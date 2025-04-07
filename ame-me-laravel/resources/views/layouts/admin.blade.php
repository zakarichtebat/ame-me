<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Administration AME</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Admin CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <!-- Page Specific Styles -->
    @stack('styles')
</head>

<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="logo">
                    <img src="{{ asset('images/logo-white.png') }}" alt="AME Logo" class="logo-img">
                    <span class="logo-text">AME</span>
                </a>
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="sidebar-content">
                <nav class="sidebar-nav">
                    <ul class="nav-list">
                        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                <i class="fas fa-tachometer-alt nav-icon"></i>
                                <span class="nav-text">Tableau de bord</span>
                            </a>
                        </li>

                        <li class="nav-section">
                            <span class="nav-section-title">Blog</span>
                        </li>

                        <li
                            class="nav-item {{ request()->routeIs('admin.blog.*') && !request()->routeIs('admin.blog.categories.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.blog.index') }}" class="nav-link">
                                <i class="fas fa-newspaper nav-icon"></i>
                                <span class="nav-text">Articles</span>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('admin.blog.categories.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.blog.categories.index') }}" class="nav-link">
                                <i class="fas fa-tags nav-icon"></i>
                                <span class="nav-text">Catégories</span>
                            </a>
                        </li>

                        <li class="nav-section">
                            <span class="nav-section-title">Contenu du site</span>
                        </li>

                        <li class="nav-item {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.pages.index') }}" class="nav-link">
                                <i class="fas fa-file-alt nav-icon"></i>
                                <span class="nav-text">Pages</span>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.services.index') }}" class="nav-link">
                                <i class="fas fa-cogs nav-icon"></i>
                                <span class="nav-text">Services</span>
                            </a>
                        </li>

                        <li class="nav-item has-submenu {{ request()->routeIs('admin.media.*') ? 'open' : '' }}">
                            <a href="#" class="nav-link submenu-toggle">
                                <i class="fas fa-images nav-icon"></i>
                                <span class="nav-text">Média</span>
                                <i class="fas fa-chevron-right submenu-indicator"></i>
                            </a>
                            <ul class="submenu-list">
                                <li class="submenu-item {{ request()->routeIs('admin.media.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.media.index') }}" class="submenu-link">Bibliothèque</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('admin.media.upload') ? 'active' : '' }}">
                                    <a href="{{ route('admin.media.upload') }}" class="submenu-link">Ajouter</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-section">
                            <span class="nav-section-title">Paramètres</span>
                        </li>

                        <li class="nav-item {{ request()->routeIs('admin.settings.general') ? 'active' : '' }}">
                            <a href="{{ route('admin.settings.general') }}" class="nav-link">
                                <i class="fas fa-cog nav-icon"></i>
                                <span class="nav-text">Général</span>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.users.index') }}" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <span class="nav-text">Utilisateurs</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>

                <div class="header-right">
                    <div class="header-actions">
                        <a href="{{ url('/') }}" class="header-action" title="Voir le site" target="_blank">
                            <i class="fas fa-external-link-alt"></i>
                        </a>

                        <div class="dropdown header-action">
                            <button class="notifications-toggle" id="notificationsDropdown" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-bell"></i>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span
                                        class="notifications-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                                @endif
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end notifications-dropdown"
                                aria-labelledby="notificationsDropdown">
                                <li class="dropdown-header">
                                    <span>Notifications</span>
                                    @if(auth()->user()->unreadNotifications->count() > 0)
                                        <a href="{{ route('admin.notifications.mark-all-read') }}"
                                            class="mark-all-read">Tout marquer comme lu</a>
                                    @endif
                                </li>

                                @forelse(auth()->user()->notifications()->take(5)->get() as $notification)
                                    <li>
                                        <a href="{{ route('admin.notifications.read', $notification->id) }}"
                                            class="dropdown-item notification-item {{ $notification->read_at ? '' : 'unread' }}">
                                            <div class="notification-icon">
                                                <i class="fas {{ $notification->data['icon'] ?? 'fa-bell' }}"></i>
                                            </div>
                                            <div class="notification-content">
                                                <div class="notification-message">{{ $notification->data['message'] }}</div>
                                                <div class="notification-time">
                                                    {{ $notification->created_at->diffForHumans() }}</div>
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <li class="empty-notifications">
                                        <span>Aucune notification</span>
                                    </li>
                                @endforelse

                                @if(auth()->user()->notifications->count() > 5)
                                    <li class="dropdown-footer">
                                        <a href="{{ route('admin.notifications.index') }}" class="view-all">Voir toutes les
                                            notifications</a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <div class="dropdown header-action">
                            <button class="user-toggle" id="userDropdown" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <div class="user-avatar">
                                    @if(auth()->user()->avatar)
                                        <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}">
                                    @else
                                        <span class="avatar-placeholder">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    @endif
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end user-dropdown" aria-labelledby="userDropdown">
                                <li class="dropdown-header">
                                    <span class="user-name">{{ auth()->user()->name }}</span>
                                    <span class="user-email">{{ auth()->user()->email }}</span>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><i
                                            class="fas fa-user-edit"></i> Modifier le profil</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.settings.general') }}"><i
                                            class="fas fa-cog"></i> Paramètres</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="content">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Admin JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Sidebar toggle
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
            const adminLayout = document.querySelector('.admin-layout');

            function toggleSidebar() {
                adminLayout.classList.toggle('sidebar-collapsed');

                // Save state in localStorage
                const isCollapsed = adminLayout.classList.contains('sidebar-collapsed');
                localStorage.setItem('sidebar-collapsed', isCollapsed);
            }

            // Initialize from localStorage
            const savedState = localStorage.getItem('sidebar-collapsed');
            if (savedState === 'true') {
                adminLayout.classList.add('sidebar-collapsed');
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            if (mobileSidebarToggle) {
                mobileSidebarToggle.addEventListener('click', function () {
                    adminLayout.classList.toggle('sidebar-mobile-open');
                });
            }

            // Submenu toggle
            const submenuToggles = document.querySelectorAll('.submenu-toggle');

            submenuToggles.forEach(toggle => {
                toggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    const menuItem = this.parentElement;
                    menuItem.classList.toggle('open');
                });
            });

            // Close sidebar on mobile when clicking outside
            document.addEventListener('click', function (e) {
                if (
                    adminLayout.classList.contains('sidebar-mobile-open') &&
                    !e.target.closest('.sidebar') &&
                    !e.target.closest('#mobileSidebarToggle')
                ) {
                    adminLayout.classList.remove('sidebar-mobile-open');
                }
            });
        });
    </script>

    <!-- Page Specific Scripts -->
    @stack('scripts')
</body>

</html>