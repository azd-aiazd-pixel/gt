@extends('layouts.admin')

@section('header')
    <h2 class="text-2xl font-black text-gray-900">Gestion Participant</h2>
    <p class="text-sm text-gray-500">Mise à jour des paramètres et du solde.</p>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <div>
        <a href="{{ route('admin.participants.index') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-purple-600 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Retour
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200 bg-gray-50/50">
            <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest">Configuration du compte</h3>
        </div>

        <form action="{{ route('admin.participants.update', $participant) }}" method="POST" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-purple-50/50 rounded-2xl border border-purple-100">
                <div>
                    <span class="block text-[10px] font-black text-purple-400 uppercase tracking-widest">Participant</span>
                    <span class="text-lg font-bold text-gray-900">{{ $participant->user->name }}</span>
                </div>
                <div>
                    <span class="block text-[10px] font-black text-purple-400 uppercase tracking-widest">Solde Actuel</span>
                    <span class="text-2xl font-black text-purple-600">{{ number_format($participant->balance, 2) }} <span class="text-sm">DH</span></span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label for="nfc_tag_id" class="block text-xs font-black text-gray-700 uppercase tracking-wider">Identifiant NFC (Bracelet)</label>
                    <input type="text" name="nfc_tag_id" id="nfc_tag_id" 
                           value="{{ old('nfc_tag_id', $participant->nfc_tag_id) }}"
                           placeholder="Scan bracelet..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition-all font-mono @error('nfc_tag_id') border-red-500 @enderror">
                    @error('nfc_tag_id') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-3">
                    <label for="recharge_amount" class="block text-xs font-black text-gray-700 uppercase tracking-wider">Rechargement (DH)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-400 font-bold text-sm">DH</span>
                        <input type="number" name="recharge_amount" id="recharge_amount" step="0.01" min="0" placeholder="0.00"
                               class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all font-bold @error('recharge_amount') border-red-500 @enderror">
                    </div>
                    @error('recharge_amount') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-8 border-t border-gray-100 flex justify-end items-center gap-4">
                <a href="{{ route('admin.participants.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">Annuler</a>
                <button type="submit" class="px-8 py-3 bg-purple-600 hover:bg-purple-700 text-white font-black text-sm rounded-xl shadow-lg shadow-purple-200 transition-all transform hover:-translate-y-0.5">
                    Mettre à jour le compte
                </button>
            </div>
        </form>
    </div>
</div>
@endsection