@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title fw-semibold">Manajemen User</h5>
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                <i class="ti ti-plus"></i> Tambah
            </a>
        </div>

        <div class="card-body table-responsive">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th class="fs-2 fw-semibold">No</th>
                        <th class="fs-2 fw-semibold">Nama</th>
                        <th class="fs-2 fw-semibold">Email</th>
                        <th class="fs-2 fw-semibold">Role</th>
                        <th class="fs-2 fw-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="text-center">
                            <td class="fs-2 fw-medium">{{ $loop->iteration }}</td>
                            <td class="fs-2 fw-medium">{{ $user->name }}</td>
                            <td class="fs-2 fw-medium">{{ $user->email }}</td>
                            <td class="fs-2 fw-medium">
                                <span class="badge bg-info">
                                    {{ $user->role->nama_role ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">
                                    <i class="ti ti-edit"></i>
                                </a>

                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus user ini?')">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($users->count() == 0)
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Data user belum tersedia
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
