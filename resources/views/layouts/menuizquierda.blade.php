
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <img alt="image" class="img-circle" src="" />
                     </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?=$datauser->nombre ?> <?=$datauser->apellidoPaterno ?> <?=$datauser->apellidoMaterno ?></strong>
                    </span> <span class="text-muted text-xs block"><?=$datauser->puesto ?> <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Perfil</a></li>
                        <li><a href="contacts.html">Contactos</a></li>
                        <li><a href="mailbox.html">Correo</a></li>
                        <li class="divider"></li>
                        <li><a href="/bienvenida">Volver a inicio</a></li>
                        <li><a href="{{ Route('admin.auth.logout') }}">Salir</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    <a href="/bienvenida" data-toggle="tooltip" data-placement="right" title="Volver a inicio" ><img alt="image" class="img-circle" src="/img/overthetop60.jpg" /></a>
                </div>
            </li>


                    <?php foreach ($menuIzquierda as $menuprincipal): ?>

             <?php if ($menuprincipal->consubmenu == 1): ?>

            <li>
                <a href="<?=$menuprincipal->route?>" data-toggle="tooltip" data-placement="right" title="<?=$menuprincipal->opcion?>"><i class="<?=$menuprincipal->icono?>"></i> <span class="nav-label"><?=$menuprincipal->opcion?></span><span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">


                    <?php foreach ($submenuIzquierda as $submenu): ?>

            <?php if ($submenu->id_menuIzquierda == $menuprincipal->id): ?>
                    <li><a href="<?=$submenu->route?>"><?= $submenu->opcion?></a></li>
           <?php endif; ?>

                    <?php endforeach ?>
                </ul>
           </li>
           <?php endif; ?>

           <?php if ($menuprincipal->consubmenu == 0): ?>

             <li>
                 <a href="<?=$menuprincipal->route?>" data-toggle="tooltip" title="<?=$menuprincipal->opcion?>"><i class="<?=$menuprincipal->icono?>"></i> <span class="nav-label"><?=$menuprincipal->opcion?></span> </a>

            </li>
         <?php endif; ?>




                    <?php endforeach ?>

        </ul>

    </div>
</nav>
