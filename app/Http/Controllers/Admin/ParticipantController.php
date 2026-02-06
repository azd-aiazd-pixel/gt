<?php
namespace App\Http\Controllers\Admin;
use \App\Enum\NfcTagStatus;

use App\Models\Participant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enum\TransactionType;
use Illuminate\Database\Eloquent\Builder;
class ParticipantController extends Controller
{
 public function index(Request $request)
{
    $query = Participant::with(['user', 'nfcTag']);

    // 1. Recherche Globale (Nom, Email, Code NFC)
    $query->when($request->search, function (Builder $q, $search) {
        $q->where(function ($subQ) use ($search) {
            $subQ->whereHas('user', function ($u) use ($search) {
                $u->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })
            ->orWhereHas('nfcTag', function ($n) use ($search) {
                $n->where('nfc_code', 'like', "%{$search}%");
            });
        });
    });

    // 2. Filtre de Statut Avancé
    $query->when($request->nfc_filter, function (Builder $q, $filter) {
        if ($filter === 'no_tag') {
            // Cas : Pas de bracelet lié du tout
            $q->whereNull('nfc_tag_id');
        } elseif ($filter === 'active') {
            // Cas : Bracelet lié ET statut 'active'
            $q->whereHas('nfcTag', function ($n) {
                $n->where('status', \App\Enum\NfcTagStatus::Active);
            });
        } elseif ($filter === 'inactive') {
            // Cas : Bracelet lié ET statut 'inactive'
            $q->whereHas('nfcTag', function ($n) {
                $n->where('status', \App\Enum\NfcTagStatus::Inactive);
            });
        }
    });

    $participants = $query->latest()->paginate(15)->withQueryString();

    return view('admin.index', compact('participants'));
}



public function show(Participant $participant)
{
    $participant->load(['user', 'nfcTag']);

    // 1. Total Rechargé (Somme des transactions de type 'top up')
    $totalRecharged = $participant->transactions()
        ->where('type', TransactionType::TopUp)
        ->sum('amount');

    // 2. Total Dépensé (Somme des paiements réels 'payment')
    $totalSpent = $participant->transactions()
        ->where('type', TransactionType::Payment)
        ->sum('amount');

    // 3. Total Remboursé (Optionnel, si tu veux l'afficher à part)
    $totalRefunded = $participant->transactions()
        ->where('type', TransactionType::Refund)
        ->sum('amount');

    $recentTransactions = $participant->transactions()->latest()->limit(10)->get();

    return view('admin.show', [
        'participant' => $participant,
        'totalRecharged' => $totalRecharged,
        'totalSpent' => abs($totalSpent), 
        'totalRefunded' => $totalRefunded,
        'recentTransactions' => $recentTransactions
    ]);
}

}
