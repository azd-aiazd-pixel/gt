@extends('layouts.admin')
@use('App\Enum\NfcTagStatus')
@section('header')
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.participants.index') }}" class="p-2 bg-white border border-gray-200 rounded-xl text-gray-400 hover:text-purple-600 transition-all shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $participant->user->name }}</h1>
            <p class="text-sm text-gray-500 font-medium">Fiche Participant #{{ $participant->id }}</p>
        </div>
    </div>
@endsection

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-wrap gap-3">
        <a href="#" class="inline-flex items-center px-4 py-2.5 bg-purple-600 text-white text-sm font-bold rounded-xl shadow-sm hover:bg-purple-700 transition-all">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Gérer le Portefeuille
        </a>
        <a href="#" class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-200 text-gray-700 text-sm font-bold rounded-xl shadow-sm hover:bg-gray-50 transition-all">
            <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
            Sécurité & NFC
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Informations</p>
            <p class="text-sm font-bold text-gray-900 truncate">{{ $participant->user->email }}</p>
            <p class="text-xs text-gray-500 mt-1">Inscrit le {{ $participant->created_at->format('d/m/Y') }}</p>
        </div>

        <div class="bg-purple-600 p-5 rounded-2xl shadow-md text-white">
            <p class="text-[10px] font-black opacity-70 uppercase tracking-widest mb-1">Solde Disponible</p>
            <p class="text-3xl font-black">{{ number_format($participant->balance, 2) }} <span class="text-xs">DH</span></p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-1 text-center">Total Rechargé</p>
            <p class="text-xl font-black text-center text-gray-900">+{{ number_format($totalRecharged, 2) }} <span class="text-xs font-bold text-gray-400">DH</span></p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-black text-rose-500 uppercase tracking-widest mb-1 text-center">Total Dépensé</p>
            <p class="text-xl font-black text-center text-gray-900">-{{ number_format($totalSpent, 2) }} <span class="text-xs font-bold text-gray-400">DH</span></p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xs font-black text-gray-900 uppercase tracking-wider">État du Bracelet</h3>
                    
                    <div @class([
                        'h-3 w-3 rounded-full',
                        'bg-emerald-500 animate-pulse' => $participant->nfcTag?->status === NfcTagStatus::Active,
                        'bg-gray-400' => $participant->nfcTag?->status === NfcTagStatus::Inactive,
                        'bg-amber-400' => !$participant->nfcTag 
                    ])></div>
                </div>
                
                @if($participant->nfcTag)
                    <div class="bg-gray-50 rounded-xl p-4 border border-dashed border-gray-200 text-center">
                        <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Code NFC Actuel</p>
                        <p class="text-lg font-mono font-black text-purple-700 tracking-tighter">{{ $participant->nfcTag->nfc_code }}</p>
                        
                        <span @class([
                            'inline-block mt-2 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide',
                            'bg-emerald-100 text-emerald-700' => $participant->nfcTag->status === NfcTagStatus::Active,
                            'bg-gray-200 text-gray-600' => $participant->nfcTag->status === NfcTagStatus::Inactive,
                        ])>
                            {{ $participant->nfcTag->status->label() }}
                        </span>
                    </div>
                @else
                    <div class="bg-amber-50 rounded-xl p-4 border border-dashed border-amber-200 text-center">
                        <p class="text-xs font-bold text-amber-600">Aucun bracelet associé</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                    <h3 class="text-xs font-black text-gray-900 uppercase tracking-widest">Activité Récente</h3>
                    <span class="text-[10px] font-bold text-gray-400 bg-white px-2 py-1 rounded-md border border-gray-100 shadow-sm">10 derniers mouvements</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                <th class="px-6 py-4">Date & Heure</th>
                                <th class="px-6 py-4">Type d'opération</th>
                                <th class="px-6 py-4 text-right">Montant</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recentTransactions as $transaction)
                            <tr class="hover:bg-gray-50/30 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="text-xs font-bold text-gray-900">{{ $transaction->created_at->translatedFormat('d M Y') }}</p>
                                    <p class="text-[10px] text-gray-400 uppercase">{{ $transaction->created_at->format('H:i') }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-lg text-[10px] font-black uppercase tracking-tighter border 
                                        {{ $transaction->type->value === 'top up' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 
                                           ($transaction->type->value === 'payment' ? 'bg-purple-50 text-purple-700 border-purple-100' : 'bg-amber-50 text-amber-700 border-amber-100') }}">
                                        {{ $transaction->type->label() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="text-sm font-black {{ $transaction->amount > 0 ? 'text-emerald-600' : 'text-gray-900' }}">
                                        {{ $transaction->amount > 0 ? '+' : '' }}{{ number_format($transaction->amount, 2) }}
                                    </span>
                                    <span class="text-[10px] font-bold text-gray-400 ml-0.5">DH</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center">
                                    <p class="text-sm text-gray-400 italic">Aucune transaction trouvée pour ce participant.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection