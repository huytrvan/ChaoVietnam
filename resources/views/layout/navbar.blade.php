<header class="w-full border-b-4 border-green-800 md:flex md:justify-between md:items-center md:px-2">
    <div class="flex justify-between p-r8">
        <a href="{{ route('homepage') }}" class="items-center md:flex">
            <svg class="w-8 h-8 text-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg>
            <span class="hidden text-green-800 md:font-bold md:inline md:ml-2">ChaoVietnam.com.vn</span>
        </a>
        <button onclick="toggle()" type="button"
            class="rounded focus:shadow-outline-gray active:shadow-outline-gray md:hidden" id="menu">
            <svg id="menuOpen" class="w-8 h-8 text-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
            <svg id="menuClose" class="hidden w-8 h-8 text-green-900" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <div id="nav" class="hidden md:flex">
        @if (empty(Auth::user()->username))
        <a href="{{ route('user.signin') }}"
            class="flex justify-between p-4 border-t bg-gray-50 md:bg-white md:border-none">
            <div class="flex items-stretch text-center">
                <span>
                    <svg class="w-5 h-5 text-green-900" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd"></path>
                        </path>
                    </svg></span>
                <span class="ml-1 text-green-900">Hello, Sign in</span>
            </div>
            <div class="md:hidden">
                <span>
                    <svg class="w-6 h-6 text-green-900" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </span>
            </div>
        </a>
        <a href="{{ route('user.signup') }}"
            class="block p-4 bg-green-600 border-b text-green-50 border-green-50 md:text-green-700 md:bg-white">
            Sign up <span class="italic text-green-200 md:text-green-500 md:text-sm">(it's free!)</span>
        </a>
        @else
        <div class="md:relative">
            <button onclick="userToggle()"
                class="flex justify-between w-full p-4 border-t bg-gray-50 md:bg-white md:border-none">
                <div class="flex items-stretch text-center ">
                    <span>
                        <svg class="w-5 h-5 text-green-900" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg></span>
                    <span class="ml-1 text-green-900">Hello, {{ Auth::user()->username }}</span>
                </div>
                <div class="">
                    <span>
                        <svg class="w-6 h-6 text-green-900" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </div>
            </button>
            <div id="user"
                class="hidden w-full bg-green-800 text-green-50 md:px-4 md:absolute md:bg-white md:text-green-800 md:top-15 md:shadow md:w-auto">
                <a href="{{ route('user.profile', ['username' => Auth::user()->username ]) }}"
                    class="block px-6 py-4 border-b border-green-50 md:border-none md:px-0.5 md:py-2">
                    My profile
                </a>
                <form action=" {{ route('user.signout') }}" method="POST"
                    class="px-6 border-b border-green-50 md:border-none md:px-0.5 md:w-auto">
                    @csrf
                    <button class="w-full py-4 text-left md:py-2">
                        Sign out
                    </button>
                </form>
            </div>
        </div>
        @if (Auth::user()->is_admin === 1)
        <a href="{{ route('admin.indexPost') }}"
            class="block p-4 bg-green-600 border-b text-green-50 border-green-50 md:text-green-700 md:bg-white">
            Admin Dashboard
        </a>
        @endif
        @endif
        <a href="{{ route('search') }}"
            class="block p-4 bg-green-600 border-b text-green-50 border-green-50 md:text-green-700 md:bg-white">
            Search
        </a>
        <a href=" {{ route('post.create') }}"
            class="block p-4 bg-green-600 text-green-50 md:text-green-700 md:bg-white">
            Create post
        </a>
    </div>
</header>
<script>
    isNavOpen = false;
    isUserOpen = false;

    function toggle() {
        isNavOpen = !isNavOpen;
        if (isNavOpen) {
            nav.classList.remove("hidden");
        } else {
            nav.classList.add("hidden");
        }
    }

    function userToggle() {
        isUserOpen = !isUserOpen;
        if (isUserOpen) {
            user.classList.remove("hidden");
        } else {
            user.classList.add("hidden");
        }
    }

</script>