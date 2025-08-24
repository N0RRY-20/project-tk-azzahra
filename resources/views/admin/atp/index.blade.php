@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Manajemen Alur Tujuan Pembelajaran (ATP)</h1>
            <a href="{{ route('admin.atp.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Tujuan Baru
            </a>
        </div>

        @include('partials.success_message')

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left ...">Urutan</th>
                        <th class="px-6 py-3 text-left ...">Elemen Kurikulum</th>
                        <th class="px-6 py-3 text-left ...">Tujuan Pembelajaran</th>
                        <th class="px-6 py-3 text-right ...">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($atpList as $item)
                        <tr>
                            <td class="px-6 py-4 w-20 text-center">{{ $item->urutan }}</td>
                            <td class="px-6 py-4 font-semibold">{{ $item->elemen_kurikulum }}</td>
                            <td class="px-6 py-4">{{ $item->tujuan_pembelajaran }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.atp.edit', $item) }}"
                                    class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                <form action="{{ route('admin.atp.destroy', $item) }}" method="POST" class="inline"
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
                                Belum ada Alur Tujuan Pembelajaran yang dibuat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
