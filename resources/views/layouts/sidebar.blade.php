@if (Auth::user()->email_verified_at != null)
    <div class="col-md-2 mb-3">
        <h5>Master</h5>
        <ul class="list-group">
            <a class="text-decoration-none" href="{{ route('pasien.index') }}">
                <li
                    class="list-group-item {{ Request::is('*pasien*') || Request::is('*rekam-medis*') ? 'bg-light' : '' }}">
                    Pasien</li>
            </a>
            <a class="text-decoration-none" href="{{ route('rekam.edit_implementasi') }}">
                <li
                    class="list-group-item {{ Request::is('*pasien*') || Request::is('*rekam-medis*') ? 'bg-light' : '' }}">Implementasi Keperawatan</li>
            </a>
        </ul>

        <h5 class="mt-4">Biodata</h5>
        <ul class="list-group">
            <a class="text-decoration-none" href="{{ route('profile.index') }}">
                <li class="list-group-item {{ Request::is('profile') ? 'bg-light' : '' }}">Biodata</li>
            </a>
            <a class="text-decoration-none" href="{{ route('profile.edit') }}">
                <li class="list-group-item {{ Request::is('profile/edit') ? 'bg-light' : '' }}">Edit Biodata</li>
            </a>
            <a class="text-decoration-none" href="{{ route('profile.edit_password') }}">
                <li class="list-group-item {{ Request::is('profile/edit-password') ? 'bg-light' : '' }}">Edit Password
                </li>
            </a>
        </ul>
    </div>
@endif
