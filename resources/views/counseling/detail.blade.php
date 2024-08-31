@extends('layout.main')
@section('container')
    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: center; align-items: center; overflow: auto; white-space: nowrap; margin-top: 10vh;">
        <div style="width: 40vw; height: 75vh; border: #1a202c solid 1px; border-radius: 7px; padding: 10px; display: flex; flex-direction: column; justify-content: start; align-items: center; gap: 20px">
            <h4>Detail Konsultasi</h4>
            <div style="display: flex; flex-direction: row; justify-content: center; gap: 7px">
                <div style="display: flex; flex-direction: column; width: 10vw">
                    <p>Nama Siswa</p>
                    <p>Nama Guru</p>
                    <p>Kelas</p>
                    <p>Tanggal</p>
                    <p>Tempat</p>
                    <p>Jenis Layanan</p>
                    <p>Kategori</p>
                    <p>Status</p>
                    <p>Catatan</p>
                </div>
                <div style="display: flex; flex-direction: column; width: 20vw">
                    <p>: {{ optional($counseling->Student)->name ?? 'No Student' }}</p>
                    <p>: {{ $mentors->name ?? 'No Teacher' }}</p>
                    <p>: {{ optional($counseling->Grade)->grade_name ?? 'No Grade' }}</p>
                    <p>: {{ \Carbon\Carbon::parse($counseling->counseling_date)->format('F d, Y') }}</p>
                    <p>: {{ $counseling->place ?? 'Belum Menentukan Tempat' }}</p>
                    <p>: {{ $counseling->service ?? 'No Service' }}</p>
                    <p>: {{ $counseling->subject ?? 'No Category' }}</p>
                    <p>: {{ optional($counseling->Status)->status ?? 'No Status' }}</p>
                    <p style="overflow: auto">: {{ $counseling->note ?? 'Belum ada Catatan' }}</p>
                </div>
            </div>
            <a href="/admin/counseling" class="btn btn-outline-secondary px-4">< Back</a>
        </div>
    </div>
@endsection
