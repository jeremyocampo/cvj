<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
            <div class="form-group mb-0">
                
            </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="<?php echo e(asset('argon'), false); ?>/img/theme/team-1-800x800.jpg">
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            
                            <span class="mb-0 text-sm  font-weight-bold"><?php echo e(auth()->user()->name, false); ?><br></span>
                        </div>
                    </div>
                </a>
                
            </li>
        </ul>
    </div>
</nav>