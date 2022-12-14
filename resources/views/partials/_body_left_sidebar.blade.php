<!-- Sidebar  -->
<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="{{ route('dashboard') }}">
            <img src="{{ getSingleMedia(settingSession('get'),'site_logo',null) }}" class="img-fluid site_logo" alt="site_logo">
            <span>{{ config('app.name', 'Metorick') }}</span>
        </a>
        <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
                <div class="line-menu half start"></div>
                <div class="line-menu"></div>
                <div class="line-menu half end"></div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
        <?php
            $auth_user = authSession();
        ?>
        @php
            $menu = Menu::new()
                ->addClass('iq-menu')
                ->add(Spatie\Menu\Html::raw('<i class="ri-separator"></i><span>'.trans('messages.dashboard').'</span></li>')
                    ->addParentClass('iq-menu-title')
                )
                ->add(Spatie\Menu\Link::to(route(auth()->user()->user_type.'.complain'), '<i class="lar la-question-circle"></i><span>Complains</span>'))
                ->submenu(
                    Spatie\Menu\Link::to('#', '<i class="las la-users"></i><span>Settings</span><i class="ri-arrow-right-s-line iq-arrow-right"></i>')
                        ->addClass('iq-waves-effect'),
                    Menu::new()
                        ->addClass('iq-submenu')
                        ->route('group.index', 'Group')
                        ->route('admin.group.index', 'Admin Group')
                        ->route('group.create', 'Category')
                        ->route('client.index', 'Clients')
                        ->route('region.index', 'Region')
                        ->route('team.index', 'Team')
                )


        @endphp
        <?php echo $menu->setActiveFromRequest()->render() ?>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
