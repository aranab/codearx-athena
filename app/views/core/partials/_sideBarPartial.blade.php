<!-- PARTIAL VIEW: Side Bar -->
<li class="nav-item">
    <a href="{{url('/core/')}}" class="nav-link nav-toggle">
        <i class="icon-home"></i>
        <span class="title">Dashboard</span>
    </a>
</li>

<li class="nav-item">
    <a href="{{url('/')}}" class="nav-link nav-toggle" target="_blank">
        <i class="icon-globe"></i>
        <span class="title">View Main Website</span>
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
            <a href="{{url('/core/users')}}" class="nav-link ">
                <span class="title">User List</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/core/users/create')}}" class="nav-link ">
                <span class="title">Add User</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/core/configs')}}" class="nav-link ">
                <span class="title">CMS Configuration Options</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-bulb" aria-hidden="true"></i>
        <span class="title">Entrepreneur Zone</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item">
            <a href="{{url('/core/questions')}}" class="nav-link ">
                <span class="title">Question Upload</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/core/questions/log')}}" class="nav-link ">
                <span class="title">Questions Log</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/core/ideas')}}" class="nav-link ">
                <span class="title">Submitted Idea</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/core/ideas/log')}}" class="nav-link ">
                <span class="title">Users Idea Log</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="{{url('/core/code')}}" class="nav-link nav-toggle">
        <i class="fa fa-css3" aria-hidden="true"></i>
        <span class="title">CSS Code Editor</span>
    </a>
</li>

<li class="nav-item">
    <a href="javascript:;" class="nav-link nav-toggle disabled">
        <i class="fa fa-file" aria-hidden="true"></i>
        <span class="title">Pages</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item">
            <a href="{{url('/core/pages')}}" class="nav-link ">
                <span class="title">All Pages</span>
            </a>
        </li>
        @foreach ($pageMenu as $id => $title)
            <li class="nav-item">
                <a href="{{url('core/pages', $id)}}" class="nav-link ">
                    <span class="title">{{$title}}</span>
                </a>
            </li>
        @endforeach
    </ul>
</li>

<li class="nav-item">
    <a href="{{url('/core/widget')}}" class="nav-link nav-toggle">
        <i class="fa fa-thumb-tack" aria-hidden="true"></i>
        <span class="title">Footer Widget</span>
    </a>
</li>

<li class="nav-item">
    <a href="{{url('/core/media')}}" class="nav-link nav-toggle">
        <i class="icon-camera"></i>
        <span class="title">Media Gallery</span>
    </a>
</li>
