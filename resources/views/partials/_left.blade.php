<div class="sidebar-content">
    <!-- Side Header -->
    <div class="content-header content-header-fullrow px-15">
        <!-- Mini Mode -->
        <div class="content-header-section sidebar-mini-visible-b">
            <!-- Logo -->
            <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                <span class="text-dual-primary-dark">f</span><span class="text-primary">c</span>
            </span>
            <!-- END Logo -->
        </div>
        <!-- END Mini Mode -->

        <!-- Normal Mode -->
        <div class="content-header-section text-center align-parent sidebar-mini-hidden">
            <!-- Close Sidebar, Visible only on mobile screens -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                <i class="fa fa-times text-danger"></i>
            </button>
            <!-- END Close Sidebar -->

            <!-- Logo -->
            <div class="content-header-item">
                <a class="link-effect font-w700" href="/home">
                    <i class="si si-fire text-primary"></i>
                    <span class="font-size-xl text-dual-primary-dark">fruit</span>
                    <span class="font-size-xl text-primary"> icapp</span>
                </a>
            </div>
            <!-- END Logo -->
        </div>
        <!-- END Normal Mode -->
    </div>
    <!-- END Side Header -->

    <!-- Side User -->
    <a class="block block-link-pop bg-gd-dusk text-center" href="javascript:void(0)">
        <div class="block-content block-content-full">
            <img class="img-avatar img-avatar-thumb" src='media/avatars/u9.png' alt="">
        </div>
        <div class="block-content block-content-full bg-black-op-5">
            <div class="font-w600 text-white mb-5">{{Auth::user() -> nom}} {{Auth::user() -> prenom}}</div>
            <div class="font-size-sm text-white-op"> {{Auth::user() -> username}} </div>
        </div>
<!--
        <div class="block-content block-content-full block-content-sm">
            <span class="font-w600 font-size-sm text-info-light">email</span>
        </div>
-->
    </a>

    <!-- END Side User -->

    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">

            <li>
                <a href="/produit"><i class="si si-basket-loaded fa-2x"></i><span class="sidebar-mini-hide">Produit</span></a>
            </li>
            <li>
                <a href="/client"><i class="si si-basket-loaded fa-2x"></i><span class="sidebar-mini-hide">Client</span></a>
            </li>
            <li>
                <a href="/stock"><i class="si si-basket-loaded fa-2x"></i><span class="sidebar-mini-hide">Stock</span></a>
            </li>
            <li>
                <a href="/register"><i class="si si-basket-loaded fa-2x"></i><span class="sidebar-mini-hide"> Parametres </span></a>
            </li>
            <li>
                <a href="/autre"><i class="si si-basket-loaded fa-2x"></i><span class="sidebar-mini-hide"> Autres </span></a>
            </li>
            <li>
                <a href="/approvisionnement"><i class="si si-basket-loaded fa-2x"></i><span class="sidebar-mini-hide"> Approvissionnement </span></a>
            </li>
            <li>
                <a href="/vente"><i class="si si-basket-loaded fa-2x"></i><span class="sidebar-mini-hide"> Vente </span></a>
            </li>





        </ul>
    </div>
    <!-- END Side Navigation -->
</div>
