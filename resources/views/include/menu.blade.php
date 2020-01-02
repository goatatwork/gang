<ul class="list-group list-group-flush gang-menu">

    <a href="{{ route('home') }}"
        class="list-group-item text-dark text-decoration-none gang-menu-heading {{ (Request::is('/')) ? 'active' : '' }}"
    >
        <i class="fas fa-home"></i>
        Home
    </a>

    <a href="#goat-collapse" data-toggle="collapse" class="list-group-item text-dark text-decoration-none gang-menu-heading {{ (Request::is('dnsmasq*')) ? 'active' : '' }}">
        <i class="fas fa-cogs"></i>
        Admin
    </a>

    <div id="goat-collapse" class="collapse {{ (Request::is('dnsmasq*')) ? 'show' : '' }} text-right">
        <a href="{{ route('dnsmasq.index') }}" class="list-group-item text-dark text-decoration-none gang-menu-item">
            Dnsmasq
        </a>
    </div>

    <a href="{{ route('recon.index') }}"
        class="list-group-item text-dark text-decoration-none gang-menu-heading"
    >
        <i class="fas fa-robot"></i>
        ReconBot
    </a>


    <a href="{{ route('horizon.index') }}"
        target="_blank"
        class="list-group-item text-dark text-decoration-none gang-menu-heading"
    >
        <i class="fab fa-laravel"></i>
        Horizon
    </a>

    <a href="/traefik"
        target="_blank"
        class="list-group-item text-dark text-decoration-none gang-menu-heading"
    >
        <!-- <img src="/traefik/dashboard/assets/images/traefik.logo.svg" height="14px" width="14px"> -->
        <i class="fas fa-traffic-light"></i>
        Traefik
    </a>
    <a href="/dozzle"
        target="_blank"
        class="list-group-item text-dark text-decoration-none gang-menu-heading"
    >
        <i class="fab fa-docker"></i>
        Dozzle
    </a>
    <a href="/portainer"
        target="_blank"
        class="list-group-item text-dark text-decoration-none gang-menu-heading"
    >
        <i class="fab fa-docker"></i>
        Portainer
    </a>
</ul>
