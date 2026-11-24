@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; flex-wrap:wrap; gap:10px;">
        <div>
            <h1>Clients</h1>
            <p style="color:#777;">Kelola logo dan data klien.</p>
        </div>

        <a href="{{ route('admin.clients.create') }}"
           style="background:#556B2F; color:white; padding:10px 18px; border-radius:8px; text-decoration:none;">
            + Tambah Client
        </a>
    </div>

    @if(session('success'))
        <div style="background:#d1fae5; color:#065f46; padding:15px; border-radius:8px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background:white; padding:20px; border-radius:12px; overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; min-width:700px;">
            <thead>
                <tr style="border-bottom:1px solid #eee; text-align:left;">
                    <th style="padding:12px;">Logo</th>
                    <th style="padding:12px;">Nama Client</th>
                    <th style="padding:12px;">Website</th>
                    <th style="padding:12px;">Status</th>
                    <th style="padding:12px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($clients as $client)
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:12px;">
                            @if($client->logo)
                                <img src="{{ asset('storage/'.$client->logo) }}"
                                     alt="Logo {{ $client->name }}"
                                     style="width:80px; height:60px; object-fit:contain;">
                            @else
                                <span style="color:#999;">No Logo</span>
                            @endif
                        </td>

                        <td style="padding:12px;">
                            {{ $client->name }}
                        </td>

                        <td style="padding:12px;">
                            @if($client->website)
                                <a href="{{ $client->website }}"
                                   target="_blank"
                                   rel="noopener noreferrer">
                                    {{ $client->website }}
                                </a>
                            @else
                                -
                            @endif
                        </td>

                        <td style="padding:12px;">
                            @if($client->is_active)
                                <span style="background:#d1fae5; color:#065f46; padding:5px 10px; border-radius:20px;">
                                    Aktif
                                </span>
                            @else
                                <span style="background:#eee; color:#666; padding:5px 10px; border-radius:20px;">
                                    Tidak Aktif
                                </span>
                            @endif
                        </td>

                        <td style="padding:12px;">
                            <div style="display:flex; gap:8px; flex-wrap:wrap;">
                                <a href="{{ route('admin.clients.edit', $client->id) }}"
                                   style="background:#e8e3d5; color:#333; padding:7px 12px; border-radius:6px; text-decoration:none;">
                                    Edit
                                </a>

                                <form action="{{ route('admin.clients.destroy', $client->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus client ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        style="background:#dc2626; color:white; padding:7px 12px; border:none; border-radius:6px; cursor:pointer;">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:30px; text-align:center; color:#777;">
                            Belum ada data client.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:20px;">
            {{ $clients->links() }}
        </div>
    </div>
</div>
@endsection