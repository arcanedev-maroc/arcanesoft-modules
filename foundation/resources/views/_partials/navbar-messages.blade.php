<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle no-caret" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
        <div class="status-indicator">
            <i class="far fa-fw fa-envelope"></i>
            <span class="status status-top status-warning"></span>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
        <h6 class="p-3 mb-0">Messages</h6>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item">
            <div class="avatar mr-3">
                {{ html()->image('http://i.pravatar.cc/300') }}
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                <p class="text-muted mb-0">1 Minutes ago</p>
            </div>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item">
            <div class="avatar mr-3">
                {{ html()->image('http://i.pravatar.cc/300') }}
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                <p class="text-muted mb-0">15 Minutes ago</p>
            </div>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item">
            <div class="avatar mr-3">
                {{ html()->image('http://i.pravatar.cc/300') }}
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                <p class="text-muted mb-0">18 Minutes ago</p>
            </div>
        </a>
        <div class="dropdown-divider"></div>
        <h6 class="p-3 mb-0 text-center">4 new messages</h6>
    </div>
</li>
