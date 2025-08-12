@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Manajemen Pengumuman & Event</h1>
            <a href="{{ route('admin.pengumuman.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Buat Baru
            </a>
        </div>

        @include('partials.success_message')

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left ...">Judul</th>
                        <th class="px-6 py-3 text-left ...">Tipe</th>
                        <th class="px-6 py-3 text-left ...">Tgl Event</th>
                        <th class="px-6 py-3 text-right ...">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pengumumanList as $item)
                        <tr>
                            <td class="px-6 py-4 font-medium">{{ $item->judul }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->tipe == 'Event' ? 'bg-indigo-100 text-indigo-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $item->tipe }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->tanggal_event ? \Carbon\Carbon::parse($item->tanggal_event)->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.pengumuman.edit', $item) }}"
                                    class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                <form action="{{ route('admin.pengumuman.destroy', $item) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                Belum ada pengumuman atau event.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
