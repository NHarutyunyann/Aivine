<header class="admin-header position-fixed">
    <div class="visit-site-box">
        <a href="/">
            <i class="fas fa-home"> Aivine</i>
        </a>
        <ul class="list">
            <li>
                <a href="/">Visit Site</a>
            </li>
        </ul>
    </div>
    <div class="admin-account-box position-relative">
        <div class="admin-name-box">
            <p>Howdy, Admin</p>
        </div>
        <img loading="lazy"  src="{{asset('/images/aivine/avatar.png')}}" class="admin-image">

        <div class="logout-box position-absolute">
            <div class="logout-box--inner">
<!--                <div class="user-avatar">
                    <img loading="lazy"  src="{{asset('/images/person/avatar.png')}}" class="admin-main-image">
                </div>-->
                <div class="user-info">
                    <p class="name">Admin</p>
                </div>
                <div class="user-actions">
                    <a href="{{route('admin.user.logout')}}" role="button">
                        <span>Log Out</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
