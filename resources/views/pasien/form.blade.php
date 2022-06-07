<div class="row">
    <div class="col-12 mt-2  pb-3 pb-md-0">
        {!! Form::label('nama', 'Nama', ['class' => 'mb-1']) !!}
        {!! Form::text('nama', null, ['class' => 'form-control', 'id' => 'nama']) !!}
    </div>
    <div class="col-12 mt-2  pb-3 pb-md-0">
        {!! Form::label('no_rm', 'No. Rm', ['class' => 'mb-1']) !!}
        {!! Form::text('no_rm', null, ['class' => 'form-control', 'id' => 'no_rm']) !!}
    </div>
    <div class="col-12 mt-2  pb-3 pb-md-0">
        {!! Form::label('jenis_kelamin', 'Jenis Kelamin', ['class' => 'mb-1']) !!}
        {!! Form::select('jenis_kelamin', ['Laki-Laki' => 'Laki-Laki', 'Perempuan' => 'Perempuan'], null, ['class' => 'form-control', 'id' => 'jenis_kelamin']) !!}
    </div>
    <div class="col-12 mt-2  pb-3 pb-md-0">
        {!! Form::label('no_hp', 'No. Handphone', ['class' => 'mb-1']) !!}
        {!! Form::text('no_hp', null, ['class' => 'form-control', 'id' => 'no_hp']) !!}
    </div>
    <div class="col-12 mt-2  pb-3 pb-md-0">
        {!! Form::label('alamat', 'Alamat', ['class' => 'mb-1']) !!}
        {!! Form::text('alamat', null, ['class' => 'form-control', 'id' => 'alamat']) !!}
    </div>
    <div class="col-12 mt-2  pb-3 pb-md-0">
        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                {!! Form::label('tempat_lahir', 'Tempat Lahir', ['class' => 'mb-1']) !!}
                {!! Form::text('tempat_lahir', null, ['class' => 'form-control', 'id' => 'tempat_lahir']) !!}
            </div>
            <div class="col-12 col-md-6">
                {!! Form::label('tanggal_lahir', 'Tanggal Lahir', ['class' => 'mb-1']) !!}
                {!! Form::date('tanggal_lahir', null, ['class' => 'form-control', 'id' => 'tanggal_lahir']) !!}
            </div>
        </div>
    </div>
    <div class="col-12 mt-2  pb-3 pb-md-0">
        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                {!! Form::label('tanggal_masuk', 'Tanggal Masuk', ['class' => 'mb-1']) !!}
                {!! Form::date('tanggal_masuk', null, ['class' => 'form-control', 'id' => 'tanggal_masuk']) !!}
            </div>
            <div class="col-12 col-md-6">
                {!! Form::label('tanggal_keluar', 'Tanggal Keluar (Kosongkan apabila belum keluar)', ['class' => 'mb-1']) !!}
                {!! Form::date('tanggal_keluar', null, ['class' => 'form-control', 'id' => 'tanggal_keluar']) !!}
            </div>
        </div>
    </div>
    <div class="col-12 mt-2  pb-3 pb-md-0">
        {!! Form::label('nama_wali', 'Nama Wali', ['class' => 'mb-1']) !!}
        {!! Form::text('nama_wali', null, ['class' => 'form-control', 'id' => 'nama_wali']) !!}
    </div>
    <div class="col-12 mt-2  pb-3 pb-md-0">
        {!! Form::label('kontak_wali', 'Kontak Wali', ['class' => 'mb-1']) !!}
        {!! Form::text('kontak_wali', null, ['class' => 'form-control', 'id' => 'kontak_wali']) !!}
    </div>
    <div class="col-12 mt-2  pb-3 pb-md-0">
        {!! Form::label('hubungan_wali', 'Kontak Wali', ['class' => 'mb-1']) !!}
        {!! Form::select( 'hubungan_wali',
            [
                'Ayah' => 'Ayah',
                'Ibu' => 'Ibu',
                'Kakek' => 'Kakek',
                'Nenek' => 'Nenek',
                'Kakak' => 'Kakak',
                'Adik' => 'Adik',
                'Lainnya' => 'Lainnya',
            ],
            null,
            ['class' => 'form-control', 'id' => 'hubungan_wali'],
        ) !!}
    </div>
    <div class="col-12 mt-2  pb-3 pb-md-0">
        {!! Form::label('diagnosa_medis', 'Diagnosa Medis', ['class' => 'mb-1']) !!}
        {!! Form::text('diagnosa_medis', null, ['class' => 'form-control', 'id' => 'diagnosa_medis']) !!}
    </div>
</div>