<div>
    {{-- BAGIAN NOTIFIKASI --}}
    @if (session()->has('success'))
        <div class="m-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm flex justify-between items-center rounded-r animate-fade-in-down">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
            <button type="button" class="text-green-700 font-bold hover:text-green-900" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif

    @if (session()->has('import_errors'))
        <div class="m-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 shadow-sm rounded-r">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <p class="font-bold text-sm">Gagal Import (Cek NIM Duplikat):</p>
            </div>
            <ul class="list-disc ml-10 text-xs space-y-1">
                @foreach (session('import_errors') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- SEARCH, FILTER, & ACTIONS SECTION --}}
    <div class="p-6 border-b border-gray-200 bg-white">
        <div class="flex flex-col space-y-6">
        
            {{-- ROW 1: HEADER & ACTIONS --}}
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                
                {{-- JUDUL & ICON (PROFESSIONAL STYLE) --}}
                <div class="flex items-center gap-5">
                    {{-- Kotak Ikon dengan Simbol Kecil --}}
                    <div class="relative flex-shrink-0 w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg shadow-orange-500/20 ring-4 ring-orange-50 border border-white/10">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        {{-- Simbol Kecil Indikator di Kotak Ikon --}}
                        <div class="absolute -top-1 -right-1 flex h-3.5 w-3.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-white flex items-center justify-center border border-orange-100">
                                <span class="h-1.5 w-1.5 rounded-full bg-orange-600"></span>
                            </span>
                        </div>
                    </div>

                    {{-- Text Group --}}
                    <div class="flex flex-col">
                        <h2 class="text-xl font-bold text-gray-900 tracking-tight leading-none">
                            Database Mahasiswa
                        </h2>
                        <p class="text-xs font-medium text-gray-500 mt-1.5 tracking-wide">
                            Kelola data dan informasi akademik
                        </p>
                    </div>
                </div>

                {{-- TOMBOL ACTIONS --}}
                <div class="flex flex-wrap items-center gap-3">                    

                    {{-- IMPORT GROUP --}}
                    <div class="inline-flex items-stretch rounded-xl shadow-sm overflow-hidden border border-emerald-200 bg-white hover:border-emerald-300 transition-all">
                        <div class="relative flex items-center">
                            <input type="file" wire:model="fileImport" id="fileImport" class="hidden" accept=".xlsx,.xls,.csv">
                            <label for="fileImport" class="flex items-center gap-2 px-4 py-2.5 cursor-pointer hover:bg-emerald-50/50 transition-colors group">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-[11px] font-black uppercase text-gray-700">
                                    {{ $fileImport ? 'Selected' : 'File' }}
                                </span>
                            </label>
                        </div>
                        <div class="w-px bg-emerald-200"></div>
                        <button wire:click="import" wire:loading.attr="disabled" class="px-5 py-2.5 bg-emerald-600 text-white text-[11px] font-black hover:bg-emerald-700 active:bg-emerald-800 disabled:bg-gray-300 transition-all uppercase flex items-center gap-2">
                            <span wire:loading.remove wire:target="import">Import</span>
                            <span wire:loading wire:target="import" class="flex items-center gap-2">...</span>
                        </button>
                    </div>

                    {{-- EXPORT GROUP --}}
                    <div class="inline-flex items-stretch rounded-xl shadow-sm overflow-hidden border border-emerald-200 bg-white hover:border-emerald-300 transition-all">
                        <div class="flex items-center gap-2 px-4 py-2.5 bg-emerald-50/30">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="text-[11px] font-black uppercase text-gray-700">Excel</span>
                        </div>
                        <div class="w-px bg-emerald-200"></div>
                        <button wire:click="export" wire:loading.attr="disabled" class="px-5 py-2.5 bg-emerald-600 text-white text-[11px] font-black hover:bg-emerald-700 active:bg-emerald-800 transition-all uppercase">
                            Export
                        </button>
                    </div>

                </div>
            </div>

            {{-- ROW 2: SEARCH & FILTER --}}
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                    <select wire:model.live="filterProdi" class="appearance-none bg-gray-50 border border-gray-300 text-gray-700 py-2.5 pl-4 pr-10 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-orange-500 focus:bg-white outline-none shadow-sm min-w-[200px] cursor-pointer transition-all">
                        <option value="">Semua Program Studi</option>
                        @foreach($program_studi as $prodi)
                            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>

                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari berdasarkan NIM atau Nama Lengkap..." class="block w-full pl-10 pr-10 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-orange-500 focus:bg-white outline-none shadow-sm transition-all">
                    @if($search)
                        <button wire:click="$set('search', '')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-red-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE SECTION --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-separate border-spacing-0">
            <thead>
                <tr class="bg-gray-50/80">
                    <th class="px-6 py-4 text-[11px] font-black text-gray-500 uppercase tracking-widest text-center border-b border-gray-200">Foto</th>
                    <th class="px-6 py-4 text-[11px] font-black text-gray-500 uppercase tracking-widest text-center border-b border-gray-200">NIM</th>
                    <th class="px-6 py-4 text-[11px] font-black text-gray-500 uppercase tracking-widest border-b border-gray-200">Detail Mahasiswa</th>
                    <th class="px-6 py-4 text-[11px] font-black text-gray-500 uppercase tracking-widest text-center border-b border-gray-200">Program Studi</th>
                    <th class="px-6 py-4 text-[11px] font-black text-gray-500 uppercase tracking-widest text-center w-40 border-b border-gray-200">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($mahasiswa as $mhs)
                    <tr class="hover:bg-indigo-50/30 transition-colors duration-150 group">
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($mhs->photo)
                                <img src="{{ asset('storage/' . $mhs->photo) }}" class="w-10 h-10 rounded-full object-cover shadow-sm mx-auto border-2 border-white ring-2 ring-gray-100 group-hover:ring-orange-200 transition-all">
                            @else
                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center border-2 border-white ring-2 ring-gray-100 mx-auto text-gray-400">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-sm font-bold text-gray-700 bg-gray-100 px-2 py-1 rounded-md">{{ $mhs->nim ?? '-' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-extrabold text-gray-900 group-hover:text-orange-600 transition-colors">{{ $mhs->name }}</span>
                                <span class="text-xs text-gray-500">{{ $mhs->email }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-3 py-1 text-[10px] font-black rounded-full bg-blue-50 text-blue-700 border border-blue-100 uppercase tracking-tighter">
                                {{ $mhs->programStudi->nama_prodi ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                {{-- Tombol Cetak PDF Per Mahasiswa --}}
                                <button wire:click="printKTM({{ $mhs->id }})" class="p-2 text-indigo-600 hover:bg-indigo-100 rounded-lg transition-all shadow-sm bg-white border border-gray-100" title="Cetak KTM PDF">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                </button>
                                <a href="{{ route('admin.mahasiswa.edit', $mhs->id) }}" class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-all shadow-sm bg-white border border-gray-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                <button onclick="confirm('Hapus data?') || event.stopImmediatePropagation()" wire:click="deleteMahasiswa({{ $mhs->id }})" class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition-all shadow-sm bg-white border border-gray-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center text-gray-500 italic">Tidak ada data ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="px-6 py-5 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-3">
            <div class="flex items-center px-3 py-1.5 bg-white border border-gray-200 rounded-full shadow-sm text-[11px] font-bold text-gray-500">
                <span class="relative flex h-2 w-2 mr-2"><span class="animate-ping absolute h-full w-full rounded-full bg-emerald-400 opacity-75"></span><span class="relative h-2 w-2 rounded-full bg-emerald-500"></span></span>
                Update: {{ now()->format('H:i') }} WIB
            </div>
        </div>
        <div>{{ $mahasiswa->links() }}</div>
    </div>
</div>