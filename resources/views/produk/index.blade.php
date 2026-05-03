<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Data Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <h3 class="mb-4 text-lg font-bold">Daftar Produk</h3>

                    <!-- Tabel Data -->
                    <table class="table-auto w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-600">
                                <th class="p-2">No</th>
                                <th class="p-2">Nama Produk</th>
                                <th class="p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Melakukan perulangan untuk setiap data produk dari database -->
                            @foreach($dataProduk as $index => $item)
                            <tr class="border-b border-gray-700">
                                
                                <!-- Menampilkan Nomor Urut -->
                                <td class="p-2">{{ $index + 1 }}</td>
                                
                                <!-- Menampilkan Nama Produk -->
                                <!-- PENTING: Ganti 'nama_produk' di bawah ini dengan nama kolom asli di tabel database kamu -->
                                <td class="p-2">{{ $item->nama_produk }}</td> 
                                
                                <td class="p-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('produk.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded text-sm mr-2 inline-block">
                                        Edit
                                    </a>

                                    <!-- Tombol Delete (Otorisasi: Hanya tampil dan bisa diakses Admin) -->
                                    @can('isAdmin')
                                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>