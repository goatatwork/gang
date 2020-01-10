@if($container['State']['Running'])

<span class="fas fa-radiation-alt fa-spin text-success" style="font-size:1.25em;"></span>
<span class="text-success">Dnsmasq has been running since
    <a-moment
        start="{{ $container['State']['StartedAt'] }}"
        :calendar="true"
    ></a-moment>
</span>

@else

<span class="fas fa-radiation-alt text-secondary" style="font-size:1.25em;"></span>
<span class="text-dark">Dnsmasq has not been running since
    <a-moment
        start="{{ $container['State']['FinishedAt'] }}"
        :calendar="true"
    ></a-moment>
</span>

@endif
