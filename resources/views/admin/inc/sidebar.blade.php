<div class="side-navbar-wrapper">
    <!-- Sidebar Header    -->
    <div class="sidenav-header d-flex align-items-center justify-content-center">
        <!-- User Info-->


        <div class="sidenav-header-inner text-center"><img src="{{asset('avatar')}}/{{Auth::guard('admin')->user()->avatar}}" alt="avatar" class="img-fluid rounded-circle">


            <h2 class="h5">{{Auth::guard('admin')->user()->name}}</h2>
            <span><a href="{{route('admin.edit',Auth::guard('admin')->id())}}">Edit Profile</a></span>
        </div>
        <!-- Small Brand information, appears on minimized sidebar-->
        <div class="sidenav-header-logo"><a href="" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
    </div>
    <!-- Sidebar Navigation Menus-->
    <div class="main-menu">
        <h5 class="sidenav-heading">Main</h5>
        <ul id="side-main-menu" class="side-menu list-unstyled">
            <li><a href="{{route('admin.home')}}"> <i class="icon-home"></i>Home</a></li>


            <div id="accordion">
                <?php $url=url()->current();?>

                <li>
                    <?php
                        if (strpos($url,'register') || strpos($url,'user')){
                            $active_user=true;
                        }
                    ?>
                    <a href="#admin" aria-expanded="{{isset($active_user)?'true':'false'}}" data-toggle="collapse" aria-controls="admins">
                        <i class="icon" data-icon="k"></i>Users
                    </a>
                    <ul id="admin" class="collapse list-unstyled {{isset($active_user)?'show':''}}" data-parent="#accordion">
                        <li><a href="{{route('admin.create')}}">Add New</a></li>
                        <li><a href="{{route('admin.list')}}">User List</a></li>
                    </ul>
                </li>
            </div>

            <div id="accordion">
                <?php $url=url()->current();?>

                <li>
                    <?php

                    if (strpos($url,'term')){
                        $active_term=true;
                    }
                    ?>
                    <a href="#term" aria-expanded="{{isset($active_term)?'true':'false'}}" data-toggle="collapse" aria-controls="terms">
                        <i class="fa fa-credit-card" ></i>Terms
                    </a>
                    <ul id="term" class="collapse list-unstyled {{isset($active_term)?'show':''}}" data-parent="#accordion">
                        <li><a href="{{route('term.create')}}">Add New Term</a></li>
                        <li><a href="{{route('term.index')}}">Term List</a></li>
                    </ul>
                </li>
            </div>

            <div id="accordion">
                <?php $url=url()->current();?>

                <li>
                    <?php

                    if (strpos($url,'post')){
                        $active_post=true;
                    }
                    ?>
                    <a href="#post" aria-expanded="{{isset($active_post)?'true':'false'}}" data-toggle="collapse" aria-controls="posts">
                        <i class="fa fa-file-text"></i>Posts
                    </a>
                    <ul id="post" class="collapse list-unstyled {{isset($active_post)?'show':''}}" data-parent="#accordion">
                        <li><a href="{{route('post.create')}}">Add New Post</a></li>
                        <li><a href="{{route('post.index')}}">Post List</a></li>
                    </ul>
                </li>
            </div>

        </ul>
    </div>
</div>

