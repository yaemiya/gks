<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl">
        <div class="flex justify-end mr-20 pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 mt-1 text-gray-800">
                ログインID：{{ Auth::user()->login_id }}
            </div>
            <div>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-logout_button>
                        {{ __('Log Out') }}
                    </x-logout_button>
                </form>
            </div>
        </div>
        <div class="flex justify-center bg-black w-screen text-sm">
            <div class="flex">
                <ul class="dropdwn_menu">
                    <li><a href="#">マスタ</a>
                        <ul class="sub2">
                            <li><a href="#">施設</a>
                                <ul class="sub2">
                                    <li><a href="/su">仕入業者</a></li>
                                    <li><a href="#">工場</a></li>
                                    <li><a href="#">店舗</a></li>
                                </ul>
                            </li>
                            <li><a href="#">商品</a>
                                <ul class="sub2">
                                    <li><a href="#">仕入品</a></li>
                                    <li><a href="#">加工品</a></li>
                                    <li><a href="#">メニュー</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">仕入</a>
                        <ul class="sub2">
                            <li><a href="#">工場</a></li>
                            <li><a href="#">店舗</a></li>
                        </ul>
                    </li>
                    <li><a href="#">売上</a>
                        <ul class="sub2">
                            <li><a href="#">工場</a></li>
                            <li><a href="#">店舗</a></li>
                        </ul>
                    </li>
                    <li><a href="/account">アカウント</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
