<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <li class="nav-small-cap">Admin</li>
        <li>

            <a class="has-arrow" aria-expanded="false">
                <i class="mdi mdi-gauge"></i>
                <span class="hide-menu">Tours</span>
            </a>

            @if($species)
                <ul aria-expanded="false" class="collapse">
                    @foreach($species as $specie)
                        <li><a href="{{ route('admin.tours.index', ['specie' => $specie->slug ]) }}">{{ $specie->name }}</a></li>
                    @endforeach
                </ul>
            @endif

        </li>

        <li>
            <a class="has-arrow" aria-expanded="false">
                <i class="mdi mdi-gauge"></i>
                <span class="hide-menu">To Tours</span>
            </a>

            <ul aria-expanded="false" class="collapse">
                <li><a href="{{ route('admin.icons.index') }}">Icons</a></li>
                <li><a href="{{ route('admin.services.index') }}">Services</a></li>
            </ul>
        </li>
        

        <li>
            <a class="has-arrow" aria-expanded="false">
                <i class="mdi mdi-gauge"></i>
                <span class="hide-menu">Species</span>
            </a>

            <ul aria-expanded="false" class="collapse">
                <li><a href="{{ route('admin.spesies.index') }}">Species</a></li>
            </ul>
        </li>
        

        <li>
            <a class="has-arrow" aria-expanded="false">
                <i class="mdi mdi-gauge"></i>
                <span class="hide-menu">Countries </span>
            </a>

            <ul aria-expanded="false" class="collapse">
                <li><a href="{{ route('admin.countries.index') }}">Countries</a></li>
                <li><a href="{{ route('admin.regions.index') }}">Regions</a></li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" aria-expanded="false">
                <i class="mdi mdi-gauge"></i>
                <span class="hide-menu">Permissions and Roles</span>
            </a>

            <ul aria-expanded="false" class="collapse">
                <li><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                <li><a href="{{ route('admin.permissions.index') }}">Permissions</a></li>
                <li><a href="{{ route('admin.permissions_roles.index') }}">Permissions & Roles</a></li>
                <li><a href="{{ route('admin.users.index') }}">Users</a></li>
                <li><a href="{{ route('admin.roles_users.index') }}">Roles & Users</a></li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" aria-expanded="false">
                <i class="mdi mdi-gauge"></i>
                <span class="hide-menu">Comments</span>
            </a>

            <ul aria-expanded="false" class="collapse">
                <li><a href="{{ route('admin.comments.index') }}">Comments</a></li>
                <li><a href="{{ route('admin.comment_plus.index') }}">Comment Plus</a></li>

            </ul>
        </li>

        <li>
            <a href="{{ route('admin.events.index') }}" class="has-arrow" aria-expanded="false">
                <i class="mdi mdi-gauge"></i>
                <span class="hide-menu">Events</span>
            </a>

        </li>



        <li class="nav-small-cap">PERSONAL</li>
        <li>

            <a class="has-arrow" href="#" aria-expanded="false">
                <i class="mdi mdi-gauge"></i>
                <span class="hide-menu">Dashboard 
                    <span class="label label-rounded label-success">
                        5
                    </span>
                </span>
            </a>

            <ul aria-expanded="false" class="collapse">
                <li><a href="index.html">Modern Dashboard</a></li>
                <li><a href="index2.html">Awesome Dashboard</a></li>
                <li><a href="index3.html">Classy Dashboard</a></li>
                <li><a href="index4.html">Analytical Dashboard</a></li>
                <li><a href="index5.html">Minimal Dashboard</a></li>
            </ul>
        </li>
        
    </ul>
</nav>