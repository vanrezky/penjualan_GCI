            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="">Stisla</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="">St</a>
                    </div>
                    <ul class="sidebar-menu">

                        <?php
                        foreach ($menu_array as $typemenu) {
                            echo "<li class='menu-header'>" . $typemenu['menu_utama']['menu'] . "</li>";
                            foreach ($typemenu['sub'] as $subMenu) {
                                if (stripos($this->uri->segment(1), $subMenu['field_url']) !== FALSE) {
                                    echo "<li class='active'><a class='nav-link' href='" . site_url() . $subMenu['field_url'] . "'><i class='<?= $subMenu[icon] ?>'></i> <span>$subMenu[title]</span></a></li>";
                                } else {
                                    echo "<li><a class='nav-link' href='" . site_url() . $subMenu['field_url'] . "'><i class='<?= $subMenu[icon] ?>'></i> <span>$subMenu[title]</span></a></li>";
                                }
                            }
                        } ?>
                    </ul>

                </aside>
            </div>