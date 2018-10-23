<!-- PARTIAL VIEW: User Login -->
<li class="dropdown dropdown-user">
    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <?php
        $src = asset('/assets/layouts/layout/img/avatar.png');
        if (Auth::user()->ext) {
            $src = asset(Auth::user()->path.Auth::user()->id.Auth::user()->ext);
        }
        ?>
        <img alt="" class="img-circle" src="{{$src}}" />
        <span class="username cus-username username-hide-on-mobile">
            {{Auth::user()->username}}
        </span>
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu cus-dropdown-menu dropdown-menu-default">
        <li>
            <a href="{{url('/user/profile')}}">
                <i class="icon-user"></i>
                Profile
            </a>
        </li>
        <li>
            <a href="{{url('#')}}">
                <i class="fa fa-key" aria-hidden="true"></i>
                Change Password
            </a>
        </li>
        <li>
            <a href="{{url('/user/logout')}}">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Log Out
            </a>
        </li>
    </ul>
</li>