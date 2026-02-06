<nav class="fixed top-0 z-50 w-full bg-gray-900 border-b border-white/10 shadow-md">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            <div class="flex items-center gap-8">
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-purple-600 text-white rounded-lg flex items-center justify-center font-bold text-lg shadow-lg shadow-purple-500/30">
                        E
                    </div>
                    <span class="font-bold text-white tracking-wide hidden md:block">
                        EventsAccess
                    </span>
                </a>

                <div class="hidden md:flex gap-1">
                    <a href="{{ route('admin.dashboard') }}"
                       class="px-3 py-2 text-sm font-medium rounded-md transition-all duration-200
                       {{ request()->routeIs('admin.dashboard') 
                           ? 'bg-gray-800 text-white shadow-inner' 
                           : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('admin.participants.index') }}"
                       class="px-3 py-2 text-sm font-medium rounded-md transition-all duration-200
                       {{ request()->routeIs('admin.participants*') 
                           ? 'bg-gray-800 text-white shadow-inner' 
                           : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        Participants
                    </a>

                    <a href="#"
                       class="px-3 py-2 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-800 hover:text-white transition-all duration-200">
                        Boutiques
                    </a>
                </div>
            </div>

            <div class="relative flex items-center">
                <button type="button" 
                        onclick="document.getElementById('user-dropdown').classList.toggle('hidden')"
                        class="flex items-center gap-3 text-sm rounded-full focus:outline-none transition-opacity hover:opacity-80">
                    
                    <span class="hidden md:block text-gray-300 font-medium text-right">
                        {{ Auth::user()->name }}
                    </span>

                    <div class="h-9 w-9 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm border-2 border-gray-800 ring-2 ring-white/10">
                        {{ substr(Auth::user()->name, 0, 2) }}
                    </div>
                </button>

                <div id="user-dropdown" class="hidden absolute right-0 top-12 z-50 mt-2 w-56 origin-top-right rounded-xl bg-white py-1 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none animate-fade-in-down">
                    <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50">
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Compte</p>
                        <p class="text-sm font-bold text-gray-900 truncate mt-1">{{ Auth::user()->email }}</p>
                    </div>
                    
                    <div class="py-1">
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors">
                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Mon Profil
                        </a>
                    </div>
                    
                    <div class="py-1 border-t border-gray-100">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors font-medium">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</nav>

<script>
    // Fermeture automatique du menu au clic extérieur
    window.addEventListener('click', function(e) {
        if (!document.getElementById('user-dropdown').contains(e.target) && !e.target.closest('button')) {
            document.getElementById('user-dropdown').classList.add('hidden');
        }
    });
</script>