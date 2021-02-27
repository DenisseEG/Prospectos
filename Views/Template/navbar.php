<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media(); ?>/images/avatar.png" alt="User Image">
        <div>
            <p class="app-sidebar__user-name"><?= $_SESSION['user_data']['nombre']; ?></p>
            <p class="app-sidebar__user-designation"><?= $_SESSION['user_data']['nombre_rol']; ?></p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item" href="<?= base_url(); ?>/dashboard">
                <i class="app-menu__icon fas fa-tachometer-alt"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <?php if(!empty($_SESSION['permisos'][1]['leer'])): ?>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fas fa-user-cog"></i>
                <span class="app-menu__label">Usuarios</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?= base_url(); ?>/usuarios"><i class="icon far fa-circle"></i> Usuarios</a></li>
                <li><a class="treeview-item" href="<?= base_url(); ?>/roles"><i class="icon far fa-circle"></i> Roles</a></li>
            </ul>
        </li>
        <?php endif; ?>
        <?php if(!empty($_SESSION['permisos'][2]['leer'])): ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/prospectos">
                <i class="app-menu__icon fa fa-users"></i>
                <span class="app-menu__label">Prospectos</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</aside>