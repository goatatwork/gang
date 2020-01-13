                    <div class="btn-toolbar" role="toolbar" aria-label="DNSMASQ Container Controls">

                        <div class="btn-group" role="group" aria-label="container power controls">
                            <form class="form" method="POST" action="{{route('dockerbot.update')}}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="action" value="start">
                                <button class="btn btn-outline-dark">
                                    <i class="fas fa-play"></i> Start
                                </button>
                            </form>
                            <form class="form" method="POST" action="{{route('dockerbot.update')}}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="action" value="stop">
                                <button class="btn btn-outline-dark">
                                    <i class="fas fa-square"></i> Stop
                                </button>
                            </form>
                            <form class="form" method="POST" action="{{route('dockerbot.update')}}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="action" value="restart">
                                <button class="btn btn-outline-dark">
                                    <i class="fas fa-sync"></i> Restart
                                </button>
                            </form>
                        </div>

                    </div>
