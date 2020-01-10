<ul class="list-group list-group-flush gang-menu">

    <a href="{{ route('home') }}"
        class="list-group-item text-dark text-decoration-none gang-menu-heading {{ (Request::is('/')) ? 'active' : '' }}"
    >
        <i class="fas fa-home"></i>
        Home
    </a>

    <!-- -->

    <a href="#dhcp-menu" data-toggle="collapse" class="list-group-item text-dark text-decoration-none gang-menu-heading">
        <i class="fas fa-brain"></i>
        DHCP
    </a>

    <div id="dhcp-menu" class="collapse {{ (Request::is('dnsmasq*')) ? 'show' : '' }} text-right">
        <a href="{{ route('dnsmasq.index', 'collapsalbe-view-of-dnsmasq-conf-file') }}"
            class="list-group-item text-dark text-decoration-none gang-menu-item"
        >
            Server
        </a>
        <a href="{{ route('dnsmasq.index', 'collapsalbe-view-of-dhcp-leases') }}"
            class="list-group-item text-dark text-decoration-none gang-menu-item"
        >
            12 Leases
        </a>
        <a href="{{ route('dnsmasq.index', 'collapsable-list-of-config-files') }}"
            class="list-group-item text-dark text-decoration-none gang-menu-item"
        >
            32 Service Files
        </a>
        <a href="{{ route('dnsmasq.index', 'collapsable-list-of-tftp_files') }}"
            class="list-group-item text-dark text-decoration-none gang-menu-item"
        >
            73 TFTP Files
        </a>
        <a href="{{ route('dnsmasq.index', 'collapsable-list-of-imports') }}"
            class="list-group-item text-dark text-decoration-none gang-menu-item"
        >
            4 Import Files
        </a>
    </div>

    <!-- -->

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
