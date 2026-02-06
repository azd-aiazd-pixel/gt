<nav class="bg-white border-b border-gray-200 fixed w-full z-50 top-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <div class="flex">
                <div class="shrink-0 flex items-center font-bold text-indigo-600 text-xl">
                    STORE
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('store.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-500 text-sm font-medium leading-5 text-gray-900 focus:outline-none transition">
                        Vue d'ensemble
                    </a>
                    <a href="#" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-indigo-700 hover:border-gray-300 focus:outline-none transition">
                        Mon Stock
                    </a>
                    <a href="#" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-indigo-700 hover:border-gray-300 focus:outline-none transition">
                        Scanner NFC
                    </a>
                </div>
            </div>

            <div class="flex items-center">
                <span class="text-sm text-gray-500 mr-4">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>