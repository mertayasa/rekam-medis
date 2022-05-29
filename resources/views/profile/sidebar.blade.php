<div class="col-md-3">
    <ul class="list-group">
        <a class="text-decoration-none" href="{{ route('profile.index') }}">
            <li class="list-group-item {{ Request::is('profile') ? 'bg-light' : '' }}">Biodata</li>
        </a>
        <a class="text-decoration-none" href="{{ route('profile.edit') }}">
            <li class="list-group-item {{ Request::is('profile/edit') ? 'bg-light' : '' }}">Edit Biodata</li>
        </a>
        <a class="text-decoration-none" href="{{ route('profile.edit_password') }}">
            <li class="list-group-item {{ Request::is('profile/edit-password') ? 'bg-light' : '' }}">Edit Password</li>
        </a>
    </ul>
</div>