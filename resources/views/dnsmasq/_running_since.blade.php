@if($container['State']['Running'])

<span class="text-dark">DHCP <span class="font-weight-bold">UP</span> Since
    <a-moment
        start="{{ $container['State']['StartedAt'] }}"
        :calendar="true"
    ></a-moment>
    <span class="font-italic">(<a-moment start="{{ $container['State']['StartedAt'] }}" :from-now="true"></a-moment>)</span>
</span>

@else

<span class="text-dark">DHCP <span class="font-weight-bold">DOWN</span> Since
    <a-moment
        start="{{ $container['State']['FinishedAt'] }}"
        :calendar="true"
    ></a-moment>
    <span class="font-italic">(<a-moment start="{{ $container['State']['FinishedAt'] }}" :from-now="true"></a-moment>)</span>
</span>

@endif
