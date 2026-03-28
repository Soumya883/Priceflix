<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-white uppercase tracking-widest">
            {{ __('Identity Verification') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Status Header -->
            <div class="glass-card p-8 bg-gradient-to-br from-slate-800/50 to-transparent border-white/5 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15l-5-5 1.41-1.41L11 14.17l7.59-7.59L20 8l-9 9z"/></svg>
                </div>
                
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h3 class="text-2xl font-black text-white mb-2 uppercase tracking-tight">Account Status</h3>
                        <p class="text-slate-400 font-medium">Verification is required to unlock higher withdrawal limits and premium features.</p>
                    </div>
                    <div>
                        <span class="px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest border {{ Auth::user()->verification_status === 'verified' ? 'bg-emerald-500/10 border-emerald-500/20 text-emerald-400' : (Auth::user()->verification_status === 'pending' ? 'bg-amber-500/10 border-amber-500/20 text-amber-400' : 'bg-slate-500/10 border-white/10 text-white') }}">
                            {{ Auth::user()->verification_status }}
                        </span>
                    </div>
                </div>
            </div>

            @if(Auth::user()->verification_status !== 'verified')
                <!-- Upload Form -->
                <div class="glass-card p-8">
                    <h3 class="text-lg font-black text-white mb-6 uppercase tracking-widest">Upload New Document</h3>
                    
                    <form action="{{ route('verification.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Document Type</label>
                                <select name="type" class="w-full bg-slate-950/50 border-white/10 rounded-xl text-white font-bold focus:ring-cyan-500 focus:border-cyan-500 py-3 transition-all">
                                    <option value="id_card">National ID Card</option>
                                    <option value="passport">International Passport</option>
                                    <option value="driver_license">Driver's License</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">File Support (JPG, PNG, PDF)</label>
                                <div class="relative group cursor-pointer">
                                    <input type="file" name="document" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" required>
                                    <div class="w-full bg-slate-950/50 border-white/10 border-2 border-dashed rounded-xl p-3 flex items-center justify-center gap-3 group-hover:border-cyan-500/50 transition-all">
                                        <svg class="w-5 h-5 text-slate-500 group-hover:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                        <span class="text-xs font-black text-slate-500 uppercase tracking-widest">Select File</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-black text-sm uppercase tracking-widest shadow-lg shadow-cyan-500/25 hover:shadow-cyan-500/40 transition-all">
                            Submit for Verification
                        </button>
                    </form>
                </div>
            @endif

            <!-- History -->
            @if($documents->count() > 0)
                <div class="glass-card overflow-hidden">
                    <div class="p-4 border-b border-white/5 bg-white/[0.02]">
                        <h3 class="font-black text-white uppercase tracking-widest text-[10px]">Verification History</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left bg-white/[0.01]">
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Type</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Date</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Status</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Details</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5 text-xs">
                                @foreach($documents as $doc)
                                    <tr class="hover:bg-white/[0.02] transition-colors">
                                        <td class="px-6 py-4 font-black text-white uppercase tracking-tight">{{ str_replace('_', ' ', $doc->type) }}</td>
                                        <td class="px-6 py-4 text-slate-400 font-bold uppercase">{{ $doc->created_at->format('M d, Y') }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter {{ $doc->status === 'approved' ? 'bg-emerald-500/10 text-emerald-500' : ($doc->status === 'rejected' ? 'bg-rose-500/10 text-rose-500' : 'bg-amber-500/10 text-amber-500') }}">
                                                {{ $doc->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-slate-500 italic font-medium">
                                            {{ $doc->rejection_reason ?? 'Verified by system' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
