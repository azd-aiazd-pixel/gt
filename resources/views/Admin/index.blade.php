@extends('layouts.admin')

@section('header')
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Gestion des Participants</h1>
            <p class="text-sm text-gray-500">Gérez les accès et les supports NFC des festivaliers.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1 rounded-full uppercase">
                {{ $participants->total() }} Inscrits
            </span>
        </div>
    </div>
@endsection

@section('content')
<div class="space-y-6">

    <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
        <form action="{{ route('admin.participants.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            
            <div class="md:col-span-2 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Rechercher par nom, email ou code NFC..." 
                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-xl focus:ring-purple-500 focus:border-purple-500 text-sm placeholder-gray-400">
            </div>

            <select name="nfc_filter" class="block w-full py-2 border border-gray-300 rounded-xl focus:ring-purple-500 focus:border-purple-500 text-sm">
                <option value="">Tous les états</option>
                <option value="active" {{ request('nfc_filter') == 'active' ? 'selected' : '' }}>NFC Actifs</option>
                <option value="inactive" {{ request('nfc_filter') == 'inactive' ? 'selected' : '' }}>NFC Inactifs</option>
                <option value="no_tag" {{ request('nfc_filter') == 'no_tag' ? 'selected' : '' }}>Sans NFC</option>
            </select>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded-xl transition-all shadow-sm text-sm">
                    Filtrer
                </button>
                @if(request()->hasAny(['search', 'nfc_filter']))
                    <a href="{{ route('admin.participants.index') }}" class="p-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl transition-all" title="Réinitialiser">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-400 text-[11px] font-black uppercase tracking-widest border-b border-gray-200">
                        <th class="px-6 py-4">Participant</th>
                        <th class="px-6 py-4">État NFC</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($participants as $participant)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-600 font-bold shrink-0">
                                    {{ substr($participant->user->name, 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-bold text-gray-900 leading-none">{{ $participant->user->name }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $participant->user->email }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            @if($participant->nfcTag)
                                <div class="flex flex-col items-start gap-1">
                                    <span @class([
                                        'px-2 py-0.5 rounded-md text-[10px] font-black uppercase border tracking-wider',
                                        'bg-emerald-50 text-emerald-700 border-emerald-100' => $participant->nfcTag->status === \App\Enum\NfcTagStatus::Active,
                                        'bg-gray-100 text-gray-500 border-gray-200'       => $participant->nfcTag->status === \App\Enum\NfcTagStatus::Inactive,
                                    ])>
                                        {{ $participant->nfcTag->status->label() }}
                                    </span>
                                    <span class="text-xs font-mono font-bold text-gray-700 bg-gray-50 px-1.5 py-0.5 rounded border border-gray-100">
                                        {{ $participant->nfcTag->nfc_code }}
                                    </span>
                                </div>
                            @else
                                <span class="inline-flex px-2.5 py-1 rounded-md text-[10px] font-black uppercase bg-amber-50 text-amber-600 border border-amber-100 tracking-wider">
                                    En attente
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.participants.show', $participant) }}" 
                               class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-200 text-xs font-bold text-gray-600 rounded-lg hover:text-purple-600 hover:border-purple-200 hover:shadow-sm transition-all shadow-sm group">
                                <span>Voir Profil</span>
                                <svg class="w-3 h-3 ml-1 text-gray-400 group-hover:text-purple-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="h-12 w-12 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <p class="text-gray-900 font-medium text-sm">Aucun participant trouvé</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($participants->hasPages())
        <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
            {{ $participants->links() }}
        </div>
        @endif
    </div>
</div>
@endsection