<header class="bg-gray-700 text-white py-4 px-6 flex justify-between items-center w-full fixed top-0 z-50 shadow-md">
    <div>
        <a href="/" class="text-xl font-bold text-white hover:text-gray-200 transition duration-300">Toko Barang</a>
    </div>
    <div class="flex items-center gap-4">
        <nav>
            <a href="{{ route('kasir') }}" class="px-4 py-2 rounded transition duration-300 border-b-2 border-transparent hover:border-cyan-500 hover:text-white @if(Request::is('kasir')) bo border-cyan-500 text-white  @endif">Kasir</a>
        </nav>
        <nav>
            <a href="/barang" class="px-4 py-2 rounded transition duration-300 border-b-2 border-transparent hover:border-cyan-500 hover:text-white @if(Request::is('barang*')) border-cyan-500 text-white @endif">Kelola Barang</a>
        </nav>
    </div>
    @auth
        <div class="flex items-center">
            <p class="mr-4">{{ auth()->user()->name }}</p>
            <form action="{{ route('logout') }}" method="post" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 rounded transition duration-300 hover:bg-gray-600 hover:text-white text-cyan-500">Logout</button>
            </form>
        </div>
    @else
        <div>
            <a href="{{ route('login') }}" class="px-4 py-2 rounded transition duration-300 hover:bg-gray-600 hover:text-white text-cyan-500">Login</a>
        </div>
    @endauth
</header>
