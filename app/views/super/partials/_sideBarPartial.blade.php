<!-- PARTIAL VIEW: Side Bar -->
<li class="nav-item">
    <a href="{{url('/~super/')}}" class="nav-link nav-toggle">
        <i class="icon-home"></i>
        <span class="title">Dashboard</span>
    </a>
</li>

<li class="nav-item">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-settings"></i>
        <span class="title">Administration</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item">
            <a href="{{url('/~super/roles')}}" class="nav-link ">
                <span class="title">Role List</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/~super/users')}}" class="nav-link ">
                <span class="title">User List</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/~super/configs')}}" class="nav-link ">
                <span class="title">CMS Configuration Options</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="{{url('/~super/code')}}" class="nav-link nav-toggle">
        <i class="fa fa-css3" aria-hidden="true"></i>
        <span class="title">CSS Code Editor</span>
    </a>
</li>

<li class="nav-item">
    <a href="{{url('/~super/pages')}}" class="nav-link nav-toggle">
        <i class="fa fa-file" aria-hidden="true"></i>
        <span class="title">Pages</span>
    </a>
</li>

<li class="nav-item">
    <a href="{{url('/~super/pages/sections')}}" class="nav-link nav-toggle">
        <i class="fa fa-puzzle-piece" aria-hidden="true"></i>
        <span class="title">Sections</span>
    </a>
</li>

<li class="nav-item">
    <a href="{{url('/~super/pages/menu')}}" class="nav-link nav-toggle">
        <i class="fa fa-bars" aria-hidden="true"></i>
        <span class="title">Menu</span>
    </a>
</li>


